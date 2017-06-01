define([
    'inherits',
    'stream/readable',
    'stream/util',
    'streamhub-sdk/collection/clients/bootstrap-client',
    'streamhub-sdk/collection/clients/stream-client',
    'streamhub-sdk/content/state-to-content',
    'streamhub-sdk/debug'],
function (inherits, Readable, streamUtil, BootstrapClient, StreamClient,
StateToContent, debug) {
    'use strict';


    var log = debug('streamhub-sdk/collection/streams/updater');


    /**
     * A Readable Stream to access streaming updates in a StreamHub Collection
     * @param opts {object}
     * @param opts.network {string} The StreamHub Network of the Collection
     * @param opts.siteId {string} The Site ID of the Collection
     * @param opts.articleId {string} The Article ID of the Collection
     * @param [opts.environment] {string} Which StreamHub Cluster the Collection
     *     resides on (e.g. t402.livefyre.com for UAT)
     * @param [opts.streamClient] {LivefyreStreamClient} A Client object that
     *     can request StreamHub's Stream web service
     * @param [opts.bootstrapClient] {LivefyreBootstrapClient} A Client object
     *     that can request StreamHub's Bootstrap web service
     */
    var CollectionUpdater = function (opts) {
        opts = opts || {};
        this._collection = opts.collection;
        this._streamClient = opts.streamClient || new StreamClient();
        this._request = null;
        Readable.call(this, opts);
    };

    inherits(CollectionUpdater, Readable);


    /**
     * Called by Readable base class on .read(). Do not call directly.
     * Get content from bootstrap and .push() onto the read buffer
     * @private
     */
    CollectionUpdater.prototype._read = function () {
        var self = this;
        log('_read', 'Buffer length is ' + this._readableState.buffer.length);

        if ( ! this._latestEvent || ! this._collection.id) {
            // Get the latest event and/or collection ID by initing
            // the collection from bootstrap
            return this._collection.initFromBootstrap(function (err, initData) {
                var collectionSettings = initData.collectionSettings,
                    latestEvent = collectionSettings && collectionSettings.event;
                if ( ! self._collection.id) {
                    throw new Error("Couldn't get Collection ID after initFromBootstrap");
                }
                if (latestEvent === undefined) {
                    throw new Error("Couldn't get latestEvent after initFromBootstrap");
                }
                self._latestEvent = latestEvent;
                self._stream();
            });
        }

        self._stream();
    };


    /**
     * Make the next stream request to get more data since the last seen event
     * @private
     */
    CollectionUpdater.prototype._stream = function () {
        var self = this,
            streamClient = this._streamClient,
            streamClientOpts = this._getStreamClientOptions();

        var request = streamClient.getContent(streamClientOpts, function (err, data) {
            if (err === 'abort') {
                log('stream request aborted');
                self.push();
                return;
            }
            if (err) {
                return self.emit('error', err);
            }
            if (data.timeout) {
                // Timed out on the long poll. This just means there
                // was no real-time data. So we should keep streaming
                // on the next event loop tick
                log('long poll timeout, requesting again on next tick');
                return pollAgain();
            }
            var contents = self._contentsFromStreamData(data);
            // Update _latestEvent so we only get new data
            self._latestEvent = data.maxEventId;

            if (contents.length) {
                self.push.apply(self, contents);
                // _read will get called again when more data is needed
            } else {
                return pollAgain();
            }

            function pollAgain() {
                // Push nothing for now.
                self.push();
                // But trigger another _read cycle ASAP
                // This gives the internals a chance to check paused state
                streamUtil.nextTick(function () {
                    self.read(0);
                });
            }
        });

        this._request = request;
    };


    /**
     * Pause the Updater
     * Including killing the active stream request
     */
    CollectionUpdater.prototype.pause = function () {
        if (this._request) {
            this._request.abort();
            this._request = null;
        }
        return Readable.prototype.pause.apply(this, arguments);
    };


    /**
     * Convert a response from the Stream service into Content models
     * @private
     * @param streamData {object} A response from the Stream service
     * @return {Content[]} An Array of Content models
     */
    CollectionUpdater.prototype._contentsFromStreamData = function (streamData) {
        var states = streamData.states,
            stateToContent = new StateToContent(streamData),
            state,
            contents = [];

        stateToContent.on('data', function (content) {
            contents.push(content);
        });

        for (var contentId in states) {
            if (states.hasOwnProperty(contentId)) {
                state = states[contentId];
                stateToContent.write(state);
            }
        }

        return contents;
    };


    /**
     * Get an Object that can be passed to LivefyreStreamClient to get new
     * data
     * @private
     * @return {object}
     */
    CollectionUpdater.prototype._getStreamClientOptions = function () {
        return {
            collectionId: this._collection.id,
            network: this._collection.network,
            commentId: this._latestEvent
        };
    };


    return CollectionUpdater;
});