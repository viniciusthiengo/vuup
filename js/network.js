if(window.opener){
	window.opener.location.reload();
	window.close();
}
$(document).on('click', '#fb-button, #gl-button', function(e){
	e.preventDefault();
	
	if($(this).attr('id') == 'fb-button'){
		newwindow = window.open($(this).attr('href'),'Facebook Login','height=500,width=500');
	}
	else if($(this).attr('id') == 'gl-button'){
		newwindow = window.open($(this).attr('href'),'Google+ Login','height=500,width=500');
	}
});