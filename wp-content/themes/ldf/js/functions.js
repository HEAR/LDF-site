
( function( $ ) {
	var body    = $( 'body' ),
	    _window = $( window );

	/**
	 * Adds a top margin to the footer if the sidebar widget area is higher
	 * than the rest of the page, to help the footer always visually clear
	 * the sidebar.
	 */






	$( function() {


			//alert(body.height())
			var settings = {
				//contentWidth :'600px'
			};
      		
    	
			$("#main").css('height', body.height()-130)
			$("#main").css('marginTop', 80)

			$(".thema-toggle").on( 'click', function() {
					$(".nav-toggle").toggleClass('active');
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
		$(".lang_select").on( 'click', function() {
			$(".lang").toggleClass('visible_lang');
			$(".lang_select").toggleClass('toggled')
		});


		$(".lang").on( 'click', function() {
			$(".lang").toggleClass('visible_lang');
			$(".lang").removeClass('active_lang');
			$(this).addClass('active_lang');
			$(this).addClass('visible_lang');
			$(".lang_select").removeClass('toggled')

		});


		function loadPageVar (sVar) {
  			return decodeURI(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + encodeURI(sVar).replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));
		}
		var lang_get = loadPageVar("lang");
		if(lang_get){
			

					$("."+lang_get).addClass('active_lang');

			$("."+lang_get).addClass('visible_lang');

		}
		else{
			$(".fr").addClass('active_lang');
			$(".fr").addClass('visible_lang');

		}







		$angle = 0;

		// on calcule le nombre de jour de guerre
		$warDuration = Math.round( (new Date('1918-10-11') - new Date('1914-08-03') ) /(1000*60*60*24) );
		// on calcule le nombre de degrÃ©s par jours
		$degreePerDay = 180/$warDuration;
		// on calcule les degrÃ©s du jour Ã  afficher
		$todayDegree =  Math.round( (new Date() - new Date('2014-08-03') ) /(1000*60*60*24) ) * $degreePerDay;

		// on ne va pas en dessous de zero
		if($todayDegree < 0){
			$todayDegree = 0;
		}else
		// ni au dessus de 180
		if($todayDegree > 180){
			$todayDegree = 180;
		}
		$todayDegree = $todayDegree+Math.random(1,55)
		// on fait tourner le logo en consÃ©quence (Ã  chaque chargement de page)
		$('.head-box h1').css('-webkit-transform','rotate('+$todayDegree+'deg)');
		$('.head-box h1').css('-moz-transform','rotate('+$todayDegree+'deg)');

		// POUR TESTE LA ROTATION
		//var test = setInterval( tourne, 60);


		// uniquement pour tester
		function tourne(obj_class){
			$angle += 0.1;
			$angle = $angle%360;   
	        $(obj_class).css( '-moz-transform','rotate(156deg)');
	       	$(obj_class).css( '-webkit-transform','rotate(156deg)');

		}
		//tourne('.head-box h1')

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








// QUAND ON CLIQUE SUR UN LIEN D'UNE GALLERIE
		$('.gallery a').each(function(){
			$(this).click(function(event){

				// on prépare le viewer
				$('body').append('<div class="overlay"></div>'+
					'<div class="viewer">'+
					'<div class="close">X</div>'+
					'<ul class="bxslider"></ul>'+
					'<div class="navigation">'+
					'<div class="arrow"><span id="slider-prev" class="bouton"></span> <span id="slider-next" class="bouton"></span></div>'+
					'<p class="legend"></p>'+
					'</div>');

				var listeImages = '';

				var gallerieID =  '#'+$(this).parent().parent().parent().attr('id') ;

				$(gallerieID+' a').each(function(){
					var li = $('<li>').append(
						$('<img>')
						.attr( "src" , $(this).attr("href") ) 
						.attr( "title" , $(this).attr("title") ) 
					);
					$('.bxslider').append(li);
				});

				var selectedID = $(this).parent().parent().index(gallerieID+' .gallery-item');

				slider(selectedID);

				event.preventDefault();

			});

		});

		function slider( selectedID ){
			$slider = $('.bxslider').bxSlider({
				speed: 150,
				mode: 'horizontal',
				pager: false,
				startSlide: selectedID,
				adaptiveHeight: true,
				infiniteLoop:false,
				nextSelector: '#slider-next',
				prevSelector: '#slider-prev',
				nextText: '>',
				prevText: '<',
				onSliderLoad: function(index){
					// on affiche la légende
					// et on adapte la dimension verticale si nécessaire
					legendAndSize(index);
				},
				onSlideBefore: function($slideElement, oldIndex, index){
					// on affiche la légende
					// et on adapte la dimension verticale si nécessaire
					legendAndSize(index);
				},
			});

			// on active les touches clavier
			$(document).keydown(function(event){
				if(event.which == 39){
					//console.log('flêche droite');
					$slider.goToNextSlide();
				}
				if(event.which == 37){
					//console.log('flêche gauche');
					$slider.goToPrevSlide();
				}
			});

			// fermeture sur le bouton
			$('.close').click(function(event){
				$('.viewer').slideUp('slow', function(){
					$slider.destroySlider();
					$('.viewer').remove();
					$('.overlay').remove();
				});	
			});

			// fermeture sur click de l'overlay
			$('.overlay').click(function(event){
				$('.close').trigger('click');
			})

			/**
			 * on affiche la légende et on adapte la dimension verticale si nécessaire
			 * @param  {[type]} index [description]
			 */
			function legendAndSize(index){

				// on affiche la légende
				var legende = $('.bxslider li').eq(index).find('img').attr('title');
				if( legende == "" ) legende = "Pas de légende.";

				$('.legend')
				.text(legende)
				.css('opacity',0)
				.animate({
					opacity: 1,
				}, 1000);

				// on ajuste la taille verticale
				var navH = $(".navigation").outerHeight(true);
				var imgH = $('.bxslider li').eq(index).find('img').height();
				var sliderH = $(window).height() - 
								parseInt( $('.viewer').css('top') )*2 -
								parseInt( $('.viewer').css('border-width') )*2 -
								parseInt( $('.bx-wrapper').css('padding-top') )*2 -
								navH;

				if(imgH > sliderH){
					$('.bxslider li').eq(index).find('img').height( sliderH );
					$('.bxslider li').eq(index).find('img').width('auto');
				}
			}
		}		











	
} )( jQuery );



