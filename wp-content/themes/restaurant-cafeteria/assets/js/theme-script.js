function restaurant_cafeteria_openNav() {
  jQuery(".sidenav").addClass('show');
}
function restaurant_cafeteria_closeNav() {
  jQuery(".sidenav").removeClass('show');
}

( function( window, document ) {
  function restaurant_cafeteria_keepFocusInMenu() {
    document.addEventListener( 'keydown', function( e ) {
      const restaurant_cafeteria_nav = document.querySelector( '.sidenav' );

      if ( ! restaurant_cafeteria_nav || ! restaurant_cafeteria_nav.classList.contains( 'show' ) ) {
        return;
      }
      const elements = [...restaurant_cafeteria_nav.querySelectorAll( 'input, a, button' )],
        restaurant_cafeteria_lastEl = elements[ elements.length - 1 ],
        restaurant_cafeteria_firstEl = elements[0],
        restaurant_cafeteria_activeEl = document.activeElement,
        tabKey = e.keyCode === 9,
        shiftKey = e.shiftKey;

      if ( ! shiftKey && tabKey && restaurant_cafeteria_lastEl === restaurant_cafeteria_activeEl ) {
        e.preventDefault();
        restaurant_cafeteria_firstEl.focus();
      }

      if ( shiftKey && tabKey && restaurant_cafeteria_firstEl === restaurant_cafeteria_activeEl ) {
        e.preventDefault();
        restaurant_cafeteria_lastEl.focus();
      }
    } );
  }
  restaurant_cafeteria_keepFocusInMenu();
} )( window, document );

var restaurant_cafeteria_btn = jQuery('#button');

jQuery(window).scroll(function() {
  if (jQuery(window).scrollTop() > 300) {
    restaurant_cafeteria_btn.addClass('show');
  } else {
    restaurant_cafeteria_btn.removeClass('show');
  }
});

restaurant_cafeteria_btn.on('click', function(e) {
  e.preventDefault();
  jQuery('html, body').animate({scrollTop:0}, '300');
});

window.addEventListener('load', (event) => {
  jQuery(".loading").delay(2000).fadeOut("slow");
});

jQuery(document).ready(function() {
    var owl = jQuery('#top-slider .owl-carousel');
    owl.owlCarousel({
    margin: 0,
    nav:false,
    autoplay : true,
    lazyLoad: true,
    autoplayTimeout: 5000,
    loop: false,
    dots: true,
    navText : ['<i class="fa fa-lg fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-lg fa-chevron-right" aria-hidden="true"></i>'],
    responsive: {
      0: {
        items: 1
      },
      576: {
        items: 1
      },
      768: {
        items: 1
      },
      1000: {
        items: 1
      },
      1200: {
        items: 1
      }
    },
    autoplayHoverPause : false,
    mouseDrag: true
  });
})

jQuery('.header-search-wrapper .search-main').click(function(){
    jQuery('.search-form-main').toggleClass('active-search');
    jQuery('.search-form-main .search-field').focus();
});