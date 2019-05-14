var widthWin;
var heightWin;
var widthContainerDesktop;
var heightContainerDesktop;
var widthContainerDevice;
var heightContainerDevice;
var widthStage;
var heightStage;
var widthColumn;
var heightColumn;
var margin = 21;
var blockStroke = 2;
var blockW = 21;
var blockInnerW = 5;
var screenMd = 900;
var isDevice;
var isPage;
var isHome;
var resizeTimeout;

function setDimension() {
	(function($) {
		widthWin = $(window).width();
		heightWin = $(window).height();
		isDevice = widthWin < screenMd ? true : false;
		
		widthContainerDesktop = widthWin - margin*4;
		heightContainerDesktop = heightWin - margin*2;
		widthContainerDevice = widthWin - margin*2;
		heightContainerDevice = heightWin - margin*2;

		if (isDevice) {
			widthStage = widthContainerDevice;
			heightStage = heightContainerDevice;
		} else {
			widthStage = widthContainerDesktop/3;
			heightStage = heightContainerDesktop;	
		}

		if (isHome)
  			if (isDevice) {
  				$('.column--2').find('.block--fill').removeClass('block--available');
  				$('.column--3').find('.block--fill').removeClass('block--available');
  			} else  {
  				$('.column--2').find('.block--fill').addClass('block--available');
  				$('.column--3').find('.block--fill').addClass('block--available');
  			}
	})(jQuery);
}

function setIsPage() {
	(function($) {
		if ($('body.page').length) isPage = true;
		else isPage = false;
	})(jQuery);	
}

function setIsHome() {
	(function($) {
		// if ($('body.home').length) isHome = true;
		// else isHome = false;
		isHome = false;
	})(jQuery);	
}

function getBlocksAmountX(w) {
	return Math.floor(w / blockW);
}

function getBlocksAmountY(y) {
	return Math.floor(y / blockW);
}

function setColumnsDesktop() {

	(function($) {

		var gap;
		var col1,col2,col3;
		widthColumn = getBlocksAmountX(widthStage) * blockW + blockW/2;
		heightColumn = getBlocksAmountY(heightStage) * blockW + blockW/2;
		gap = widthContainerDesktop - (widthColumn*3);
		
		$('.column--1, .column--3').width(widthColumn);

		// dynamic gallery columns
		// var galleryContainer = $('.gallery-rows').width();
		// var flexSides = widthColumn / (galleryContainer/100);
		// $('.item--1, .item--3').width(widthColumn).css('flex', '0 0 ' + flexSides + '%');
		
		col1 = widthColumn;
		col2 = widthColumn;
		col3 = widthColumn;

		if ($('.column--content--full--container').length) {
			var maxHeightColumn = 0;
			$('.column--content--full').each(function() {
				if ( $(this).height() > maxHeightColumn ) maxHeightColumn = $(this).outerHeight();
			});
			$('.column--content--full--container').height(maxHeightColumn);
		}

		if (gap < margin) {
			
			$('.column--2').width(widthColumn-blockW);
			col2 = col2 - blockW;

			// dynamic gallery columns
			// var flexInner = (widthColumn-blockW) / (galleryContainer/100);
			// $('.item--2').css('flex', '0 0 ' + flexInner + '%');;
			
		}
		else {
			$('.column--2').width(widthColumn);
			// dynamic gallery columns
			// $('.item--2').width(widthColumn).css('flex', '0 0 ' + flexSides + '%');
		}
		
		if ($('.column--23').length) {
			var middleMargin = (widthWin - col1 - col2 - col3 - margin*2) / 2;
			var col23Left = margin + col1 + middleMargin;
			$('.column--23').css('left', col23Left);
			$('.column--23').width(col2 + middleMargin + col3);
		}
		
		$('.column--static').height(heightColumn);
		
	})(jQuery);

}

function setColumnsDevice() {

	(function($) {

		var gap;
		widthColumn = getBlocksAmountX(widthStage) * blockW + blockW/2;
		heightColumn = getBlocksAmountY(heightStage) * blockW + blockW/2;

		gap = widthWin - widthColumn;

		if (gap < margin*2) {
			$('.column').width(widthColumn-blockW);
			$('.column--1').width(widthColumn-12);
		}
		else {
			$('.column').width(widthColumn);
			$('.column--1').width(widthColumn+2);
		}

		if ($('.column--content--full--container').length) {
			$('.column--content--full--container').height('auto');
		}

		if (isHome) {
			$('.column--1').height(heightColumn);	
		} else {
			$('.column--1').css('height','auto');
			$('.column--3').not('.column--content--full').height(heightColumn);
		}

		if ($('.column--23').length) {
			$('.column--23').css('left', 'auto');
		}

	})(jQuery);

}

function setColumns() {
	setIsPage();
	setIsHome();
	setDimension();
	layoutProgramColumns();
	if (isDevice) setColumnsDevice(); else setColumnsDesktop();
  	showColumns();
	if (isPage && isDevice) {
		stage.remove();
	} else {
		if (!animationFinished) {
			makeBlocks();
			if(isHome) render();
		}
	}
}

function resizeColumns() {
	layoutProgramColumns();
	if (beforeAnimation || animationFinished) {
		setColumns();
	} else {
		loop = -1;
		setColumns();
		makeBlocks();
		render();
		startRemovingAnimation();
	}
}

function showColumns() {
	(function($) {
		$('body').addClass('rendered');
	})(jQuery);
}

function removingAnimationFinished() {
	(function($) {

		$('#blocks--touch').remove();
		$('#header-main').css('visibility','visible');
		$('.footer').css('visibility','visible');

	})(jQuery);
	
	stage.remove();
}

function buildingAnimationFinished() {
	(function($) {
		$('body').addClass('animated');
		setTimeout(function() {
     		stage.remove();
     		fillAnimation();
    	}, 100);
	})(jQuery);
}

function onFrontTouch() {
	(function($) {
		if (isHome) {
			if (blocksCreated) {
				$(document).off('touchstart touch tap click','#blocks--touch', onFrontTouch);
				if (!animationFinished) startRemovingAnimation();
			}
		}
	})(jQuery);
}

function animationAutoPlay() {
	(function($) {
		setTimeout(function() {
			if (beforeAnimation) onFrontTouch();
    	}, 3500);
	})(jQuery);
}

function navLinks() {
	(function($) {
		if ($('body').hasClass('single-web3s_node')) {
			$('.menu-item').children('a[href$="/program/"]').parent('li').addClass('current_page_item');
		}
	})(jQuery);
}

function layoutProgramColumns() {
	(function($) {
		if (isDevice) {
			$('.program-row').height('auto');
		} else {
			$('.column--1').children('.program-column').children('.program-row').each(function(index, el) {
				var maxHeight = 0;
				var rowIndex = index;
				$('.program-column').each(function(index, el) {
					var programRow = $(this).children('.program-row').eq(rowIndex);
					var programRowInner = programRow.children('.program-row--inner');
					var rowHeight = programRowInner.height();
					if (rowHeight > maxHeight) maxHeight = rowHeight;
				});
				$('.program-column').each(function(index, el) {
					$(this).children('.program-row').eq(rowIndex).height(maxHeight);
				});
			});
		}
	})(jQuery);
}

function imgHeight() {
	(function($) {
		var imgHeightFirst = $('.l-ratio-box').first().outerHeight();
		var imgHeight = $('.column--2 .l-ratio-box').first().outerHeight();
		var marginFix = imgHeightFirst - imgHeight;
		$('.gallery-item__img').height(imgHeight);
		$('.column:not(".column--2") .l-ratio-box__img').css('bottom',marginFix);
	})(jQuery);
}

function galleryInit() {
  (function ($) {

    $('.jsGalleryItem').magnificPopup({
      type: 'image',
      tLoading: '<div class="preloader">Loading..</div>',
      gallery: {
        enabled: true, // set to true to enable gallery
        preload: [0,2], // read about this option in next Lazy-loading section
        navigateByImgClick: false,
        arrowMarkup: '<div class="mfp-arrow mfp-arrow-%dir%"></div>', // markup of an arrow button
        tPrev: '', // title for left button
        tNext: '', // title for right button
        tCounter: '<span class="mfp-counter">%curr% of %total%</span>' // markup of counter
      },
      image: {
        markup: '<div class="mfp-figure">'+
                  '<div class="mfp-img"></div>'+
                '</div>', // Popup HTML markup. `.mfp-img` div will be replaced with img tag, `.mfp-close` by close button
        verticalFit: true, // Fits image in area vertically
        tError: '<a href="%url%">The image</a> could not be loaded.' // Error message
      },
      callbacks: {
        lazyLoad: function(item) {
        }
      },
      closeOnContentClick: true
    });

  })(jQuery);
}

(function($) {
	$(document).ready(function() {
		setColumns();
		navLinks();
		imgHeight();
		if ($('body').hasClass('page@home')) $('nav.nav').find('li').first().addClass('current_page_item');

		if (isDevice) $('body').addClass('started-device');
		if ($('body').hasClass('single-web3s_speaker')) $('.menu-item-78, .menu-item-46').addClass('current_page_item');
		if ($('body').hasClass('single-web3s_video')) $('.menu-item-1068').addClass('current_page_item');
		if ( $('.footer--submenu').length ) $('.footer--link').addClass('is-active');

		if ($('body').hasClass('page-template-template-photos-one-page') || $('body').hasClass('page-template-template-photos-w-subpages') || $('body').hasClass('page-template-template-photos-one-page-no-submenu-php')) galleryInit();
	});
})(jQuery);

(function($) {
	$(window).on('load', function() {
		setColumns();
		imgHeight();
		if (!(isPage && !isDevice)) fillAnimation();
		$(document).on('touchstart touch tap click','#blocks--touch', onFrontTouch);

		if (isHome) animationAutoPlay();

    	if (isPage && !isDevice) {
    		if (blocksCreated) {
    			startBuildingAnimation();
    		}
    	}
	});
})(jQuery);

(function($) {
	$(window).on('resize', function() {
		if ( $('html').hasClass('touch') && isHome ) {
			if($(window).width() != widthWin && $(window).height() != heightWin){
				resizeColumns();
			}
		} else {
			resizeColumns();
    		imgHeight();
		}

		clearTimeout(resizeTimeout);
    	resizeId = setTimeout(doneResizing, 500);

	});
})(jQuery);

function doneResizing(){
    layoutProgramColumns();
}
