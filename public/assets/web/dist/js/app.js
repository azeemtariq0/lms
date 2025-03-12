
$(document).ready(function () {
    $('#menu-toggle').on('click', function () {
        $('#menu').slideToggle(400, function () {
            $('#navbar').toggleClass('collapsed');
            $('#menu-toggle i').toggleClass('fa-bars fa-xmark');
        });
    });

    $(window).on('resize', function () {
        if ($(window).width() > 768) {
            $('#navbar').removeClass('collapsed');
            $('#menu-toggle i').removeClass('fa-xmark').addClass('fa-bars'); // Resets the icon.
            $('#menu').attr('style', '');
        }
        console.log($(window).width());
    });
    new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 30,
        centeredSlides: true,
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
});
