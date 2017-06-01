define(['streamhub-sdk/jquery', 'streamhub-sdk/content', 'inherits'], function($, Content, inherits) {
    'use strict';

    /**
     * Base class for any piece of Livefyre content. Extracts the details of the content
     * from the json object passed in via the Livefyre stream.
     * @param json {Object} An object obtained via a Livefyre stream that represents the
     *        state of the content.
     * @exports streamhub-sdk/content/types/livefyre-content
     * @constructor
     */
    var LivefyreContent = function(json) {
        Content.call(this);
        if ( ! json) {
            return this;
        }
        this.body = json.content.bodyHtml || "";
        this.source = LivefyreContent.SOURCES[json.source];
        this.id = json.content.id;
        this.author = json.author;
        this.createdAt = new Date(1000 * json.content.createdAt);
        this.updatedAt = new Date(1000 * json.content.updatedAt);
        this.visibility = json.vis;
        this.parentId = json.content.parentId;
        this.meta = json;
        this._annotations = json.content.annotations;
    };
    inherits(LivefyreContent, Content);

    /**
     * Attach an Oembed to the Content while first checking for an existing attachment.
     * @param obj {Oembed} An Oembed Content instance to attach
     * @fires Content#addAttachment
     */
    LivefyreContent.prototype.addAttachment = function(obj) {
        var found = false;
        if (obj.id) {
            for (var i in this.attachments) {
                if (this.attachments[i].id === obj.id) {
                    found = true;
                }
            }
        }
        if (!found) {
            this.attachments.push(obj);
            this.emit('attachment', obj);
        }
    };

    /**
     * Add a reply to the Content while first checking for an existing reply.
     * @param obj {Content} A piece of Content in reply to this one
     * @fires Content#addReply
     */
    LivefyreContent.prototype.addReply = function(obj) {
        var found = false;
        if (obj.id) {
            for (var i in this.replies) {
                if (this.replies[i].id === obj.id) {
                    found = true;
                }
            }
        }
        if (!found) {
            this.replies.push(obj);
            this.emit('reply', obj);
        }
    };

    /**
     * Return whether this Content is featured in a StreamHub Collection
     * @return {boolean}
     */
    LivefyreContent.prototype.isFeatured = function () {
        var featuredAnnotation = this._annotations && this._annotations.featuredmessage;
        return Boolean(featuredAnnotation);
    };

    /**
     * Return the featured value for this Content, if it is featured
     * @return {Number|undefined} The featured value, if featured, else undefined
     */
    LivefyreContent.prototype.getFeaturedValue = function () {
        var featuredAnnotation = this._annotations && this._annotations.featuredmessage;
        return featuredAnnotation ? featuredAnnotation.value : undefined;
    };

    /**
     * The set of sources as defined by Livefyre's Stream API
     */
    LivefyreContent.SOURCES = [
        "livefyre",
        "twitter",
        "twitter",
        "facebook",
        "livefyre",
        "livefyre",
        "facebook",
        "twitter",
        "livefyre",
        "unknown",
        "unknown",
        "unknown",
        "unknown",
        "feed",
        "facebook"
    ];

    return LivefyreContent;
});
