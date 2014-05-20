

$j = jQuery.noConflict();

jQuery(function () {

  	$j('a.menu-close').click(function(event) {
      event.preventDefault();
  		$j('.btn-menu').removeClass('active');
  		$j('.menu-button').addClass('active');
  		$j('#menu-main').css('position', 'absolute');
  		console.log('yooo', jQuery(this));
  	});

  	$j('.menu-button').click(function(event) {
      event.preventDefault();
  		$j('.btn-menu').addClass('active');
  		$j(this).removeClass('active');
  		$j('#menu-main').css('position', 'fixed');
  		console.log('yeee', jQuery(this));
  	});

});



jQuery(window).load(function() {
  
    updateViewCovers();

    jQuery(window).on('resize', function() {
        updateViewCovers();
    });

});


function updateViewCovers() {
    // var sH = jQuery(window).height() - 105;
    // jQuery('.home-top-slider').height(sH);

    // jQuery('.igallery-images .on-home.item .overlay p').each(function() {
    //     var pt = ( jQuery(this).closest('li.on-home').height() - jQuery(this).height() ) / 2;
    //     jQuery(this).css('top', pt + 'px');
    // });

}

/* **********************************************
     Begin jquery.img-cover.js
********************************************** */

(function($, window, undefined) {

    var $w = $(window);

    function init() {
        $('.home-top-slider .divSimpleSlider > a').each(function() {
            var $cover = $(this),
            $img = $cover.find('img');

            //$img.addClass('sr-only');
            $cover.css('background-image', 'url(' + $img.attr('src') + ')');
        });
    }

    $(document).ready(function() {
        init();
    })

})(jQuery, window);





