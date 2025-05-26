$(document).ready(function () {
    const sections = $('section');
    const navItems = $('.links li');

    $(window).on('scroll', function () {
        const header = $('header');
        const scrollPosition = $(window).scrollTop() - header.outerHeight();

        if (scrollPosition <= 0) {
            header.css('box-shadow', 'none');
        } else {
            header.css('box-shadow', '5px 1px 5px rgba(0,0,0,0.1)');
        }
    });

    ScrollReveal().reveal('#cta', {
        origin: 'left',
        duration: 2000,
        distance: '20%',
    });

    ScrollReveal().reveal('#tu', {
        origin: 'left',
        duration: 2000,
        distance: '20%',
    });

    ScrollReveal().reveal('#con', {
        origin: 'left',
        duration: 2000,
        distance: '20%',
    });
});
