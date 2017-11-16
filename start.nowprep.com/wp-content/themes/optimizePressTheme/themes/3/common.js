;(function($){
    $(window).load(function(){
        $('.searchform :input[name="s"]').focus(function(){
            var $t = $(this), v = $t.val();
            if(v == OptimizePress.search_default){
                $t.val('');
            }
        }).blur(function(){
            var $t = $(this), v = $t.val();
            if(v == ''){
                $t.val(OptimizePress.search_default);
            }
        }).trigger('blur');
        $('#comments .tabs a').click(function(e){
            var hash = $(this).attr('href').split('#'), li = $(this).parent();
            li.parent().find('.selected').removeClass('selected').end().end().addClass('selected').closest('#comments').find('.tab-content').hide().end().find('.'+hash[1]+'-panel.tab-content').show();
            e.preventDefault();
        });
        $('.minipost-area .tabs a').click(function(e){
            var hash = $(this).attr('href').split('#');
            $(this).parent().siblings('.selected').removeClass('selected').end().addClass('selected').closest('div').find('.miniposts').hide().filter('.tab-'+hash[1]).show();
            //$('.main-content-area,.main-sidebar').setAllToMaxHeight();
            e.preventDefault();
        });

        //$('.main-content-area,.main-sidebar').setAllToMaxHeight();

        /* OLD MENU FLYOUT

            $('.sub-menux').each(function(){
                var themenu = $(this);
                var position = themenu.parent().position();
                var offset = themenu.parent().offset();
                if ((themenu.width() + offset.left) >= $(window).width()) {
                    themenu.css('left','auto');
                };
            });

        END OLD MENU FLYOUT */

        setMenuPosition();

        $('.menu-parent').mouseover(function(){
            setMenuPosition();
        });

        //$(window).resize(setMenuPosition());
        //$('.navigation > ul > .menu-parent > a, .banner .nav > .menu-parent > a, .header-nav > .menu-parent > a').append('&nbsp;&nbsp;&#x25BE;');
        //$('.navigation .sub-menu .menu-parent > a, .banner .nav .sub-menu .menu-parent > a, .header-nav .sub-menu .menu-parent > a').append('&nbsp;&nbsp;&#x25B8;');
    });

    $(document).ready(function(){
        $("span.fb_share_no_count").each(function(){
            $(this).removeClass("fb_share_no_count");
            $(".fb_share_count_inner", this).html("0");
        });
    });

    $.fn.setAllToMaxHeight = function(){
        this.removeAttr('style');
        return this.css('min-height',( Math.max.apply(this, $.map( this , function(e){ return $(e).height() }) )) );
    };

    $.fn.setAllToMaxHeight2 = function(){
        this.removeAttr('style');
    };

    function setMenuPosition(){
        $('li > .sub-menu').each(function(){
            var themenu = $(this);
            var position = themenu.parent().position();
            var offset = themenu.parent().offset();
            if ((themenu.width() + offset.left) >= $(window).width()) {
                themenu.css('left','auto');
                themenu.css('right','-16px');
                themenu.find('.sub-menu').css('right','100%').css('left','auto');
            };
        });
    };

}(opjq));