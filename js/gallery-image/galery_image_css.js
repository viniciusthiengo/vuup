// galery_image_capixi_css.js
// This file is only required to run some of the demos.
function setupDemos() {
	$('div.box-intern-photos').each(function(){
		var parent = $(this).parents('div.event-intern').attr('id').replace(/[^\d]/g, '');
		Shadowbox.setup('a.photos-'+parent, {
			gallery:        'box-photos-'+parent,
			continuous:     true,
			counterType:    'skip',
			allowFullScreen: "true"
		});
	});
	Shadowbox.setup("a.photo", {
		gallery: 'box-img-photos',
		continuous: true,
		counterType: 'skip',
		allowFullScreen: "true"
	});
}