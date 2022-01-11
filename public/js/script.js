$(document).ready(function(){
 var myMain = document.getElementById("scrollbar");
 var rect = myMain.getBoundingClientRect();
 var myTop = rect.top;

// alert(myTop);

   // Viewport menu device Smart phone and Tablet
    if ($(window).width() < 960) {
        $('.navbar').addClass("sticky");
            $('.top-content').addClass("logo-top-disable");
            $('.navbar .menu li a').addClass("menu-scroll");
            $('.logo-scroll img').addClass("logo-scroll-display");
            $('.menu').addClass("menu-margin-right");
            $('.whiteline').css("border-left","1px solid black");

        $(window).scroll(function(){
        
            // scroll-up button show/hide script
            if(this.scrollY > 500){
                $('.scroll-up-btn').addClass("show");
            }else{
                $('.scroll-up-btn').removeClass("show");
            }
        });
             // slide-up script
        $('.scroll-up-btn').click(function(){
            $('html').animate({scrollTop: 0});
            // removing smooth scroll on slide-up button click
            $('html').css("scrollBehavior", "auto");
        });

        $('.navbar .menu li a').click(function(){
            // applying again smooth scroll on menu items click
            $('html').css("scrollBehavior", "smooth");
        });

        // toggle menu/navbar script
        $('.menu-btn').click(function(){
            $('.navbar .menu').toggleClass("active");
            $('.menu-btn i').toggleClass("active");
        });

    }
    else {
       // alert('More than 960');

        if (myTop=0) {
            $('.navbar').addClass("sticky");
            $('.top-content').addClass("logo-top-disable");
            $('.navbar .menu li a').addClass("menu-scroll");
            $('.logo-scroll img').addClass("logo-scroll-display");
            $('.menu').addClass("menu-margin-right");
            $('.whiteline').css("border-left","1px solid black");
        }
        
    $(window).scroll(function(){
        // sticky navbar on scroll script
        if(this.scrollY > 5){
            $('.navbar').addClass("sticky");
            $('.top-content').addClass("logo-top-disable");
            $('.navbar .menu li a').addClass("menu-scroll");
            $('.logo-scroll img').addClass("logo-scroll-display");
            $('.menu').addClass("menu-margin-right");
            $('.whiteline').css("border-left","1px solid black");

            // $(".logo-top").display("none");
        }else{
            $('.navbar').removeClass("sticky");
            $('.top-content').removeClass("logo-top-disable");
            $('.navbar .menu li a').removeClass("menu-scroll");
            $('.logo-scroll img').removeClass("logo-scroll-display");
            $('.menu').removeClass("menu-margin-right");
            $('.whiteline').css("border-left","1px solid white");
        }
        
        // scroll-up button show/hide script
        if(this.scrollY > 500){
            $('.scroll-up-btn').addClass("show");
        }else{
            $('.scroll-up-btn').removeClass("show");
        }
    });

    // slide-up script
    $('.scroll-up-btn').click(function(){
        $('html').animate({scrollTop: 0});
        // removing smooth scroll on slide-up button click
        $('html').css("scrollBehavior", "auto");
    });

    $('.navbar .menu li a').click(function(){
        // applying again smooth scroll on menu items click
        $('html').css("scrollBehavior", "smooth");
    });

    // toggle menu/navbar script
    $('.menu-btn').click(function(){
        $('.navbar .menu').toggleClass("active");
        $('.menu-btn i').toggleClass("active");
    });



    // typing text animation script
    // var typed = new Typed(".typing", {
    //     strings: ["YouTuber", "Developer", "Blogger", "Designer", "Freelancer"],
    //     typeSpeed: 100,
    //     backSpeed: 60,
    //     loop: true
    // });

    // var typed = new Typed(".typing-2", {
    //     strings: ["YouTuber", "Developer", "Blogger", "Designer", "Freelancer"],
    //     typeSpeed: 100,
    //     backSpeed: 60,
    //     loop: true
    // });

    // owl carousel script
//     $('.carousel').owlCarousel({
//         margin: 20,
//         loop: true,
//         autoplay: true,
//         autoplayTimeOut: 2000,
//         autoplayHoverPause: true,
//         responsive: {
//             0:{
//                 items: 1,
//                 nav: false
//             },
//             600:{
//                 items: 2,
//                 nav: false
//             },
//             1000:{
//                 items: 3,
//                 nav: false
//             }
//         }
//     });
    }

});