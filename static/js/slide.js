$(document).on('ready', function () {
	var $status = $('.counter');
	var $slickElement = $('.top-banner');

	$slickElement.on('init reInit afterChange', function (event, slick, currentSlide, nextSlide) {
		//currentSlide is undefined on init -- set it to 0 in this case (currentSlide is 0 based)
		var i = (currentSlide ? currentSlide : 0) + 1;
		$status.text(i + '/' + slick.slideCount);
	});

	$slickElement.slick({
		dots: true,
		arrows: false,
		infinite: true,
		variableWidth: true,
		speed: 600,
		centerMode: true,
		centerPadding: '0px',
		slidesToShow: 1,
		slidesToScroll: 1,
		autoplay: false,
		autoplaySpeed: 4800,
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					centerPadding: '1000px',
					slidesToShow: 1,
					slidesToScroll: 1,
					infinite: true,
					dots: true
				}
        },
			{
				breakpoint: 800,
				settings: {
					centerPadding: '0px',
					slidesToShow: 1,
					slidesToScroll: 1,
					infinite: true,
					dots: true
				}
        },
			{
				breakpoint: 600,
				settings: {
					centerPadding: '0px',
					variableWidth: false,
					slidesToShow: 1,
					slidesToScroll: 1
				}
        },
			{
				breakpoint: 480,
				settings: {
					centerPadding: '0px',
					variableWidth: false,
					slidesToShow: 1,
					slidesToScroll: 1
				}
        },
			{
				breakpoint: 330,
				settings: {
					centerPadding: '0px',
					variableWidth: false,
					slidesToShow: 1,
					slidesToScroll: 1
				}
        }
      ]
	});

});





$(document).on('ready', function () {
	var $status = $('.counter');
	var $slickElement = $('.ad-banner');

	$slickElement.on('init reInit afterChange', function (event, slick, currentSlide, nextSlide) {
		//currentSlide is undefined on init -- set it to 0 in this case (currentSlide is 0 based)
		var i = (currentSlide ? currentSlide : 0) + 1;
		$status.text(i + '/' + slick.slideCount);
	});

	$slickElement.slick({
		dots: true,
		arrows: false,
		infinite: true,
		variableWidth: true,
		speed: 600,
		centerMode: true,
		centerPadding: '0px',
		slidesToShow: 1,
		slidesToScroll: 1,
		autoplay: true,
		autoplaySpeed: 4800,
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					centerPadding: '0px',
					slidesToShow: 1,
					slidesToScroll: 1,
					infinite: true,
					dots: true
				}
        },
			{
				breakpoint: 800,
				settings: {
					centerPadding: '0px',
					slidesToShow: 1,
					slidesToScroll: 1,
					infinite: true,
					dots: true
				}
        },
			{
				breakpoint: 600,
				settings: {
					centerPadding: '0px',
					variableWidth: false,
					slidesToShow: 1,
					slidesToScroll: 1
				}
        },
			{
				breakpoint: 480,
				settings: {
					centerPadding: '0px',
					variableWidth: false,
					slidesToShow: 1,
					slidesToScroll: 1
				}
        },
			{
				breakpoint: 330,
				settings: {
					centerPadding: '0px',
					variableWidth: false,
					slidesToShow: 1,
					slidesToScroll: 1
				}
        }
      ]
	});

});



//地圖1
$('.slider-main').slick({
	slidesToShow: 1,
	slidesToScroll: 1,
	arrows: true,
	autoplay: false,
	fade: true,
	asNavFor: '.slider-nav'
});
$('.slider-nav').slick({
	slidesToShow: 6,
	slidesToScroll: 1,
	asNavFor: '.slider-main',
	autoplay: false,
	centerMode: true,
	vertical: true,
	focusOnSelect: true
});

//地圖2
$('.slider-main2').slick({
	slidesToShow: 1,
	slidesToScroll: 1,
	arrows: false,
	autoplay: true,
	fade: true,
	verticalSwiping: true,
	asNavFor: '.slider-nav2'
});
$('.slider-nav2').slick({
	slidesToShow: 6,
	slidesToScroll: 1,
	asNavFor: '.slider-main2',
	dots: true,
	autoplay: true,
	centerMode: true,
	vertical: true,
	focusOnSelect: true
});
//地圖3
$('.slider-main3').slick({
	slidesToShow: 1,
	slidesToScroll: 1,
	arrows: false,
	autoplay: true,
	fade: true,
	verticalSwiping: true,
	asNavFor: '.slider-nav3'
});
$('.slider-nav3').slick({
	slidesToShow: 6,
	slidesToScroll: 1,
	asNavFor: '.slider-main3',
	dots: true,
	autoplay: true,
	centerMode: true,
	vertical: true,
	focusOnSelect: true
});
//地圖4
$('.slider-main4').slick({
	slidesToShow: 1,
	slidesToScroll: 1,
	arrows: false,
	autoplay: true,
	fade: true,
	verticalSwiping: true,
	asNavFor: '.slider-nav4'
});
$('.slider-nav4').slick({
	slidesToShow: 6,
	slidesToScroll: 1,
	asNavFor: '.slider-main4',
	dots: true,
	autoplay: true,
	centerMode: true,
	vertical: true,
	focusOnSelect: true
});
//地圖5
$('.slider-main5').slick({
	slidesToShow: 1,
	slidesToScroll: 1,
	arrows: false,
	autoplay: true,
	fade: true,
	verticalSwiping: true,
	asNavFor: '.slider-nav5'
});
$('.slider-nav5').slick({
	slidesToShow: 6,
	slidesToScroll: 1,
	asNavFor: '.slider-main5',
	dots: true,
	autoplay: true,
	centerMode: true,
	vertical: true,
	focusOnSelect: true
});
//地圖6
$('.slider-main6').slick({
	slidesToShow: 1,
	slidesToScroll: 1,
	arrows: false,
	autoplay: true,
	fade: true,
	verticalSwiping: true,
	asNavFor: '.slider-nav6'
});
$('.slider-nav6').slick({
	slidesToShow: 6,
	slidesToScroll: 1,
	asNavFor: '.slider-main6',
	dots: true,
	autoplay: true,
	centerMode: true,
	vertical: true,
	focusOnSelect: true
});



// 田間 圖片跑馬燈效果
$('.slidMarquee').slick({
	infinite: true,
	variableWidth: true,
	autoplay: true,
	pauseOnHover: true,

	//速度
	autoplaySpeed:0,
	speed:8000,
	useCSS: false,//把css到點的緩慢效果拿掉
	waitForAnimate: true,
});


/*
$(document).on('ready', function() {
        $(".map-slider").slick({
            dots: true,
            arrows: false,
            infinite: false,
            centerMode: true,
            centerPadding: '0px',
            variableWidth: false,
            speed: 800,
            slidesToShow: 1,

            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 780,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        centerMode: false
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    });
*/
