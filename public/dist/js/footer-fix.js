(function($)
{
    $.fn.smartFooter = function(options)
    {
        var settings = $.extend({
            mainSelector: 'main',  // seletor do conteúdo principal
            offset: 0              // margem opcional inferior
        }, options);

        var $footer = this;
        var $main = $(settings.mainSelector);

        function adjustFooter()
        {
            // Altura total da página
            var docHeight = $(window).height();
            var contentHeight = $('body').outerHeight(true);

            if (contentHeight + settings.offset < docHeight)
            {
                $footer.addClass('fixed-bottom');
            } else
            {
                $footer.removeClass('fixed-bottom');
            }
        }

        // Ajusta ao carregar e ao redimensionar
        $(window).on('load resize', adjustFooter);
        adjustFooter();

        return this;
    };
})(jQuery);