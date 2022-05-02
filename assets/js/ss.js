(function ($) {
    localStorage.setItem("visualEditor", false);
    localStorage.setItem("beaverEditor", false);
    $(document).ready(function(){
        if(bertha_object.ber_everywhere == 'yes' && bertha_object.is_user_logged_in && bertha_object.current_page == 'index.php' && bertha_object.is_admin != 'false' && bertha_object.is_visual != 'true' && bertha_object.is_beaver != 'true' && bertha_object.is_oxygen != 'true' && bertha_object.is_thrive != 'true') {
            $('body').after('<a class="bertha bertha-dashboard-launcher" data-bs-toggle="offcanvas" aria-controls="offcanvasExample" href="#bertha_canvas"></a>');
        } else if(bertha_object.ber_everywhere == 'no' && bertha_object.is_user_logged_in && (bertha_object.current_page == 'index.php' || bertha_object.is_visual == 'true' || bertha_object.is_beaver == 'true' || bertha_object.is_oxygen == 'true' || bertha_object.is_thrive == 'true' || bertha_object.is_composer == 'true' || bertha_object.is_elementor == 'true' || $('body').hasClass('block-editor-page')) ) {
            if(bertha_object.is_divi) $(top.document.body).after('<a class="bertha bertha-dashboard-launcher" data-bs-toggle="offcanvas" aria-controls="offcanvasExample" href="#bertha_canvas"></a>');
            else $('body').after('<a class="bertha bertha-dashboard-launcher" data-bs-toggle="offcanvas" aria-controls="offcanvasExample" href="#bertha_canvas"></a>');

            if($('body.tcb-editor-main').length) $('body.tcb-editor-main').next().remove();
        }
    });

    focus();
    var iframeSelector = "iframe";


var iframeListener = window.addEventListener('blur', function() {
    if (document.activeElement.tagName == 'IFRAME' && document.activeElement.id != 'ct-artificial-viewport') {
        visualEditor_id = document.activeElement.id;
        if(visualEditor_id != 'elementor-preview-iframe') localStorage.setItem("visualEditor", '#'+visualEditor_id);
        detectfame(document.activeElement.id, $('#'+visualEditor_id));
    }
    window.removeEventListener('blur', iframeListener);
});
jQuery(document).on("click", ".elementor-widget-text-editor", function(e){
    e.preventDefault();
    var refreshIntervalId = setInterval(()=>{
        var iframe = $('#elementor-preview-iframe', top.document).closest('#elementor-preview').prev().find('.mce-tinymce iframe');
        if(iframe.length > 0){
            clearInterval(refreshIntervalId);
            localStorage.setItem("visualEditor", '#'+iframe.attr('id'));
            $('#elementor-preview-iframe', top.document).closest('#elementor-preview').prev().closest('body').next('#bertha_canvas').attr('data-block', '#'+iframe.attr('id'));
            detectfame(iframe.attr('id'), iframe);
        }
    }, 100);
});

$(document).on('click', '.oxy_rich_text', function(e) {
    e.preventDefault();
    var refreshIntervalId = setInterval(()=>{
        var iframe = $('#ct-artificial-viewport', top.document).closest('#ct-viewport-container').closest('body').find('#oxygen-ui .oxygen-tinymce-dialog-wrap  iframe');
        if(iframe.length > 0){
            clearInterval(refreshIntervalId);
            localStorage.setItem("visualEditor", '#'+iframe.attr('id'));
            $('#ct-artificial-viewport', top.document).closest('#ct-viewport-container').closest('body').next('#bertha_canvas').attr('data-block', '#'+iframe.attr('id'));
            detectfame(iframe.attr('id'), iframe);
        }
    }, 100);
})

function detectfame(bertha_iframe, bertha_iframe_element) {
    setTimeout(function(){
            if($(document).find('.et-fb-switch-editor-mode').next('.bertha').length) $(document).find('.et-fb-switch-editor-mode').next('.bertha').remove();
            if($(document).find('#et-fb-app-frame').next('.bertha').length) $(document).find('#et-fb-app-frame').next('.bertha').remove();
        }, 150);
    if(bertha_iframe_element.next('.bertha').length == 0) {
        var bertha_offset = bertha_iframe_element.offset();
        var bertha_width = $(this).width();
        if(bertha_object.ber_everywhere == 'yes' && bertha_iframe != 'tve-editor-frame' && bertha_iframe != 'elementor-preview-iframe' && bertha_iframe != 'vcv-editor-iframe') {
           if(bertha_object.is_elementor) bertha_iframe_element.after('<a class="bertha" data-bs-toggle="offcanvas" aria-controls="offcanvasExample" href="#bertha_canvas" style="top: 105px;"></a>');
           else bertha_iframe_element.after('<a class="bertha" data-bs-toggle="offcanvas" aria-controls="offcanvasExample" href="#bertha_canvas"></a>');
        }
        $(".bertha").offset({ top: bertha_offset.top }); //top right position
        if(bertha_iframe != 'elementor-preview-iframe') $('#bertha_canvas').attr('data-block', '#'+bertha_iframe);
        $('body #bertha_canvas').find('.ber-btn-check-template').each(function(){
            $(this).attr('data-block', bertha_iframe);
        });
    }
}

    $(document).click(function() {
        var ess = localStorage.getItem("visualEditor");
        var visualEditor = $(ess);
        if(visualEditor) {
            removeBertha(visualEditor);
            localStorage.setItem("visualEditor", false);
        }
    }); 

    $(document).on('click', '.et-fb-switch-editor-mode .et-fb-switch-editor-mode__tab--tinymce', function() {
        setTimeout(function(){
            if($(document).find('.et-fb-switch-editor-mode').next('.bertha').length) $(document).find('.et-fb-switch-editor-mode').next('.bertha').remove();
            if($(document).find('#et-fb-app-frame').next('.bertha').length) $(document).find('#et-fb-app-frame').next('.bertha').remove();
        }, 150);
    });

    $(document).on('focusin', 'textarea, input[type="text"], .block-editor-rich-text__editable, .block-editor-block-list__block, .ng-pristine, .fr-element.fr-view, .yst-replacevar__editor', function() {
        var input_id = $(this).attr('id');
        var input_name = $(this).attr('name');
        var gutenberg_block_bertha = $(document).find('.block-editor-block-list__layout').children().first();
        if(gutenberg_block_bertha.hasClass('bertha')) {
            gutenberg_block_bertha.remove();
        }
        if($(this).next('.bertha').length == 0 && $(this).closest('#bertha_canvas').length == 0 && $(this).attr('placeholder') != 'Search Options' && $(this).attr('id') != 'et-fb-filterByTitle' && input_name != 'link' && !$(this).hasClass('oxygen-add-searchbar')  && !$(this).hasClass('module-import-input') && $(this).attr('id') != 'et-fb-custom_margin-input-top' && $(this).attr('id') != 'et-fb-custom_margin-input-bottom' && $(this).attr('id') != 'et-fb-custom_margin-input-left' && $(this).attr('id') != 'et-fb-custom_margin-input-right' && $(this).attr('id') != 'et-fb-custom_padding-input-top' && $(this).attr('id') != 'et-fb-custom_padding-input-bottom' && $(this).attr('id') != 'et-fb-custom_padding-input-left' && $(this).attr('id') != 'et-fb-custom_padding-input-right' && $(this).attr('id') != 'add-content-search' && $(this).attr('placeholder') != '-' && $(this).attr('id') != 'ber_report_body' && !$(this).hasClass('ct-active-parent') ) { 
            if(bertha_object.is_thrive != 'true' || ( bertha_object.is_thrive == 'true' && $(this).closest('.fr-wrapper').next('.bertha').length == 0)) {
                var bertha_offset = $(this).offset();
                var bertha_width = $(this).width();
                if(bertha_object.is_thrive == 'true') {
                    $(this).closest('.fr-wrapper').uniqueId();
                    input_id = $(this).closest('.fr-wrapper').attr('id');
                    if( (bertha_object.ber_everywhere == 'yes' && bertha_object.is_user_logged_in) || $(this).closest('.popover-body').length) $(this).closest('.fr-wrapper').after('<a class="bertha" data-bs-toggle="offcanvas" aria-controls="offcanvasExample" href="#bertha_canvas"></a>');
                }else if(bertha_object.is_composer == 'true') {
                    $(this).uniqueId();
                    input_id = $(this).attr('id');
                    if( (bertha_object.ber_everywhere == 'yes' && bertha_object.is_user_logged_in) || $(this).closest('.popover-body').length) $(this).after('<a class="bertha" data-bs-toggle="offcanvas" aria-controls="offcanvasExample" href="#bertha_canvas"></a>');
                } else {
                    if($(this).hasClass('yst-replacevar__editor')) {
                        $(this).find('.public-DraftStyleDefault-ltr').uniqueId();
                        input_id = $(this).find('.public-DraftStyleDefault-ltr').attr('id');
                        if( (bertha_object.ber_everywhere == 'yes' && bertha_object.is_user_logged_in) || $(this).closest('.popover-body').length) $(this).find('.public-DraftStyleDefault-ltr').after('<a class="bertha" data-bs-toggle="offcanvas" aria-controls="offcanvasExample" href="#bertha_canvas"></a>');
                        //$(this).find('.public-DraftStyleDefault-ltr').append('<span class="yoast-bertha-custom"><span data-text="true"></span></span>');
                    }else if( (bertha_object.ber_everywhere == 'yes' && bertha_object.is_user_logged_in) || $(this).closest('.popover-body').length) {
                        if(bertha_object.is_oxygen == 'true') {
                            $(this).uniqueId();
                            input_id = $(this).attr('id');
                        }
                        $(this).after('<a class="bertha" data-bs-toggle="offcanvas" aria-controls="offcanvasExample" href="#bertha_canvas"></a>');
                    }
                }

                $(".bertha").offset({ top: bertha_offset.top, left: bertha_offset.left+bertha_width - 25}); //top right position
                if(input_id){
                    if(bertha_object.is_thrive == 'true') $('#bertha_canvas').attr('data-block', '#'+input_id+' .fr-element.fr-view');
                    else $('#bertha_canvas').attr('data-block', '#'+input_id);
                } else { 
                    $('#bertha_canvas').attr('data-block', '[name='+input_name+']');
                }
                if($(this).hasClass('wp-block-post-title') && $(this).hasClass('block-editor-block-list__block')) $('#bertha_canvas').attr('data-block', '.block-editor-block-list__block.wp-block-post-title');
                $('body #bertha_canvas').find('.ber-btn-check-template').each(function(){
                    $(this).attr('data-block', input_id);
                });
            }
        }
        setTimeout(function(){
            if($(document).find('.et-fb-switch-editor-mode').next('.bertha').length) $(document).find('.et-fb-switch-editor-mode').next('.bertha').remove();
            if($(document).find('#et-fb-app-frame').next('.bertha').length) $(document).find('#et-fb-app-frame').next('.bertha').remove();
        }, 150);
    });
    $(document).on('focusout', 'textarea, input[type="text"], .block-editor-rich-text__editable, .block-editor-block-list__block, .ng-pristine, .fr-element.fr-view, .yst-replacevar__editor', function() {
        if(bertha_object.is_thrive == 'true') removeBertha($(this).closest('.fr-wrapper'));
        else removeBertha($(this));
    });
    function removeBertha(input) {
        setTimeout(function(){
                input.next('.bertha').remove();
        }, 150);
    }
})(jQuery);
