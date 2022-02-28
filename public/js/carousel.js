$('.owl-carousel').owlCarousel({
    loop: false,
    margin: 30,
    nav: true,
    navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
    navigation: false,
    navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
    responsive: {
        0: {
            items: 1
        },
        750: {
            items: 2
        },
        970: {
            items: 2
        },
        1170: {
            items: 3
        }
    }
    })