(function ($) {
    var speed = 10;
    function typeWriter(text, selector, i, j, tag, myAudio) {
        if(j < text.length) {
            var txt = text[j];
            if (i <= txt.length) {
                if(tag && tag != 'INPUT' && tag != 'TEXTAREA') {
                    if(tag == 'IFRAME') {
                        var cur = $(selector).contents().find('body').html();
                        $(selector).contents().find('body').html(cur+txt.charAt(i));        
                    } else {
                        if($(selector).children('li').length) {
                            var cur = $(selector+' li:last-child').html();
                            $(selector+' li:last-child').html(cur+txt.charAt(i));
                        } else {
                            var cur = $(selector).html();
                            $(selector).html(cur+txt.charAt(i));
                        }
                    }
                } 
                else{
                    var cur = $(selector).val();
                    if($(selector).hasClass('editor-post-title__input')) wp.data.dispatch( 'core/editor' ).editPost( { title: cur+txt.charAt(i) } );
                    else $(selector).val(cur+txt.charAt(i));
                }
                i++;
                if(i == txt.length || txt.length == 0) {
                    $(document).find('.bertha_idea').each(function(){
                        $(this).removeClass('bertha_idea_non_clickable');
                    });
                    myAudio.pause();
                    if(tag == 'IFRAME') {
                        var cur = $(selector).contents().find('body').html();
                        $(selector).contents().find('body').html(cur+"<br>");
            			$(selector).contents().find('body').focus();
					    var e = jQuery.Event("keyup");
					    e.which = 32; // # Some key code value
					    $(selector).contents().find('body').html(cur+String.fromCharCode(e.which));
					    $(selector).contents().find('body').trigger(e);
                        $('#et-fb-filter-options--settings-modal-front--input').trigger('focus');
                    } else {
                        if($(selector).attr('data-type') == 'core/paragraph') {
                            $('.editor-post-title__input').focus();
                            var cur = $(selector).html();
                            $(selector).html(cur+"<br data-rich-text-line-break='true'>");
                        }
                    }
                    j++;
                    i = 0;
                }
                setTimeout(function() {
                    typeWriter(text, selector, i, j, tag, myAudio);
                }, speed);
            }
        }
    }

    function typeWriterText(txt, selector, i, tag, myAudio) { 
      if (i < txt.length) {
        if(tag && tag != 'INPUT' && tag != 'TEXTAREA') {
            if(tag == 'IFRAME') {
                var cur = $(selector).contents().find('body pre:last-child').html();
                $(selector).contents().find('body pre:last-child').html(cur+txt.charAt(i));        
            } else {
                console.log(selector);
                if($(selector).children('li').length) {
                    var cur = $(selector+' li:last-child').html();
                    $(selector+' li:last-child').html(cur+txt.charAt(i));
                } else if($(selector).hasClass('public-DraftStyleDefault-ltr')) {
                    cur = $(selector+ ' span.yoast-bertha-custom:last span').html();
                    $(selector+ ' span.yoast-bertha-custom:last span').html(cur+txt.charAt(i))
                } else {
                    var cur = $(selector).html();
                    $(selector).html(cur+txt.charAt(i));
                }
            }
        } 
        else{
            var cur = $(selector).val();
            if($(selector).hasClass('editor-post-title__input')) wp.data.dispatch( 'core/editor' ).editPost( { title: cur+txt.charAt(i) } );
            else $(selector).val(cur+txt.charAt(i));
        }
        i++;
        setTimeout(function() {
            typeWriterText(txt, selector, i, tag, myAudio);
        }, speed);
        if(i == txt.length) {
            $(document).find('.bertha_idea').each(function(){
                $(this).removeClass('bertha_idea_non_clickable');
                myAudio.pause();
            });
            var cur = $(selector).val();
            $(selector).focus();
		    var e = jQuery.Event("keyup");
		    e.which = 32; // # Some key code value
		    $(selector).val(cur+String.fromCharCode(e.which));
		    $(selector).trigger(e);
            $('#et-fb-filter-options--settings-modal-front--input').trigger('focus');
        }
      }
    }

    function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
        return false;
    };


    var wa_sidebar = bertha_setup_object.wa_template;
    $(document).ready(function(){
        var history_count = 20;
        var favourite_count = 20;
        var drft_count = 20;

        $(document).on('click', '.ber-nav-tabs li .ber-nav-link', function() {
            document.addEventListener('scroll', function (event) {
                var body = '';
                var tab = $(document).find('.ber-nav-tabs li .ber-nav-link.ber-active').attr('data-bs-target');
                if($('#bertha_canvas').find('.ber-offcanvas-body').length) body = $('#bertha_canvas').find('.ber-offcanvas-body');
                else if($('#bertha_backend_canvas').find('.ber-tab-pane.ber-active').length) body = $('#bertha_backend_canvas').find('.ber-tab-pane.ber-active');
                 if($(body).scrollTop() + $(body).innerHeight() >= $(body)[0].scrollHeight - 0.05) {
                    if(tab == '#history') {
                        var bertha_contents = 0;
                        $('#bertha_canvas, #bertha_backend_canvas').find('.idea-history #form4 .bertha-content-element').each(function() {
                            bertha_contents++;
                        });
                        if(bertha_contents && bertha_contents >= 20) {
                            $(".ber-offcanvas-body, .ber-tab-content").addClass("loading");
                            var ajaxurl = bertha_setup_object.ajax_url;
                            var data = {
                                action   : 'wa_bertha_load_history',
                                history_count : history_count,
                                bertha_load_history_nonce: bertha_setup_object.template_nonce
                            } 
                            $.post(ajaxurl, data, function(response) {
                                var result = JSON.parse(response);
                                if(result['response'] == "success") {
                                    $(".ber-offcanvas-body, .ber-tab-content").removeClass("loading");
                                    $('#bertha_canvas, #bertha_backend_canvas').find('.idea-history #form4').html(result['ideas']);
                                    history_count += 10;
                                }
                            });
                        }
                    } else if(tab == '#favourite') {
                        var bertha_favourites = 0;
                        $('#bertha_canvas, #bertha_backend_canvas').find('.favourite-idea #form4 .bertha-content-element').each(function() {
                            bertha_favourites++;
                        });
                        if(bertha_favourites && bertha_favourites >= 20) {
                            $(".ber-offcanvas-body, .ber-tab-content").addClass("loading");
                            var ajaxurl = bertha_setup_object.ajax_url;
                            var data = {
                                action   : 'wa_bertha_load_favourite',
                                favourite_count : favourite_count,
                                bertha_load_favourite_nonce: bertha_setup_object.template_nonce
                            } 
                            $.post(ajaxurl, data, function(response) {
                                var result = JSON.parse(response);
                                if(result['response'] == "success") {
                                    $(".ber-offcanvas-body, .ber-tab-content").removeClass("loading");
                                    $('#bertha_canvas, #bertha_backend_canvas').find('.favourite-idea #form4').html(result['ideas']);
                                    favourite_count += 10;
                                }
                            });
                        }
                    } else if(tab == '#backedn') {
                        var bertha_drafts = 0;
                        $('#bertha_backend_canvas').find('.bertha-backend-content #form4 .bertha-content-element').each(function() {
                            bertha_drafts++;
                        });
                        if(bertha_drafts && bertha_drafts >= 20) {
                            $(".ber-offcanvas-body, .ber-tab-content").addClass("loading");
                            var ajaxurl = bertha_setup_object.ajax_url;
                            var data = {
                                action   : 'wa_bertha_load_draft',
                                drft_count : drft_count,
                                bertha_load_draft_nonce: bertha_setup_object.template_nonce
                            } 
                            $.post(ajaxurl, data, function(response) {
                                var result = JSON.parse(response);
                                if(result['response'] == "success") {
                                    $(".ber-offcanvas-body, .ber-tab-content").removeClass("loading");
                                    $('#bertha_backend_canvas').find('.bertha-backend-content #form4').html(result['ideas']);
                                    drft_count += 10;
                                }
                            });
                        }
                    }
            }
            }, true);
        });

        
        var success = getUrlParameter('bertha_success_response');
        var expire = getUrlParameter('bertha_key_expires');
        var page = getUrlParameter('page');
        if(success && expire && !page)  $('#exampleModalCenter').show();
        $(document).on('click', '.bertha_close_modal', function() {
            $('#exampleModalCenter').hide();
        });
        if(bertha_setup_object.current_page != 'bertha-ai-backend-bertha') {
            if($('body').attr('ng-controller') != 'BuilderController') $("body").after(wa_sidebar);
            if($('#toplevel_page_bertha-ai-setting a.wp-first-item').length > 0) {
                $('#toplevel_page_bertha-ai-setting a.wp-first-item').attr("data-bs-toggle", "offcanvas");
                $('#toplevel_page_bertha-ai-setting a.wp-first-item').attr("aria-controls", "offcanvasExample");
                $('#toplevel_page_bertha-ai-setting a.wp-first-item').attr("href", "#bertha_canvas");
            }
        } else {
            if($('#toplevel_page_bertha-ai-setting a.wp-first-item').length > 0) {
                $('#toplevel_page_bertha-ai-setting a.wp-first-item').attr("id", "bertha_backend_launch");
                $('#toplevel_page_bertha-ai-setting a.wp-first-item').attr("href", "#");
            }
        }

        $(document).on('click', '#bertha_backend_launch', function() {
            $(this).after("<div class='ber-notice-content'>Oops... The Sidebar can't be launched within the Long-form editor.Please use the options on this page OR load Bertha within a post or page.</div>");
            setTimeout(function(){
              $('.ber-notice-content').remove();
            }, 5000);
        })
        
        $("#bertha_template_filter").keyup(function(){
            if($("#bertha_template_filter").val() == '') {
                $("#template_selection .ber_inner_title, #template_selection .ber_inner_p").show();
            }else {
                $("#template_selection .ber_inner_title, #template_selection .ber_inner_p").fadeOut();
            }
            var filter = $(this).val();
            $("#template_selection .ber-mb-3").each(function(){
                if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                    $(this).fadeOut();
                } else {
                    $(this).show();
                }
            });
        });

        $(".ber_form :input, .long_form_inputs :input").each(function(){
            if($(this).attr('maxlength')) {
                var max = $(this).attr('maxlength');
                var length = $(this).val().length;
                $(this).after('<p class="bertha_char_count">'+length+'/'+max+'</p>');
            }
        });
        $(".ber_form :input, .long_form_inputs :input").on("input", function() {
            var max = $(this).attr('maxlength');
            var length = $(this).val().length;
            $(this).next('p.bertha_char_count').html(length+'/'+max);
        });
    });
    $(document).on('click', '#ber_page1_save', function() {
        $('#ber_page1').hide();
        $('#ber_page3').show();
    });
    
    $(document).on('click', '#ber_page3_save', function() {
        var brand = $('#berbrand').val();
        var description = $('#berdescription').val();
        var ideal_cust = $('#beraudience').val();
        var sentiment = $('#bersentiment').val();
            $.ajax({
                url:  bertha_setup_object.ajax_url,
                data: {
                    action   : 'set_wizzard_setting_data',
                    brand : brand,
                    description : description,
                    ideal_cust : ideal_cust,
                    sentiment : sentiment,
                    bertha_wizzard_setup_nonce: $('#bertha_wizzard_setup_nonce').val()
                },
                type: 'POST',
                success: function( response ) {
                    $('#ber_page3').hide();
                    $('#ber_page4').show();
                }
            });
    });

    $(document).on('click', '.wa-generate-idea', function(e) {
        e.preventDefault();
        var wa_generate_idea_button = $(this);
        $(".ber-offcanvas-body, .ber-tab-content").addClass("loading");
        var wa_template = $(this).attr('data-id');
        var data_block = $(this).attr('data-block');
        var block = data_block+'bertha';
        var ajaxurl = bertha_setup_object.ajax_url;
        switch (wa_template) {
            case "USP":
                var data = {
                    action   : 'wa_open_ai_action',
                    bertha_brand : $('.bertha_brand').val(),
                    bertha_ideal_cust : $('.bertha_ideal_cust').val(),
                    bertha_sentiment : $('.bertha_sentiment').val(),
                    bertha_desc : $('.bertha_desc').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_brand : $(this).attr('data-brand'),
                    data_ideal_cust : $(this).attr('data-customer'),
                    data_sentiment : $(this).attr('data-sentiment'),
                    data_desc : $(this).attr('data-desc'),
                    bertha_usp_template_nonce: bertha_setup_object.template_nonce
                } 
                break;
            case "Headline":
                var data = {
                    action   : 'sub_headline_ai_action',
                    bertha_ideal_cust : $('.sub_headline_ideal_cust').val(),
                    bertha_sentiment : $('.sub_headline_sentiment').val(),
                    bertha_desc : $('.sub_headline_desc').val(),
                    sub_headline_usp : $('.sub_headline_usp').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_ideal_cust : $(this).attr('data-customer'),
                    data_sentiment : $(this).attr('data-sentiment'),
                    data_desc : $(this).attr('data-desc'),
                    data_headline_usp : $(this).attr('data-headline-usp'),
                    bertha_headline_template_nonce: bertha_setup_object.template_nonce
                } 
                break;
            case "Title":
                var data = {
                    action   : 'sec_generate_ai_action',
                    bertha_ideal_cust : $('.sec_title_ideal_cust').val(),
                    bertha_sentiment : $('.sec_title_sentiment').val(),
                    bertha_desc : $('.sec_title_desc').val(),
                    sec_title_type : $('.sec_title_type').val(),
                    sec_other_title : $('.other_title').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_ideal_cust : $(this).attr('data-customer'),
                    data_sentiment : $(this).attr('data-sentiment'),
                    data_desc : $(this).attr('data-desc'),
                    data_title_type : $(this).attr('data-title-type'),
                    data_other_title : $(this).attr('data-other-title'),
                    bertha_title_template_nonce: bertha_setup_object.template_nonce
                } 
                break;
            case "Paragraph":
                var data = {
                    action   : 'para_generate_ai_action',
                    bertha_ideal_cust : $('.para_ideal_cust').val(),
                    bertha_sentiment : $('.para_sentiment').val(),
                    bertha_desc : $('.para_desc').val(),
                    para_title : $('.para_title').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_ideal_cust : $(this).attr('data-customer'),
                    data_sentiment : $(this).attr('data-sentiment'),
                    data_desc : $(this).attr('data-desc'),
                    data_title : $(this).attr('data-title'),
                    bertha_para_template_nonce: bertha_setup_object.template_nonce
                } 
                break;
            case "Service":
                var data = {
                    action   : 'service_description_ai_action',
                    bertha_sentiment : $('.service_description_sentiment').val(),
                    bertha_desc : $('.service_description_desc').val(),
                    service_description_name : $('.service_description_name').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_sentiment : $(this).attr('data-sentiment'),
                    data_desc : $(this).attr('data-desc'),
                    data_desc_name : $(this).attr('data-desc-name'),
                    bertha_service_template_nonce: bertha_setup_object.template_nonce
                } 
                break;
            case "Company":
                var data = {
                    action   : 'company_bio_ai_action',
                    bertha_brand : $('.company_brand').val(),
                    bertha_desc : $('.company_bio_desc').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_desc : $(this).attr('data-desc'),
                    data_brand : $(this).attr('data-brand'),
                    bertha_company_template_nonce: bertha_setup_object.template_nonce
                } 
                break;
            case "Company-mission":
                var data = {
                    action   : 'company_mission_ai_action',
                    bertha_brand : $('.company_mission_brand').val(),
                    bertha_desc : $('.company_mission_desc').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_desc : $(this).attr('data-desc'),
                    data_brand : $(this).attr('data-brand'),
                    bertha_mission_template_nonce: bertha_setup_object.template_nonce
                } 
                break;
            case "Testimonial":
                var data = {
                    action   : 'testimonial_ai_action',
                    bertha_desc : $('.testimonial_desc').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_desc : $(this).attr('data-desc'),
                    bertha_testimonial_template_nonce: bertha_setup_object.template_nonce
                } 
                break;
            case "Benefit-List":
                var data = {
                    action   : 'benefit_ai_action',
                    bertha_desc : $('.benefit_desc').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_index_desc : $(this).attr('data-desc'),
                    bertha_lists_template_nonce: bertha_setup_object.template_nonce
                } 
                break;
            case "Content-Improver":
                var data = {
                    action   : 'content_improver_ai_action',
                    bertha_desc : $('.content_improver_desc').val(),
                    bertha_sentiment : $('.content_improver_sentiment').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_sentiment : $(this).attr('data-sentiment'),
                    data_desc : $(this).attr('data-desc'),
                    bertha_improver_template_nonce: bertha_setup_object.template_nonce
                } 
                break;
            case "Benefit-Title":
                var data = {
                    action   : 'benefit_title_ai_action',
                    bertha_desc : $('.Benefit_title_desc').val(),
                    Benefit_title : $('.Benefit_title').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_title : $(this).attr('data-title'),
                    data_desc : $(this).attr('data-desc'),
                    bertha_ben_title_template_nonce: bertha_setup_object.template_nonce
                } 
                break;
            case "bullet-points":
                var data = {
                    action   : 'bullet_points_ai_action',
                    bertha_desc : $('.bullet_desc').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_desc : $(this).attr('data-desc'),
                    bertha_points_template_nonce: bertha_setup_object.template_nonce
                } 
                break;
            case "personal-bio":
                var data = {
                    action   : 'personal_bio_ai_action',
                    bertha_sentiment : $('.personal_bio_sentiment').val(),
                    bertha_desc : $('.personal_bio_desc').val(),
                    personal_bio_point : $('.personal_bio_point').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_sentiment : $(this).attr('data-sentiment'),
                    data_desc : $(this).attr('data-desc'),
                    data_point : $(this).attr('data-point'),
                    bertha_bio_template_nonce: bertha_setup_object.template_nonce
                } 
                break;
            case "blog-post-idea":
                var data = {
                    action   : 'blog_idea_ai_action',
                    bertha_ideal_cust : $('.blog_idea_cust').val(),
                    bertha_sentiment : $('.blog_idea_sentiment').val(),
                    bertha_desc : $('.blog_idea_desc').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_ideal_cust : $(this).attr('data-customer'),
                    data_sentiment : $(this).attr('data-sentiment'),
                    data_desc : $(this).attr('data-desc'),
                    bertha_blog_post_template_nonce: bertha_setup_object.template_nonce
                } 
                break;
            case "blog-post-intro-paragraph":
                var data = {
                    action   : 'intro_paragraph_ai_action',
                    bertha_ideal_cust : $('.intro_ideal_cust').val(),
                    bertha_sentiment : $('.intro_sentiment').val(),
                    intro_title : $('.intro_title').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_ideal_cust : $(this).attr('data-customer'),
                    data_sentiment : $(this).attr('data-sentiment'),
                    data_title : $(this).attr('data-title'),
                    bertha_post_intro_template_nonce: bertha_setup_object.template_nonce
                } 
                break;
            case "blog-post-outline":
                var data = {
                    action   : 'post_outline_ai_action',
                    bertha_sentiment : $('.post_outline_sentiment').val(),
                    bertha_title : $('.post_outline_title').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_title : $(this).attr('data-title'),
                    data_sentiment : $(this).attr('data-sentiment'),
                    bertha_post_outline_template_nonce: bertha_setup_object.template_nonce
                } 
                break;
            case "blog-post-conclusion":
                var data = {
                    action   : 'conclusion_paragraph_ai_action',
                    bertha_cta : $('.conslusion_cta').val(),
                    bertha_sentiment : $('.conclusion_sentiment').val(),
                    bertha_title : $('.conclusion_title').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_cta : $(this).attr('data-cta'),
                    data_sentiment : $(this).attr('data-sentiment'),
                    data_title : $(this).attr('data-title'),
                    bertha_post_con_template_nonce: bertha_setup_object.template_nonce
                } 
                break;
            case "blog-action":
                var data = {
                    action   : 'blog_action_ai_action',
                    bertha_desc : $('.blog_action_desc').val(),
                    bertha_action : $('.blog_action').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_desc : $(this).attr('data-desc'),
                    data_action : $(this).attr('data-action'),
                    bertha_action_template_nonce: bertha_setup_object.template_nonce
                } 
                break;
             case "child-explain":
                var data = {
                    action   : 'child_input_ai_action',
                    child_input : $('.child_input').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_input : $(this).attr('data-input'),
                    bertha_child_template_nonce: bertha_setup_object.template_nonce
                } 
                break;
            case "seo-title":
                var data = {
                    action   : 'seo_title_ai_action',
                    bertha_brand : $('.seo_title_brand').val(),
                    bertha_keyword : $('.seo_keyword').val(),
                    bertha_title : $('.seo_title').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_title : $(this).attr('data-title'),
                    data_keyword : $(this).attr('data-keyword'),
                    data_brand : $(this).attr('data-brand'),
                    bertha_seo_title_template_nonce: bertha_setup_object.template_nonce
                } 
                break;
            case "seo-description":
                var data = {
                    action   : 'seo_description_ai_action',
                    bertha_keyword : $('.seo_desc_keyword').val(),
                    bertha_title : $('.seo_desc_title').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_title : $(this).attr('data-title'),
                    data_keyword : $(this).attr('data-keyword'),
                    bertha_seo_desc_template_nonce: bertha_setup_object.template_nonce
                }  
                break;
            case "aida-marketing":
                var data = {
                    action   : 'aida_marketing_ai_action',
                    bertha_brand : $('.aida_brand').val(),
                    bertha_ideal_cust : $('.aida_cust').val(),
                    bertha_sentiment : $('.aida_Sentiment').val(),
                    bertha_desc : $('.aida_desc').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_brand : $(this).attr('data-brand'),
                    data_ideal_cust : $(this).attr('data-customer'),
                    data_sentiment : $(this).attr('data-sentiment'),
                    data_desc : $(this).attr('data-desc'),
                    bertha_aida_marketing_template_nonce: bertha_setup_object.template_nonce
                } 
                break;
            case "seo-city":
                var data = {
                    action   : 'seo_city_ai_action',
                    bertha_brand : $('.seo_city_brand').val(),
                    bertha_city : $('.seo_city').val(),
                    bertha_cta : $('.seo_city_cta').val(),
                    bertha_keyword : $('.seo_city_keyword').val(),
                    bertha_desc : $('.seo_city_desc').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_brand : $(this).attr('data-brand'),
                    data_city : $(this).attr('data-city'),
                    data_cta : $(this).attr('data-cta'),
                    data_keyword : $(this).attr('data-keyword'),
                    data_desc : $(this).attr('data-desc'),
                    bertha_seo_city_template_nonce: bertha_setup_object.template_nonce
                } 
                break;
            case "buisiness-name":
                var data = {
                    action   : 'buisiness_name_ai_action',
                    bertha_sentiment : $('.buisiness_name_vibe').val(),
                    bertha_desc : $('.buisiness_name_desc').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_sentiment : $(this).attr('data-sentiment'),
                    data_desc : $(this).attr('data-desc'),
                    bertha_buisiness_name_template_nonce: bertha_setup_object.template_nonce
                } 
                break;
            case "bridge":
                var data = {
                    action   : 'bridge_ai_action',
                    bertha_brand : $('.bridge_brand').val(),
                    bertha_ideal_cust : $('.bridge_cust').val(),
                    bertha_sentiment : $('.bridge_Sentiment').val(),
                    bertha_desc : $('.bridge_desc').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_brand : $(this).attr('data-brand'),
                    data_ideal_cust : $(this).attr('data-customer'),
                    data_sentiment : $(this).attr('data-sentiment'),
                    data_desc : $(this).attr('data-desc'),
                    bertha_bridge_template_nonce: bertha_setup_object.template_nonce
                } 
                break;
            case "pas-framework":
                var data = {
                    action   : 'pas_framework_ai_action',
                    bertha_brand : $('.pas_brand').val(),
                    bertha_ideal_cust : $('.pas_cust').val(),
                    bertha_sentiment : $('.pas_Sentiment').val(),
                    bertha_desc : $('.pas_desc').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_brand : $(this).attr('data-brand'),
                    data_ideal_cust : $(this).attr('data-customer'),
                    data_sentiment : $(this).attr('data-sentiment'),
                    data_desc : $(this).attr('data-desc'),
                    bertha_pas_framework_template_nonce: bertha_setup_object.template_nonce
                } 
                break;
            case "faq-list":
                var data = {
                    action   : 'faq_list_ai_action',
                    bertha_desc : $('.faq_list_desc').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_desc : $(this).attr('data-desc'),
                    bertha_faq_list_template_nonce: bertha_setup_object.template_nonce
                } 
                break;
            case "faq-answer":
                var data = {
                    action   : 'faq_answer_ai_action',
                    bertha_question : $('.faq_answer_question').val(),
                    bertha_desc : $('.faq_answer_desc').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_question : $(this).attr('data-question'),
                    data_desc : $(this).attr('data-desc'),
                    bertha_faq_answer_template_nonce: bertha_setup_object.template_nonce
                } 
                break;
            case "summaries":
                var data = {
                    action   : 'summaries_ai_action',
                    bertha_summary : $('.content_summary').val(),
                    bertha_sentiment : $('.summary_sentiment').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_summary : $(this).attr('data-summary'),
                    data_sentiment : $(this).attr('data-sentiment'),
                    bertha_summaries_template_nonce: bertha_setup_object.template_nonce
                } 
                break;
            case "contact-blurb":
                var data = {
                    action   : 'contact_blurb_ai_action',
                    bertha_brand : $('.contact_blurb_brand').val(),
                    bertha_cta : $('.contact_blurb_cta').val(),
                    bertha_desc : $('.contact_blurb_desc').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_brand : $(this).attr('data-brand'),
                    data_cta : $(this).attr('data-cta'),
                    data_desc : $(this).attr('data-desc'),
                    bertha_contact_blurb_template_nonce: bertha_setup_object.template_nonce
                } 
                break;
            case "seo-keyword":
                var data = {
                    action   : 'seo_keyword_ai_action',
                    bertha_desc : $('.seo_keyword_desc').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_desc : $(this).attr('data-desc'),
                    bertha_seo_keyword_template_nonce: bertha_setup_object.template_nonce
                } 
                break;
            case "evil-bertha":
                var data = {
                    action   : 'evil_bertha_ai_action',
                    bertha_desc : $('.evil_bertha_bio').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_desc : $(this).attr('data-desc'),
                    bertha_evil_bertha_template_nonce: bertha_setup_object.template_nonce
                } 
                break;
            case "real-estate":
                var data = {
                    action   : 'real_estate_ai_action',
                    bertha_brand : $('.real_estate_brand').val(),
                    bertha_location : $('.real_estate_location').val(),
                    bertha_type : $('.real_estate_type').val(),
                    bertha_desc : $('.real_estate_desc').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_brand : $(this).attr('data-brand'),
                    data_location : $(this).attr('data-location'),
                    data_type : $(this).attr('data-type'),
                    data_desc : $(this).attr('data-desc'),
                    bertha_real_estate_template_nonce: bertha_setup_object.template_nonce
                } 
                break;
            case "press-blurb":
                var data = {
                    action   : 'press_blurb_ai_action',
                    bertha_name : $('.press_blurb_pub_name').val(),
                    bertha_info : $('.press_blurb_article_info').val(),
                    bertha_desc : $('.press_blurb_desc').val(),
                    bertha_keyword : $('.press_blurb_keyword').val(),
                    bertha_brand : $('.press_blurb_brand').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_name : $(this).attr('data-name'),
                    data_info : $(this).attr('data-info'),
                    data_desc : $(this).attr('data-desc'),
                    data_keyword : $(this).attr('data-keyword'),
                    data_brand : $(this).attr('data-brand'),
                    bertha_press_blurb_template_nonce: bertha_setup_object.template_nonce
                } 
                break;
            case "case-study":
                var data = {
                    action   : 'case_study_ai_action',
                    bertha_subject : $('.case_study_subject').val(),
                    bertha_info : $('.case_study_info').val(),
                    bertha_brand : $('.case_study_brand').val(),
                    bertha_desc : $('.case_study_desc').val(),
                    bertha_keyword : $('.case_study_keyword').val(),
                    bertha_desc_index : $(this).attr('data-index'),
                    data_subject : $(this).attr('data-subject'),
                    data_info : $(this).attr('data-info'),
                    data_brand : $(this).attr('data-brand'),
                    data_desc : $(this).attr('data-desc'),
                    data_keyword : $(this).attr('data-keyword'),
                    bertha_case_study_template_nonce: bertha_setup_object.template_nonce
                } 
                break;
            default:
                alert("You have selected wrong template.");
        }
        console.log(data);
        data['data_block'] = data_block;
        var bertha_desc = child_input = bertha_summary = '';
        if(data['data_desc']!== undefined) bertha_desc = data['data_desc'];
        else bertha_desc = data['bertha_desc'];
        if(data['data_input']!== undefined) child_input = data['data_input'];
        else child_input = data['child_input'];
        if(data['data_summary']!== undefined) bertha_summary = data['data_summary'];
        else bertha_summary = data['bertha_summary'];
        if( wa_generate_idea_button.hasClass('bertha-desc-notice') && (bertha_desc !== undefined && bertha_desc.length < 200) || (child_input !== undefined && child_input.length < 200) || (bertha_summary !== undefined && bertha_summary.length < 200)) {
            $(".ber-offcanvas-body, .ber-tab-content").removeClass("loading"); 
            wa_generate_idea_button.removeClass('bertha-desc-notice');
            $('.ber-offcanvas').after('<div class="ber-notice-content">OPTIONAL: We recommend at least 200 characters to get better results. Click generate to ignore this message or Add more characters.</div>')
            setTimeout(function(){
                  $('.ber-notice-content').remove();
            }, 5000);
        } else {
            $.post(ajaxurl, data, function(response) {
                var result = JSON.parse(response);
                $('.bertha-back').attr('id', 'back3');
                $('.idea-history').html(result['idea_history']);
                var limit_percentage = (result['left_limit'] * 100) / result['limit'];
                if($('.ber-progress-bar').hasClass('bg-success')) {
                    $('.ber-progress-bar').removeClass('bg-success');
                }else if($('.ber-progress-bar').hasClass('bg-warning')) {
                    $('.ber-progress-bar').removeClass('bg-warning');
                }else if($('.ber-progress-bar').hasClass('bg-danger')) {
                    $('.ber-progress-bar').removeClass('bg-danger');
                }
                limit_percentage = limit_percentage >= 0 ? limit_percentage : 100;
                if(limit_percentage < 50) {
                    var meter = 'success';
                }else if(limit_percentage >= 50 && limit_percentage < 80) {
                    var meter = 'warning';
                }else if(limit_percentage >= 80) {
                    var meter = 'danger';
                }
                $('.ber-progress-bar').addClass('bg-'+meter);
                $('.ber-progress-bar').css('width', limit_percentage+'%');
                $('.ber-progress-bar').attr('aria-valuenow', limit_percentage);

                if(result['left_limit'] >= result['limit'] || result['token_denied']) $('.ber_metrix_bar').html('<a class="ber_btn" href="https://bertha.ai/pricing/?plugin=1" target="_blank">Upgrade Now</a>');
                else $("head").append($('<style>.ber-progress-bar:after { content: "'+result['left_limit']+' / '+result['limit']+'" !important; position: absolute !important; left: 50% !important; color: black !important; }</style>'));
                $('.ber-offcanvas-body').animate({ scrollTop: 0 }, 0);
                $(".ber-offcanvas-body, .ber-tab-content").removeClass("loading"); 
                $('#bertha_canvas').addClass('bertha-idea-expand');
                $(document).find('.ber-sidebar_expension').addClass('expanded');
                //$(document).find('.ber-sidebar_expension').html('Shrink Sidebar');
                $('#bertha_canvas, #bertha_backend_canvas').find('#template_selection').hide();
                $('#bertha_canvas, #bertha_backend_canvas').find('#template_description').hide();
                var temp_desc = $('#bertha_canvas, #bertha_backend_canvas').find('#template_description').html();
                if(result['token_denied']) $('#bertha_canvas, #bertha_backend_canvas').find('#template_description').html(result['token_denied']); 
                else $('#bertha_canvas, #bertha_backend_canvas').find('#template_description').html(result['html']);
                $(document).find('#samsa').show();
                $('#bertha_canvas, #bertha_backend_canvas').find('#samsa').html($('#bertha_canvas, #bertha_backend_canvas').find('#template_description').html());
                $('#bertha_canvas, #bertha_backend_canvas').find('#template_description').html(temp_desc);
                $('#bertha_canvas, #bertha_backend_canvas').find('#template_description').css('right', '-450px');
                $('#bertha_canvas, #bertha_backend_canvas').find('#template_description').hide();
                $('#bertha_canvas, #bertha_backend_canvas').find('#samsa').css('right', '20px');
            });
        }
    });

    $(document).on('click', '.bertha_template', function(e) {
        e.preventDefault();
        var prev = $(this).prev('.ber-btn-check-template');
        var data_block = prev.attr('data-block');
        $(".ber-offcanvas-body, .ber-tab-content").addClass("loading");
        var wa_template = prev.attr('data-id');
        var wa_template_name = prev.attr('data-name');
        var block = data_block+'bertha';
        var ajaxurl = bertha_setup_object.ajax_url;
        var data = {
            action   : 'wa_ai_templates',
            wa_template : wa_template,
            data_block : data_block,
            bertha_template_nonce: $('#bertha_template_nonce').val()
        } 
        $.post(ajaxurl, data, function(result) {
            var response = JSON.parse(result);
            $('.bertha-back').show();
            $('.bertha-back').attr('id', 'back4');
            $('.ber-offcanvas-body').animate({ scrollTop: 0 }, 0);
            $(".ber-offcanvas-body, .ber-tab-content").removeClass("loading"); 
            $('#bertha_canvas, #bertha_backend_canvas').find('#ber-offcanvasExampleLabel').html(response['tax_description']);
            //$('#bertha_canvas, #bertha_backend_canvas').find('.ber_inner_ber-offcanvas').html(response['tax_description']);
            $('#bertha_canvas, #bertha_backend_canvas').find('#template_description').show();
            $('#bertha_canvas, #bertha_backend_canvas').find('#template_description').html(response['html']);
            $('#bertha_canvas, #bertha_backend_canvas').find('#template_selection').css({'right':'-450px'});
            $('#bertha_canvas, #bertha_backend_canvas').find('#template_description').css({'right':'20px'});
            $('#bertha_canvas, #bertha_backend_canvas').find('#template_selection').hide();

            $('#bertha_canvas, #bertha_backend_canvas').find("#template_description :input").each(function(){
                if($(this).attr('maxlength')) {
                    var max = $(this).attr('maxlength');
                    var length = $(this).val().length;
                    $(this).after('<p class="bertha_char_count">'+length+'/'+max+'</p>');
                }
            });
            $('#bertha_canvas, #bertha_backend_canvas').find("#template_description :input").on("input", function() {
                var max = $(this).attr('maxlength');
                var length = $(this).val().length;
                $(this).next('p.bertha_char_count').html(length+'/'+max);
            });
        });
    });


    $(document).on('click', '.bertha_idea', function(e) {
        e.preventDefault();
        if($('.ber-offcanvas.bertha-ai').data('block') || $('#bertha_backend_canvas').data('block') || bertha_setup_object.current_page == 'bertha-ai-backend-bertha') {
            if($('#bertha_canvas').attr('data-block') != '#et-fb-app-frame' && $('#bertha_canvas').attr('data-block') != '#elementor-preview-iframe' && $('#bertha_canvas').attr('data-block') != '#vcv-editor-iframe') {
                if(!$('#bertha_backend_canvas').data('block')) $('#bertha_backend_canvas').attr('data-block', '#bertha_backend_body_ifr');
                if(!$(this).hasClass('bertha_idea_non_clickable')) {
                    var prev = $(this).prev('.ber-idea-btn-check');
                    var content_block = $('#bertha_canvas, #bertha_backend_canvas').attr('data-block');
                    prev.prop('checked', true);
                    var ss = $(this).find('.bertha_idea_body pre').html();
                    var tag = $(content_block).prop("tagName");
                    var myAudio = new Audio(bertha_setup_object.bertha_sound);
                    myAudio.play();
                    $(document).find('.bertha_idea').each(function(){
                        $(this).addClass('bertha_idea_non_clickable');
                    });
                    if(tag == 'IFRAME' || $(content_block).attr('data-type') == 'core/paragraph') {
                        ss = ss.split("\n");
                        typeWriter(ss, content_block, 0, 0, tag, myAudio);
                    }
                    else {
                        if(tag == 'INPUT') $('#titlewrap #title-prompt-text').hide();
                        $(content_block).focus().trigger('focusin');
                        $(content_block).find('span:last').before('<span class="yoast-bertha-custom"><span data-text="true"></span></span>');
                        typeWriterText(ss, content_block, 0, tag, myAudio);
                    }
                }
            } else {
                $(this).after('<div class="ber-notice-content">Please click inside the text area you would like to add this idea, then click the idea again to add the text to that area</div>')
            setTimeout(function(){
              $('.ber-notice-content').remove();
            }, 5000);
            }
        } else {
            $(this).after('<div class="ber-notice-content">Please click inside the text area you would like to add this idea, then click the idea again to add the text to that area</div>')
            setTimeout(function(){
              $('.ber-notice-content').remove();
            }, 5000);

        }
    });

    $(document).on('click', '#back4', function(e) {
        e.preventDefault();
        var data_block = $(this).attr('data-block');
        var block = data_block+'bertha';
        $('#bertha_canvas, #bertha_backend_canvas').find('#ber-offcanvasExampleLabel').html('What are we writing?');
        $('#bertha_canvas, #bertha_backend_canvas').find('.ber_inner_offcanvas').html('');
        $('#bertha_canvas, #bertha_backend_canvas').find('#template_selection').show();
        $('#bertha_canvas, #bertha_backend_canvas').find('#template_selection').css({'right':'20px'});
        $('#bertha_canvas, #bertha_backend_canvas').find('#template_description').css({'right':'-450px'});
        $('#bertha_canvas, #bertha_backend_canvas').find('#template_description').hide();
        $('#bertha_canvas, #bertha_backend_canvas').find('.ber-offcanvas-body').animate({ scrollTop: 0 }, 0);
        $('.bertha-back').hide();
        $('.bertha-back').removeAttr("id");
    });

    $(document).on('click', '#back3', function(e) {
        e.preventDefault();
        var data_block = $(this).attr('data-block');
        var block = data_block+'bertha';
        $('.bertha-back').attr('id', 'back4');
        $('#bertha_canvas').removeClass('bertha-idea-expand');
        $('#bertha_canvas, #bertha_backend_canvas').find('#template_description').show();
        $(document).find('#samsa').css('right', '-450px');
        $(document).find('#samsa').hide();
        $('#bertha_canvas, #bertha_backend_canvas').find('#template_description').css({'right':'20px'});
        $('#bertha_canvas, #bertha_backend_canvas').find('.ber-offcanvas-body').animate({ scrollTop: 0 }, 0);    
    });

    $(document).on('change', '#history_filter', function(e) {
        e.preventDefault();
        $(".ber-offcanvas-body, .ber-tab-content").addClass("loading");
        var wa_template = $('#history_filter').val();
        var ajaxurl = bertha_setup_object.ajax_url;
        var data = {
            action   : 'wa_history_filter',
            wa_template : wa_template,
            bertha_history_filter_nonce: bertha_setup_object.template_nonce
        } 
        $.post(ajaxurl, data, function(response) {
            $('.ber-offcanvas-body').animate({ scrollTop: 0 }, 0);
            $(".ber-offcanvas-body, .ber-tab-content").removeClass("loading"); 
            $('.idea-history').html('');
            $('.idea-history').html(response);
        });
    });

    $(document).on('click', '.ber-sidebar_expension', function() {
        if(!$(this).hasClass('expanded')) {
            $('#bertha_canvas').addClass('bertha-idea-expand');
            $(this).addClass('expanded');
        } else {
            $('#bertha_canvas').removeClass('bertha-idea-expand');
            $(this).removeClass('expanded');
        }
    });

    $(document).on('click', '#next3', function(e) {
        e.preventDefault();
        $('#bertha_canvas, #bertha_backend_canvas').find('#ber-offcanvasExampleLabel').html('What are we writing?');
        $('#bertha_canvas, #bertha_backend_canvas').find('.ber_inner_offcanvas').html('');
        $(document).find('#samsa').css('right', '-450px');
        $(document).find('#samsa').hide();
        $('#bertha_canvas, #bertha_backend_canvas').find('#template_description').css({'right':'-450px'});
        $('#bertha_canvas, #bertha_backend_canvas').find('#template_description').hide();
        $('#bertha_canvas, #bertha_backend_canvas').find('#template_selection').show();
        $('#bertha_canvas, #bertha_backend_canvas').find('#template_selection').css({'right':'20px'});
        $('#bertha_canvas, #bertha_backend_canvas').find('.ber-offcanvas-body').animate({ scrollTop: 0 }, 0);
        $('#bertha_canvas').removeClass('bertha-idea-expand');
        $(document).find('.ber-sidebar_expension').removeClass('expanded');
        $('.bertha-back').hide();
        $('.bertha-back').removeAttr("id");
    });

    $(document).on('click', '.ber-nav-link', function() {
        var control = $(this).attr('aria-controls');
        if(control == 'history') {
            $('.ber-nav-item #templates-tab').removeClass('ber-active');
            $('.ber-tab-content #templates').removeClass('ber-show ber-active');
            $('.ber-nav-item #favourite-tab').removeClass('ber-active');
            $('.ber-tab-content #favourite').removeClass('ber-show ber-active');
        } else if(control == 'templates') {
            $('.ber-nav-item #history-tab').removeClass('ber-active');
            $('.ber-tab-content #history').removeClass('ber-show ber-active');
            $('.ber-nav-item #favourite-tab').removeClass('ber-active');
            $('.ber-tab-content #favourite').removeClass('ber-show ber-active');
        }else if(control == 'favourite') {
            $('.ber-nav-item #templates-tab').removeClass('ber-active');
            $('.ber-tab-content #templates').removeClass('ber-show ber-active');
            $('.ber-nav-item #history-tab').removeClass('ber-active');
            $('.ber-tab-content #history').removeClass('ber-show ber-active');
        }
        $(this).addClass('ber-active');
        $('.ber-tab-content #'+control).addClass('ber-show ber-active');
    });

    // $(document).on('click', '.ber-btn-close', function() {
    //     $('.ber-offcanvas').css('visibility', 'hidden');
    //     $('.ber-offcanvas').removeClass('show');
    //     $('.ber-offcanvas').removeAttr('role');
    //     $('.ber-offcanvas').removeAttr('aria-modal');
    //     $('.ber-offcanvas').attr('aria-hidden', 'true');
    // });

    $(document).on('click', '.bertha_idea_copy', function(e) {
        e.preventDefault();
        $(".ber-offcanvas-body, .ber-tab-content").addClass("loading");
        var idea_id = $(this).attr('data-value');
        var ajaxurl = bertha_setup_object.ajax_url;
        var data = {
            action   : 'long_form_edit_draft_ai_action',
            draft_id : idea_id,
            bertha_draft_edit_nonce: bertha_setup_object.template_nonce
        }  
        $.post(ajaxurl, data, function(response) {
            var result = JSON.parse(response);
            if(result['draft_body'] != 'false') {
                $(".ber-offcanvas-body, .ber-tab-content").removeClass("loading");
                navigator.clipboard.writeText(result['draft_body']);
                var berthaCopied = $(this).next('#berthaCopied');
                berthaCopied.html('Copied');
            }
        });
    });

    $(document).on('click', '.bertha_idea_favourite', function(e) {
        e.preventDefault();
        var favourite_bertha_element =  $(this);
        if(favourite_bertha_element.hasClass('favourate_added')) {
            var request_type = 'remove-favourate';
        } else {
            var request_type = 'add-favourate';
        }
        $(".ber-offcanvas-body, .ber-tab-content").addClass("loading");
        var idea_id = favourite_bertha_element.attr('data-value');
        var berthaFavourite =favourite_bertha_element.next('#berthaFavourite');
        var ajaxurl = bertha_setup_object.ajax_url;
        var data = {
            action   : 'wa_favourite_added',
            idea_id : idea_id,
            request_type : request_type,
            bertha_favourite_idea_nonce: bertha_setup_object.template_nonce
        }
        console.log(data); 
        $.post(ajaxurl, data, function(response) {
            var result = JSON.parse(response);
            if(result['response'] == 'success') {
                $('.favourite-idea').html(result['favourite_ideas']);
                $(".ber-offcanvas-body, .ber-tab-content").removeClass("loading"); 
                if(!favourite_bertha_element.hasClass('favourate_added')){
                    favourite_bertha_element.addClass('favourate_added');
                    berthaFavourite.html('Favourite added');
                    $('.idea-history').find('.bertha_idea_favourite[data-value='+idea_id+']').addClass('favourate_added');
                    $('.idea-history').find('.bertha_idea_favourite[data-value='+idea_id+']').next('#berthaFavourite').html('Favourite added');
                } else {
                    favourite_bertha_element.removeClass('favourate_added');
                    berthaFavourite.html('Add to favourite');
                    $('.idea-history').find('.bertha_idea_favourite[data-value='+idea_id+']').removeClass('favourate_added');
                    $('.idea-history').find('.bertha_idea_favourite[data-value='+idea_id+']').next('#berthaFavourite').html('Add to favourite');
                }
            }
        });
    });

    $(document).on('click', '.bertha_idea_trash', function(e) {
        e.preventDefault();
        var favourite_bertha_element =  $(this);
        $(".ber-offcanvas-body, .ber-tab-content").addClass("loading");
        var idea_id = favourite_bertha_element.attr('data-value');
        var ajaxurl = bertha_setup_object.ajax_url;
        var data = {
            action   : 'wa_idea_trash',
            idea_id : idea_id,
            bertha_idea_trash_nonce: bertha_setup_object.template_nonce
        }
        $.post(ajaxurl, data, function(response) {
            var result = JSON.parse(response);
            if(result['response'] == 'success') {
                $('.idea-history').html(result['idea_history']);
                $('.favourite-idea').html(result['favourite_ideas']);
                if(favourite_bertha_element.closest('#samsa').length || favourite_bertha_element.closest('.bertha-backend-content').length) {
                    favourite_bertha_element.closest('.ber-mb-3').remove();
                }
                $(".ber-offcanvas-body, .ber-tab-content").removeClass("loading"); 
            }
        });
    });

    $(document).on('click', '.bertha_idea_report', function(e) {
        e.preventDefault();
        var idea_id = $(this).attr('data-value');
        if($('#ber_idea_report_modal').length) {
            $('#ber_idea_report_modal').show();
            $('#ber_idea_report_modal').attr('data-id', idea_id);
        } else if($('iframe').contents().find('body #ber_idea_report_modal').length) {
            $('iframe').contents().find('body #ber_idea_report_modal').show();
            $('iframe').contents().find('body #ber_idea_report_modal').attr('data-id', idea_id);
        }
    });
    $(document).on('click', '.ber-report-close', function() {
        $('#ber_idea_report_modal').hide();
        $('#ber_idea_report_modal').removeAttr('data-id');
        $('.ber-modal-body').show();
        $('.ber-modal-footer').show();
        $('#ber_idea_report_modal').find('.ber-modal-body.ber-report-response').remove();
        $('#ber_report_body').val('');
    });
    $(document).on('click', '.ber_report_submit', function() {
        console.log('works');
        $("#ber_idea_report_modal").addClass("loading");
        var idea_id = $('#ber_idea_report_modal').attr('data-id');
        var report_body = $('#ber_report_body').val();
        var ajaxurl = bertha_setup_object.ajax_url;
        var data = {
            action   : 'wa_idea_report',
            idea_id : idea_id,
            report_body : report_body,
            bertha_idea_report_nonce: bertha_setup_object.template_nonce
        }
        $.post(ajaxurl, data, function(response) {
            var result = JSON.parse(response);
            console.log(result);
            if(result['response'] == 'success') {
                $("#ber_idea_report_modal").removeClass("loading"); 
                $('.ber-modal-body').hide();
                $('.ber-modal-footer').hide();
                $('.ber-modal-header').after('<div class="ber-modal-body ber-report-response"><div class="ber_inner_title">Thank You for Your Submission.</div></div>');
            }
        });
    });

    $(document).on('change', '.sec_title_type', function() {
        if($(this).val() == 'other') $('.other-title').show();
        else $('.other-title').hide();
    });

    $(document).on('click', '.ber_search_tag', function(e) {
        e.preventDefault();
        console.log('okay');
        var template_tag = $(this).attr('data-id');
        $('.ber_search_tag').each(function() {
            $(this).removeClass('active');
        });
        $(this).addClass('active');
        $('.bertha_template').each(function() {
            if(template_tag != 'all') {
                if($(this).attr('data-id') != template_tag) $(this).closest('.ber-mb-3').hide();
                else $(this).closest('.ber-mb-3').show();
            } else {
                $(this).closest('.ber-mb-3').show();
            }
        });
        $('.ber_inner_title, .ber_inner_p').each(function() {
            if(template_tag != 'all') {
                if($(this).attr('data-id') != template_tag) $(this).hide();
                else $(this).show();
            }else {
                $(this).show();
            }
        });
    });

    $(document).on('click', '.bertha', function() {
        if($('.ber-offcanvas-end').hasClass('show') && $('body').find('.popover-body').length) {
            if(jQuery_WPF('#wpf_launcher .wpf_sidebar_container').hasClass('active')) {

                jQuery_WPF('#wpf_launcher .wpf_sidebar_container').css({"opacity": "0","margin-right": "-380px"});

                jQuery_WPF('#wpf_launcher .wpf_sidebar_container').removeClass('active');

                if(jQuery_WPF('a.wpf_filter_tab_btn_bottom.wpf_btm_withside').hasClass('wpf_active')){
                    jQuery_WPF('.wpf_list').removeClass('wpf_active').addClass('wpf_hide');
                    jQuery_WPF('a.wpf_filter_tab_btn_bottom.wpf_btm_withside').removeClass('wpf_active');

                    //graphics page
                    graphics_sidebar_active();
                }
            }
        }
    });

    /*free */
    $(document).on('click', '#ber-create-user', function(e) {
        e.preventDefault();
        var ber_free_name = $('#ber_free_name').val();
        var ber_free_email = $('#ber_free_email').val();
        if(Is_Ber_Email(ber_free_email)==true){
            if(ber_free_email == '' || ber_free_name == '') {
                $(this).after('<div class="ber-notice-content">Please Fill All the Fields</div>')
                setTimeout(function(){
                  $('.ber-notice-content').remove();
                }, 5000);
            } else {
    			$(document).find('#ber_page2_save').attr('data-email', ber_free_email);
                $(this).css('cursor', 'not-allowed');
                var data = {
                    action   : 'wa_ber_free_create_purchase',
                    ber_free_name : ber_free_name,
                    ber_free_email : ber_free_email,
                    bertha_ber_create_nonce: $('#bertha_ber_create_nonce').val()
                } 
                $.post(ajaxurl, data, function(response) {
                    if(response != 'failed') {
                        $(this).css('cursor', '');
                        $('#ber_page1').hide();
                        $('#ber_page2').show();
                        $('.bertha-free-user').val(response);
                    }
                });
            }
        } else {
            $(this).after('<div class="ber-notice-content">Invalid Email</div>')
                setTimeout(function(){
                  $('.ber-notice-content').remove();
            }, 5000);
        }
    });

    function Is_Ber_Email(email) {
       var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
       if(!regex.test(email)) {
         return false;
       }else{
         return true;
       }
    }

    $(document).on('click', '.ber_where', function() {
        $('.field_ber_where').hide();
        $('.field_ber_what').show();
        $('.ber_what_savechanges').show();
    });

    $(document).on('click', '#ber_page2_save', function(e) {
        e.preventDefault();
        var website_for = '';
        var about_website = '';
        $(this).css('cursor', 'not-allowed');
		var user_email = $(this).attr('data-email');
        $('.ber_wizzard_main').each(function() {
            var id = $(this).attr('id');
            if($('#'+id).prop("checked")) {
               var name = $(this).attr('name');
               if(name == 'ber_where') website_for = $(this).attr('value');
               if(name == 'ber_what') about_website = $(this).attr('value'); 
            }
        });
        var data = {
            action   : 'wa_ber_free_create_purchase_submit',
            website_for : website_for,
            about_website : about_website,
            free_user : $('.bertha-free-user').val(),
            bertha_ber_free_create_nonce: $('#bertha_ber_free_create_nonce').val()
        } 
        $.post(ajaxurl, data, function(response) {
            if(response == 'success') {
                $(this).css('cursor', '');
                window.location.replace(bertha_setup_object.onboard_page+'&email='+user_email);
            }
        });
    });


})(jQuery);
