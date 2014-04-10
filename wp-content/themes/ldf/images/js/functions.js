
( function( $ ) {
	var body    = $( 'body' ),
	    _window = $( window );

	/**
	 * Adds a top margin to the footer if the sidebar widget area is higher
	 * than the rest of the page, to help the footer always visually clear
	 * the sidebar.
	 */

var jRes = jRespond([
   {
        label: 'desktop',
        enter: 1000,
        exit: 1002
    }
]);
jRes.addFunc({
    breakpoint: 'desktop',
    enter: function() {
        alert('desktop enter')
    },
    exit: function() {
               alert('desktop exit')

    }
});


	$( function() {




		console.log('/-)\'s ready');
		body.addClass('loaded');

		
		var settings = {
		contentWidth :600
		};
		$('.scroll-pane').jScrollPane(settings);
		// http://jscrollpane.kelvinluck.com/settings.html

		$(".thema-toggle").on( 'click', function() {
			$(".menu-menu-thematiques-container").toggleClass('active');
		});


		$('#tz').tilezoom({	
				xml: 'http://lignesdefront.dev:8888/dest/ldf.xml',
				mousewheel: true,
				navigation: null,
				zoomIn: '#plus',
				zoomOut: '#minus',
				goHome: '#home'
			});
		//?? je sais pas, doc pas claire.. $('#tz').tilezoom('zoom',2 )

		$(".lang_select").on( 'click', function() {
			$(".lang").addClass('active_lang');
		});
		$(".lang").on( 'click', function() {
			$(".lang").removeClass('active_lang');
			$(this).addClass('active_lang');
		});

		

		
	} );



	/**
	 * Makes "skip to content" link work correctly in IE9 and Chrome for better
	 * accessibility.
	 *
	 * @link http://www.nczonline.net/blog/2013/01/15/fixing-skip-to-content-links/
	 */
	_window.on( 'hashchange.twentythirteen', function() {
		var element = document.getElementById( location.hash.substring( 1 ) );

		if ( element ) {
			if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) )
				element.tabIndex = -1;

			element.focus();
		}
	} );

	/**
	 * Arranges footer widgets vertically.
	 */
	
} )( jQuery );