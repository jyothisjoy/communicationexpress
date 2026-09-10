jQuery(document).ready(function ($) {
    "use strict";
    var isMobile = false;
    if (/Android|webOS|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        $('html').addClass('touch');
        isMobile = true;
    } else {
        $('html').addClass('no-touch');
        isMobile = false;
    }

    // Banner Slider
    var swiper = new Swiper('.theme-main-carousel', {
        centeredSlides: true,
        slidesPerView: 1,
        loop: true,
        spaceBetween: 0,
        speed: 1000,
        roundLengths: true,
        keyboard: true,
        parallax: true,
        mousewheel: false,
        grabCursor: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            768: {
                slidesPerView: 1,
            },
            1200: {
                slidesPerView: 1,
            },
            1600: {
                slidesPerView: 1,
            }
        }
    });

    // Scroll To
    $(".scroll-content").click(function () {
        $('html, body').animate({
            scrollTop: $("#site-content").offset().top
        }, 500);
    });
    // Product sidebar menu toggle — collapsible sub-menus
    $('.product-sidebar-menu .menu-item-has-children').each(function () {
        var $parent = $(this);
        if ($parent.children('.submenu-toggle-btn').length) return;
        var $link = $parent.children('a').first();
        var $btn = $('<span class="submenu-toggle-btn" role="button" tabindex="0" aria-label="Toggle submenu"><i class="fa fa-chevron-down" aria-hidden="true"></i></span>');
        if ($link.length) {
            $link.after($btn);
        } else {
            $parent.prepend($btn);
        }
    });
    $('.product-sidebar-menu').on('click', '.submenu-toggle-btn', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).closest('.menu-item-has-children').toggleClass('is-open');
    });
    $('.product-sidebar-menu').on('keydown', '.submenu-toggle-btn', function (e) {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            $(this).closest('.menu-item-has-children').toggleClass('is-open');
        }
    });

    // Aub Menu Toggle
    $('.submenu-toggle').click(function () {
        $(this).toggleClass('button-toggle-active');
        var currentClass = $(this).attr('data-toggle-target');
        $(currentClass).toggleClass('submenu-toggle-active');
    });
    $('.skip-link-menu-start').focus(function () {
        if (!$("#offcanvas-menu #primary-nav-offcanvas").length == 0) {
            $("#offcanvas-menu #primary-nav-offcanvas ul li:last-child a").focus();
        }
    });
    // Toggle Menu
    $('.navbar-control-offcanvas').click(function () {
        $(this).addClass('active');
        $('body').addClass('body-scroll-locked');
        $('#offcanvas-menu').toggleClass('offcanvas-menu-active');
        $('.button-offcanvas-close').focus();
    });
    $('.offcanvas-close .button-offcanvas-close').click(function () {
        $('#offcanvas-menu').removeClass('offcanvas-menu-active');
        $('.navbar-control-offcanvas').removeClass('active');
        $('body').removeClass('body-scroll-locked');
        setTimeout(function () {
            $('.navbar-control-offcanvas').focus();
        }, 300);
    });
    $('#offcanvas-menu').click(function () {
        $('#offcanvas-menu').removeClass('offcanvas-menu-active');
        $('.navbar-control-offcanvas').removeClass('active');
        $('body').removeClass('body-scroll-locked');
    });
    $(".offcanvas-wraper").click(function (e) {
        e.stopPropagation(); //stops click event from reaching document
    });
    $('.skip-link-menu-end').on('focus', function () {
        $('.button-offcanvas-close').focus();
    });
    // Data Background
    var pageSection = $(".data-bg");
    pageSection.each(function (indx) {
        if ($(this).attr("data-background")) {
            $(this).css("background-image", "url(" + $(this).data("background") + ")");
        }
    });
    // Scroll to Top on Click
    $('.to-the-top').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 700);
        return false;
    });
});

jQuery(document).ready(function(){
    jQuery('a[href="#search"]').on('click', function(event) {                    
        jQuery('#search').addClass('open');
        jQuery('#search > form > input[type="search"]').focus();
    });            
    jQuery('#search, #search button.close').on('click keyup', function(event) {
        if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
            jQuery(this).removeClass('open');
        }
    });            
});

    jQuery(window).scroll(function() {
      var data_sticky = jQuery('#middle-header').attr('data-sticky');

      if (data_sticky == "true") {
        if (jQuery(this).scrollTop() > 1){
          jQuery('.header-navbar').addClass("stick_head");
        } else {
          jQuery('.header-navbar').removeClass("stick_head");
        }
      }
    });


document.addEventListener('DOMContentLoaded', function () {
    // Check if there's a stored active tab in the browser storage
    var storedTab = localStorage.getItem('activeTab');

    // If there's a stored active tab, show that tab
    if (storedTab) {
        showTabContent(storedTab);
    } else {
        // Otherwise, default to the first tab
        showTabContent(1);
    }
});

function showTabContent(tabNumber) {
    // Hide all tab panes
    var tabContents = document.querySelectorAll('.tab-content');
    tabContents.forEach(function (tabContent) {
       // tabContent.style.display = 'none';
    });

    // Show the selected tab pane
    var selectedTabContent = document.getElementById('tab-content-' + tabNumber);
    if (selectedTabContent) {
        selectedTabContent.style.display = 'block';
    }

    // Remove 'active' class from all tab items
    var tabItems = document.querySelectorAll('.tab-header .tab-item');
    tabItems.forEach(function (tabItem) {
        tabItem.classList.remove('active');
    });

    // Add 'active' class to the selected tab item
    var selectedTabItem = document.querySelector('.tab-header .tab-item:nth-child(' + tabNumber + ')');
    if (selectedTabItem) {
        selectedTabItem.classList.add('active');
    }

    // Store the active tab in the browser storage
    localStorage.setItem('activeTab', tabNumber);
}

jQuery(function() {
  jQuery(".toggle-menu").click(function() {
    jQuery(this).toggleClass("active");
    jQuery('.menu-drawer').toggleClass("open");
  });
});
/* Product loop: short-description tooltip on the info icon (Bootstrap tooltip, hover + keyboard focus) */
jQuery(function ($) {
    if (typeof $.fn.tooltip === 'function') {
        $('.product-info-tip').tooltip({ container: 'body', customClass: 'product-info-tooltip' });
    }
});
