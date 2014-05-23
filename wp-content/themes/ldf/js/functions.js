


(function( $ ) {
	var body    = $( 'body' ),
	    _window = $( window );

	/**
	 * Adds a top margin to the footer if the sidebar widget area is higher
	 * than the rest of the page, to help the footer always visually clear
	 * the sidebar.
	 */


	(function ($, F) {
		F.transitions.resizeIn = function() {
			var previous = F.previous,
			    current  = F.current,
			    startPos = previous.wrap.stop(true).position(),
			    endPos   = $.extend({opacity : 1}, current.pos);

			startPos.width  = previous.wrap.width();
			startPos.height = previous.wrap.height();

			previous.wrap.stop(true).trigger('onReset').remove();

			delete endPos.position;

			//current.inner.hide();

			current.wrap.css(startPos).animate(endPos, {
			    duration : current.nextSpeed,
			    easing   : current.nextEasing,
			    step     : F.transitions.step,
			    complete : function() {
			        F._afterZoomIn();

			        current.inner.fadeIn("fast");
			    }
			});
		};

	}(jQuery, jQuery.fancybox));


	$( function() {

		//alert(body.height())
		var settings = {
			//contentWidth :'600px'
		};
  		
	
		$("#main").css('height', body.height()-130)
		$("#main").css('marginTop', 80)

		$(".thema-toggle").on( 'click', function() {
				$(".nav-toggle").toggleClass('active');

				if( $(".nav-toggle").hasClass('active') ){
					$('.thema-toggle span').text('∧');
				}else{
					$('.thema-toggle span').text('∨');
				};
		});
	
		body.addClass('loaded');
		/*

				$('#tz').tilezoom({	
						xml: 'http://lignesdefront.hear.fr/dest/ldf.xml',
						mousewheel: true,
						navigation: null,
						zoomIn: '#plus',
						zoomOut: '#minus',
						goHome: '#home'
					});
				//?? je sais pas, doc pas claire.. $('#tz').tilezoom('zoom',2 )
		*/


		// lang selectors
		var langmenu = false;

	    $('.langselector .selector').click(function (event) {

	        if (!langmenu) {
	            $(this).text('<');
	            $('.langselector a').show('fast');
	        } else {
	            $(this).text('>');
	            $('.langselector a').hide('fast');
	        }
	        langmenu = !langmenu;
	    });


	    $("#content").fitVids();



	    // rotation du logo
		$angle = 0;
		$decalage = -30;

		// on calcule le nombre de jour de guerre
		$warDuration = Math.round( (new Date('1918-10-11') - new Date('1914-08-03') ) /(1000*60*60*24) );
		// on calcule le nombre de degrés par jours
		$degreePerDay = 180/$warDuration;
		// on calcule les degrés du jour à afficher
		$todayDegree =  Math.round( (new Date() - new Date('2014-08-03') ) /(1000*60*60*24) ) * $degreePerDay;

		// on ne va pas en dessous de zero
		if($todayDegree < 0){
			$todayDegree = 0;
		}else
		// ni au dessus de 180
		if($todayDegree > 180){
			$todayDegree = 180;
		}
		$todayDegree = $todayDegree/*+Math.random(1,55)*/ + $decalage;
		// on fait tourner le logo en consÃ©quence (Ã  chaque chargement de page)
		$('.head-box #logo').css('-webkit-transform','rotate('+$todayDegree+'deg)');
		$('.head-box #logo').css('-moz-transform','rotate('+$todayDegree+'deg)');

		// POUR TESTE LA ROTATION
		//var test = setInterval( tourne, 60);


		// uniquement pour tester
		function tourne(obj_class){
			$angle += 0.1;
			$angle = $angle%360;   
	        $(obj_class).css( '-moz-transform','rotate(156deg)');
	       	$(obj_class).css( '-webkit-transform','rotate(156deg)');

		}
		//tourne('.head-box #logo')
		//
		
		// Pour appliquer fancy box sur toutes les galleries qui ne pointent pas vers la page media
		$(".gallery").each(function(){

			$("a[href$='.jpg'], a[href$='.jpeg'], a[href$='.png'], a[href$='.gif']", this)
			.attr('rel', $(this).attr('id') )
			.data('fancybox-group', $(this).attr('id'))
			.addClass('fancybox-buttons');

		})

		
		/**
		 *
		 * GESTION DE LA GALERIE
		 * avec fancybox
		 * 
		 */
		
		$('.gallery figure').each(function(){
			$('a', this).attr('title', $('figcaption', this).html() );
		})

		$('.fancybox-buttons').fancybox({
			nextMethod : 'resizeIn',
			nextSpeed  : 250,
			prevMethoc : false,
			wrapCSS    : 'fancybox-custom',
			closeBtn  : true,
			arrows : false,
			loop : false,
			margin:28,
			padding : 0,
			helpers : {
				title : {
					type : 'inside'
				},
			},
			afterLoad : function() {
				this.title = '<div class="legend"><strong>'+(this.index + 1) + ' / ' + this.group.length +'</strong>'+ (this.title ? ' — ' + this.title : '')+'</div>'+
				'<div class="nav">'+
				'<a title="Previous" class="prev" href="javascript:;"><span>Prev</span></a>'+
				'<a title="Next" class="next" href="javascript:;"><span>Next</span></a>'+
				'</div>';
			},
			afterShow : function(){
				$('.next').click(function(event){
					$.fancybox.next();
				});
				$('.prev').click(function(event){
					$.fancybox.prev();
				});

				if(this.index == 0){
					console.log('premier');
					$('a.prev span').css('visibility','hidden');
				}
				if(this.index == this.group.length - 1){
					console.log('dernier');
					$('a.next span').css('visibility','hidden');
				}
			},
		});


	} );



	


	// responsive

	$isScrollBar = false;

	var jRes = jRespond([
	    {
	        label: 'handheld',
	        enter: 0,
	        exit: 699
	    },{
	        label: 'tablet',
	        enter: 700,
	        exit: 991
	    },{
	        label: 'laptop',
	        enter: 992,
	        exit: 1199
	    },{
	        label: 'desktop',
	        enter: 1200,
	        exit: 10000
	    }
	]);

	jRes.addFunc([
	    {
	        breakpoint: 'desktop',
	        enter: function() {
	            myInitFuncDesktop();
	        },
	        exit: function() {
	            myUnInitFuncDesktop();
	        }
	    },{
	        breakpoint: 'laptop',
	        enter: function() {
	            myInitFuncLaptop();
	        },
	        exit: function() {
	            myUnInitFuncLaptop();
	        }
	    },{
	        breakpoint: 'tablet',
	        enter: function() {
	            myInitFuncTablet();
	        },
	        exit: function() {
	            myUnInitFuncTablet();
	        }
	    },{
	        breakpoint: 'handheld',
	        enter: function() {
	            myInitFuncHandHeld();
	        },
	        exit: function() {
	            myUnInitFuncHandHeld();
	        }
	    }
	]);


	function myInitFuncDesktop(){
		console.log('enter Desktop');
		activateScroll();
	}
	function myUnInitFuncDesktop(){
		console.log('leave Desktop');
	}
	function myInitFuncLaptop(){
		console.log('enter Laptop');
		activateScroll();
	}
	function myUnInitFuncLaptop(){
		console.log('leave Laptop');
	}
	function myInitFuncTablet(){
		console.log('enter Tablet');
		activateScroll();
	}
	function myUnInitFuncTablet(){
		console.log('leave Tablet');
		
	}
	function myInitFuncHandHeld(){
		console.log('enter HandHeld');
		if($isScrollBar){
			$(".scrollBar").mCustomScrollbar("destroy");
			$isScrollBar = false;
		}
	}
	function myUnInitFuncHandHeld(){
		console.log('leave HandHeld');
	}

	// cf http://manos.malihu.gr/jquery-custom-content-scroller/
	function activateScroll(){

		if(!$isScrollBar){
			$(".scrollBar").mCustomScrollbar({
				scrollInertia : 400,
				scrollButtons:{
					enable:false
				},
				advanced:{
				    updateOnBrowserResize: true
				},
				theme: 'LDF',
				callbacks:{
					onTotalScrollBack:function(){
						console.log("scrolled back to the beginning of content.");
					}
				}		
			});

			$('#content img').load(function(){
				$(".scrollBar").mCustomScrollbar("update");
			});

			$isScrollBar = true;
		}
	}


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


	
} )( jQuery );



