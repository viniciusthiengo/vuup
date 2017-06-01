// FACEBOOK
var postToFacebook;
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1&appId=657926134229159";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
window.fbAsyncInit = function(){
	// init the FB JS SDK
	FB.init({
		appId: '657926134229159',                        // App ID from the app dashboard
		status: true,                                 // Check Facebook Login status
		xfbml: true                                  // Look for social plugins on the page
	});
	// EVENTS
		FB.Event.subscribe('edge.create',
			function(href, widget) { getfbcount(href, postToFacebook); }
		);
		FB.Event.subscribe('edge.remove',
			function(href, widget) { getfbcount(href, postToFacebook); }
		);
		FB.Event.subscribe('comment.create',
			function(href, widget) { getfbcommentscount(href, postToFacebook, 1); }
		);
		FB.Event.subscribe('comment.remove',
			function(href, widget) { getfbcommentscount(href, postToFacebook); }
		);
};

function getfbcount(url, post){
	var likes;
	postToFacebook = post;
	$.getJSON('http://graph.facebook.com/?ids='+url, function(data){
		likes = Number(data[url].shares);
		likes = /^[\d]{1,}$/.test(likes) ? likes : 0;
		if(likes > 0){
			$.ajax({
				url: 'package/ctrl/CtrlPost.php',
				type: 'post',
				dataType: 'html',
				data: {
					'method': 'update-likes-facebook',
					'post': post,
					'likes': likes
				}
			});
		}
	});
}
function getfbcommentscount(url, post, isCommented){
	var comments;
	url = typeof url == 'object' ? url.href : url;
	postToFacebook = post;
	$.getJSON('http://graph.facebook.com/?ids='+url, function(data){
		comments = Number(data[url].comments);
		comments = /^[\d]{1,}$/.test(comments) ? comments : 0;
		if(comments > 0){
			$.ajax({
				url: 'package/ctrl/CtrlPost.php',
				type: 'post',
				dataType: 'html',
				data: {
					'method': 'update-comments-facebook',
					'post': post,
					'comments': comments,
					'is-commented': isCommented
				}
			});
		}
	});
}