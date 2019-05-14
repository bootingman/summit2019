// @codekit-prepend "_timer.js";
var WindowW,
WindowH,
containerW,
offsetX,
offsetY,
cursorX, cursorY,
unit = 21,
gutter = 7,
BgW,
BgH,
gapX,
gapY,
messageHovered = false,
timeout,
randomInteraction;

(function ($, root, undefined) {
	
	'use strict';

	$(document).ready(function() {
		randomInteraction = Math.floor(Math.random() * 3) + 1;

		switch(randomInteraction) {
			case 1:
			interaction1();
			break;
			case 2:
			interaction2();
			break;
			case 3:
			interaction3();
			break;
			default:
		}

		$('.jsMessage').on('touchstart touchmove touchmend click', function(event) {
			removeInteraction();
		});

	});

	var defWindowVars = function() {
		WindowW = $(window).width();
		WindowH = $(window).height();
	}

	var setBgSize = function(initial = false) {
		defWindowVars();
		BgW = Math.floor(WindowW / unit) * unit;
		BgH = Math.floor(WindowH / unit) * unit;
		gapX = WindowW - BgW;
		gapY = WindowH - BgH;
		
		if (gapX >= 2 * gutter) BgW = BgW + gutter; else BgW = BgW - 2 * gutter;
		if (gapY >= 2 * gutter) BgH = BgH + gutter; else BgH = BgH - 2 * gutter;

		gapX = (WindowW - BgW)/2;
		gapY = (WindowH - BgW)/2;

		offsetX = (WindowW - BgW) / 2;
		offsetY = (WindowH - BgH) / 2;

		if (initial) $('.jsBg').hide();
		$('.jsBg').width(BgW).height(BgH);
		$('.jsBody').addClass('is-intro');
	}

	var interaction1 = function() {
		timer.start();
		$('.jsBody').addClass('is-interaction1');
		$(document).on('mousemove', function(event) {
			$('.jsBg').stop(true, true).fadeTo(100, 1, function() {});
			$('.jsBg').show();
			var initialW = cursorX - offsetX;
			containerW = (Math.floor(initialW/unit)*unit)+unit;
			$('.jsBgContainer').width(containerW - 2);

			if (timeout !== undefined) {
				window.clearTimeout(timeout);
			}
			timeout = window.setTimeout(function () {
				timer.start();
			}, 100);
		});
	}

	var interaction2 = function() {
		$('.jsBody').addClass('is-interaction2');
		$('.jsBgContainer').hide();
		var $mask = $('.jsBgMask');
		$mask.css({
			'margin-left': -1000 + 'px'
		});

		$(document).on('mousemove', function(event) {

			if (!messageHovered) $('.jsBgMask').stop(true, true).fadeTo(200, 1, function() {});

			var leftOrigin = event.pageX;
			var topOrigin = event.pageY;

			var marginLeft = Math.floor(leftOrigin / unit) * unit;
			var marginTop = Math.floor(topOrigin / unit) * unit;

			if ( (leftOrigin < unit*2) ) {
				$mask.css('margin-left', 0 + 'px');
			}
			else if ( (leftOrigin < (BgW - 6*unit)) ) {
				$mask.css('margin-left', marginLeft - 2*unit + 'px');
			} else {
				$mask.css('margin-left', BgW - 5*unit + 2*gutter + 'px');
			}

			if ( (topOrigin < unit*2) ) {
				$mask.css('margin-top', 0 + 'px');
			}
			else if ( (topOrigin < (BgH - 6*unit)) ) {
				$mask.css('margin-top', marginTop - 2*unit + 'px');
			} else {
				$mask.css('margin-top', BgH - 5*unit + 2*gutter + 'px');
			}


			if (timeout !== undefined) {
				window.clearTimeout(timeout);
			}
			timeout = window.setTimeout(function () {
				timer.start();
			}, 100);
		});
	}

	var interaction3 = function() {
		$('.jsBody').addClass('is-interaction3');
		
		$(document).on('mousemove', function(event) {
			cursorX = event.pageX;
			cursorY = event.pageY;
			var $mask = $('.jsBgMaskVH');
			var $staticBg = $('.jsBgContainer');
			var cursorXinside = Math.floor(cursorX - offsetX);
			var cursorYinside = Math.floor(cursorY - offsetY);
			
			if (cursorXinside >= 0 && cursorYinside >= 0) {
				
				var indexX = Math.floor(cursorXinside / 105) + 1;
				var indexXBase = indexX - (((Math.ceil(indexX/4)) - 1) * 4);

				var indexY = Math.floor(cursorYinside / 105) + 1;
				var indexYBase = indexY - (((Math.ceil(indexY/4)) - 1) * 4);

				if (indexXBase === indexYBase)
				{
					$mask.addClass('is-vertical');
				} else {
					$mask.removeClass('is-vertical');
				} 

				if ( (indexXBase === 1 && indexYBase === 3) || (indexXBase === 3 && indexYBase === 1) || (indexXBase === 2 && indexYBase === 4) || (indexXBase === 4 && indexYBase === 2) )
				{
					$mask.addClass('is-horizontal');
				} else {
					$mask.removeClass('is-horizontal');
				}

				if ((indexXBase === indexYBase) || (indexXBase === 1 && indexYBase === 3) || (indexXBase === 3 && indexYBase === 1) || (indexXBase === 2 && indexYBase === 4) || (indexXBase === 4 && indexYBase === 2)) {
					$staticBg.css('opacity',1);
				} else {
					$staticBg.css('opacity',0);
				}

				if (messageHovered) {
					$mask.removeClass('is-horizontal');
					$mask.removeClass('is-vertical');
				}

			}

			if (timeout !== undefined) {
				window.clearTimeout(timeout);
			}
			timeout = window.setTimeout(function () {
				timer.start();
			}, 100);

		});
	}

	var removeInteraction = function() {
		$('.jsMessage').fadeTo(1, 0, function() {});
		$('.body-container').show();
		$('.jsIntroBody').delay(200).fadeTo(400, 0, function() {
			$(this).remove();
			$('.ui-page-theme-a').contents().unwrap();
			$('.ui-loader').remove();
		});
	}

	$(window).on('load', function() {
		setBgSize(true);
	});

	$(window).resize(function() {
		setBgSize();
	})

	$(document).on('mousemove', function(event) {
		timer.stop();
		cursorX = event.pageX;
		cursorY = event.pageY;
	});

	function addListenerMulti(el, s, fn) {
		s.split(' ').forEach(e => el.addEventListener(e, fn, false));
	}

	addListenerMulti(document, 'touchstart touchmove touchmend', function(e){
		timer.stop();
		cursorX = e.touches[0].pageX;
		cursorY = e.touches[0].pageY;
	});

	$('.jsMessage').mouseenter(function() {
		messageHovered = true;
		$('.jsBgContainerStatic').fadeTo(200, 1, function() {});
		$('.jsBgMask').stop(true, true).fadeTo(200, 0, function() {});
	})
	.mouseleave(function() {
		messageHovered = false;
		$('.jsBgContainerStatic').fadeTo(200, 0, function() {});
	});

	var timer = new Timer(function() {
		timer.stop();
		$('.jsBg').stop(true, true).fadeTo(1000, 0, function() {});
		if (randomInteraction === 2) $('.jsBgMask').stop(true, true).fadeTo(1000, 0, function() {});
		if (randomInteraction === 2 || randomInteraction === 3) $('.jsBgContainerStatic').stop(true, true).fadeTo(1000, 0, function() {});
		if (randomInteraction === 3) $('.jsBgContainer').stop(true, true).fadeTo(1000, 0, function() {});
	}, 2000);
	
})(jQuery, this);
