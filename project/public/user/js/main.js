;
(function($) {
    "use strict";

    $(document).ready(function() {
        /**-----------------------------
         *  Navbar fix
         * ---------------------------*/
        $(document).on('click', '.navbar-area .navbar-nav li.menu-item-has-children>a', function(e) {
            e.preventDefault();
        })



        /*-------------------------------------
            menu activation
        -------------------------------------*/
       
        $('.menu').on('click', function() {
            $(this).toggleClass('open');
            $('.navbar-area .navbar-collapse').toggleClass('sopen');
        });
        // mobile menu
        if ($(window).width() < 992) {
            $(".in-mobile").clone().appendTo(".sidebar-inner");
            $(".in-mobile ul li.menu-item-has-children").append('<i class="fas fa-chevron-right"></i>');
            $('<i class="fas fa-chevron-right"></i>').insertAfter("");

            $(".menu-item-has-children a").on('click', function(e) {
                // e.preventDefault();

                $(this).siblings('.sub-menu').animate({
                    height: "toggle"
                }, 300);
            });
        }

        var menutoggle = $('.menu-toggle');
        var mainmenu = $('.navbar-nav');

        menutoggle.on('click', function() {
            if (menutoggle.hasClass('is-active')) {
                mainmenu.removeClass('menu-open');
            } else {
                mainmenu.addClass('menu-open');
            }
        });


        /* -------------------------------------------------------------
            menu show Form
        ------------------------------------------------------------- */
        if ($(window).width() > 991) {
            if ($('.cat-menu').length) {
                $(".cat-menu").on('click', function() {
                    $(".cat-menu-wrap .sidebar-categories").fadeToggle("sidebar-categories-show", "linear");
                    $('.cat-menu').toggleClass('open');
                });

                $('body').on('click', function(event) {
                    if (!$(event.target).closest('.cat-menu').length && !$(event.target).closest('.cat-menu-wrap .sidebar-categories').length) {
                        $(".cat-menu-wrap .sidebar-categories").fadeOut("sidebar-categories-show");
                    }
                    if (!$(event.target).closest('.cat-menu').length && !$(event.target).closest('.cat-menu-wrap .sidebar-categories').length) {
                        $('.cat-menu').removeClass('open');
                    }
                });
            }
        }

        /*---------------------------
            banner V3 slider
        ---------------------------*/
        var bannerSlider = $(".banner-v3-slider-area-wrapper");
        if (bannerSlider.length) {
            bannerSlider
                .slick({
                    slidesToShow: 1,
                    autoplay: false,
                    arrows: false,
                    pauseOnFocus: true,
                    pauseOnHover: false,
                    pauseOnDotsHover: true,
                    dots: true,
                    autoplaySpeed: 10000,
                    responsive: [{
                        breakpoint: 769,
                        settings: {
                            dots: false
                        }
                    }]
                })
                .slickAnimation();
        }

        $(".banner-v3-slider-area-wrapper").on("beforeChange", function(event, slick, currentSlide, nextSlide) {
            var firstNumber = check_number(++nextSlide);
            $(".banner-v3-slider-controls .slider-extra .text .first").text(firstNumber);
            resetProgressbar(
                $(".banner-v3-slider-controls .slider-extra .slider-progress .progress-width")
            );
        });
        $(".banner-v3-slider-area-wrapper").on("afterChange", function(event, slick, currentSlide, nextSlide) {
            startProgressbar(
                $(".banner-v3-slider-controls .slider-extra .slider-progress .progress-width")
            );
        });
        startProgressbar($(".banner-v3-slider-controls .slider-extra .slider-progress .progress-width"));
        //progressbar js
        function startProgressbar(selector) {
            selector.css({
                width: "100%",
                transition: "all 10000ms"
            });
        }

        function resetProgressbar(selector) {
            selector.css({
                width: "0%",
                transition: "all 0ms"
            });
        }
        var bannerv3Slider = $(".banner-v3-slider-area-wrapper").slick("getSlick");
        var bannerv3SliderCount = bannerv3Slider.slideCount;
        $(".banner-v3-slider-controls .slider-extra .text .last").text(check_number(bannerv3SliderCount));

        function check_number(num) {
            var IsInteger = /^[0-9]+$/.test(num);
            return IsInteger ? "0" + num : null;
        }


        /*---------------------------------------------------
            banner consult Slider
        ----------------------------------------------------*/
        $('.banner-silder').slick({
            dots: true,
            autoplay: true,
            infinite: true,
            arrows: true,
            autoplaySpeed: 5000,
            speed: 500,
            slidesToShow: 1,
            slidesToScroll: 1,
            prevArrow: '<a class="slick-prev"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>',
            nextArrow: '<a class="slick-next"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>',
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        }).on('afterChange', function() {
            new WOW().init();
        });

        /*----------------------
            Search Popup
        -----------------------*/
        var bodyOvrelay = $('#body-overlay');
        var searchPopup = $('#search-popup');
        var sidebarMenu = $('#sidebar-menu');

        $(document).on('click', '#body-overlay', function(e) {
            e.preventDefault();
            bodyOvrelay.removeClass('active');
            searchPopup.removeClass('active');
            sidebarMenu.removeClass('active');
        });
        $(document).on('click', '#search', function(e) {
            e.preventDefault();
            searchPopup.addClass('active');
            bodyOvrelay.addClass('active');
        });

        // sidebar menu 
        $(document).on('click', '.sidebar-menu-close', function(e) {
            e.preventDefault();
            bodyOvrelay.removeClass('active');
            sidebarMenu.removeClass('active');
        });
        $(document).on('click', '#navigation-button', function(e) {
            e.preventDefault();
            sidebarMenu.addClass('active');
            bodyOvrelay.addClass('active');
        });




        /*------------------
           back to top
       ------------------*/
        $(document).on('click', '.back-to-top', function() {
            $("html,body").animate({
                scrollTop: 0
            }, 2000);
        });


    });

    /*-----------------
            scroll
    ------------------*/
    $(window).on("scroll", function() {

        var ScrollTop = $('.back-to-top');
        if ($(window).scrollTop() > 1000) {
            ScrollTop.fadeIn(1000);
        } else {
            ScrollTop.fadeOut(1000);
        }
    });


    $(window).on('load', function() {

        /*-----------------
            preloader
        ------------------*/
        var preLoder = $("#preloader");
        preLoder.fadeOut(0);

        /*-----------------
            back to top
        ------------------*/
        var backtoTop = $('.back-to-top')
        backtoTop.fadeOut();

        /*---------------------
            Cancel Preloader
        ----------------------*/
        $(document).on('click', '.cancel-preloader a', function(e) {
            e.preventDefault();
            $("#preloader").fadeOut(2000);
        });


          /**-------------------------------
         * - wow js init
         * ---------------------------**/
        new WOW().init();

        /* -------------------------------------------------------------
        fact counter
        ------------------------------------------------------------- */
        $('.counter').counterUp({
            delay: 15,
            time: 2000
        });

        /*---------------------------------------
            Nice Select
        ---------------------------------------*/
        if ($('select').length) {
            $('select').niceSelect();
        }
    });
    /* -------------------------------------------------
            Magnific JS 
    ------------------------------------------------- */
    $('.video-play-btn').magnificPopup({
        type: 'iframe',
        removalDelay: 260,
        mainClass: 'mfp-zoom-in',
    });
    $.extend(true, $.magnificPopup.defaults, {
        iframe: {
            patterns: {
                youtube: {
                    index: 'youtube.com/',
                    id: 'v=',
                    src: 'https://www.youtube.com/embed/ttv0ApD4wtw'
                }
            }
        }
    });
    /* -------------------------------------------------
            news-slider JS 
    ------------------------------------------------- */
    $('.news-slider').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            smartSpeed: 1500,
            navText: ['<img src="assets/img/icon/arrow-left.png"/>', '<img src="assets/img/icon/arrow-left.png"/>'],
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        })
        /* -------------------------------------------------
            testimonial-slider JS 
        ------------------------------------------------- */
    $('.testimonial-main-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        fade: true,
        prevArrow: '<span class="slick-prev"><img src="assets/img/icon/arrow-left-blue.png" alt="img" /></span>',
        nextArrow: '<span class="slick-next"><img src="assets/img/icon/arrow-right-pink.png" alt="img" /></span>',
        asNavFor: '.testimonial-thumb-slider'
    });
    $('.testimonial-thumb-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        asNavFor: '.testimonial-main-slider',
        dots: false,
        fade: true,
    });

    /* -------------------------------------------------
        partner-slider JS 
    ------------------------------------------------- */
    $('.partner-slider').owlCarousel({
        loop: true,
        margin: 0,
        nav: false,
        smartSpeed: 1500,
        dots: false,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    })

    // coun down Timer
    var myDate = new Date();
    myDate.setDate(myDate.getDate() + 7);
    $("#countdown").countdown(myDate, function(event) {
        $(this).html(
            event.strftime(
                '<div class="timer-wrapper"><div class="time">%D<span class="text">Days</span></div></div><div class="timer-wrapper"><div class="time">%H<span class="text">Hours</span></div></div><div class="timer-wrapper"><div class="time">%M<span class="text">Minutes</span></div></div><div class="timer-wrapper"><div class="time">%S<span class="text">Seconds</span></div></div>'
            )
        );
    });
    // coun down Timer
    var myDate = new Date();
    myDate.setDate(myDate.getDate() + 10);
    $("#countdown2").countdown(myDate, function(event) {
        $(this).html(
            event.strftime(
                '<div class="timer-wrapper"><div class="time">%D<span class="text">Days</span></div></div><div class="timer-wrapper"><div class="time">%H<span class="text">Hours</span></div></div><div class="timer-wrapper"><div class="time">%M<span class="text">Minutes</span></div></div><div class="timer-wrapper"><div class="time">%S<span class="text">Seconds</span></div></div>'
            )
        );
    });
    // coun down Timer
    var myDate = new Date();
    myDate.setDate(myDate.getDate() + 3);
    $("#countdown3").countdown(myDate, function(event) {
        $(this).html(
            event.strftime(
                '<div class="timer-wrapper"><div class="time">%D<span class="text">Days</span></div></div><div class="timer-wrapper"><div class="time">%H<span class="text">Hours</span></div></div><div class="timer-wrapper"><div class="time">%M<span class="text">Minutes</span></div></div><div class="timer-wrapper"><div class="time">%S<span class="text">Seconds</span></div></div>'
            )
        );
    });

})(jQuery);