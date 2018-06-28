(function ($){

    function getMetaContentByProperty(name,content)
    {
        var content = (content == null) ? 'content' : content;
        return document.querySelector("meta[property='"+name+"']").getAttribute(content);
    }

    $(document).ready(function(){

        var arOG = {
            URL: encodeURIComponent(getMetaContentByProperty("og:url")),
            TITLE: encodeURIComponent(getMetaContentByProperty("og:title")),
            IMAGE: encodeURIComponent(getMetaContentByProperty("og:image")),
            TEXT: encodeURIComponent(getMetaContentByProperty("og:description"))
        },
            md = new MobileDetect(window.navigator.userAgent);

        switch(md.os()){
            case "AndroidOS":
                $(".icon-android").addClass("active");
                break;
            case "iOS":
                $(".icon-apple").addClass("active");
                break;
            default:
                $(".icon-android").addClass("active");
                $(".icon-apple").addClass("active");
                break;
        }

        $(".share-links a").click(function(e)
        {
            e.preventDefault();

            var link = false;

            switch($(this).data("social"))
            {
                case "vk":
                    link = '//vk.com/share.php?url=' + arOG.URL;
                    break;

                case "facebook":
                    link = '//www.facebook.com/sharer/sharer.php?u=' + arOG.URL + '';
                    break;

                case "odnoklassniki":
                    link = '//ok.ru/dk?st.cmd=addShare&st._surl=' + arOG.URL + '&title=' + arOG.TITLE + '';
                    break;

                case "twitter":
                    link = '//twitter.com/intent/tweet?text='+ arOG.TEXT + '&url=' + arOG.URL + '';
                    break;

                default:
                    break;
            }

            if(link)
            {
                window.open(link, '_blank', 'scrollbars=0, resizable=1, menubar=0, left=100, top=100, width=550, height=440, toolbar=0, status=0');
            }
        });

        $(".faq-list .item-title").click(function()
        {
           var parent = $(this).closest(".item"),
               element = parent.find(".item-content");

           if(parent.hasClass("open"))
           {
               parent.removeClass("open");
               element.stop().animate({ height: "0" }, parseInt(500));
           }
           else
           {
               parent.addClass("open");
               var autoHeight = element.css('height', 'auto').height();
               element.height(0);
               element.stop().animate({ height: autoHeight }, parseInt(500));
           }

        });

        $("a[href^='#']").click(function (event) {
            event.preventDefault();
            var id  = $(this).attr('href'),
                top = $(id).offset().top;
            $('body,html').animate({scrollTop: top}, 1500);
        });

        function tableWrap(){
            if($(window).width() < 769){
                $(".table").each(function(){
                    if(!($(this).parent().hasClass("table-wrapper"))){
                        $(this).wrap("<div class='table-wrapper'></div>");
                    }
                });
            }
            else{
                $(".table").each(function(){
                   if($(this).parent().hasClass("table-wrapper")){
                       $(this).unwrap();
                   }
                });
            }
        }

        tableWrap();
        $(window).resize(function(){
            tableWrap();
        });


    });
})(jQuery);