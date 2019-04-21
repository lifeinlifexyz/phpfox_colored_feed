$Ready(function() {
    if ($('#js_feed_content').length > 0) {

        PF.cmd('coloredfeed.toggle_bgs', function() {
           $('#feed-backgrounds').slideToggle();
        });

        PF.cmd('coloredfeed.reset_bg', function(target) {
            var form = target.closest('form');
            form.find('.feed-bg-value').val(0);
            form.find('.feed-bg-item').removeClass('active');
            form.find('.global_attachment_holder_section').css('background', 'transparent')
                .removeClass('attached').find('textarea')
                .removeAttr("style")
                .addAttr('cols', 60)
                .addAttr('rows', 2);
            target.addClass('active');
        });

        function formatDummyText( text ) {
            if ( !text ) {
                return '&nbsp;';
            }
            return text.replace( /\n$/, '<br>&nbsp;' )
                .replace( /\n/g, '<br>' );
        }

        PF.cmd('coloredfeed.select_bg', function(target) {
            var id = target.data('bg');
            var form = target.closest('form');
            form.find('.feed-bg-value').val(id);
            form.find('.feed-bg-item').removeClass('active');
            if (target.data('img').indexOf('url') != -1) {
                form.find('.global_attachment_holder_section').css('background-image', target.data('img'));
                form.find('.global_attachment_holder_section').css('background-color', 'none');
            } else {
                form.find('.global_attachment_holder_section').css('background-color', target.data('img'));
                form.find('.global_attachment_holder_section').css('background-image', 'none');
            }

            form.find('.global_attachment_holder_section').addClass('attached').find('textarea')
                .css('color', target.data('color'));

            target.addClass('active');

            var $wrap = form.find('#global_attachment_status');
            var $textarea = $wrap.find('textarea');
            $textarea.removeAttr('cols');
            $textarea.removeAttr('rows');
            if ($wrap.find('.dummy').length == 0) {
                $wrap.prepend('<div class="area dummy"><div');
            }
            var $dummy = $wrap.find('.dummy');

            function positionTextarea() {
                var h = $wrap.height();
                var top = Math.max( 0, ( h - $dummy.height() ) * 0.5 );
                $textarea.css({
                    paddingTop: top
                });
            }

            $textarea.on('keyup change', function( event ) {
                var html = formatDummyText( $textarea.val() );
                $dummy.html( html );
                positionTextarea();
            }).trigger('change');

            $( window ).on( 'resize', positionTextarea );
        });

        $.ajaxCall('cmcoloredfeed.getBgs');

        $('.feed-bg').each(function(){
            var data = $(this).data();
            $(this).find('.activity_feed_content_text').css('background', data.bg).addClass(data.bgClass);
            $(this).find('.activity_feed_content_text').css('color', data.textColor);
            $(this).removeClass('feed-bg');
        });

        $('.activity_feed_form_attach a').click(function(ev){
           var target = $(ev.target).closest('a');
            if (target.attr('rel') == 'global_attachment_status') {
                $('#feed-bg-control').show();
            } else {
                $('#feed-bg-control, #feed-backgrounds').hide();
            }
        });

        $()
    }
});