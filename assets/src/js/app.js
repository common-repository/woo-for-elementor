(function ($) {

    var WidgetWFEProductsSlidersHandler = function ($scope, $) {

        var carousel_elem = $scope.find('.js-slick-slider').eq(0);

        if (carousel_elem.length > 0) {

            var settings = carousel_elem.data('wfe-products-slider_options');
            carousel_elem.slick(settings);
        }

    };

    // Make sure you run this code under Elementor..
    $(window).on('elementor/frontend/init', function () {

        elementorFrontend.hooks.addAction('frontend/element_ready/wfe_products_slider.default', WidgetWFEProductsSlidersHandler);

    });

})(jQuery);
