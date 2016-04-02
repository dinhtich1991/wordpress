jQuery(document).ready(function() {
    jQuery('nav.primary-menu ul.sf-menu').superfish();

    // Fixed menu top 
    var nav = $('.nav-menu');
    
    $(window).scroll(function () {
        if ($(this).scrollTop() > 136) {
            nav.addClass("fixed-top-nav");
        } else {
            nav.removeClass("fixed-top-nav");
        }
    });
});