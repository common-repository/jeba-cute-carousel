(function() {
	tinymce.PluginManager.add('jeba_carousel_button_carousel', function( editor, url ) {
		editor.addButton('jeba_carousel_button_carousel', {
			text: 'JCarousel',
			icon: false,
			onclick: function() {
				editor.insertContent('[jeba_carousel post_type="jeba-carousel" id="jeba3" count="5"]');
			}
		});
	});
})();