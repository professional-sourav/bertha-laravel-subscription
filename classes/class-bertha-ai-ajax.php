<?php

class WA_Bertha_AI_Ajax {

    private $plugin_url;
    public $plugin_path;
    public $license_key;
    public $price_id;
    public $dashboard_url;
    public $item_id;

    public function __construct($file) {

        $this->file = $file;
        $this->plugin_url = trailingslashit(plugins_url('', $plugin = $file));
        $this->plugin_path = trailingslashit(dirname($file));
        $this->license_key = BTHAI_LICENSE_KEY;
        $this->price_id = BTHAI_LICENSE_PRICE_ID;
        $this->dashboard_url = BTHAI_STORE_URL;
        $this->item_id = BTHAI_ITEM_ID;
        $this->strict_mode = 70;
        //$this->text_domain = WOO_PRODUCT_STOCK_ALERT_TEXT_DOMAIN;

        add_action('wp_ajax_wa_open_ai_action', array(&$this, 'bthai_action_callback'));
        add_action('wp_ajax_nopriv_wa_open_ai_action', array(&$this, 'bthai_action_callback'));
        add_action('wp_ajax_para_generate_ai_action', array(&$this, 'bthai_para_generate_ai_action_callback'));
        add_action('wp_ajax_nopriv_para_generate_ai_action', array(&$this, 'bthai_para_generate_ai_action_callback'));
        add_action('wp_ajax_sec_generate_ai_action', array(&$this, 'bthai_sec_generate_ai_action_callback'));
        add_action('wp_ajax_nopriv_sec_generate_ai_action', array(&$this, 'bthai_sec_generate_ai_action_callback'));
        add_action('wp_ajax_sub_headline_ai_action', array(&$this, 'bthai_sub_headline_ai_action_callback'));
        add_action('wp_ajax_nopriv_sub_headline_ai_action', array(&$this, 'bthai_sub_headline_ai_action_callback'));
        add_action('wp_ajax_service_description_ai_action', array(&$this, 'bthai_service_description_ai_action_callback'));
        add_action('wp_ajax_nopriv_service_description_ai_action', array(&$this, 'bthai_service_description_ai_action_callback'));
        add_action('wp_ajax_company_bio_ai_action', array(&$this, 'bthai_company_bio_ai_action_callback'));
        add_action('wp_ajax_nopriv_company_bio_ai_action', array(&$this, 'bthai_company_bio_ai_action_callback'));
        add_action('wp_ajax_company_mission_ai_action', array(&$this, 'bthai_company_mission_ai_action_callback'));
        add_action('wp_ajax_nopriv_company_mission_ai_action', array(&$this, 'bthai_company_mission_ai_action_callback'));
        add_action('wp_ajax_testimonial_ai_action', array(&$this, 'bthai_testimonial_ai_action_callback'));
        add_action('wp_ajax_nopriv_testimonial_ai_action', array(&$this, 'bthai_testimonial_ai_action_callback'));
        add_action('wp_ajax_benefit_ai_action', array(&$this, 'bthai_benefit_ai_action_callback'));
        add_action('wp_ajax_nopriv_benefit_ai_action', array(&$this, 'bthai_benefit_ai_action_callback'));
        add_action('wp_ajax_content_improver_ai_action', array(&$this, 'bthai_content_improver_ai_action_callback'));
        add_action('wp_ajax_nopriv_content_improver_ai_action', array(&$this, 'bthai_content_improver_ai_action_callback'));
        add_action('wp_ajax_benefit_title_ai_action', array(&$this, 'bthai_benefit_title_ai_action_callback'));
        add_action('wp_ajax_nopriv_benefit_title_ai_action', array(&$this, 'bthai_benefit_title_ai_action_callback'));
        add_action('wp_ajax_bullet_points_ai_action', array(&$this, 'bthai_bullet_points_ai_action_callback'));
        add_action('wp_ajax_nopriv_bullet_points_ai_action', array(&$this, 'bthai_bullet_points_ai_action_callback'));
        add_action('wp_ajax_personal_bio_ai_action', array(&$this, 'bthai_personal_bio_ai_action_callback'));
        add_action('wp_ajax_nopriv_personal_bio_ai_action', array(&$this, 'bthai_personal_bio_ai_action_callback'));
        add_action('wp_ajax_blog_idea_ai_action', array(&$this, 'bthai_blog_idea_ai_action_callback'));
        add_action('wp_ajax_nopriv_blog_idea_ai_action', array(&$this, 'bthai_blog_idea_ai_action_callback'));
        add_action('wp_ajax_intro_paragraph_ai_action', array(&$this, 'bthai_intro_paragraph_ai_action_callback'));
        add_action('wp_ajax_nopriv_intro_paragraph_ai_action', array(&$this, 'bthai_intro_paragraph_ai_action_callback'));
        add_action('wp_ajax_post_outline_ai_action', array(&$this, 'bthai_post_outline_ai_action_callback'));
        add_action('wp_ajax_nopriv_post_outline_ai_action', array(&$this, 'bthai_post_outline_ai_action_callback'));
        add_action('wp_ajax_conclusion_paragraph_ai_action', array(&$this, 'bthai_conclusion_paragraph_ai_action_callback'));
        add_action('wp_ajax_nopriv_conclusion_paragraph_ai_action', array(&$this, 'bthai_conclusion_paragraph_ai_action_callback'));
        add_action('wp_ajax_blog_action_ai_action', array(&$this, 'bthai_ber_blog_action_ai_action_callback'));
        add_action('wp_ajax_nopriv_action_ai_action', array(&$this, 'bthai_ber_blog_action_ai_action_callback'));
        add_action('wp_ajax_child_input_ai_action', array(&$this, 'bthai_ber_child_input_ai_action_callback'));
        add_action('wp_ajax_nopriv_child_input_ai_action', array(&$this, 'bthai_ber_child_input_ai_action_callback'));
        add_action('wp_ajax_seo_title_ai_action', array(&$this, 'bthai_seo_title_ai_action_callback'));
        add_action('wp_ajax_nopriv_seo_title_ai_action', array(&$this, 'bthai_seo_title_ai_action_callback'));
        add_action('wp_ajax_seo_description_ai_action', array(&$this, 'bthai_seo_description_ai_action_callback'));
        add_action('wp_ajax_nopriv_seo_description_ai_action', array(&$this, 'bthai_seo_description_ai_action_callback'));
        add_action('wp_ajax_aida_marketing_ai_action', array(&$this, 'bthai_aida_marketing_ai_action_callback'));
        add_action('wp_ajax_nopriv_aida_marketing_ai_action', array(&$this, 'bthai_aida_marketing_ai_action_callback'));
        add_action('wp_ajax_seo_city_ai_action', array(&$this, 'bthai_seo_city_ai_action_callback'));
        add_action('wp_ajax_nopriv_seo_city_ai_action', array(&$this, 'bthai_seo_city_ai_action_callback'));
        add_action('wp_ajax_buisiness_name_ai_action', array(&$this, 'bthai_buisiness_name_ai_action_callback'));
        add_action('wp_ajax_nopriv_buisiness_name_ai_action', array(&$this, 'bthai_buisiness_name_ai_action_callback'));
        add_action('wp_ajax_bridge_ai_action', array(&$this, 'bthai_bridge_ai_action_callback'));
        add_action('wp_ajax_nopriv_bridge_ai_action', array(&$this, 'bthai_bridge_ai_action_callback'));
        add_action('wp_ajax_pas_framework_ai_action', array(&$this, 'bthai_pas_framework_ai_action_callback'));
        add_action('wp_ajax_nopriv_pas_framework_ai_action', array(&$this, 'bthai_pas_framework_ai_action_callback'));
        add_action('wp_ajax_faq_list_ai_action', array(&$this, 'bthai_faq_list_ai_action_callback'));
        add_action('wp_ajax_nopriv_faq_list_ai_action', array(&$this, 'bthai_faq_list_ai_action_callback'));
        add_action('wp_ajax_faq_answer_ai_action', array(&$this, 'bthai_faq_answer_ai_action_callback'));
        add_action('wp_ajax_nopriv_faq_answer_ai_action', array(&$this, 'bthai_faq_answer_ai_action_callback'));
        add_action('wp_ajax_summaries_ai_action', array(&$this, 'bthai_summaries_ai_action_callback'));
        add_action('wp_ajax_nopriv_summaries_ai_action', array(&$this, 'bthai_summaries_ai_action_callback'));
        add_action('wp_ajax_contact_blurb_ai_action', array(&$this, 'bthai_contact_blurb_ai_action_callback'));
        add_action('wp_ajax_nopriv_contact_blurb_ai_action', array(&$this, 'bthai_contact_blurb_ai_action_callback'));
        add_action('wp_ajax_seo_keyword_ai_action', array(&$this, 'bthai_seo_keyword_ai_action_callback'));
        add_action('wp_ajax_nopriv_seo_keyword_ai_action', array(&$this, 'bthai_seo_keyword_ai_action_callback'));
        add_action('wp_ajax_evil_bertha_ai_action', array(&$this, 'bthai_evil_bertha_ai_action_callback'));
        add_action('wp_ajax_nopriv_evil_bertha_ai_action', array(&$this, 'bthai_evil_bertha_ai_action_callback'));
        add_action('wp_ajax_real_estate_ai_action', array(&$this, 'bthai_real_estate_ai_action_callback'));
        add_action('wp_ajax_nopriv_real_estate_ai_action', array(&$this, 'bthai_real_estate_ai_action_callback'));
        add_action('wp_ajax_press_blurb_ai_action', array(&$this, 'bthai_press_blurb_ai_action_callback'));
        add_action('wp_ajax_nopriv_press_blurb_ai_action', array(&$this, 'bthai_press_blurb_ai_action_callback'));
        add_action('wp_ajax_case_study_ai_action', array(&$this, 'bthai_case_study_ai_action_callback'));
        add_action('wp_ajax_nopriv_case_study_ai_action', array(&$this, 'bthai_case_study_ai_action_callback'));
        add_action('wp_ajax_long_form_ai_action', array(&$this, 'bthai_long_form_ai_action_callback'));
        add_action('wp_ajax_long_form_save_draft_ai_action', array(&$this, 'bthai_long_form_save_draft_ai_action_callback'));
        add_action('wp_ajax_long_form_edit_draft_ai_action', array(&$this, 'bthai_long_form_edit_draft_ai_action_callback'));
        add_action('wp_ajax_wa_ai_templates', array(&$this, 'bthai_wa_ai_templates_callback'));
        add_action('wp_ajax_nopriv_wa_ai_templates', array(&$this, 'bthai_wa_ai_templates_callback'));
        add_action('wp_ajax_set_wizzard_data', array(&$this, 'bthai_set_wizzard_data_callback'));
        add_action('wp_ajax_set_wizzard_setting_data', array(&$this, 'bthai_set_wizzard_setting_data_callback'));
        add_action('wp_ajax_wa_history_filter', array(&$this, 'bthai_history_filter_callback'));
        add_action('wp_ajax_nopriv_wa_history_filter', array(&$this, 'bthai_history_filter_callback'));
        add_action('wp_ajax_wa_favourite_added', array(&$this, 'bthai_wa_favourite_added_callback'));
        add_action('wp_ajax_nopriv_wa_favourite_added', array(&$this, 'bthai_wa_favourite_added_callback'));
        add_action('wp_ajax_wa_idea_trash', array(&$this, 'bthai_wa_idea_trash_callback'));
        add_action('wp_ajax_nopriv_wa_idea_trash', array(&$this, 'bthai_wa_idea_trash_callback'));
        add_action('wp_ajax_wa_idea_report', array(&$this, 'bthai_wa_idea_report_callback'));
        add_action('wp_ajax_nopriv_wa_idea_report', array(&$this, 'bthai_wa_idea_report_callback'));
        add_action('wp_ajax_wa_bertha_load_history', array(&$this, 'bthai_wa_bertha_load_history_callback'));
        add_action('wp_ajax_nopriv_wa_bertha_load_history', array(&$this, 'bthai_wa_bertha_load_history_callback'));
        add_action('wp_ajax_wa_bertha_load_favourite', array(&$this, 'bthai_wa_bertha_load_favourite_callback'));
        add_action('wp_ajax_nopriv_wa_bertha_load_favourite', array(&$this, 'bthai_wa_bertha_load_favourite_callback'));
        add_action('wp_ajax_wa_bertha_load_draft', array(&$this, 'bthai_wa_bertha_load_draft_callback'));
        add_action('wp_ajax_nopriv_wa_bertha_load_draft', array(&$this, 'bthai_wa_bertha_load_draft_callback'));
        /* free */
        add_action('wp_ajax_wa_ber_free_create_purchase', array(&$this, 'bthai_free_create_purchase_callback'));
        add_action('wp_ajax_wa_ber_free_create_purchase_submit', array(&$this, 'bthai_free_create_purchase_submit_callback'));
    }

    function bthai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_usp_template_nonce' );
        
        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'idea-usp', 'idea_template');
        $bertha_brand = isset($_POST['bertha_brand']) ? sanitize_text_field($_POST['bertha_brand']) : "";
        $bertha_ideal_cust = isset($_POST['bertha_ideal_cust']) ? sanitize_text_field($_POST['bertha_ideal_cust']) : "";
        $bertha_sentiment = isset($_POST['bertha_sentiment']) ? sanitize_text_field($_POST['bertha_sentiment']) : "";
        $bertha_desc = isset($_POST['bertha_desc']) ? sanitize_textarea_field($_POST['bertha_desc']) : "";
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        if(isset($_POST['data_brand']) && $_POST['data_brand']) $bertha_brand = sanitize_text_field($_POST['data_brand']);
        if(isset($_POST['data_ideal_cust']) && $_POST['data_ideal_cust']) $bertha_ideal_cust = sanitize_text_field($_POST['data_ideal_cust']);
        if(isset($_POST['data_sentiment']) && $_POST['data_sentiment']) $bertha_sentiment = sanitize_text_field($_POST['data_sentiment']);
        if(isset($_POST['data_desc']) && $_POST['data_desc']) $bertha_desc = sanitize_textarea_field($_POST['data_desc']);

        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'brand' => $bertha_brand, 'cust' => $bertha_ideal_cust, 'desc' => $bertha_desc, 'sentiment' => $bertha_sentiment, 'template' => 'USP', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email, 'idea_unique_id' => $idea_unique_id ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args); 
        if (!is_wp_error($response) && isset($response['body'])) {
            if(get_option('wa_usp_ideas')) {
                $usp_ideas = get_option('wa_usp_ideas');
            } else {
                $usp_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'idea-usp', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $usp_ideas++;
                        $new = array(
                            'post_title' => 'Unique Selling Proposition - Idea:'. $usp_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_brand', $bertha_brand);
                        update_post_meta($post_id, 'wa_parent_ideal_customer', $bertha_ideal_cust);
                        update_post_meta($post_id, 'wa_parent_sentiment', $bertha_sentiment);
                        update_post_meta($post_id, 'wa_parent_description', $bertha_desc);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="USP" data-index="'.$key_num.'" data-brand="'.$bertha_brand.'" data-customer="'.$bertha_ideal_cust.'" data-sentiment="'.$bertha_sentiment.'" data-desc="'.$bertha_desc.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>
                            <div class="ber-gap-2 ber_half">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div> 
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
                update_option('wa_usp_ideas', $usp_ideas);
            }
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_para_generate_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_para_template_nonce' );

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'idea-paragraph', 'idea_template');
        $bertha_ideal_cust = isset($_POST['bertha_ideal_cust']) ? sanitize_text_field($_POST['bertha_ideal_cust']) : "";
        $bertha_sentiment = isset($_POST['bertha_sentiment']) ? sanitize_text_field($_POST['bertha_sentiment']) : "";
        $bertha_desc = isset($_POST['bertha_desc']) ? sanitize_textarea_field($_POST['bertha_desc']) : "";
        $para_title = isset($_POST['para_title']) ? sanitize_text_field($_POST['para_title']) : "";
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        if(isset($_POST['data_ideal_cust']) && $_POST['data_ideal_cust']) $bertha_ideal_cust = sanitize_text_field( $_POST['data_ideal_cust']);
        if(isset($_POST['data_sentiment']) && $_POST['data_sentiment']) $bertha_sentiment = sanitize_text_field($_POST['data_sentiment']);
        if(isset($_POST['data_desc']) && $_POST['data_desc']) $bertha_desc = sanitize_textarea_field($_POST['data_desc']);
        if(isset($_POST['data_title']) && $_POST['data_title']) $para_title = sanitize_text_field($_POST['data_title']);

        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'cust' => $bertha_ideal_cust, 'desc' => $bertha_desc, 'sentiment' => $bertha_sentiment, 'title_type' =>  $para_title_type, 'title' =>  $para_title, 'template' => 'Paragraph', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email, 'idea_unique_id' => $idea_unique_id ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args);
        if (!is_wp_error($response) && isset($response['body'])) {
            $results = '';
            if(get_option('wa_paragraph_ideas')) {
             $wa_paragraph_ideas = get_option('wa_paragraph_ideas');
            } else {
             $wa_paragraph_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'idea-paragraph', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
                if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $wa_paragraph_ideas++;
                        $new = array(
                            'post_title' => 'Paragraph - Idea:'.$wa_paragraph_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_ideal_customer', $bertha_ideal_cust);
                        update_post_meta($post_id, 'wa_parent_sentiment', $bertha_sentiment);
                        update_post_meta($post_id, 'wa_parent_description', $bertha_desc);
                        update_post_meta($post_id, 'wa_parent_title', $para_title);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="Paragraph" data-index="'.$key_num.'" data-customer="'.$bertha_ideal_cust.'" data-sentiment="'.$bertha_sentiment.'" data-desc="'.$bertha_desc.'" data-title="'.$para_title.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>
                            <div class="ber_half ber-gap-2">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div> 
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
                update_option('wa_paragraph_ideas', $wa_paragraph_ideas);
            }
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_sec_generate_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_title_template_nonce' );

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'section-title', 'idea_template');
        $bertha_ideal_cust = isset($_POST['bertha_ideal_cust']) ? sanitize_text_field($_POST['bertha_ideal_cust']) : "";
        $bertha_sentiment = isset($_POST['bertha_sentiment']) ? sanitize_text_field($_POST['bertha_sentiment']) : "";
        $bertha_desc = isset($_POST['bertha_desc']) ? sanitize_textarea_field($_POST['bertha_desc']) : "";
        $sec_title_type = isset($_POST['sec_title_type']) ? sanitize_text_field($_POST['sec_title_type']) : "";
        $sec_other_title = isset($_POST['sec_other_title']) ? sanitize_text_field($_POST['sec_other_title']) : "";
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        if(isset($_POST['data_ideal_cust']) && $_POST['data_ideal_cust']) $bertha_ideal_cust = sanitize_text_field($_POST['data_ideal_cust']);
        if(isset($_POST['data_sentiment']) && $_POST['data_sentiment']) $bertha_sentiment = sanitize_text_field($_POST['data_sentiment']);
        if(isset($_POST['data_desc']) && $_POST['data_desc']) $bertha_desc = sanitize_textarea_field($_POST['data_desc']);
        if(isset($_POST['data_title_type']) && $_POST['data_title_type']) $sec_title_type = sanitize_text_field($_POST['data_title_type']);
        if(isset($_POST['data_other_title']) && $_POST['data_other_title']) $sec_other_title = sanitize_text_field($_POST['data_other_title']);
        
        $headers = array(
           "Authorization: Bearer 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",
           "Content-Type: application/json",
        );

        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'cust' => $bertha_ideal_cust, 'desc' => $bertha_desc, 'sentiment' => $bertha_sentiment, 'title_type' =>  $sec_title_type, 'other_title' =>  $sec_other_title, 'template' => 'Title', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email, 'idea_unique_id' => $idea_unique_id ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args);
        if (!is_wp_error($response) && isset($response['body'])) {
            $results = '';
            if(get_option('wa_section_title_ideas')) {
             $wa_section_title_ideas = get_option('wa_section_title_ideas');
            } else {
             $wa_section_title_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'section-title', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $wa_section_title_ideas++;
                        $new = array(
                            'post_title' => 'Section Title - Idea:'.$wa_section_title_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_ideal_customer', $bertha_ideal_cust);
                        update_post_meta($post_id, 'wa_parent_sentiment', $bertha_sentiment);
                        update_post_meta($post_id, 'wa_parent_description', $bertha_desc);
                        update_post_meta($post_id, 'wa_parent_title_type', $sec_title_type);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="Title" data-index="'.$key_num.'" data-customer="'.$bertha_ideal_cust.'" data-sentiment="'.$bertha_sentiment.'" data-desc="'.$bertha_desc.'" data-title-type="'.$sec_title_type.'" data-other-title="'.$sec_other_title.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>
                            <div class="ber_half ber-gap-2">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div> 
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
                update_option('wa_section_title_ideas', $wa_section_title_ideas);
            }
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_sub_headline_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_headline_template_nonce' );

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'sub-headline', 'idea_template');
        $bertha_ideal_cust = isset($_POST['bertha_ideal_cust']) ? sanitize_text_field($_POST['bertha_ideal_cust']) : "";
        $bertha_sentiment = isset($_POST['bertha_sentiment']) ? sanitize_text_field($_POST['bertha_sentiment']) : "";
        $bertha_desc = isset($_POST['bertha_desc']) ? sanitize_textarea_field($_POST['bertha_desc']) : "";
        $sub_headline_usp = isset($_POST['sub_headline_usp']) ? sanitize_text_field($_POST['sub_headline_usp']) : "";
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        if(isset($_POST['data_ideal_cust']) && $_POST['data_ideal_cust']) $bertha_ideal_cust = sanitize_text_field($_POST['data_ideal_cust']);
        if(isset($_POST['data_sentiment']) && $_POST['data_sentiment']) $bertha_sentiment = sanitize_text_field($_POST['data_sentiment']);
        if(isset($_POST['data_desc']) && $_POST['data_desc']) $bertha_desc = sanitize_textarea_field($_POST['data_desc']);
        if(isset($_POST['data_headline_usp']) && $_POST['data_headline_usp']) $sub_headline_usp = sanitize_text_field($_POST['data_headline_usp']);

        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'cust' => $bertha_ideal_cust, 'desc' => $bertha_desc, 'sentiment' => $bertha_sentiment, 'usp' =>  $sub_headline_usp, 'template' => 'Headline', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args);
        if (!is_wp_error($response) && isset($response['body'])) {
            $results = '';
            if(get_option('wa_sub_headline_ideas')) {
             $wa_sub_headline_ideas = get_option('wa_sub_headline_ideas');
            } else {
             $wa_sub_headline_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'sub-headline', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $wa_sub_headline_ideas++;
                        $new = array(
                            'post_title' => 'website sub headline - idea:'.$wa_sub_headline_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_ideal_customer', $bertha_ideal_cust);
                        update_post_meta($post_id, 'wa_parent_sentiment', $bertha_sentiment);
                        update_post_meta($post_id, 'wa_parent_description', $bertha_desc);
                        update_post_meta($post_id, 'sub_headline_usp', $sub_headline_usp);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="Headline" data-index="'.$key_num.'" data-customer="'.$bertha_ideal_cust.'" data-sentiment="'.$bertha_sentiment.'" data-desc="'.$bertha_desc.'" data-headline-usp="'.$sub_headline_usp.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>
                            <div class="ber_half ber-gap-2">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div> 
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
                update_option('wa_sub_headline_ideas', $wa_sub_headline_ideas);       
            }
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_service_description_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_service_template_nonce' );

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'product-service-description', 'idea_template');
        $bertha_sentiment = isset($_POST['bertha_sentiment']) ? sanitize_text_field($_POST['bertha_sentiment']) : "";
        $bertha_desc = isset($_POST['bertha_desc']) ? sanitize_textarea_field($_POST['bertha_desc']) : "";
        $service_description_name = isset($_POST['service_description_name']) ? sanitize_textarea_field($_POST['service_description_name']) : "";
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        if(isset($_POST['data_sentiment']) && $_POST['data_sentiment']) $bertha_sentiment = sanitize_text_field($_POST['data_sentiment']);
        if(isset($_POST['data_desc']) && $_POST['data_desc']) $bertha_desc = sanitize_textarea_field($_POST['data_desc']);
        if(isset($_POST['data_desc_name']) && $_POST['data_desc_name']) $service_description_name = sanitize_textarea_field($_POST['data_desc_name']);
        
        $headers = array(
           "Authorization: Bearer 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",
           "Content-Type: application/json",
        );

        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'desc' => $bertha_desc, 'sentiment' => $bertha_sentiment, 'service_desc' =>  $service_description_name, 'template' => 'Service', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email, 'idea_unique_id' => $idea_unique_id ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args);
            if (!is_wp_error($response) && isset($response['body'])) {
            $results = '';
            if(get_option('wa_service_description_ideas')) {
             $wa_service_description_ideas = get_option('wa_service_description_ideas');
            } else {
             $wa_service_description_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'product-service-description', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $wa_service_description_ideas++;
                        $new = array(
                            'post_title' => 'Product Service Description - idea:'.$wa_service_description_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_sentiment', $bertha_sentiment);
                        update_post_meta($post_id, 'wa_parent_description', $bertha_desc);
                        update_post_meta($post_id, 'wa_parent_desciption_name', $service_description_name);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="Service" data-index="'.$key_num.'" data-sentiment="'.$bertha_sentiment.'" data-desc="'.$bertha_desc.'" data-desc-name="'.$service_description_name.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>
                            <div class="ber_half ber-gap-2">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div> 
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
            update_option('wa_service_description_ideas', $wa_service_description_ideas);
            }
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_company_bio_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_company_template_nonce' );

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'company-bio', 'idea_template');
        $bertha_brand = isset($_POST['bertha_brand']) ? sanitize_text_field($_POST['bertha_brand']) : "";
        $bertha_desc = isset($_POST['bertha_desc']) ? sanitize_textarea_field($_POST['bertha_desc']) : "";
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        if(isset($_POST['data_brand']) && $_POST['data_brand']) $bertha_brand = sanitize_text_field($_POST['data_brand']);
        if(isset($_POST['data_desc']) && $_POST['data_desc']) $bertha_desc = sanitize_textarea_field($_POST['data_desc']);
        
        $headers = array(
           "Authorization: Bearer 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",
           "Content-Type: application/json",
        );

        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'brand' => $bertha_brand, 'desc' => $bertha_desc, 'template' => 'Company', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args);
        if (!is_wp_error($response) && isset($response['body'])) {
            $results = '';
            if(get_option('wa_company_bio_ideas')) {
             $wa_company_bio_ideas = get_option('wa_company_bio_ideas');
            } else {
             $wa_company_bio_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'company-bio', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $wa_company_bio_ideas++;
                        $new = array(
                            'post_title' => 'Company Bio - Idea:'.$wa_company_bio_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_description', $bertha_desc);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="Company" data-index="'.$key_num.'" data-brand="'.$data_brand.'" data-desc="'.$bertha_desc.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>
                            <div class="ber_half ber-gap-2">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div> 
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
            update_option('wa_company_bio_ideas', $wa_company_bio_ideas);
            }
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_company_mission_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_mission_template_nonce' );

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'Company-mission', 'idea_template');
        $bertha_brand = isset($_POST['bertha_brand']) ? sanitize_text_field($_POST['bertha_brand']) : "";
        $bertha_desc = isset($_POST['bertha_desc']) ? sanitize_textarea_field($_POST['bertha_desc']) : "";
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        if(isset($_POST['data_brand']) && $_POST['data_brand']) $bertha_brand = sanitize_text_field($_POST['data_brand']);
        if(isset($_POST['data_desc']) && $_POST['data_desc']) $bertha_desc = sanitize_textarea_field($_POST['data_desc']);
        
        $headers = array(
           "Authorization: Bearer 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",
           "Content-Type: application/json",
        );

        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'brand' => $bertha_brand, 'desc' => $bertha_desc, 'template' => 'Company-mission', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email, 'idea_unique_id' => $idea_unique_id ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args);
        if (!is_wp_error($response) && isset($response['body'])) {
            $results = '';
            if(get_option('wa_company_mission_ideas')) {
             $wa_company_mission_ideas = get_option('wa_company_mission_ideas');
            } else {
             $wa_company_mission_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'Company-mission', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $wa_company_mission_ideas++;
                        $new = array(
                            'post_title' => 'Company Mission & Vision - Idea:'.$wa_company_mission_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_description', $bertha_desc);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="Company-mission" data-index="'.$key_num.'" data-brand="'.$data_brand.'" data-desc="'.$bertha_desc.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>
                            <div class="ber_half ber-gap-2">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div> 
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
            update_option('wa_company_mission_ideas', $wa_company_mission_ideas);
            }
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_testimonial_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_testimonial_template_nonce' );

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'idea-testimonial', 'idea_template');
        $bertha_desc = isset($_POST['bertha_desc']) ? sanitize_textarea_field($_POST['bertha_desc']) : "";
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        if(isset($_POST['data_desc']) && $_POST['data_desc']) $bertha_desc = sanitize_textarea_field($_POST['data_desc']);
        
        $headers = array(
           "Authorization: Bearer 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",
           "Content-Type: application/json",
        );

        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'desc' => $bertha_desc, 'template' => 'Testimonial', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email, 'idea_unique_id' => $idea_unique_id ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args);
        if (!is_wp_error($response) && isset($response['body'])) {
            $results = '';
            if(get_option('wa_testimonial_ideas')) {
             $wa_testimonial_ideas = get_option('wa_testimonial_ideas');
            } else {
             $wa_testimonial_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'idea-testimonial', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $wa_testimonial_ideas++;
                        $new = array(
                            'post_title' => 'Testimonial - Idea:'.$wa_testimonial_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_description', $bertha_desc);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="Testimonial" data-index="'.$key_num.'" data-desc="'.$bertha_desc.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>
                            <div class="ber_half ber-gap-2">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div> 
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
                update_option('wa_testimonial_ideas', $wa_testimonial_ideas);        
            }
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_benefit_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_lists_template_nonce' );

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'idea-benefit', 'idea_template');
        $bertha_desc = isset($_POST['bertha_desc']) ? sanitize_textarea_field($_POST['bertha_desc']) : "";
        if($_POST['data_index_desc']) $bertha_desc = sanitize_textarea_field($_POST['data_index_desc']);
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        
        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'desc' => $bertha_desc, 'template' => 'Benefit-List', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email, 'idea_unique_id' => $idea_unique_id ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args); 
        if (!is_wp_error($response) && isset($response['body'])) {
            $results = '';
            if(get_option('wa_benefits_ideas')) {
             $wa_benefits_ideas = get_option('wa_benefits_ideas');
            } else {
             $wa_benefits_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'idea-benefit', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $wa_benefits_ideas++;
                        $new = array(
                            'post_title' => 'Benefit Lists - Idea:'.$wa_benefits_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_description', $bertha_desc);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="Benefit-List" data-index="'.$key_num.'" data-desc="'.$bertha_desc.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>
                            <div class="ber_half ber-gap-2">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div> 
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
                update_option('wa_benefits_ideas', $wa_benefits_ideas);
            }
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_content_improver_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_improver_template_nonce' );

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'content-improver', 'idea_template');
        $bertha_desc = isset($_POST['bertha_desc']) ? sanitize_textarea_field($_POST['bertha_desc']) : "";
        $bertha_sentiment = isset($_POST['bertha_sentiment']) ? sanitize_text_field($_POST['bertha_sentiment']) : "";
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        if(isset($_POST['data_sentiment']) && $_POST['data_sentiment']) $bertha_sentiment = sanitize_text_field($_POST['data_sentiment']);
        if(isset($_POST['data_desc']) && $_POST['data_desc']) $bertha_desc = sanitize_textarea_field($_POST['data_desc']);
        
        $headers = array(
           "Authorization: Bearer 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",
           "Content-Type: application/json",
        );

        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'desc' => $bertha_desc, 'sentiment' => $bertha_sentiment,'template' => 'Content-Improver', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email, 'idea_unique_id' => $idea_unique_id ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args);
        if (!is_wp_error($response) && isset($response['body'])) {
            $results = '';
            if(get_option('wa_content_improver_ideas')) {
             $wa_content_improver_ideas = get_option('wa_content_improver_ideas');
            } else {
             $wa_content_improver_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'content-improver', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $wa_content_improver_ideas++;
                        $new = array(
                            'post_title' => 'Content Improver - Idea:'.$wa_content_improver_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_description', $bertha_desc);
                        update_post_meta($post_id, 'wa_parent_sentiment', $bertha_sentiment);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="Content-Improver" data-index="'.$key_num.'" data-desc="'.$bertha_desc.'" data-sentiment="'.$bertha_sentiment.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>  
                            <div class="ber_half ber-gap-2">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div> 
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
                update_option('wa_content_improver_ideas', $wa_content_improver_ideas);
            }
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_benefit_title_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_ben_title_template_nonce' );

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'benefit-title', 'idea_template');
        $bertha_desc = isset($_POST['bertha_desc']) ? sanitize_textarea_field($_POST['bertha_desc']) : "";
        $Benefit_title = isset($_POST['Benefit_title']) ? sanitize_text_field($_POST['Benefit_title']) : "";
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        if(isset($_POST['data_title']) && $_POST['data_title']) $Benefit_title = sanitize_text_field($_POST['data_title']);
        if(isset($_POST['data_desc']) && $_POST['data_desc']) $bertha_desc = sanitize_textarea_field($_POST['data_desc']);
        
        $headers = array(
           "Authorization: Bearer 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",
           "Content-Type: application/json",
        );

        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'desc' => $bertha_desc, 'title' => $Benefit_title, 'template' => 'Benefit-Title', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email, 'idea_unique_id' => $idea_unique_id ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args);
        if (!is_wp_error($response) && isset($response['body'])) {
            $results = '';
            if(get_option('wa_benefit_title_ideas')) {
             $wa_benefit_title_ideas = get_option('wa_benefit_title_ideas');
            } else {
             $wa_benefit_title_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'benefit-title', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $wa_benefit_title_ideas++;
                        $new = array(
                            'post_title' => 'Content Improver - Idea:'.$wa_benefit_title_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_description', $bertha_desc);
                        update_post_meta($post_id, 'wa_parent_title', $Benefit_title);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="Benefit-Title" data-index="'.$key_num.'" data-desc="'.$bertha_desc.'" data-title="'.$Benefit_title.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>
                            <div class="ber_half ber-gap-2">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div> 
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
                update_option('wa_benefit_title_ideas', $wa_benefit_title_ideas);
            }       
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_bullet_points_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_points_template_nonce' );

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'bullet-points', 'idea_template');
        $bertha_desc = isset($_POST['bertha_desc']) ? sanitize_textarea_field($_POST['bertha_desc']) : "";
        if($_POST['data_index_desc']) $bertha_desc = sanitize_textarea_field($_POST['data_index_desc']);
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        
        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'desc' => $bertha_desc, 'template' => 'bullet-points', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args); 
        if (!is_wp_error($response) && isset($response['body'])) {
            $results = '';
            if(get_option('wa_bullet_ideas')) {
             $wa_bullet_ideas = get_option('wa_bullet_ideas');
            } else {
             $wa_bullet_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'bullet-points', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $wa_bullet_ideas++;
                        $new = array(
                            'post_title' => 'Persuasive Bullet Points - Idea:'.$wa_bullet_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_description', $bertha_desc);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="bullet-points" data-index="'.$key_num.'" data-desc="'.$bertha_desc.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>
                            <div class="ber_half ber-gap-2">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div> 
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
                update_option('wa_bullet_ideas', $wa_bullet_ideas);
            }
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_personal_bio_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_bio_template_nonce' );

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'personal-bio', 'idea_template');
        $bertha_sentiment = isset($_POST['bertha_sentiment']) ? sanitize_text_field($_POST['bertha_sentiment']) : "";
        $bertha_desc = isset($_POST['bertha_desc']) ? sanitize_textarea_field($_POST['bertha_desc']) : "";
        $personal_bio_point = isset($_POST['personal_bio_point']) ? sanitize_text_field($_POST['personal_bio_point']) : "";
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        if(isset($_POST['data_sentiment']) && $_POST['data_sentiment']) $bertha_sentiment = sanitize_text_field($_POST['data_sentiment']);
        if(isset($_POST['data_desc']) && $_POST['data_desc']) $bertha_desc = sanitize_textarea_field($_POST['data_desc']);
        if(isset($_POST['data_point']) && $_POST['data_point']) $personal_bio_point = sanitize_text_field($_POST['data_point']);
        
        $headers = array(
           "Authorization: Bearer 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",
           "Content-Type: application/json",
        );

        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'desc' => $bertha_desc, 'sentiment' => $bertha_sentiment, 'personal_bio_point' =>  $personal_bio_point, 'template' => 'personal-bio', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email, 'idea_unique_id' => $idea_unique_id ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args);
            if (!is_wp_error($response) && isset($response['body'])) {
            $results = '';
            if(get_option('wa_personal_bio_point_ideas')) {
             $wa_personal_bio_point_ideas = get_option('wa_personal_bio_point_ideas');
            } else {
             $wa_personal_bio_point_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'personal-bio', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $wa_personal_bio_point_ideas++;
                        $new = array(
                            'post_title' => 'Personal Bio - idea:'.$wa_personal_bio_point_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_sentiment', $bertha_sentiment);
                        update_post_meta($post_id, 'wa_parent_description', $bertha_desc);
                        update_post_meta($post_id, 'wa_parent_bio_point', $personal_bio_point);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="personal-bio" data-index="'.$key_num.'" data-sentiment="'.$bertha_sentiment.'" data-desc="'.$bertha_desc.'" data-point="'.$personal_bio_point.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>
                            <div class="ber_half ber-gap-2">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div> 
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
            update_option('wa_personal_bio_point_ideas', $wa_personal_bio_point_ideas);
            }
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_blog_idea_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_blog_post_template_nonce' );

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'blog-post-idea', 'idea_template');
        $bertha_ideal_cust = isset($_POST['bertha_ideal_cust']) ? sanitize_text_field($_POST['bertha_ideal_cust']) : "";
        $bertha_sentiment = isset($_POST['bertha_sentiment']) ? sanitize_text_field($_POST['bertha_sentiment']) : "";
        $bertha_desc = isset($_POST['bertha_desc']) ? sanitize_textarea_field($_POST['bertha_desc']) : "";
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        if(isset($_POST['data_ideal_cust']) && $_POST['data_ideal_cust']) $bertha_ideal_cust = sanitize_textarea_field($_POST['data_ideal_cust']);
        if(isset($_POST['data_sentiment']) && $_POST['data_sentiment']) $bertha_sentiment = sanitize_text_field($_POST['data_sentiment']);
        if(isset($_POST['data_desc']) && $_POST['data_desc']) $bertha_desc = sanitize_textarea_field($_POST['data_desc']);
        
        $headers = array(
           "Authorization: Bearer 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",
           "Content-Type: application/json",
        );

        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'cust' => $bertha_ideal_cust, 'desc' => $bertha_desc, 'sentiment' => $bertha_sentiment, 'template' => 'blog-post-idea', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email, 'idea_unique_id' => $idea_unique_id ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args);
        if (!is_wp_error($response) && isset($response['body'])) {
            $results = '';
            if(get_option('wa_blog_ideas')) {
             $wa_blog_ideas = get_option('wa_blog_ideas');
            } else {
             $wa_blog_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'blog-post-idea', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $wa_blog_ideas++;
                        $new = array(
                            'post_title' => 'Blog Post Topic Ideas - Idea:'.$wa_blog_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_ideal_customer', $bertha_ideal_cust);
                        update_post_meta($post_id, 'wa_parent_sentiment', $bertha_sentiment);
                        update_post_meta($post_id, 'wa_parent_description', $bertha_desc);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="blog-post-idea" data-index="'.$key_num.'" data-customer="'.$bertha_ideal_cust.'" data-sentiment="'.$bertha_sentiment.'" data-desc="'.$bertha_desc.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>
                            <div class="ber_half ber-gap-2">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div> 
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
                update_option('wa_blog_ideas', $wa_blog_ideas);
            }
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_intro_paragraph_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_post_intro_template_nonce' );

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'intro-para-idea', 'idea_template');
        $bertha_ideal_cust = isset($_POST['bertha_ideal_cust']) ? sanitize_text_field($_POST['bertha_ideal_cust']) : "";
        $bertha_sentiment = isset($_POST['bertha_sentiment']) ? sanitize_text_field($_POST['bertha_sentiment']) : "";
        $intro_title = isset($_POST['intro_title']) ? sanitize_text_field($_POST['intro_title']) : "";
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        if(isset($_POST['data_ideal_cust']) && $_POST['data_ideal_cust']) $bertha_ideal_cust = sanitize_text_field($_POST['data_ideal_cust']);
        if(isset($_POST['data_sentiment']) && $_POST['data_sentiment']) $bertha_sentiment = sanitize_text_field($_POST['data_sentiment']);
        if(isset($_POST['data_title']) && $_POST['data_title']) $intro_title = sanitize_text_field($_POST['data_title']);
        
        $headers = array(
           "Authorization: Bearer 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",
           "Content-Type: application/json",
        );

        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'cust' => $bertha_ideal_cust, 'title' => $intro_title, 'sentiment' => $bertha_sentiment, 'template' => 'blog-post-intro-paragraph', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email, 'idea_unique_id' => $idea_unique_id ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args);
        if (!is_wp_error($response) && isset($response['body'])) {
            $results = '';
            if(get_option('intro_para_ideas')) {
             $intro_para_ideas = get_option('intro_para_ideas');
            } else {
             $intro_para_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'intro-para-idea', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $intro_para_ideas++;
                        $new = array(
                            'post_title' => 'Blog Post Intro Paragraph - Idea:'.$intro_para_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_ideal_customer', $bertha_ideal_cust);
                        update_post_meta($post_id, 'wa_parent_sentiment', $bertha_sentiment);
                        update_post_meta($post_id, 'wa_parent_title', $intro_title);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="blog-post-intro-paragraph" data-index="'.$key_num.'" data-customer="'.$bertha_ideal_cust.'" data-sentiment="'.$bertha_sentiment.'" data-title="'.$intro_title.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>
                            <div class="ber_half ber-gap-2">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div> 
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
                update_option('intro_para_ideas', $intro_para_ideas);
            }
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_post_outline_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_post_outline_template_nonce' );

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'post-outline-idea', 'idea_template');
        $bertha_sentiment = isset($_POST['bertha_sentiment']) ? sanitize_text_field($_POST['bertha_sentiment']) : "";
        $bertha_title = isset($_POST['bertha_title']) ? sanitize_text_field($_POST['bertha_title']) : "";
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        if(isset($_POST['data_title']) && $_POST['data_title']) $bertha_title = sanitize_text_field($_POST['data_title']);
        if(isset($_POST['data_sentiment']) && $_POST['data_sentiment']) $bertha_sentiment = sanitize_text_field($_POST['data_sentiment']);
        
        $headers = array(
           "Authorization: Bearer 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",
           "Content-Type: application/json",
        );

        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'sentiment' => $bertha_sentiment, 'title' => $bertha_title, 'template' => 'blog-post-outline', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email, 'idea_unique_id' => $idea_unique_id ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args);
        if (!is_wp_error($response) && isset($response['body'])) {
            $results = '';
            if(get_option('post_outline_ideas')) {
             $post_outline_ideas = get_option('post_outline_ideas');
            } else {
             $post_outline_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'post-outline-idea', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $post_outline_ideas++;
                        $new = array(
                            'post_title' => 'Blog Post Outline - Idea:'.$post_outline_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_sentiment', $bertha_sentiment);
                        update_post_meta($post_id, 'wa_parent_title', $bertha_title);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="blog-post-outline" data-index="'.$key_num.'" data-sentiment="'.$bertha_sentiment.'" data-title="'.$bertha_title.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>
                            <div class="ber_half ber-gap-2">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div> 
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
                update_option('post_outline_ideas', $post_outline_ideas);
            }       
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_conclusion_paragraph_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_post_con_template_nonce' );

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'conclusion-para-idea', 'idea_template');
        $bertha_cta = isset($_POST['bertha_cta']) ? sanitize_text_field($_POST['bertha_cta']) : "";
        $bertha_sentiment = isset($_POST['bertha_sentiment']) ? sanitize_text_field($_POST['bertha_sentiment']) : "";
        $bertha_title = isset($_POST['bertha_title']) ? sanitize_text_field($_POST['bertha_title']) : "";
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        if(isset($_POST['data_cta']) && $_POST['data_cta']) $bertha_cta = sanitize_text_field($_POST['data_cta']);
        if(isset($_POST['data_sentiment']) && $_POST['data_sentiment']) $bertha_sentiment = sanitize_text_field($_POST['data_sentiment']);
        if(isset($_POST['data_title']) && $_POST['data_title']) $bertha_title = sanitize_text_field($_POST['data_title']);
        
        $headers = array(
           "Authorization: Bearer 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",
           "Content-Type: application/json",
        );

        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'cta' => $bertha_cta, 'title' => $bertha_title, 'sentiment' => $bertha_sentiment, 'template' => 'blog-post-conclusion', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email, 'idea_unique_id' => $idea_unique_id ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args);
        if (!is_wp_error($response) && isset($response['body'])) {
            $results = '';
            if(get_option('conclusion_para_ideas')) {
             $conclusion_para_ideas = get_option('conclusion_para_ideas');
            } else {
             $conclusion_para_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'conclusion-para-idea', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $conclusion_para_ideas++;
                        $new = array(
                            'post_title' => 'Blog Post Conclusion Paragraph - Idea:'.$conclusion_para_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_cta', $bertha_cta);
                        update_post_meta($post_id, 'wa_parent_sentiment', $bertha_sentiment);
                        update_post_meta($post_id, 'wa_parent_title', $bertha_title);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="blog-post-conclusion" data-index="'.$key_num.'" data-cta="'.$bertha_cta.'" data-sentiment="'.$bertha_sentiment.'" data-title="'.$bertha_title.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>
                            <div class="ber_half ber-gap-2">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div>
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
                update_option('conclusion_para_ideas', $conclusion_para_ideas);
            }
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_ber_blog_action_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_action_template_nonce' );

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'blog-action-idea', 'idea_template');
        $bertha_desc = isset($_POST['bertha_desc']) ? sanitize_textarea_field($_POST['bertha_desc']) : "";
        $bertha_action = isset($_POST['bertha_action']) ? sanitize_text_field($_POST['bertha_action']) : "";
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        if(isset($_POST['data_desc']) && $_POST['data_desc']) $bertha_desc = sanitize_textarea_field($_POST['data_desc']);
        if(isset($_POST['data_action']) && $_POST['data_action']) $bertha_action = sanitize_text_field($_POST['data_action']);
        
        $headers = array(
           "Authorization: Bearer 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",
           "Content-Type: application/json",
        );

        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'desc' => $bertha_desc, 'action' => $bertha_action, 'template' => 'blog-action', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email, 'idea_unique_id' => $idea_unique_id ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args);
        if (!is_wp_error($response) && isset($response['body'])) {
            $results = '';
            if(get_option('blog_action_ideas')) {
             $blog_action_ideas = get_option('blog_action_ideas');
            } else {
             $blog_action_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'blog-action-idea', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $blog_action_ideas++;
                        $new = array(
                            'post_title' => 'Button Call to Action - Idea:'.$blog_action_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_desc', $bertha_desc);
                        update_post_meta($post_id, 'wa_parent_action', $bertha_action);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="blog-action" data-index="'.$key_num.'" data-desc="'.$bertha_desc.'" data-action="'.$bertha_action.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>
                            <div class="ber_half ber-gap-2">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div> 
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
                update_option('blog_action_ideas', $blog_action_ideas);
            }       
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_ber_child_input_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_child_template_nonce' );

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'child-input', 'idea_template');
        $child_input = isset($_POST['child_input']) ? sanitize_text_field($_POST['child_input']) : "";
        if($_POST['data_input']) $child_input = sanitize_text_field($_POST['data_input']);
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        
        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'input' => $child_input, 'template' => 'child-explain', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email, 'idea_unique_id' => $idea_unique_id ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args); 
        if (!is_wp_error($response) && isset($response['body'])) {
            $results = '';
            if(get_option('child_input_ideas')) {
             $child_input_ideas = get_option('child_input_ideas');
            } else {
             $child_input_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'child-input', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $child_input_ideas++;
                        $new = array(
                            'post_title' => 'Explain It To a Child - Idea:'.$child_input_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_input', $child_input);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="child-explain" data-index="'.$key_num.'" data-input="'.$child_input.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>
                            <div class="ber_half ber-gap-2">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div> 
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
                update_option('child_input_ideas', $child_input_ideas);
            }
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_seo_title_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_seo_title_template_nonce' );

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'bertha-seo-title', 'idea_template');
        $bertha_brand = isset($_POST['bertha_brand']) ? sanitize_text_field($_POST['bertha_brand']) : "";
        $bertha_keyword = isset($_POST['bertha_keyword']) ? sanitize_text_field($_POST['bertha_keyword']) : "";
        $bertha_title = isset($_POST['bertha_title']) ? sanitize_text_field($_POST['bertha_title']) : "";
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        if(isset($_POST['data_title']) && $_POST['data_title']) $bertha_title = sanitize_text_field($_POST['data_title']);
        if(isset($_POST['data_keyword']) && $_POST['data_keyword']) $bertha_keyword = sanitize_text_field($_POST['data_keyword']);
        if(isset($_POST['data_brand']) && $_POST['data_brand']) $bertha_brand = sanitize_text_field($_POST['data_brand']);
        
        $headers = array(
           "Authorization: Bearer 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",
           "Content-Type: application/json",
        );

        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'brand' => $bertha_brand, 'keyword' => $bertha_keyword, 'title' => $bertha_title, 'template' => 'seo-title', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email, 'idea_unique_id' => $idea_unique_id ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args);
        if (!is_wp_error($response) && isset($response['body'])) {
            $results = '';
            if(get_option('seo_title_ideas')) {
             $seo_title_ideas = get_option('seo_title_ideas');
            } else {
             $seo_title_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'bertha-seo-title', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $seo_title_ideas++;
                        $new = array(
                            'post_title' => 'Seo Title - Idea:'.$seo_title_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_keyword', $bertha_keyword);
                        update_post_meta($post_id, 'wa_parent_title', $bertha_title);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="seo-title" data-index="'.$key_num.'" data-keyword="'.$bertha_keyword.'" data-title="'.$bertha_title.'" data-brand="'.$bertha_brand.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>
                            <div class="ber_half ber-gap-2">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div> 
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
                update_option('seo_title_ideas', $seo_title_ideas);
            }       
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_seo_description_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_seo_desc_template_nonce' );

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'bertha-seo-description', 'idea_template');
        $bertha_keyword = isset($_POST['bertha_keyword']) ? sanitize_text_field($_POST['bertha_keyword']) : "";
        $bertha_title = isset($_POST['bertha_title']) ? sanitize_text_field($_POST['bertha_title']) : "";
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        if(isset($_POST['data_title']) && $_POST['data_title']) $bertha_title = sanitize_text_field($_POST['data_title']);
        if(isset($_POST['data_keyword']) && $_POST['data_keyword']) $bertha_keyword = sanitize_text_field($_POST['data_keyword']);
        
        $headers = array(
           "Authorization: Bearer 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",
           "Content-Type: application/json",
        );

        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'keyword' => $bertha_keyword, 'title' => $bertha_title, 'template' => 'seo-description', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email, 'idea_unique_id' => $idea_unique_id ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args);
        if (!is_wp_error($response) && isset($response['body'])) {
            $results = '';
            if(get_option('seo_description_ideas')) {
             $seo_description_ideas = get_option('seo_description_ideas');
            } else {
             $seo_description_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'bertha-seo-description', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $seo_description_ideas++;
                        $new = array(
                            'post_title' => 'Seo Description - Idea:'.$seo_description_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_keyword', $bertha_keyword);
                        update_post_meta($post_id, 'wa_parent_title', $bertha_title);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="seo-description" data-index="'.$key_num.'" data-keyword="'.$bertha_keyword.'" data-title="'.$bertha_title.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>
                            <div class="ber_half ber-gap-2">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div> 
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
                update_option('seo_description_ideas', $seo_description_ideas);
            }       
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_aida_marketing_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_aida_marketing_template_nonce' );

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'bertha-aida-marketing', 'idea_template');
        $bertha_brand = isset($_POST['bertha_brand']) ? sanitize_text_field($_POST['bertha_brand']) : "";
        $bertha_ideal_cust = isset($_POST['bertha_ideal_cust']) ? sanitize_text_field($_POST['bertha_ideal_cust']) : "";
        $bertha_sentiment = isset($_POST['bertha_sentiment']) ? sanitize_text_field($_POST['bertha_sentiment']) : "";
        $bertha_desc = isset($_POST['bertha_desc']) ? sanitize_textarea_field($_POST['bertha_desc']) : "";
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        if(isset($_POST['data_brand']) && $_POST['data_brand']) $bertha_brand = sanitize_text_field($_POST['data_brand']);
        if(isset($_POST['data_ideal_cust']) && $_POST['data_ideal_cust']) $bertha_ideal_cust = sanitize_text_field($_POST['data_ideal_cust']);
        if(isset($_POST['data_sentiment']) && $_POST['data_sentiment']) $bertha_sentiment = sanitize_text_field($_POST['data_sentiment']);
        if(isset($_POST['data_desc']) && $_POST['data_desc']) $bertha_desc = sanitize_textarea_field($_POST['data_desc']);

        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'brand' => $bertha_brand, 'cust' => $bertha_ideal_cust, 'desc' => $bertha_desc, 'sentiment' => $bertha_sentiment, 'template' => 'aida-marketing', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email, 'idea_unique_id' => $idea_unique_id ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args); 
        if (!is_wp_error($response) && isset($response['body'])) {
            if(get_option('wa_aida_marketing_ideas')) {
                $wa_aida_marketing_ideas = get_option('wa_aida_marketing_ideas');
            } else {
                $wa_aida_marketing_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'bertha-aida-marketing', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $wa_aida_marketing_ideas++;
                        $new = array(
                            'post_title' => 'Unique Selling Proposition - Idea:'. $wa_aida_marketing_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_brand', $bertha_brand);
                        update_post_meta($post_id, 'wa_parent_ideal_customer', $bertha_ideal_cust);
                        update_post_meta($post_id, 'wa_parent_sentiment', $bertha_sentiment);
                        update_post_meta($post_id, 'wa_parent_description', $bertha_desc);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="aida-marketing" data-index="'.$key_num.'" data-brand="'.$bertha_brand.'" data-customer="'.$bertha_ideal_cust.'" data-sentiment="'.$bertha_sentiment.'" data-desc="'.$bertha_desc.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>
                            <div class="ber-gap-2 ber_half">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div> 
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
                update_option('wa_aida_marketing_ideas', $wa_aida_marketing_ideas);
            }
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_seo_city_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_seo_city_template_nonce' );

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'bertha-seo-city', 'idea_template');
        $bertha_brand = isset($_POST['bertha_brand']) ? sanitize_text_field($_POST['bertha_brand']) : "";
        $bertha_city = isset($_POST['bertha_city']) ? sanitize_text_field($_POST['bertha_city']) : "";
        $bertha_cta = isset($_POST['bertha_cta']) ? sanitize_text_field($_POST['bertha_cta']) : "";
        $bertha_keyword = isset($_POST['bertha_keyword']) ? sanitize_text_field($_POST['bertha_keyword']) : "";
        $bertha_desc = isset($_POST['bertha_desc']) ? sanitize_textarea_field($_POST['bertha_desc']) : "";
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        if(isset($_POST['data_brand']) && $_POST['data_brand']) $bertha_brand = sanitize_text_field($_POST['data_brand']);
        if(isset($_POST['data_city']) && $_POST['data_city']) $bertha_city = sanitize_text_field($_POST['data_city']);
        if(isset($_POST['data_cta']) && $_POST['data_cta']) $bertha_cta = sanitize_text_field($_POST['data_cta']);
        if(isset($_POST['data_keyword']) && $_POST['data_keyword']) $bertha_keyword = sanitize_text_field($_POST['data_keyword']);
        if(isset($_POST['data_desc']) && $_POST['data_desc']) $bertha_desc = sanitize_textarea_field($_POST['data_desc']);

        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'brand' => $bertha_brand, 'city' => $bertha_city, 'desc' => $bertha_desc, 'cta' => $bertha_cta, 'keyword' => $bertha_keyword, 'template' => 'seo-city', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email, 'idea_unique_id' => $idea_unique_id ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args); 
        if (!is_wp_error($response) && isset($response['body'])) {
            if(get_option('wa_seo_city_ideas')) {
                $seo_city_ideas = get_option('wa_seo_city_ideas');
            } else {
                $seo_city_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'bertha-seo-city', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $seo_city_ideas++;
                        $new = array(
                            'post_title' => 'SEO City Based Pages - Idea:'. $seo_city_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_brand', $bertha_brand);
                        update_post_meta($post_id, 'wa_parent_city', $bertha_city);
                        update_post_meta($post_id, 'wa_parent_cta', $bertha_cta);
                        update_post_meta($post_id, 'wa_parent_keyword', $bertha_keyword);
                        update_post_meta($post_id, 'wa_parent_description', $bertha_desc);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="seo-city" data-index="'.$key_num.'" data-brand="'.$bertha_brand.'" data-city="'.$bertha_city.'" data-cta="'.$bertha_cta.'" data-keyword="'.$bertha_keyword.'" data-desc="'.$bertha_desc.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>
                            <div class="ber-gap-2 ber_half">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div> 
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
                update_option('wa_seo_city_ideas', $seo_city_ideas);
            }
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_buisiness_name_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_buisiness_name_template_nonce' );

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'bertha-buisiness-name', 'idea_template');
        $bertha_desc = isset($_POST['bertha_desc']) ? sanitize_textarea_field($_POST['bertha_desc']) : "";
        $bertha_sentiment = isset($_POST['bertha_sentiment']) ? sanitize_text_field($_POST['bertha_sentiment']) : "";
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        if(isset($_POST['data_desc']) && $_POST['data_desc']) $bertha_desc = sanitize_textarea_field($_POST['data_desc']);
        if(isset($_POST['data_sentiment']) && $_POST['data_sentiment']) $bertha_sentiment = sanitize_text_field($_POST['data_sentiment']);
        
        $headers = array(
           "Authorization: Bearer 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",
           "Content-Type: application/json",
        );

        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'desc' => $bertha_desc, 'sentiment' => $bertha_sentiment, 'template' => 'buisiness-name', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email, 'idea_unique_id' => $idea_unique_id ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args);
        if (!is_wp_error($response) && isset($response['body'])) {
            $results = '';
            if(get_option('buisiness_name_ideas')) {
             $buisiness_name_ideas = get_option('buisiness_name_ideas');
            } else {
             $buisiness_name_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'bertha-buisiness-name', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $buisiness_name_ideas++;
                        $new = array(
                            'post_title' => 'Business or Product Name - Idea:'.$buisiness_name_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_desc', $bertha_desc);
                        update_post_meta($post_id, 'wa_parent_sentiment', $bertha_sentiment);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="buisiness-name" data-index="'.$key_num.'" data-desc="'.$bertha_desc.'" data-sentiment="'.$bertha_sentiment.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>
                            <div class="ber_half ber-gap-2">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div> 
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
                update_option('buisiness_name_ideas', $buisiness_name_ideas);
            }       
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_bridge_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_bridge_template_nonce' );

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'bertha-bridge', 'idea_template');
        $bertha_brand = isset($_POST['bertha_brand']) ? sanitize_text_field($_POST['bertha_brand']) : "";
        $bertha_ideal_cust = isset($_POST['bertha_ideal_cust']) ? sanitize_text_field($_POST['bertha_ideal_cust']) : "";
        $bertha_sentiment = isset($_POST['bertha_sentiment']) ? sanitize_text_field($_POST['bertha_sentiment']) : "";
        $bertha_desc = isset($_POST['bertha_desc']) ? sanitize_textarea_field($_POST['bertha_desc']) : "";
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        if(isset($_POST['data_brand']) && $_POST['data_brand']) $bertha_brand = sanitize_text_field($_POST['data_brand']);
        if(isset($_POST['data_ideal_cust']) && $_POST['data_ideal_cust']) $bertha_ideal_cust = sanitize_text_field($_POST['data_ideal_cust']);
        if(isset($_POST['data_sentiment']) && $_POST['data_sentiment']) $bertha_sentiment = sanitize_text_field($_POST['data_sentiment']);
        if(isset($_POST['data_desc']) && $_POST['data_desc']) $bertha_desc = sanitize_textarea_field($_POST['data_desc']);

        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'brand' => $bertha_brand, 'cust' => $bertha_ideal_cust, 'desc' => $bertha_desc, 'sentiment' => $bertha_sentiment, 'template' => 'bridge', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email, 'idea_unique_id' => $idea_unique_id ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args); 
        if (!is_wp_error($response) && isset($response['body'])) {
            if(get_option('wa_aida_marketing_ideas')) {
                $wa_aida_marketing_ideas = get_option('wa_aida_marketing_ideas');
            } else {
                $wa_aida_marketing_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'bertha-bridge', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $wa_aida_marketing_ideas++;
                        $new = array(
                            'post_title' => 'Before, After and Bridge - Idea:'. $wa_aida_marketing_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_brand', $bertha_brand);
                        update_post_meta($post_id, 'wa_parent_ideal_customer', $bertha_ideal_cust);
                        update_post_meta($post_id, 'wa_parent_sentiment', $bertha_sentiment);
                        update_post_meta($post_id, 'wa_parent_description', $bertha_desc);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="bridge" data-index="'.$key_num.'" data-brand="'.$bertha_brand.'" data-customer="'.$bertha_ideal_cust.'" data-sentiment="'.$bertha_sentiment.'" data-desc="'.$bertha_desc.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>
                            <div class="ber-gap-2 ber_half">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div> 
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
                update_option('wa_aida_marketing_ideas', $wa_aida_marketing_ideas);
            }
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_pas_framework_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_pas_framework_template_nonce' );

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'bertha-pas-framework', 'idea_template');
        $bertha_brand = isset($_POST['bertha_brand']) ? sanitize_text_field($_POST['bertha_brand']) : "";
        $bertha_ideal_cust = isset($_POST['bertha_ideal_cust']) ? sanitize_text_field($_POST['bertha_ideal_cust']) : "";
        $bertha_sentiment = isset($_POST['bertha_sentiment']) ? sanitize_text_field($_POST['bertha_sentiment']) : "";
        $bertha_desc = isset($_POST['bertha_desc']) ? sanitize_textarea_field($_POST['bertha_desc']) : "";
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        if(isset($_POST['data_brand']) && $_POST['data_brand']) $bertha_brand = sanitize_text_field($_POST['data_brand']);
        if(isset($_POST['data_ideal_cust']) && $_POST['data_ideal_cust']) $bertha_ideal_cust = sanitize_text_field($_POST['data_ideal_cust']);
        if(isset($_POST['data_sentiment']) && $_POST['data_sentiment']) $bertha_sentiment = sanitize_text_field($_POST['data_sentiment']);
        if(isset($_POST['data_desc']) && $_POST['data_desc']) $bertha_desc = sanitize_textarea_field($_POST['data_desc']);

        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'brand' => $bertha_brand, 'cust' => $bertha_ideal_cust, 'desc' => $bertha_desc, 'sentiment' => $bertha_sentiment, 'template' => 'pas-framework', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email, 'idea_unique_id' => $idea_unique_id ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args); 
        if (!is_wp_error($response) && isset($response['body'])) {
            if(get_option('wa_pas_framework_ideas')) {
                $wa_pas_framework_ideas = get_option('wa_pas_framework_ideas');
            } else {
                $wa_pas_framework_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'bertha-pas-framework', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $wa_pas_framework_ideas++;
                        $new = array(
                            'post_title' => 'PAS Framework - Idea:'. $wa_pas_framework_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_brand', $bertha_brand);
                        update_post_meta($post_id, 'wa_parent_ideal_customer', $bertha_ideal_cust);
                        update_post_meta($post_id, 'wa_parent_sentiment', $bertha_sentiment);
                        update_post_meta($post_id, 'wa_parent_description', $bertha_desc);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="pas-framework" data-index="'.$key_num.'" data-brand="'.$bertha_brand.'" data-customer="'.$bertha_ideal_cust.'" data-sentiment="'.$bertha_sentiment.'" data-desc="'.$bertha_desc.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>
                            <div class="ber-gap-2 ber_half">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div> 
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
                update_option('wa_pas_framework_ideas', $wa_pas_framework_ideas);
            }
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_faq_list_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_faq_list_template_nonce' );

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'bertha-faq-list', 'idea_template');
        $bertha_desc = isset($_POST['bertha_desc']) ? sanitize_textarea_field($_POST['bertha_desc']) : "";
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        if(isset($_POST['data_desc']) && $_POST['data_desc']) $bertha_desc = sanitize_textarea_field($_POST['data_desc']);
        
        $headers = array(
           "Authorization: Bearer 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",
           "Content-Type: application/json",
        );

        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'desc' => $bertha_desc, 'template' => 'faq-list', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email, 'idea_unique_id' => $idea_unique_id ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args);
        if (!is_wp_error($response) && isset($response['body'])) {
            $results = '';
            if(get_option('faq_list_ideas')) {
             $faq_list_ideas = get_option('faq_list_ideas');
            } else {
             $faq_list_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'bertha-faq-list', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $buisiness_name_ideas++;
                        $new = array(
                            'post_title' => 'FAQs List - Idea:'.$faq_list_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_desc', $bertha_desc);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="faq-list" data-index="'.$key_num.'" data-desc="'.$bertha_desc.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>
                            <div class="ber_half ber-gap-2">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div> 
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
                update_option('faq_list_ideas', $faq_list_ideas);
            }       
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_faq_answer_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_faq_answer_template_nonce' );

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'bertha-faq-answer', 'idea_template');
        $bertha_desc = isset($_POST['bertha_desc']) ? sanitize_textarea_field($_POST['bertha_desc']) : "";
        $bertha_question = isset($_POST['bertha_question']) ? sanitize_text_field($_POST['bertha_question']) : "";
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        if(isset($_POST['data_desc']) && $_POST['data_desc']) $bertha_desc = sanitize_textarea_field($_POST['data_desc']);
        if(isset($_POST['data_question']) && $_POST['data_question']) $bertha_question = sanitize_text_field($_POST['data_question']);
        
        $headers = array(
           "Authorization: Bearer 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",
           "Content-Type: application/json",
        );

        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'desc' => $bertha_desc, 'question' => $bertha_question, 'template' => 'faq-answer', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email, 'idea_unique_id' => $idea_unique_id ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args);
        if (!is_wp_error($response) && isset($response['body'])) {
            $results = '';
            if(get_option('faq_answer_ideas')) {
             $faq_answer_ideas = get_option('faq_answer_ideas');
            } else {
             $faq_answer_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'bertha-faq-answer', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $faq_answer_ideas++;
                        $new = array(
                            'post_title' => 'FAQ Answers - Idea:'.$faq_answer_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_desc', $bertha_desc);
                        update_post_meta($post_id, 'wa_parent_question', $bertha_question);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="faq-answer" data-index="'.$key_num.'" data-desc="'.$bertha_desc.'" data-question="'.$bertha_question.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>
                            <div class="ber_half ber-gap-2">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div> 
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
                update_option('faq_answer_ideas', $faq_answer_ideas);
            }       
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_summaries_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_summaries_template_nonce' );

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'bertha-summary', 'idea_template');
        $bertha_sentiment = isset($_POST['bertha_sentiment']) ? sanitize_text_field($_POST['bertha_sentiment']) : "";
        $bertha_summary = isset($_POST['bertha_summary']) ? sanitize_text_field($_POST['bertha_summary']) : "";
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        if(isset($_POST['data_desc']) && $_POST['data_desc']) $bertha_sentiment = sanitize_text_field($_POST['data_sentiment']);
        if(isset($_POST['data_question']) && $_POST['data_question']) $bertha_summary = sanitize_text_field($_POST['data_summary']);
        
        $headers = array(
           "Authorization: Bearer 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",
           "Content-Type: application/json",
        );

        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'sentiment' => $bertha_sentiment, 'summary' => $bertha_summary, 'template' => 'summaries', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email, 'idea_unique_id' => $idea_unique_id ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args);
        if (!is_wp_error($response) && isset($response['body'])) {
            $results = '';
            if(get_option('summaries_ideas')) {
             $summaries_ideas = get_option('summaries_ideas');
            } else {
             $summaries_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'bertha-summary', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $summaries_ideas++;
                        $new = array(
                            'post_title' => 'Summaries - Idea:'.$summaries_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_sentiment', $bertha_sentiment);
                        update_post_meta($post_id, 'wa_parent_summary', $bertha_summary);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="summaries" data-index="'.$key_num.'" data-summary="'.$bertha_summary.'" data-sentiment="'.$bertha_sentiment.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>
                            <div class="ber_half ber-gap-2">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div> 
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
                update_option('summaries_ideas', $summaries_ideas);
            }       
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_contact_blurb_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_contact_blurb_template_nonce' );

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'bertha-contact-blurb', 'idea_template');
        $bertha_brand = isset($_POST['bertha_brand']) ? sanitize_text_field($_POST['bertha_brand']) : "";
        $bertha_cta = isset($_POST['bertha_cta']) ? sanitize_text_field($_POST['bertha_cta']) : "";
        $bertha_desc = isset($_POST['bertha_desc']) ? sanitize_textarea_field($_POST['bertha_desc']) : "";
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        if(isset($_POST['data_brand']) && $_POST['data_brand']) $bertha_brand = sanitize_text_field($_POST['data_brand']);
        if(isset($_POST['data_cta']) && $_POST['data_cta']) $bertha_cta = sanitize_text_field($_POST['data_cta']);
        if(isset($_POST['data_desc']) && $_POST['data_desc']) $bertha_desc = sanitize_textarea_field($_POST['data_desc']);

        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'brand' => $bertha_brand, 'cta' => $bertha_cta, 'desc' => $bertha_desc, 'template' => 'contact-blurb', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email, 'idea_unique_id' => $idea_unique_id ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args); 
        if (!is_wp_error($response) && isset($response['body'])) {
            if(get_option('contact_blurb_ideas')) {
                $contact_blurb_ideas = get_option('contact_blurb_ideas');
            } else {
                $contact_blurb_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'bertha-contact-blurb', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $contact_blurb_ideas++;
                        $new = array(
                            'post_title' => 'Contact Form Blurb - Idea:'. $contact_blurb_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_brand', $bertha_brand);
                        update_post_meta($post_id, 'wa_parent_cta', $bertha_cta);
                        update_post_meta($post_id, 'wa_parent_description', $bertha_desc);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="contact-blurb" data-index="'.$key_num.'" data-brand="'.$bertha_brand.'" data-cta="'.$bertha_cta.'" data-desc="'.$bertha_desc.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>
                            <div class="ber-gap-2 ber_half">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div> 
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
                update_option('contact_blurb_ideas', $contact_blurb_ideas);
            }
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_seo_keyword_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_seo_keyword_template_nonce' );

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'bertha-seo-keyword', 'idea_template');
        $bertha_desc = isset($_POST['bertha_desc']) ? $_POST['bertha_desc'] : "";
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? $_POST['bertha_desc_index'] : 0;
        $data_block = isset($_POST['data_block']) ? $_POST['data_block'] : '';
        if(isset($_POST['data_desc']) && $_POST['data_desc']) $bertha_desc = $_POST['data_desc'];
        
        $headers = array(
           "Authorization: Bearer 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",
           "Content-Type: application/json",
        );

        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'desc' => $bertha_desc, 'template' => 'seo-keyword', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email, 'idea_unique_id' => $idea_unique_id ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args);
        if (!is_wp_error($response) && isset($response['body'])) {
            $results = '';
            if(get_option('seo_keyword_ideas')) {
             $seo_keyword_ideas = get_option('seo_keyword_ideas');
            } else {
             $seo_keyword_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'bertha-seo-keyword', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $seo_keyword_ideas++;
                        $new = array(
                            'post_title' => 'SEO Keyword Suggestions - Idea:'.$seo_keyword_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_desc', $bertha_desc);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="seo-keyword" data-index="'.$key_num.'" data-desc="'.$bertha_desc.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>
                            <div class="ber_half ber-gap-2">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div> 
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
                update_option('seo_keyword_ideas', $seo_keyword_ideas);
            }       
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_evil_bertha_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_evil_bertha_template_nonce' );

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'bertha-evil-bertha', 'idea_template');
        $bertha_desc = isset($_POST['bertha_desc']) ? sanitize_textarea_field($_POST['bertha_desc']) : "";
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        if(isset($_POST['data_desc']) && $_POST['data_desc']) $bertha_desc = sanitize_textarea_field($_POST['data_desc']);
        
        $headers = array(
           "Authorization: Bearer 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",
           "Content-Type: application/json",
        );

        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'desc' => $bertha_desc, 'template' => 'evil-bertha', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email, 'idea_unique_id' => $idea_unique_id ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args);
        if (!is_wp_error($response) && isset($response['body'])) {
            $results = '';
            if(get_option('evil_bertha_ideas')) {
             $evil_bertha_ideas = get_option('evil_bertha_ideas');
            } else {
             $evil_bertha_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'bertha-evil-bertha', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $evil_bertha_ideas++;
                        $new = array(
                            'post_title' => 'Evil Bertha - Idea:'.$evil_bertha_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_desc', $bertha_desc);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="evil-bertha" data-index="'.$key_num.'" data-desc="'.$bertha_desc.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>
                            <div class="ber_half ber-gap-2">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div> 
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
                update_option('evil_bertha_ideas', $evil_bertha_ideas);
            }       
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_real_estate_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_real_estate_template_nonce' );

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'bertha-real-eastate', 'idea_template');
        $bertha_brand = isset($_POST['bertha_brand']) ? sanitize_text_field($_POST['bertha_brand']) : "";
        $bertha_location = isset($_POST['bertha_location']) ? sanitize_text_field($_POST['bertha_location']) : "";
        $bertha_type = isset($_POST['bertha_type']) ? sanitize_textarea_field($_POST['bertha_type']) : "";
        $bertha_desc = isset($_POST['bertha_desc']) ? sanitize_text_field($_POST['bertha_desc']) : "";
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        if(isset($_POST['data_brand']) && $_POST['data_brand']) $bertha_brand = sanitize_text_field($_POST['data_brand']);
        if(isset($_POST['data_location']) && $_POST['data_location']) $bertha_location = sanitize_text_field($_POST['data_location']);
        if(isset($_POST['data_type']) && $_POST['data_type']) $bertha_type = sanitize_textarea_field($_POST['data_type']);
        if(isset($_POST['data_desc']) && $_POST['data_desc']) $bertha_desc = sanitize_text_field($_POST['data_desc']);

        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'brand' => $bertha_brand, 'location' => $bertha_location, 'type' => $bertha_type, 'desc' => $bertha_desc, 'template' => 'real-estate', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email, 'idea_unique_id' => $idea_unique_id ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args); 
        if (!is_wp_error($response) && isset($response['body'])) {
            if(get_option('wa_real_estate_ideas')) {
                $wa_real_estate_ideas = get_option('wa_real_estate_ideas');
            } else {
                $wa_real_estate_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'bertha-real-eastate', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $wa_real_estate_ideas++;
                        $new = array(
                            'post_title' => 'Real Estate Property Listing Description - Idea:'. $wa_real_estate_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_brand', $bertha_brand);
                        update_post_meta($post_id, 'wa_parent_location', $bertha_location);
                        update_post_meta($post_id, 'wa_parent_type', $bertha_type);
                        update_post_meta($post_id, 'wa_parent_desc', $bertha_desc);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="real-estate" data-index="'.$key_num.'" data-brand="'.$bertha_brand.'" data-location="'.$bertha_location.'" data-type="'.$bertha_type.'" data-desc="'.$bertha_desc.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>
                            <div class="ber-gap-2 ber_half">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div> 
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
                update_option('wa_real_estate_ideas', $wa_real_estate_ideas);
            }
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_press_blurb_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_press_blurb_template_nonce' );

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'bertha-press-blurb', 'idea_template');
        $bertha_name = isset($_POST['bertha_name']) ? sanitize_text_field($_POST['bertha_name']) : "";
        $bertha_info = isset($_POST['bertha_info']) ? sanitize_text_field($_POST['bertha_info']) : "";
        $bertha_desc = isset($_POST['bertha_desc']) ? sanitize_textarea_field($_POST['bertha_desc']) : "";
        $bertha_keyword = isset($_POST['bertha_keyword']) ? sanitize_text_field($_POST['bertha_keyword']) : "";
        $bertha_brand = isset($_POST['bertha_brand']) ? sanitize_text_field($_POST['bertha_brand']) : "";
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        if(isset($_POST['data_name']) && $_POST['data_name']) $bertha_name = sanitize_text_field($_POST['data_name']);
        if(isset($_POST['data_info']) && $_POST['data_info']) $bertha_info = sanitize_text_field($_POST['data_info']);
        if(isset($_POST['data_desc']) && $_POST['data_desc']) $bertha_desc = sanitize_textarea_field($_POST['data_desc']);
        if(isset($_POST['data_keyword']) && $_POST['data_keyword']) $bertha_keyword = sanitize_text_field($_POST['data_keyword']);
        if(isset($_POST['data_brand']) && $_POST['data_brand']) $bertha_brand = sanitize_text_field($_POST['data_brand']);

        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'name' => $bertha_name, 'info' => $bertha_info, 'desc' => $bertha_desc, 'keyword' => $bertha_keyword, 'brand' => $bertha_brand, 'template' => 'press-blurb', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email, 'idea_unique_id' => $idea_unique_id ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args); 
        if (!is_wp_error($response) && isset($response['body'])) {
            if(get_option('wa_press_blurb_ideas')) {
                $wa_press_blurb_ideas = get_option('wa_press_blurb_ideas');
            } else {
                $wa_press_blurb_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'bertha-press-blurb', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $wa_press_blurb_ideas++;
                        $new = array(
                            'post_title' => 'Press Mention Blurb - Idea:'. $wa_press_blurb_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_name', $bertha_name);
                        update_post_meta($post_id, 'wa_parent_info', $bertha_info);
                        update_post_meta($post_id, 'wa_parent_description', $bertha_desc);
                        update_post_meta($post_id, 'wa_parent_keyword', $bertha_keyword);
                        update_post_meta($post_id, 'wa_parent_brand', $bertha_brand);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="press-blurb" data-index="'.$key_num.'" data-name="'.$bertha_name.'" data-info="'.$bertha_info.'" data-desc="'.$bertha_desc.'" data-keyword="'.$bertha_keyword.'" data-brand="'.$bertha_brand.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>
                            <div class="ber-gap-2 ber_half">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div> 
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
                update_option('wa_press_blurb_ideas', $wa_press_blurb_ideas);
            }
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_case_study_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_case_study_template_nonce' );

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $term = get_term_by('slug', 'bertha-case-study', 'idea_template');
        $bertha_subject = isset($_POST['bertha_subject']) ? sanitize_text_field($_POST['bertha_subject']) : "";
        $bertha_info = isset($_POST['bertha_info']) ? sanitize_text_field($_POST['bertha_info']) : "";
        $bertha_brand = isset($_POST['bertha_brand']) ? sanitize_text_field($_POST['bertha_brand']) : "";
        $bertha_desc = isset($_POST['bertha_desc']) ? sanitize_textarea_field($_POST['bertha_desc']) : "";
        $bertha_keyword = isset($_POST['bertha_keyword']) ? sanitize_text_field($_POST['bertha_keyword']) : "";
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        if(isset($_POST['data_subject']) && $_POST['data_subject']) $bertha_subject = sanitize_text_field($_POST['data_subject']);
        if(isset($_POST['data_info']) && $_POST['data_info']) $bertha_info = sanitize_text_field($_POST['data_info']);
        if(isset($_POST['data_brand']) && $_POST['data_brand']) $bertha_brand = sanitize_text_field($_POST['data_brand']);
        if(isset($_POST['data_desc']) && $_POST['data_desc']) $bertha_desc = sanitize_textarea_field($_POST['data_desc']);
        if(isset($_POST['data_keyword']) && $_POST['data_keyword']) $bertha_keyword = sanitize_text_field($_POST['data_keyword']);

        $idea_unique_id = md5(uniqid());
        $url = 'https://bertha.ai/wp-json/wa/implement';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'subject' => $bertha_subject, 'info' => $bertha_info, 'brand' => $bertha_brand, 'desc' => $bertha_desc, 'keyword' => $bertha_keyword, 'template' => 'case-study', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $user_email, 'idea_unique_id' => $idea_unique_id ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args); 
        if (!is_wp_error($response) && isset($response['body'])) {
            if(get_option('wa_case_study_ideas')) {
                $wa_case_study_ideas = get_option('wa_case_study_ideas');
            } else {
                $wa_case_study_ideas = 0;
            }
            $idea_tax = get_term_by('slug', 'bertha-case-study', 'idea_template');
            $results = '<form  id="form3">
            <div class="ber_inner_title">'.__('Choose the idea you prefer', 'bertha-ai').' <span class="ber-dashicons ber-dashicons-arrow-right-alt2"></span></div>
                            <div class="ber_inner_p">'.__('Click the area you want the idea to be inserted to, then click the idea that works for you.', 'bertha-ai').'</div>';
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
                $result_array['left_limit'] = json_decode($response['body'])->left_limit;
                $result_array['limit'] = json_decode($response['body'])->limit;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $wa_case_study_ideas++;
                        $new = array(
                            'post_title' => 'Case Study Generator (STAR Method) - Idea:'. $wa_case_study_ideas,
                            'post_content' => $choice->text,
                            'post_type'   => 'idea',
                            'post_status' => 'publish',
                        );
                        $post_id = wp_insert_post( $new );
                        wp_set_object_terms($post_id, $idea_tax->term_id, 'idea_template');

                        if(get_post_meta($post_id, 'bertha_favourate_added', true)) {
                            $favourite =  __('Favourite added', 'bertha-ai');
                            $favourate_added = 'favourate_added';
                        } else {
                            $favourite = __('Add to favourite', 'bertha-ai');
                            $favourate_added = '';
                        }
                        update_post_meta($post_id, 'wa_idea_unique_id', $idea_unique_id);

                        update_post_meta($post_id, 'wa_parent_name', $bertha_subject);
                        update_post_meta($post_id, 'wa_parent_info', $bertha_info);
                        update_post_meta($post_id, 'wa_parent_brand', $bertha_brand);
                        update_post_meta($post_id, 'wa_parent_description', $bertha_desc);
                        update_post_meta($post_id, 'wa_parent_keyword', $bertha_keyword);
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$post_id.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$post_id.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$post_id.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$post_id.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                           <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key_num.'" autocomplete="off" data-block="'.$data_block.'">
                                            <label class="ber-btn bertha_idea" for="option'.$key_num.'"><span class="bertha_idea_number">'.$term->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',wp_strip_all_tags($choice->text)).'</pre></div></label>
                                        </div>
                                    </div>';
                    }
                }
                $results .= '<div class="ber-gap-2 ber_half" id="more_idea_generate" style="margin-bottom: 15px;">
                                <button class="ber-btn ber-btn-primary wa-generate-idea" id="next7" data-id="case-study" data-index="'.$key_num.'" data-subject="'.$bertha_subject.'" data-info="'.$bertha_info.'" data-brand="'.$bertha_brand.'" data-desc="'.$bertha_desc.'" data-keyword="'.$bertha_keyword.'" data-block="'.$data_block.'">'.__('Generate More Ideas', 'bertha-ai').'</button>
                            </div>
                            <div class="ber-gap-2 ber_half">
                                <button class="ber-btn bertha_sec_btn" id="next3">'.__('Choose Another Template', 'bertha-ai').'</button>
                            </div> 
                            <div class="ber-overlay"></div>
                            <div class="ber-more-new-ideas-here"></div>               
                        </form>';
                update_option('wa_case_study_ideas', $wa_case_study_ideas);
            }
            $result_array['html'] = $results;
            $result_array['left_limit'] = json_decode($response['body'])->left_limit;
            $result_array['limit'] = json_decode($response['body'])->limit;
            $result_array['idea_history'] = get_bertha_history_ideas();
            if($key_num > 4) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_long_form_ai_action_callback() {
        if (!isset($_POST['bertha_long_form_nonce']) || !wp_verify_nonce($_POST['bertha_long_form_nonce'], 'bertha_long_form')) {
               die();
        }

        global $current_user;
        $result_array = array();
        $bertha_keyword = isset($_POST['bertha_keyword']) ? sanitize_text_field($_POST['bertha_keyword']) : "";
        $bertha_title = isset($_POST['bertha_title']) ? sanitize_text_field($_POST['bertha_title']) : "";
        $bertha_desc = isset($_POST['bertha_desc']) ? sanitize_textarea_field($_POST['bertha_desc']) : "";
        $bertha_audience = isset($_POST['bertha_audience']) ? sanitize_text_field($_POST['bertha_audience']) : "";
        $bertha_tone = isset($_POST['bertha_tone']) ? sanitize_text_field($_POST['bertha_tone']) : "";
        $bertha_body_offset = isset($_POST['bertha_body_offset']) ? sanitize_text_field($_POST['bertha_body_offset']) : 0;
        $bertha_desc_index = isset($_POST['bertha_desc_index']) ? sanitize_text_field($_POST['bertha_desc_index']) : 0;
        if(isset($_POST['data_title']) && $_POST['data_title']) $bertha_title = sanitize_text_field($_POST['data_title']);
        if(isset($_POST['data_keyword']) && $_POST['data_keyword']) $bertha_keyword = sanitize_text_field($_POST['data_keyword']);
        if(isset($_POST['last_dec']) && $_POST['last_dec']) {
            $last_dec = sanitize_textarea_field($_POST['last_dec']);
            // if($bertha_body_offset && $bertha_body_offset > 1) $last_dec = substr($last_dec, 0, ($bertha_body_offset));
            // print_r($last_dec);die;
            $context = substr($last_dec, -3000);
        } else {
            $context = '';
        }
        if($_POST['data_audience']) $bertha_audience = sanitize_text_field($_POST['data_audience']);
        if($_POST['data_tone']) $bertha_tone = sanitize_text_field($_POST['data_tone']);
        
        $headers = array(
           "Authorization: Bearer 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",
           "Content-Type: application/json",
        );

        $url = 'https://bertha.ai/wp-json/wa/implement';
        if($context) {
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'keyword' => $bertha_keyword, 'title' => $bertha_title, 'tone' => $bertha_tone, 'desc' => $bertha_desc, 'audience' => $bertha_audience, 'context' => $context, 'template' => 'long-form', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $current_user->user_email ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
        } else {
            $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'strict_mode' => $this->strict_mode, 'desc' => $bertha_desc, 'keyword' => $bertha_keyword, 'audience' => $bertha_audience, 'title' => $bertha_title, 'tone' => $bertha_tone, 'token' => true, 'template' => 'long-form', 'key' => BTHAI_LICENSE_KEY, 'home_url' => home_url(), 'current_user' => $current_user->user_email ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        }
        $response = wp_remote_post($url, $args);
        if (!is_wp_error($response) && isset($response['body'])) {
            if(isset(json_decode($response['body'])->token_denied)) {
                $result_array['token_denied'] = json_decode($response['body'])->token_denied;
            } else {
                foreach(json_decode($response['body'])->choices as $key => $choice) {
                    if(strlen($choice->text) > 1) {
                        $key_num = $key + 1 + $bertha_desc_index;
                        $results = preg_replace('/\\\\/', '', wp_strip_all_tags($choice->text));
                    }
                }
            }       
            $result_array['html'] = $results;
            $result_array['data-index'] = $key_num;
            $result_array['data-keyword'] = $bertha_keyword;
            $result_array['data-title'] = $bertha_title;
            $result_array['data-desc'] = $bertha_desc;
            $result_array['data-audience'] = $bertha_audience;
            $result_array['data-tone'] = $bertha_tone;
            if($key_num > 1) {
                $result_array['more_html'] = 'true';
            }else {
                $result_array['more_html'] = 'false';
            }
            print_r(json_encode($result_array));die;
        }
    }

    function bthai_long_form_save_draft_ai_action_callback() {

        if (!isset($_POST['bertha_long_form_nonce']) || !wp_verify_nonce($_POST['bertha_long_form_nonce'], 'bertha_long_form')) {
               die();
        }

        global $current_user;
        if(empty( (array)$current_user->data )) {
            $user_email = '';
            $url = 'https://bertha.ai/wp-json/license/customer';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license' => BTHAI_LICENSE_KEY ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $user_email = json_decode($response['body']);
            }
        } else {
            $user_email = $current_user->user_email;
        }
        $result_array = array();
        $bertha_title = isset($_POST['bertha_title']) ? sanitize_text_field($_POST['bertha_title']) : "";
        $bertha_body = isset($_POST['bertha_body']) ? sanitize_text_field($_POST['bertha_body']) : "";
        $bertha_draft = isset($_POST['bertha_draft']) ? sanitize_text_field($_POST['bertha_draft']) : "";

        if($bertha_draft) {
            $new = array(
                    'ID' =>  $bertha_draft,
                    'post_title' => $bertha_title,
                    'post_content' => $bertha_body,
                    'post_type'   => 'backedn',
                    'post_status' => 'publish',
                );
            wp_update_post( $new );
        } else {
            $new = array(
                    'post_title' => $bertha_title,
                    'post_content' => $bertha_body,
                    'post_type'   => 'backedn',
                    'post_status' => 'publish',
                );
            wp_insert_post( $new );
        }
        $result_array['drafts'] = get_bertha_backedn_drafts();
        print_r(json_encode($result_array));die;
    }

    function bthai_long_form_edit_draft_ai_action_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_draft_edit_nonce' );

        $result = array();
        $draft_id = isset($_POST['draft_id']) ? sanitize_text_field($_POST['draft_id']) : '';
        $draft_post = get_post($draft_id); 
        if($draft_post) {
            $result['draft_body'] = $draft_post->post_content;
        } else {
            $result['draft_body'] = 'false';
        }
        print_r(json_encode($result));die;
    }

    function bthai_wa_ai_templates_callback() {

        if (!isset($_POST['bertha_template_nonce']) || !wp_verify_nonce($_POST['bertha_template_nonce'], 'bertha_templates_form')) {
               die();
        }

        $result = array();
        $template = isset($_POST['wa_template']) ? sanitize_text_field($_POST['wa_template']) : '';
        $data_block = isset($_POST['data_block']) ? sanitize_text_field($_POST['data_block']) : '';
        $options = get_option('bertha_ai_options') ? (array) get_option('bertha_ai_options') : array();
        if(BTHAI_LICENSE_KEY) {
            $url = 'https://bertha.ai/wp-json/license/limit';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license_key' => $this->license_key ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args);
            if (!is_wp_error($response) && isset($response['body'])) {
                $data = json_decode($response['body']);
                $free_templates = json_decode($data->free_templates);
                $upgrade_message = '<div class="ber_notice">'.__('This is a Premium Feature', 'bertha-ai').' <a class="bertha_premium_upgrade" href="http://bertha.ai/pricing" target="_blank">'.__('click to upgrade', 'bertha-ai').'</a></div>';
            }
            switch ($template) {
                case "USP":
                    $term = get_term_by('slug', 'idea-usp', 'idea_template');
                    $result['tax_name'] = __('🏆 Unique Value Proposition', 'bertha-ai');
                    $result['tax_description'] = '<div class="ber-mb-3">
                                <div class="ber-d-grid gap-2">
                                    <label class="ber-btn bertha_template" for="option8" data-id="website"><span class="bertha_template_icon">🏆</span>'.__('Unique Value Proposition', 'bertha-ai').'<span class="bertha_power">Premium</span><span class="bertha_template_desc">'.__('That will make you stand out form the Crowd and used as the top sentence of your website.', 'bertha-ai').'</span></label>
                                </div>
                            </div>';
                    if(isset($free_templates->usp_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <input type="hidden" class="ber-form-control bertha_brand" id="brand" value="'.esc_attr( $options['brand_name'] ).'">
                                <input type="hidden" class="ber-form-control bertha_ideal_cust" id="ideal_customer" value="'.esc_attr( $options['ideal_customer'] ).'">
                                <input type="hidden" class="ber-form-control bertha_sentiment" id="sentiment" value="'.esc_attr( $options['sentiment'] ).'">
                                <div class="ber-mb-3">
                                    <label for="bertha_desc" class="ber-form-label">'.__('Company Description/In your own words', 'bertha-ai').'</label>
                                    <textarea class="ber-form-control bertha_desc" maxlength="800" id="bertha_desc" rows="3" placeholder="'.__('Company Description', 'bertha-ai').'">'.esc_attr( $options['customer_details'] ).'</textarea>
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea bertha-desc-notice" id="wa-generate-idea" data-id="USP" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/kdck5F2TwiU"></iframe></div>
                                </div>
                            </form>';
                    }else {
                        $result['html'] = $upgrade_message;
                    }
                    break;
                case "Headline":
                    $term = get_term_by('slug', 'sub-headline', 'idea_template');
                    $result['tax_name'] = __('🥈 Website Sub-Headline', 'bertha-ai');
                    $result['tax_description'] = '<div class="ber-mb-3">
                                <div class="ber-d-grid ber-gap-2">
                                    <label class="ber-btn bertha_template" for="option9" data-id="website"><span class="bertha_template_icon">🥈</span>'.__('Website Sub-Headline', 'bertha-ai').'<span class="bertha_template_desc">'.__('A converting description that will go below your USP on the website - great for H2 Headings and SEO.', 'bertha-ai').'</span></label>
                                </div>
                            </div>';
                    if(isset($free_templates->heading_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <input type="hidden" class="ber-form-control sub_headline_ideal_cust" id="ideal_customer" value="'.esc_attr( $options['ideal_customer'] ).'">
                                <input type="hidden" class="ber-form-control sub_headline_sentiment" id="sentiment" value="'.esc_attr( $options['sentiment'] ).'">
                                <div class="ber-mb-3">
                                    <label for="usp" class="ber-form-label">'.__('The main title of the website or page', 'bertha-ai').'/post</label>
                                    <input type="text" class="ber-form-control sub_headline_usp" maxlength="100" id="usp" placeholder="'.__('E.G Your unique selling proposition', 'bertha-ai').'">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="bertha_desc" class="ber-form-label">'.__('Description in your own words', 'bertha-ai').'</label>
                                    <textarea class="ber-form-control sub_headline_desc" maxlength="800" id="bertha_desc" rows="3" placeholder="'.__('Company Description', 'bertha-ai').'">'.esc_attr( $options['customer_details'] ).'</textarea>
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea bertha-desc-notice" id="wa-generate-idea" data-id="Headline" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/6HZzfGNbMOM"></iframe></div>
                                </div>
                            </form>';
                    }else {
                        $result['html'] = $upgrade_message;
                    }
                    break;
                case "Title":
                    $term = get_term_by('slug', 'section-title', 'idea_template');
                    $result['tax_name'] = __('🏹 Section Title Generator', 'bertha-ai');
                    $result['tax_description'] = '<div class="ber-mb-3">
                                <div class="ber-d-grid ber-gap-2">
                                    <label class="ber-btn bertha_template" for="option10" data-id="website"><span class="bertha_template_icon">🏹</span>'.__('Section Title Generator', 'bertha-ai').'<span class="bertha_template_desc">'.__('Creative titles for each section of your website. No more boring "About us" type of titles.', 'bertha-ai').'</span></label>
                                </div>
                            </div>';
                    if(isset($free_templates->title_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <input type="hidden" class="ber-form-control sec_title_ideal_cust" id="ideal_customer" value="'.esc_attr( $options['ideal_customer'] ).'">
                                <input type="hidden" class="ber-form-control sec_title_sentiment" id="sentiment" value="'.esc_attr( $options['sentiment'] ).'">
                                <div class="ber-mb-3">
                                    <label for="title_type" class="ber-form-label">'.__('Title Type', 'bertha-ai').'</label>
                                    <select class="ber-form-control sec_title_type" id="title_type">
                                    <option value="">'.__('Select from the drop down or choose your own', 'bertha-ai').'</option>
                                        <option>'.__('About Us', 'bertha-ai').'</option>
                                        <option>'.__('Client Recommendation', 'bertha-ai').'</option>
                                        <option>'.__('Our Services', 'bertha-ai').'</option>
                                        <option>'.__('How It Works', 'bertha-ai').'</option>
                                        <option>'.__('Call To Action', 'bertha-ai').'</option>
                                        <option>'.__('Contact Us', 'bertha-ai').'</option>
                                        <option>'.__('Latest Articles', 'bertha-ai').'</option>
                                        <option>'.__('From The Press', 'bertha-ai').'</option>
                                        <option>'.__('Our Partners', 'bertha-ai').'</option>
                                        <option>'.__('But Wait... There More', 'bertha-ai').'</option>
                                        <option>'.__('Price Guarantee', 'bertha-ai').'</option>
                                        <option>'.__('Our Features', 'bertha-ai').'</option>
                                        <option>'.__('Newsletter Sign Up', 'bertha-ai').'</option>
                                        <option>'.__('Urgency and Scarcity', 'bertha-ai').'</option>
                                        <option>'.__('Before and After', 'bertha-ai').'</option>
                                        <option value="other">'.__('Other...', 'bertha-ai').'</option>
                                    </select>
                                </div>
                                <div class="ber-mb-3 other-title" style="display:none;">
                                    <label for="other" class="ber-form-label">'.__('Insert Your Own Title Type', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control other_title" maxlength="100" id="other" placeholder="'.__('Insert Your Own Title Type', 'bertha-ai').'">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="bertha_desc" class="ber-form-label">'.__('Company Description or use your own words', 'bertha-ai').'</label>
                                    <textarea class="ber-form-control sec_title_desc" maxlength="800" id="bertha_desc" rows="3" placeholder="'.__('Company Description', 'bertha-ai').'">'.esc_attr( $options['customer_details'] ).'</textarea>
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea bertha-desc-notice" id="wa-generate-idea" data-id="Title" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/Z3zthDuzPKs"></iframe></div>
                                </div>
                            </form>';
                    }else {
                       $result['html'] = $upgrade_message; 
                    }
                    break;
                case "Paragraph":
                    $term = get_term_by('slug', 'idea-paragraph', 'idea_template');
                    $result['tax_name'] = __('💣 Paragraph Generator', 'bertha-ai');
                    $result['tax_description'] = '<div class="ber-mb-3">
                                <div class="ber-d-grid ber-gap-2">
                                    <label class="ber-btn bertha_template" for="option6" data-id="website"><span class="bertha_template_icon">💣</span>'.__('Paragraph Generator', 'bertha-ai').'<span class="bertha_template_desc">'.__('Great for getting over writers block: Craft creative short paragraphs fro different areas of your website in blog posts and pages.', 'bertha-ai').'</span></label>
                                </div>
                            </div>';
                    if(isset($free_templates->paragraph_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <input type="hidden" class="ber-form-control para_ideal_cust" id="ideal_customer" value="'.esc_attr( $options['ideal_customer'] ).'">
                                <input type="hidden" class="ber-form-control para_sentiment" id="sentiment" value="'.esc_attr( $options['sentiment'] ).'">
                                <div class="ber-mb-3">
                                    <label for="title" class="ber-form-label">'.__('Title', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control para_title" maxlength="100" id="title" placeholder="'.__('The title of the subject of the paragraph', 'bertha-ai').'">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="bertha_desc" class="ber-form-label">'.__('In Your Own Words (If required)', 'bertha-ai').'</label>
                                    <textarea class="ber-form-control para_desc" id="bertha_desc" rows="3" maxlength="800" placeholder="'.__('Company Description', 'bertha-ai').'">'.esc_attr( $options['customer_details'] ).'</textarea>
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea bertha-desc-notice" id="wa-generate-idea" data-id="Paragraph" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/N50nUnub3gQ"></iframe></div>
                                </div>
                            </form>';
                    }else {
                        $result['html'] = $upgrade_message;
                    }
                    break;
                case "Service":
                    $term = get_term_by('slug', 'product-service-description', 'idea_template');
                    $result['tax_name'] = __('💲 Product/Service Description', 'bertha-ai');
                    $result['tax_description'] = '<div class="ber-mb-3">
                                <div class="ber-d-grid ber-gap-2">
                                    <label class="ber-btn bertha_template" for="option13" data-id="website"><span class="bertha_template_icon">💲</span>'.__('Product/Service Description', 'bertha-ai').'<span class="bertha_template_desc">'.__('Perfect for e-commerce Stores.', 'bertha-ai').'</span></label>
                                </div>
                            </div>';
                    if(isset($free_templates->service_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <input type="hidden" class="ber-form-control service_description_sentiment" id="sentiment" value="'.esc_attr( $options['sentiment'] ).'">
                                <div class="ber-mb-3">
                                    <label for="name" class="ber-form-label">'.__('Product/Service Name', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control service_description_name" maxlength="100" id="name" placeholder="'.__('Add a product, feature or service name or title', 'bertha-ai').'">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="bertha_desc" class="ber-form-label">'.__('Add a short description of your Product or Service', 'bertha-ai').'</label>
                                    <textarea class="ber-form-control service_description_desc" maxlength="800" id="bertha_desc" rows="3">'.esc_attr( $options['customer_details'] ).'</textarea>
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea bertha-desc-notice" id="wa-generate-idea" data-id="Service" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/knc2AnzVXXs"></iframe></div>
                                </div>
                            </form>';
                    }else {
                        $result['html'] = $upgrade_message;
                    }
                    break;
                case "Company":
                    $term = get_term_by('slug', 'company-bio', 'idea_template');
                    $result['tax_name'] = __('🏭 Full-on About Us Page (Company Bio)', 'bertha-ai');
                    $result['tax_description'] = '<div class="ber-mb-3">
                                <div class="ber-d-grid ber-gap-2">
                                    <label class="ber-btn bertha_template" for="option14" data-id="website"><span class="bertha_template_icon">🏭</span>'.__('Full-on About Us Page', 'bertha-ai').'<span class="bertha_power">Premium</span><span class="bertha_template_desc">'.__('Bertha already knows you. She will write an overview, history, mission and vision for your company.', 'bertha-ai').'</span></label>
                                </div>
                            </div>';
                    if(isset($free_templates->company_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <div class="ber-mb-3">
                                    <label for="brand" class="ber-form-label">'.__('Brand Name', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control company_brand" id="brand" value="'.esc_attr( $options['brand_name'] ).'">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="bertha_desc" class="ber-form-label">'.__('Company Details or add your own text if you wish', 'bertha-ai').'</label>
                                    <textarea class="ber-form-control company_bio_desc" maxlength="800" id="bertha_desc" rows="3" placeholder="'.__('Company Description', 'bertha-ai').'">'.esc_attr( $options['customer_details'] ).'</textarea>
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea bertha-desc-notice" id="wa-generate-idea" data-id="Company" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/zWX67ClHQhQ"></iframe></div>
                                </div>
                            </form>';
                    }else {
                        $result['html'] = $upgrade_message;
                    }
                    break;
                case "Company-mission":
                    $term = get_term_by('slug', 'Company-mission', 'idea_template');
                    $result['tax_name'] = __('🚀 Company Mission & Vision', 'bertha-ai');
                    $result['tax_description'] = '<div class="ber-mb-3">
                                <div class="ber-d-grid ber-gap-2">
                                    <label class="ber-btn bertha_template" for="option23" data-id="website"><span class="bertha_template_icon">🚀</span>'.__('Company Mission & Vision', 'bertha-ai').'<span class="bertha_power">'.__('Premium', 'bertha-ai').'</span><span class="bertha_template_desc">'.__('From your company description, Bertha will write inspiring Mission and Vision statements for your "About Us" page.', 'bertha-ai').'</span></label>
                                </div>
                            </div>';
                    if(isset($free_templates->company_mission_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <div class="ber-mb-3">
                                    <label for="brand" class="ber-form-label">Brand Name</label>
                                    <input type="text" class="ber-form-control company_mission_brand" id="brand" value="'.esc_attr( $options['brand_name'] ).'">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="bertha_desc" class="ber-form-label">'.__('Company Details', 'bertha-ai').'</label>
                                    <textarea class="ber-form-control company_mission_desc" maxlength="800" id="bertha_desc" rows="3" placeholder="'.__('Company Description', 'bertha-ai').'">'.esc_attr( $options['customer_details'] ).'</textarea>
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea bertha-desc-notice" id="wa-generate-idea" data-id="Company-mission" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>  
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/J6iNkPeVAT0"></iframe></div>
                                </div>
                            </form>';
                    }else {
                        $result['html'] = $upgrade_message;
                    }
                    break;
                case "Testimonial":
                    $term = get_term_by('slug', 'idea-testimonial', 'idea_template');
                    $result['tax_name'] = __('🥂 Testimonial Generator', 'bertha-ai');
                    $result['tax_description'] = __('Chasing clients to write testimonials is a pain. Generate them for them and ask their approval to use them.', 'bertha-ai');
                    if(isset($free_templates->testimonial_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <div class="ber-mb-3">
                                    <label for="bertha_desc" class="ber-form-label">'.__('Company Description', 'bertha-ai').'</label>
                                    <textarea class="ber-form-control testimonial_desc" maxlength="800" id="bertha_desc" rows="3" placeholder="'.__('Company Description', 'bertha-ai').'">'.esc_attr( $options['customer_details'] ).'</textarea>
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea bertha-desc-notice" id="wa-generate-idea" data-id="Testimonial" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/tgbNymZ7vqY"></iframe></div>
                                </div>
                            </form>';
                    }else {
                        $result['html'] = $upgrade_message;
                    }
                    break;
                case "Benefit-List":
                    $term = get_term_by('slug', 'idea-benefit', 'idea_template');
                    $result['tax_name'] = __('🥰 Service/Product Benefit List', 'bertha-ai');
                    $result['tax_description'] = '<div class="ber-mb-3">
                                <div class="ber-d-grid ber-gap-2">
                                    <label class="ber-btn bertha_template" for="option12" data-id="website"><span class="bertha_template_icon">🥰</span>'.__('Service/Product Benefit List', 'bertha-ai').'<span class="bertha_template_desc">'.__('Instantly generate a list of differentiators and benefits for your own company and brand.', 'bertha-ai').'</span></label>
                                </div>
                            </div>';
                    if(isset($free_templates->benefit_list_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <div class="ber-mb-3">
                                    <label for="bertha_desc" class="ber-form-label">'.__('Company Description or use your own words to get the best out of this model', 'bertha-ai').'</label>
                                    <textarea class="ber-form-control benefit_desc" maxlength="800" id="bertha_desc" rows="3" placeholder="'.__('Company Description', 'bertha-ai').'">'.esc_attr( $options['customer_details'] ).'</textarea>
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea bertha-desc-notice" id="wa-generate-idea" data-id="Benefit-List" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/Onz1IGBLBIw"></iframe></div>
                                </div>
                            </form>';
                    }else {
                        $result['html'] = $upgrade_message;
                    }
                    break;
                case "Content-Improver":
                    $term = get_term_by('slug', 'content-improver', 'idea_template');
                    $result['tax_name'] = __('🎢 Content Rephraser', 'bertha-ai');
                    $result['tax_description'] = '<div class="ber-mb-3">
                                <div class="ber-d-grid ber-gap-2">
                                    <label class="ber-btn bertha_template" for="option7" data-id="website"><span class="bertha_template_icon">🎢</span>'.__('Content Rephraser', 'bertha-ai').'<span class="bertha_template_desc">'.__('Not confident with what you wrote? Paste it in and let Bertha\'s magic make it all better.', 'bertha-ai').'</span></label>
                                </div>
                            </div>';
                    if(isset($free_templates->content_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <div class="ber-mb-3">
                                    <label for="sentiment" class="ber-form-label">'.__('Tone of voice. E.G. Professional or Witty', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control content_improver_sentiment" maxlength="100" id="sentiment" value="'.esc_attr( $options['sentiment'] ).'">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="bertha_desc" class="ber-form-label">'.__('Text Origin', 'bertha-ai').'</label>
                                    <textarea class="ber-form-control content_improver_desc" maxlength="800" id="bertha_desc" rows="3" placeholder="'.__('Paste or type some text you would like to improve upon', 'bertha-ai').'"></textarea>
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea bertha-desc-notice" id="wa-generate-idea" data-id="Content-Improver" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/sy5EgKUK4KY"></iframe></div>
                                </div>
                            </form>';
                    }else {
                        $result['html'] = $upgrade_message;
                    }
                    break;
                case "Benefit-Title":
                    $term = get_term_by('slug', 'benefit-title', 'idea_template');
                    $result['tax_name'] = __('🦚 Title to Benefit Sections', 'bertha-ai');
                    $result['tax_description'] = '<div class="ber-mb-3">
                                <div class="ber-d-grid ber-gap-2">
                                    <label class="ber-btn bertha_template" for="option5" data-id="website"><span class="bertha_template_icon">🦚</span>'.__('Title to Benefit Sections', 'bertha-ai').'<span class="bertha_template_desc">'.__('Take a benefit of your product/service and expand it to provide additional engaging details.', 'bertha-ai').'</span></label>
                                </div>
                            </div>';
                    if(isset($free_templates->benefit_title_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <div class="ber-mb-3">
                                    <label for="title" class="ber-form-label">'.__('Title of benefit', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control Benefit_title" maxlength="100" id="title" placeholder="'.__('Add a benefit or your product or service', 'bertha-ai').'">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="bertha_desc" class="ber-form-label">'.__('Description in your own words', 'bertha-ai').'</label>
                                    <textarea class="ber-form-control Benefit_title_desc" maxlength="800" id="bertha_desc" rows="3" placeholder="'.__('Company Description', 'bertha-ai').'">'.esc_attr( $options['customer_details'] ).'</textarea>
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea bertha-desc-notice" id="wa-generate-idea" data-id="Benefit-Title" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/Uk9SgrvE4d0"></iframe></div>
                                </div>
                            </form>';
                    }else {
                        $result['html'] = $upgrade_message;
                    }
                    break;
                case "bullet-points":
                    $term = get_term_by('slug', 'bullet-points', 'idea_template');
                    $result['tax_name'] = __('✔ Persuasive Bullet Points', 'bertha-ai');
                    $result['tax_description'] = '<div class="ber-mb-3">
                                <div class="ber-d-grid ber-gap-2">
                                    <label class="ber-btn bertha_template" for="option15" data-id="marketing"><span class="bertha_template_icon">✔</span>'.__('Persuasive Bullet Points', 'bertha-ai').'<span class="bertha_template_desc">'.__('Convince readers that your product is the best by listing all the reasons they should take action NOW.', 'bertha-ai').'</span></label>
                                </div>
                            </div>';
                    if(isset($free_templates->bullet_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <div class="ber-mb-3">
                                    <label for="bullet_desc" class="ber-form-label">'.__('Company Description', 'bertha-ai').'</label>
                                    <textarea class="ber-form-control bullet_desc" maxlength="800" id="bullet_desc" rows="3" placeholder="'.__('Company Description', 'bertha-ai').'">'.esc_attr( $options['customer_details'] ).'</textarea>
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea bertha-desc-notice" id="wa-generate-idea" data-id="bullet-points" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/BqTgBP-fl0s"></iframe></div>
                                </div>
                            </form>';
                    }else {
                        $result['html'] = $upgrade_message;
                    }
                    break;
                case "personal-bio":
                    $term = get_term_by('slug', 'personal-bio', 'idea_template');
                    $result['tax_name'] = __('😎 Personal Bio (About Me)', 'bertha-ai');
                    $result['tax_description'] = '<div class="ber-mb-3">
                                <div class="ber-d-grid ber-gap-2">
                                    <label class="ber-btn bertha_template" for="option16" data-id="website"><span class="bertha_template_icon">😎</span>'.__('Personal Bio (About Me)', 'bertha-ai').'<span class="bertha_template_desc">'.__('Writing about ourselves is hard. It\'s not for Bertha - Let her do it for you and only fix what\'s needed.', 'bertha-ai').'</span></label>
                                </div>
                            </div>';
                    if(isset($free_templates->personal_bio_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <div class="ber-mb-3">
                                    <label for="info" class="ber-form-label">'.__('Personal Information', 'bertha-ai').'</label>
                                    <textarea class="ber-form-control personal_bio_desc" maxlength="800" id="info" rows="1" placeholder="'.__('Personal Information', 'bertha-ai').'"></textarea>
                                </div>
                                <div class="ber-mb-3">
                                    <label for="sentiment" class="ber-form-label">'.__('Sentiment', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control personal_bio_sentiment" maxlength="100" id="sentiment" value="'.esc_attr( $options['sentiment'] ).'">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="point" class="ber-form-label">'.__('Point of view', 'bertha-ai').'</label>
                                    <select class="ber-form-control personal_bio_point" id="point">
                                        <option>'.__('First Person', 'bertha-ai').'</option>
                                        <option>'.__('Third Person', 'bertha-ai').'</option>
                                    </select>
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea bertha-desc-notice" id="wa-generate-idea" data-id="personal-bio" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/KJ5_Z8f_Mkk"></iframe></div>
                                </div>
                            </form>';
                    }else {
                        $result['html'] = $upgrade_message;
                    }
                    break;
                case "blog-post-idea":
                    $term = get_term_by('slug', 'blog-post-idea', 'idea_template');
                    $result['tax_name'] = __('💡 Blog Post Topic Ideas', 'bertha-ai');
                    $result['tax_description'] = '<div class="ber-mb-3">
                                <div class="ber-d-grid ber-gap-2">
                                    <label class="ber-btn bertha_template" for="option17" data-id="blog"><span class="bertha_template_icon">💡</span>'.__('Blog Post Topic Ideas', 'bertha-ai').'<span class="bertha_power">'.__('Premium', 'bertha-ai').'</span><span class="bertha_template_desc">'.__('Trained with data from hundreds of thousands of blog posts, Bertha uses this data to generate a variety of creative blog post ideas.', 'bertha-ai').'</span></label>
                                </div>
                            </div>';
                    if(isset($free_templates->topic_ideas_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <input type="hidden" class="ber-form-control blog_idea_sentiment" id="sentiment" value="'.esc_attr( $options['sentiment'] ).'">
                                <input type="hidden" class="ber-form-control blog_idea_cust" id="bertha_desc" rows="3" value="'.esc_attr( $options['ideal_customer'] ).'">
                                <div class="ber-mb-3">
                                    <label for="bullet_desc" class="ber-form-label">'.__('Company Description', 'bertha-ai').'</label>
                                    <textarea class="ber-form-control blog_idea_desc" maxlength="800" id="bullet_desc" rows="3" placeholder="'.__('Company Description', 'bertha-ai').'">'.esc_attr( $options['customer_details'] ).'</textarea>
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea bertha-desc-notice" id="wa-generate-idea" data-id="blog-post-idea" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/3SBsBh3uDY0"></iframe></div>
                                </div>
                            </form>';
                    }else {
                        $result['html'] = $upgrade_message;
                    }
                    break;
                case "blog-post-intro-paragraph":
                    $term = get_term_by('slug', 'intro-para-idea', 'idea_template');
                    $result['tax_name'] = __('🦅 Blog Post Intro Paragraph', 'bertha-ai');
                    $result['tax_description'] = '<div class="ber-mb-3">
                                <div class="ber-d-grid ber-gap-2">
                                    <label class="ber-btn bertha_template" for="option18" data-id="blog"><span class="bertha_template_icon">🦅</span>'.__('Blog Post Intro Paragraph', 'bertha-ai').'<span class="bertha_template_desc">'.__('Not sure how to start writing your next winning blog post? Bertha will get the ball rolling on taking your blog post topic and generate an intriguing intro paragraph.', 'bertha-ai').'</span></label>
                                </div>
                            </div>';
                    if(isset($free_templates->intro_para_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <div class="ber-mb-3">
                                    <label for="sentiment" class="ber-form-label">'.__('Sentiment', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control intro_sentiment" maxlength="100" id="sentiment" value="'.esc_attr( $options['sentiment'] ).'">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="ideal_customer" class="ber-form-label">'.__('Ideal Customer', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control intro_ideal_cust" maxlength="100" id="ideal_customer" value="'.esc_attr( $options['ideal_customer'] ).'">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="title" class="ber-form-label">'.__('The Title of the Article', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control intro_title" maxlength="100" id="title" placeholder="'.__('Add the subject of the title of the blog post', 'bertha-ai').'">
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea" id="wa-generate-idea" data-id="blog-post-intro-paragraph" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/QL0sSIoSLgM"></iframe></div>
                                </div>
                            </form>';
                    }else {
                        $result['html'] = $upgrade_message;
                    }
                    break;
                case "blog-post-outline":
                    $term = get_term_by('slug', 'post-outline-idea', 'idea_template');
                    $result['tax_name'] = __('🧐 Blog Post Outline', 'bertha-ai');
                    $result['tax_description'] = '<div class="ber-mb-3">
                                <div class="ber-d-grid ber-gap-2">
                                    <label class="ber-btn bertha_template" for="option19" data-id="blog"><span class="bertha_template_icon">🧐</span>'.__('Blog Post Outline', 'bertha-ai').'<span class="bertha_template_desc">'.__('Map out your blog post\'s outline simply by adding the title or topic of the blog post you want to create. Bertha will take care of the rest.', 'bertha-ai').'</span></label>
                                </div>
                            </div>';
                    if(isset($free_templates->post_outline_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <input type="hidden" class="ber-form-control post_outline_sentiment" id="sentiment" value="'.esc_attr( $options['sentiment'] ).'">
                                <div class="ber-mb-3">
                                    <label for="title" class="ber-form-label">'.__('The Title of the Article', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control post_outline_title" maxlength="100" id="title" placeholder="'.__('Add the subject of the title of the blog post', 'bertha-ai').'">
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea" id="wa-generate-idea" data-id="blog-post-outline" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/PGciuse1QXQ"></iframe></div>
                                </div>
                            </form>';
                    }else {
                        $result['html'] = $upgrade_message;
                    }
                    break;
                case "blog-post-conclusion":
                    $term = get_term_by('slug', 'conclusion-para-idea', 'idea_template');
                    $result['tax_name'] = __('🦸‍♀️ Blog Post Conclusion Paragraph', 'bertha-ai');
                    $result['tax_description'] = '<div class="ber-mb-3">
                                <div class="ber-d-grid ber-gap-2">
                                    <label class="ber-btn bertha_template" for="option20" data-id="blog"><span class="bertha_template_icon">🦸‍♀️</span>'.__('Blog Post Conclusion Paragraph', 'bertha-ai').'<span class="bertha_template_desc">'.__('Bertha can write a blog post conclusion paragraph that will help your visitors stick around to read the rest of your content.', 'bertha-ai').'</span></label>
                                </div>
                            </div>';
                    if(isset($free_templates->conclusion_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <input type="hidden" class="ber-form-control conclusion_sentiment" id="sentiment" value="'.esc_attr( $options['sentiment'] ).'">
                                <div class="ber-mb-3">
                                    <label for="title" class="ber-form-label">'.__('The Title of the Article', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control conclusion_title" maxlength="100" id="title" placeholder="'.__('Add the subject of the title of the blog post', 'bertha-ai').'">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="cta" class="ber-form-label">'.__('Call to Action', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control conslusion_cta" maxlength="100" id="cta" placeholder="'.__('The action you would like the reader to take', 'bertha-ai').'">
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea" id="wa-generate-idea" data-id="blog-post-conclusion" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/wQ0iUu4s71g"></iframe></div>
                                </div>
                            </form>';
                    }else {
                        $result['html'] = $upgrade_message;
                    }
                    break;
                case "blog-action":
                    $term = get_term_by('slug', 'blog-action-idea', 'idea_template');
                    $result['tax_name'] = __('🎯 Button Call to Action', 'bertha-ai');
                    $result['tax_description'] = '<div class="ber-mb-3">
                                <div class="ber-d-grid ber-gap-2">
                                    <label class="ber-btn bertha_template" for="option21" data-id="website"><span class="bertha_template_icon">🎯</span>'.__('Button Call to Action', 'bertha-ai').'<span class="bertha_template_desc">'.__('With Bertha, you can generate a call to action button that\'s guaranteed to convert. No more guessing what words will convert best!', 'bertha-ai').'</span></label>
                                </div>
                            </div>';
                    if(isset($free_templates->action_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <div class="ber-mb-3">
                                    <label for="bullet_desc" class="ber-form-label">'.__('Description in your own words', 'bertha-ai').'</label>
                                    <textarea class="ber-form-control blog_action_desc" maxlength="800" id="bullet_desc" rows="3" placeholder="'.__('Company Description', 'bertha-ai').'">'.esc_attr( $options['customer_details'] ).'</textarea>
                                </div>
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('Let your users know  what to do when the button is clicked', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control blog_action" maxlength="100" id="action" placeholder="'.__('E.G Click here to find out more', 'bertha-ai').'">
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea bertha-desc-notice" id="wa-generate-idea" data-id="blog-action" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/uqxQ7tBk2oc"></iframe></div>
                                </div>
                            </form>';
                    }else {
                        $result['html'] = $upgrade_message;
                    }
                    break;
                case "child-explain":
                    $term = get_term_by('slug', 'child-input', 'idea_template');
                    $result['tax_name'] = __('👶 Explain It To a Child', 'bertha-ai');
                    $result['tax_description'] = '<div class="ber-mb-3">
                                <div class="ber-d-grid ber-gap-2">
                                    <label class="ber-btn bertha_template" for="option22" data-id="useful_extra"><span class="bertha_template_icon">👶</span>'.__('Explain It To a Child', 'bertha-ai').'<span class="bertha_template_desc">'.__('Taking complex concepts and simplifying them. So that everyone can get it. Get it?', 'bertha-ai').'</span></label>
                                </div>
                                </div>';
                    if(isset($free_templates->child_input_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <div class="ber-mb-3">
                                    <label for="input" class="ber-form-label">'.__('Input Text', 'bertha-ai').'</label>
                                    <textarea class="ber-form-control child_input" id="input" maxlength="800" rows="3" placeholder="'.__('Input Text', 'bertha-ai').'"></textarea>
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea bertha-desc-notice" id="wa-generate-idea" data-id="child-explain" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/rX1gT9_YwmM"></iframe></div>
                                </div>
                            </form>';
                    }else {
                        $result['html'] = $upgrade_message;
                    }
                    break;
                case "seo-title":
                    $term = get_term_by('slug', 'bertha-seo-title', 'idea_template');
                    $result['tax_name'] = __('⛩️ SEO Title Tag', 'bertha-ai');
                    $result['tax_description'] = '<div class="ber-mb-3">
                                <div class="ber-d-grid ber-gap-2">
                                    <label class="ber-btn bertha_template" for="option23" data-id="seo"><span class="bertha_template_icon">⛩️</span>'.__('SEO Title Tag', 'bertha-ai').'<span class="bertha_template_desc">'.__('Get highly optimized title tags that will help you rank higher in search engines.', 'bertha-ai').'</span></label>
                                </div>
                                </div>';
                    if(isset($free_templates->seo_title_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('Brand', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control seo_title_brand" maxlength="100" id="action" placeholder="">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('The Title in Your Own Words', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control seo_title" maxlength="100" id="action" placeholder="">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('Keyword', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control seo_keyword" maxlength="100" id="action" placeholder="">
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea" id="wa-generate-idea" data-id="seo-title" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/pz-0752mxrQ"></iframe></div>
                                </div>
                            </form>';
                    }else {
                        $result['html'] = $upgrade_message;
                    }
                    break;
                case "seo-description":
                    $term = get_term_by('slug', 'bertha-seo-description', 'idea_template');
                    $result['tax_name'] = __('✒️ SEO Description Tag', 'bertha-ai');
                    $result['tax_description'] = '<div class="ber-mb-3">
                                <div class="ber-d-grid ber-gap-2">
                                    <label class="ber-btn bertha_template" for="option24" data-id="seo"><span class="bertha_template_icon">✒️</span>'.__('SEO Description Tag', 'bertha-ai').'<span class="bertha_template_desc">'.__('You are serious about SEO, But this is a tedious task that can easily be automated with Bertha.', 'bertha-ai').'</span></label>
                                </div>
                                </div>';
                    if(isset($free_templates->seo_description_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('The Title in Your Own Words', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control seo_desc_title" maxlength="100" id="action" placeholder="">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('Keyword', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control seo_desc_keyword" maxlength="100" id="action" placeholder="">
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea" id="wa-generate-idea" data-id="seo-description" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/yk44WBgUUMQ"></iframe></div>
                                </div>
                            </form>';
                    }else {
                        $result['html'] = $upgrade_message;
                    }
                    break;
                case "aida-marketing":
                    $term = get_term_by('slug', 'bertha-aida-marketing', 'idea_template');
                    $result['tax_name'] = __('✒️ AIDA Marketing Framework', 'bertha-ai');
                    $result['tax_description'] = '<div class="ber-mb-3">
                                <div class="ber-d-grid ber-gap-2">
                                    <label class="ber-btn bertha_template" for="option25" data-id="marketing"><span class="bertha_template_icon">🍬</span>'.__('AIDA Marketing Framework', 'bertha-ai').'<span class="bertha_template_desc">'.__('Awareness > Interest > Desire > Action - Structure your writing and create more compelling content.', 'bertha-ai').'</span></label>
                                </div>
                            </div>';
                    if(isset($free_templates->aida_marketing_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('Brand Name', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control aida_brand" maxlength="100" id="action" value="'.esc_attr( $options['brand_name'] ).'">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="bullet_desc" class="ber-form-label">'.__('Product Description', 'bertha-ai').'</label>
                                    <textarea class="ber-form-control aida_desc" maxlength="800" id="bullet_desc" rows="3">'.esc_attr( $options['customer_details'] ).'</textarea>
                                </div>
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('Ideal Customer', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control aida_cust" maxlength="100" id="action" value="'.esc_attr( $options['ideal_customer'] ).'">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('Tone of voice', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control aida_Sentiment" maxlength="100" id="action" value="'.esc_attr( $options['sentiment'] ).'">
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea bertha-desc-notice" id="wa-generate-idea" data-id="aida-marketing" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/zQCwEVSXuJQ"></iframe></div>
                                </div>
                            </form>';
                    }else {
                        $result['html'] = $upgrade_message;
                    }
                    break;
                case "seo-city":
                    $term = get_term_by('slug', 'bertha-seo-city', 'idea_template');
                    $result['tax_name'] = __('✒️ SEO City Based Pages', 'bertha-ai');
                    $result['tax_description'] = '<div class="ber-mb-3">
                                <div class="ber-d-grid ber-gap-2">
                                    <label class="ber-btn bertha_template" for="option26" data-id="seo"><span class="bertha_template_icon">🏙</span>'.__('SEO City Based Pages', 'bertha-ai').'<span class="bertha_template_desc">'.__('Generate city page titles and descriptions for your city or town pages to help rank your website locally.', 'bertha-ai').'</span></label>
                                </div>
                                </div>';
                    if(isset($free_templates->seo_city_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('Brand Name', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control seo_city_brand" maxlength="100" id="action" value="'.esc_attr( $options['brand_name'] ).'">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('City', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control seo_city" maxlength="100" id="action" placeholder="">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="bullet_desc" class="ber-form-label">'.__('Service Description', 'bertha-ai').'</label>
                                    <textarea class="ber-form-control seo_city_desc" maxlength="800" id="bullet_desc" rows="3">'.esc_attr( $options['customer_details'] ).'</textarea>
                                </div>
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('Call To Action', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control seo_city_cta" maxlength="100" id="action" placeholder="">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('Keyword', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control seo_city_keyword" maxlength="100" id="action" placeholder="">
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea bertha-desc-notice" id="wa-generate-idea" data-id="seo-city" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/M6cBC6PkiyQ"></iframe></div>
                                </div>
                            </form>';
                    }else {
                        $result['html'] = $upgrade_message;
                    }
                    break;
                case "buisiness-name":
                    $term = get_term_by('slug', 'bertha-buisiness-name', 'idea_template');
                    $result['tax_name'] = __('✒️ Business or Product Name', 'bertha-ai');
                    $result['tax_description'] = '<div class="ber-mb-3">
                                <div class="ber-d-grid ber-gap-2">
                                    <label class="ber-btn bertha_template" for="option27" data-id="useful_extra"><span class="bertha_template_icon">⚓</span>'.__('Business or Product Name', 'bertha-ai').'<span class="bertha_template_desc">'.__('Create a new business or product name from scratch based on a keyword or phrase.', 'bertha-ai').'</span></label>
                                </div>
                             </div>';
                    if(isset($free_templates->buisiness_name_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <div class="ber-mb-3">
                                    <label for="bullet_desc" class="ber-form-label">'.__('Company Description', 'bertha-ai').'</label>
                                    <textarea class="ber-form-control buisiness_name_desc" maxlength="800" id="bullet_desc" rows="3">'.esc_attr( $options['customer_details'] ).'</textarea>
                                </div>
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('Tone of Voice - or we change everything to Vibe', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control buisiness_name_vibe" maxlength="100" id="action" value="'.esc_attr( $options['sentiment'] ).'">
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea bertha-desc-notice" id="wa-generate-idea" data-id="buisiness-name" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/1LI6zLrfGSY"></iframe></div>
                                </div>
                            </form>';
                    }else {
                        $result['html'] = $upgrade_message;
                    }
                    break;
                case "bridge":
                    $term = get_term_by('slug', 'bertha-bridge', 'idea_template');
                    $result['tax_name'] = __('✒️ Before, After and Bridge', 'bertha-ai');
                    $result['tax_description'] = '<div class="ber-mb-3">
                                <div class="ber-d-grid ber-gap-2">
                                    <label class="ber-btn bertha_template" for="option28" data-id="marketing"><span class="bertha_template_icon">🌉</span>'.__('Before, After and Bridge', 'bertha-ai').'<span class="bertha_template_desc">'.__('Get a short description to build a page with a before and after look, with a transition in between.', 'bertha-ai').'</span></label>
                                </div>
                            </div>';
                    if(isset($free_templates->bridge_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('Brand Name', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control bridge_brand" maxlength="100" id="action" value="'.esc_attr( $options['brand_name'] ).'">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="bullet_desc" class="ber-form-label">'.__('Product Description', 'bertha-ai').'</label>
                                    <textarea class="ber-form-control bridge_desc" maxlength="800" id="bullet_desc" rows="3">'.esc_attr( $options['customer_details'] ).'</textarea>
                                </div>
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('Ideal Customer', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control bridge_cust" maxlength="100" id="action" value="'.esc_attr( $options['ideal_customer'] ).'">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('Tone of voice', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control bridge_Sentiment" maxlength="100" id="action" value="'.esc_attr( $options['sentiment'] ).'">
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea bertha-desc-notice" id="wa-generate-idea" data-id="bridge" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/NT5OeIf3xkY"></iframe></div>
                                </div>
                            </form>';
                    }else {
                        $result['html'] = $upgrade_message;
                    }
                    break;
                case "pas-framework":
                    $term = get_term_by('slug', 'bertha-pas-framework', 'idea_template');
                    $result['tax_name'] = __('✒️ PAS Framework', 'bertha-ai');
                    $result['tax_description'] = '<div class="ber-mb-3">
                                <div class="ber-d-grid ber-gap-2">
                                    <label class="ber-btn bertha_template" for="option29" data-id="marketing"><span class="bertha_template_icon">🚥</span>'.__('PAS Framework', 'bertha-ai').'<span class="bertha_template_desc">'.__('Problem > Agitate > Solution - A framework for planning and evaluating your content marketing activities.', 'bertha-ai').'</span></label>
                                </div>
                            </div>';
                    if(isset($free_templates->pas_framework_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('Brand Name', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control pas_brand" maxlength="100" id="action" value="'.esc_attr( $options['brand_name'] ).'">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="bullet_desc" class="ber-form-label">'.__('Product Description', 'bertha-ai').'</label>
                                    <textarea class="ber-form-control pas_desc" maxlength="800" id="bullet_desc" rows="3">'.esc_attr( $options['customer_details'] ).'</textarea>
                                </div>
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('Ideal Customer', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control pas_cust" maxlength="100" id="action" value="'.esc_attr( $options['ideal_customer'] ).'">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('Tone of voice', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control pas_Sentiment" maxlength="100" id="action" value="'.esc_attr( $options['sentiment'] ).'">
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea bertha-desc-notice" id="wa-generate-idea" data-id="pas-framework" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/M99rpDP-lBs"></iframe></div>
                                </div>
                            </form>';
                    }else {
                        $result['html'] = $upgrade_message;
                    }
                    break;
                case "faq-list":
                    $term = get_term_by('slug', 'bertha-faq-list', 'idea_template');
                    $result['tax_name'] = __('✒️ FAQs List', 'bertha-ai');
                    $result['tax_description'] = '<div class="ber-mb-3">
                                <div class="ber-d-grid ber-gap-2">
                                    <label class="ber-btn bertha_template" for="option30" data-id="website"><span class="bertha_template_icon">🙋‍♀️</span>'.__('FAQs List', 'bertha-ai').'<span class="bertha_template_desc">'.__('Generate a list of frequently asked questions for a service or product.', 'bertha-ai').'</span></label>
                                </div>
                            </div>';
                    if(isset($free_templates->faq_list_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <div class="ber-mb-3">
                                    <label for="bullet_desc" class="ber-form-label">'.__('Company/Service/Product Details', 'bertha-ai').'</label>
                                    <textarea class="ber-form-control faq_list_desc" maxlength="800" id="bullet_desc" rows="3">'.esc_attr( $options['customer_details'] ).'</textarea>
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea bertha-desc-notice" id="wa-generate-idea" data-id="faq-list" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/6EJwwiJYIi4"></iframe></div>
                                </div>
                            </form>';
                    }else {
                        $result['html'] = $upgrade_message;
                    }
                    break;
                case "faq-answer":
                    $term = get_term_by('slug', 'bertha-faq-answer', 'idea_template');
                    $result['tax_name'] = __('✒️ FAQ Answers', 'bertha-ai');
                    $result['tax_description'] = '<div class="ber-mb-3">
                                <div class="ber-d-grid ber-gap-2">
                                    <label class="ber-btn bertha_template" for="option31" data-id="website"><span class="bertha_template_icon">😑</span>'.__('FAQ Answers', 'bertha-ai').'<span class="bertha_template_desc">'.__('Get an anwser to a question.', 'bertha-ai').'</span></label>
                                </div>
                            </div>';
                    if(isset($free_templates->faq_answer_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('Question', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control faq_answer_question" maxlength="100" id="action" placeholder="">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="bullet_desc" class="ber-form-label">'.__('Company Description', 'bertha-ai').'</label>
                                    <textarea class="ber-form-control faq_answer_desc" maxlength="800" id="bullet_desc" rows="3">'.esc_attr( $options['customer_details'] ).'</textarea>
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea bertha-desc-notice" id="wa-generate-idea" data-id="faq-answer" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/hdKVKZegksk"></iframe></div>
                                </div>
                            </form>';
                    }else {
                        $result['html'] = $upgrade_message;
                    }
                    break;
                case "summaries":
                    $term = get_term_by('slug', 'bertha-summary', 'idea_template');
                    $result['tax_name'] = __('✒️ Summaries', 'bertha-ai');
                    $result['tax_description'] = '<div class="ber-mb-3">
                                <div class="ber-d-grid ber-gap-2">
                                    <label class="ber-btn bertha_template" for="option32" data-id="useful_extra"><span class="bertha_template_icon">🪐</span>'.__('Content Summary', 'bertha-ai').'<span class="bertha_template_desc">'.__('Create a summary of an article/website/blog post. Great for SEO and to share on social media.', 'bertha-ai').'</span></label>
                                </div>
                            </div>';
                    if(isset($free_templates->summary_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <div class="ber-mb-3">
                                    <label for="bullet_desc" class="ber-form-label">'.__('Content to summarise', 'bertha-ai').'</label>
                                    <textarea class="ber-form-control content_summary" maxlength="800" id="bullet_desc" rows="3"></textarea>
                                </div>
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('Tone of Voice', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control summary_sentiment" maxlength="100" id="action" value="'.esc_attr( $options['sentiment'] ).'">
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea bertha-desc-notice" id="wa-generate-idea" data-id="summaries" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/hcnHWwnWFCw"></iframe></div>
                                </div>
                            </form>';
                    }else {
                        $result['html'] = $upgrade_message;
                    }
                    break;
                case "contact-blurb":
                    $term = get_term_by('slug', 'bertha-contact-blurb', 'idea_template');
                    $result['tax_name'] = __('✒️ Contact Form Blurb', 'bertha-ai');
                    $result['tax_description'] = '<div class="ber-mb-3">
                                <div class="ber-d-grid ber-gap-2">
                                    <label class="ber-btn bertha_template" for="option33" data-id="website"><span class="bertha_template_icon">🤝</span>'.__('Contact Form Blurb', 'bertha-ai').'<span class="bertha_template_desc">'.__('Create a short description & Call to Action that will be used as the final persuasion text next to a contact form.', 'bertha-ai').'</span></label>
                                </div>
                            </div>';
                    if(isset($free_templates->contact_blurb_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('Brand Name', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control contact_blurb_brand" maxlength="100" id="action" value="'.esc_attr( $options['brand_name'] ).'">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="bullet_desc" class="ber-form-label">'.__('Company Description', 'bertha-ai').'</label>
                                    <textarea class="ber-form-control contact_blurb_desc" maxlength="800" id="bullet_desc" rows="3">'.esc_attr( $options['customer_details'] ).'</textarea>
                                </div>
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('Call To Action', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control contact_blurb_cta" maxlength="100" id="action" placehlder="">
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea bertha-desc-notice" id="wa-generate-idea" data-id="contact-blurb" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/Ggrmnq-NHI4"></iframe></div>
                                </div>
                            </form>';
                    }else {
                        $result['html'] = $upgrade_message;
                    }
                    break;
                case "seo-keyword":
                    $term = get_term_by('slug', 'bertha-seo-keyword', 'idea_template');
                    $result['tax_name'] = __('✒️ SEO Keyword Suggestions', 'bertha-ai');
                    $result['tax_description'] = '<div class="ber-mb-3">
                                <div class="ber-d-grid ber-gap-2">
                                    <label class="ber-btn bertha_template" for="option34" data-id="seo"><span class="bertha_template_icon">🔑</span>'.__('SEO Keyword Suggestions', 'bertha-ai').'<span class="bertha_template_desc">'.__('Generate suggestions of long-tail keywords that are related to your topic.', 'bertha-ai').'</span></label>
                                </div>
                                </div>';
                    if(isset($free_templates->seo_keyword_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <div class="ber-mb-3">
                                    <label for="bullet_desc" class="ber-form-label">'.__('Company/Service/Product Details', 'bertha-ai').'</label>
                                    <textarea class="ber-form-control seo_keyword_desc" maxlength="800" id="bullet_desc" rows="3">'.esc_attr( $options['customer_details'] ).'</textarea>
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea bertha-desc-notice" id="wa-generate-idea" data-id="seo-keyword" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/DvBj7wgRETY"></iframe></div>
                                </div>
                            </form>';
                    }else {
                        $result['html'] = $upgrade_message;
                    }
                    break;
                case "evil-bertha":
                    $term = get_term_by('slug', 'bertha-evil-bertha', 'idea_template');
                    $result['tax_name'] = __('✒️ SEO Keyword Suggestions', 'bertha-ai');
                    $result['tax_description'] = '<div class="ber-mb-3">
                                <div class="ber-d-grid ber-gap-2">
                                    <label class="ber-btn bertha_template ber_evil" for="option34" data-id="speciality"><span class="bertha_template_icon">😈</span>'.__('Evil Bertha', 'bertha-ai').'<span class="bertha_template_desc">'.__('Usually Bertha is nice and friendly, but not always...', 'bertha-ai').'</span></label>
                                </div>
                                </div>';
                    if(isset($free_templates->evil_bertha_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <div class="ber-mb-3">
                                    <label for="bullet_desc" class="ber-form-label">'.__('Bio', 'bertha-ai').'</label>
                                    <textarea class="ber-form-control evil_bertha_bio" maxlength="800" id="bullet_desc" rows="3">'.esc_attr( $options['customer_details'] ).'</textarea>
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea bertha-desc-notice" id="wa-generate-idea" data-id="evil-bertha" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/X2vm7oic5-E"></iframe></div>
                                </div>
                            </form>';
                    }else {
                        $result['html'] = $upgrade_message;
                    }
                    break;
                case "real-estate":
                    $term = get_term_by('slug', 'bertha-real-eastate', 'idea_template');
                    $result['tax_name'] = __('🏡 Real Estate Property Listing Description', 'bertha-ai');
                    $result['tax_description'] = '<div class="ber-mb-3">
                                <div class="ber-d-grid ber-gap-2">
                                    <label class="ber-btn bertha_template" for="option35" data-id="speciality"><span class="bertha_template_icon">🏡</span>'.__('Real Estate Property Listing Description', 'bertha-ai').'<span class="bertha_template_desc">'.__('Detailed and enticing property listings for your real estate websites. So you can focus on the sale.', 'bertha-ai').'</span></label>
                                </div>
                            </div>';
                    if(isset($free_templates->contact_blurb_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('Brand', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control real_estate_brand" maxlength="100" id="action" value="'.esc_attr( $options['brand_name'] ).'">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('Location', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control real_estate_location" maxlength="100" id="action" placeholder="Location" value="">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('Type', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control real_estate_type" maxlength="100" id="action" placehlder="Type">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="bullet_desc" class="ber-form-label">'.__('Property Description', 'bertha-ai').'</label>
                                    <textarea class="ber-form-control real_estate_desc" maxlength="800" id="bullet_desc" rows="3" placeholder="Property Description"></textarea>
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea bertha-desc-notice" id="wa-generate-idea" data-id="real-estate" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/wb6WXUcXQI4"></iframe></div>
                                </div>
                            </form>';
                    }else {
                        $result['html'] = $upgrade_message;
                    }
                    break;
                case "press-blurb":
                    $term = get_term_by('slug', 'bertha-press-blurb', 'idea_template');
                    $result['tax_name'] = __('📰 Press Mention Blurb', 'bertha-ai');
                    $result['tax_description'] = '<div class="ber-mb-3">
                                <div class="ber-d-grid ber-gap-2">
                                    <label class="ber-btn bertha_template" for="option36" data-id="speciality"><span class="bertha_template_icon">📰</span>'.__('Press Mention Blurb', 'bertha-ai').'<span class="bertha_template_desc">'.__('Provide the press mention title and publication to craft a press mention blurb.', 'bertha-ai').'</span></label>
                                </div>
                            </div>';
                    if(isset($free_templates->contact_blurb_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('Publication Name', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control press_blurb_pub_name" maxlength="100" id="action" placeholder="Publication Name" value="">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('What is the article about?', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control press_blurb_article_info" maxlength="100" id="action" placeholder="What is the article about?" value="">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="bullet_desc" class="ber-form-label">'.__('Company Description', 'bertha-ai').'</label>
                                    <textarea class="ber-form-control press_blurb_desc" maxlength="800" id="bullet_desc" rows="3">'.esc_attr( $options['customer_details'] ).'</textarea>
                                </div>
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('Keyword', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control press_blurb_keyword" maxlength="100" id="action" placehlder="Keyword">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('Brand Name', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control press_blurb_brand" maxlength="100" id="action" value="'.esc_attr( $options['brand_name'] ).'">
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea bertha-desc-notice" id="wa-generate-idea" data-id="press-blurb" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/9i8bfl-pPcc"></iframe></div>
                                </div>
                            </form>';
                    }else {
                        $result['html'] = $upgrade_message;
                    }
                    break;
                case "case-study":
                    $term = get_term_by('slug', 'bertha-case-study', 'idea_template');
                    $result['tax_name'] = __('👨‍🎓 Case Study Generator (STAR Method)', 'bertha-ai');
                    $result['tax_description'] = '<div class="ber-mb-3">
                                <div class="ber-d-grid ber-gap-2">
                                    <label class="ber-btn bertha_template" for="option37" data-id="speciality"><span class="bertha_template_icon">👨‍🎓</span>'.__('Case Study Generator (STAR Method)', 'bertha-ai').'<span class="bertha_template_desc">'.__('Generate a case study based on a client name and a problem they wanted to solve.', 'bertha-ai').'</span></label>
                                </div>
                            </div>';
                    if(isset($free_templates->contact_blurb_version) || $data->bertha_plugin_type == 'pro') {
                        $result['html'] = '<form  id="form2">
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('Subject', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control case_study_subject" maxlength="100" id="action" placeholder="Subject" value="">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('What happened', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control case_study_info" maxlength="100" id="action" placeholder="What is the article about?" value="">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('Brand Name', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control case_study_brand" maxlength="100" id="action" value="'.esc_attr( $options['brand_name'] ).'">
                                </div>
                                <div class="ber-mb-3">
                                    <label for="bullet_desc" class="ber-form-label">'.__('Company Description', 'bertha-ai').'</label>
                                    <textarea class="ber-form-control case_study_desc" maxlength="800" id="bullet_desc" rows="3">'.esc_attr( $options['customer_details'] ).'</textarea>
                                </div>
                                <div class="ber-mb-3">
                                    <label for="action" class="ber-form-label">'.__('Keyword', 'bertha-ai').'</label>
                                    <input type="text" class="ber-form-control case_study_keyword" maxlength="100" id="action" placehlder="Keyword">
                                </div>
                                <div class="ber-d-grid ber-gap-2">
                                    <button class="ber-btn ber-btn-primary wa-generate-idea bertha-desc-notice" id="wa-generate-idea" data-id="case-study" data-block="'.$data_block.'">'.__('Generate Ideas', 'bertha-ai').'</button>
                                    
                                </div>
                                <div class="ber-overlay"></div>
                                <div class="ber-mb-3 bertha-template-video-container">
                                    <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                                    <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/0VDd302YMlU"></iframe></div>
                                </div>
                            </form>';
                    }else {
                        $result['html'] = $upgrade_message;
                    }
                    break;
                default: 
                    $result['tax_name'] = '';
                    $result['tax_description'] = '';
                    $result['html'] = '<div class="ber_notice">'.__('You have selected wrong template.', 'bertha-ai').'</div>';
            }
        } else {
            $result['tax_name'] = '';
            $result['tax_description'] = '';
            $result['html'] = '<div class="ber_notice">'.__('Please activate your license.', 'bertha-ai').'<a href='.admin_url( 'admin.php?page=bertha-ai-license' ).'>'.__('Click Here', 'bertha-ai').'</a></div>';
        }
        print_r(json_encode($result));die;
    }

    function bthai_set_wizzard_data_callback() {

        if (!isset($_POST['bertha_set_wizzard_setup_nonce']) || !wp_verify_nonce($_POST['bertha_set_wizzard_setup_nonce'], 'bertha_set_wizzard_setup_form')) {
               die();
        }

        $setup_wizard = array();
        $setup_wizard['website_for'] = isset($_POST['website_for']) ? sanitize_text_field($_POST['website_for']) : "";
        $setup_wizard['about_client'] = isset($_POST['about_client']) ? sanitize_text_field($_POST['about_client']) : "";
        $setup_wizard['about_website'] = isset($_POST['about_website']) ? sanitize_text_field($_POST['about_website']) : "";
     
        update_option('bertha_setup_wizard_datas', $setup_wizard);
        die();
    }

    function bthai_set_wizzard_setting_data_callback() {

        if (!isset($_POST['bertha_wizzard_setup_nonce']) || !wp_verify_nonce($_POST['bertha_wizzard_setup_nonce'], 'bertha_wizzard_setup_form')) {
               die();
        }

        $setup_wizard = array();
        $setup_wizard['brand_name'] = isset($_POST['brand']) ? sanitize_text_field(str_replace("\'", "'", $_POST['brand'])) : "";
        $setup_wizard['customer_details'] = isset($_POST['description']) ? sanitize_textarea_field(str_replace("\'", "'", $_POST['description'])) : "";
        $setup_wizard['ideal_customer'] = isset($_POST['ideal_cust']) ? sanitize_text_field(str_replace("\'", "'", $_POST['ideal_cust'])) : "";
        $setup_wizard['sentiment'] = isset($_POST['sentiment']) ? sanitize_text_field(str_replace("\'", "'", $_POST['sentiment'])) : "";
     
        update_option('bertha_ai_options', $setup_wizard);
        die();
    }

    function bthai_history_filter_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_history_filter_nonce' );

        $wa_template = isset($_POST['wa_template']) ? sanitize_text_field($_POST['wa_template']) : "";
        $idea_template = '<form  id="form4">';
        $args = array( 
          'numberposts'     => -1,
          'post_type'       => 'idea',
          'orderby'         => 'date',
          'order'       => 'DESC',
        );
        if($wa_template != 'all') {
            $args['tax_query'] = array(
                                    array(
                                        'taxonomy' => 'idea_template',
                                        'field'    => 'slug',
                                        'terms'    => $wa_template,
                                    )
                                );
        }
        $bertha_ideas = get_posts($args);
        if($bertha_ideas) {
            foreach($bertha_ideas as $key => $idea) {
                if(get_post_meta($idea->ID, 'bertha_favourate_added', true)) {
                    $favourite =  __('Favourite added', 'bertha-ai');
                    $favourate_added = 'favourate_added';
                } else {
                    $favourite = __('Add to favourite', 'bertha-ai');
                    $favourate_added = '';
                }
                $tax = get_the_terms( $idea->ID, 'idea_template' );
                $key += 1;
                $idea_template .= '<div class="ber-mb-3">
                                        <div class="ber-d-grid ber-gap-2">
                                            <div class="ber-action-icon-wrap">
                                                <div class="bertha-copied-container ber-action-icon">
                                                    <button class="bertha_idea_copy" data-value="'.$idea->ID.'"><i class="ber-i-copy"></i></button>
                                                    <span class="bertha-copied-text" id="berthaCopied">'.__('Copy to clipboard', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-favourite-container ber-action-icon">
                                                    <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$idea->ID.'"><i class="ber-i-heart"></i></button>
                                                    <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                                </div>
                                                <div class="bertha-trash-container ber-action-icon">
                                                    <button class="bertha_idea_trash" data-value="'.$idea->ID.'"><i class="ber-i-trash"></i></button>
                                                    <span class="bertha-trash-text" id="berthaTrash">'.__('Delete', 'bertha-ai').'</span>
                                                </div>
                                                <div class="bertha-report-container ber-action-icon">
                                                    <button class="bertha_idea_report" data-value="'.$idea->ID.'"><i class="ber-i-flag-alt"></i></button>
                                                    <span class="bertha-report-text" id="berthaReport">'.__('Report', 'bertha-ai').'</span>
                                                </div>
                                            </div>
                                            <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key.'" autocomplete="off" data-block="">
                                            <label class="ber-btn bertha_idea" for="option'.$key.'"><span class="bertha_idea_number">'.$tax[0]->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '',$idea->post_content).'</pre></div></label>
                                        </div>
                                    </div>';
                }
                $idea_template .= '<div class="ber-overlay"></div>';
        } else {
            $idea_template .= '<div class="ber_notice">'.__('No results found.', 'bertha-ai').'</div>';
        }
        $idea_template .= '</form>';
        print_r($idea_template);
        die();
    }

    function bthai_wa_favourite_added_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_favourite_idea_nonce' );

        $favourite_array = array();
        $idea_id = isset($_POST['idea_id']) ? sanitize_text_field($_POST['idea_id']) : "";
        $request_type = isset($_POST['request_type']) ? sanitize_text_field($_POST['request_type']) : "";
        if($idea_id) {
            if($request_type == 'add-favourate') update_post_meta($idea_id, 'bertha_favourate_added', true);
            else delete_post_meta($idea_id, 'bertha_favourate_added', true);
            $favourite_array['response'] = 'success';
            $favourite_array['favourite_ideas'] = get_bertha_favourite_ideas();
        } else {
            $favourite_array['response'] = 'failed';
        }
        print_r(json_encode($favourite_array));die();
    }

    function bthai_wa_idea_trash_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_idea_trash_nonce' );

        $favourite_array = array();
        $idea_id = isset($_POST['idea_id']) ? sanitize_text_field($_POST['idea_id']) : "";
        if($idea_id) {
            wp_delete_post($idea_id);
            $favourite_array['response'] = 'success';
            $favourite_array['idea_history'] = get_bertha_history_ideas();
            $favourite_array['favourite_ideas'] = get_bertha_favourite_ideas();
        } else {
            $favourite_array['response'] = 'failed';
        }
        print_r(json_encode($favourite_array));die();
    }

    function bthai_wa_idea_report_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_idea_report_nonce' );

        global $current_user;
        $return = array();
        $idea_id = isset($_POST['idea_id']) ? sanitize_text_field($_POST['idea_id']) : "";
        $report_body = isset($_POST['report_body']) ? sanitize_text_field($_POST['report_body']) : "";

        $data = bertha_license_holder_details();
        if(empty( (array)$current_user->data )) {
            $user_email = $data['user_email'];
            $user_name = $data['user_name'];
        } else {
            $user_email = $current_user->user_email;
            $user_name = $current_user->display_name;
        }
        $account_email = $data['account_email'];

        if($idea_id) {
            $idea_post = get_post($idea_id);
            $idea_unique_id = get_post_meta($idea_id, 'wa_idea_unique_id', true) ? get_post_meta($idea_id, 'wa_idea_unique_id', true) : '';
            $term_obj_list = get_the_terms( $idea_id, 'idea_template' ); 
            $template_name = $term_obj_list[0]->name ? $term_obj_list[0]->name : '';
            $url = 'https://bertha.ai/wp-json/reports/submit';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'idea' => $idea_post->post_content, 'report_body' => $report_body, 'idea_unique_id' => $idea_unique_id, 'idea_name' => $template_name, 'home_url' => home_url(), 'user_name' => $user_name, 'user_email' => $user_email, 'license' => BTHAI_LICENSE_KEY, 'account_email' => $account_email ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args); 
            if (!is_wp_error($response) && isset($response['body'])) {
                $return['response'] = 'success';
            } else {
                $return['response'] = 'failed';
            }
        } else {
            $return['response'] = 'failed';
        }
        print_r(json_encode($return));die();
    }

    function bthai_wa_bertha_load_history_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_load_history_nonce' );

        $history_count = isset($_POST['history_count']) ? sanitize_text_field( $_POST['history_count'] ) : 0;
        $history_count += 10;

        $args = array( 
      'numberposts'     => $history_count,
      'post_type'       => 'idea',
      'orderby'         => 'date',
      'order'       => 'DESC',
    );
    $bertha_ideas = get_posts($args);
    $idea_template =  array();
    $hjhgh = '';
    if($bertha_ideas) {
        foreach($bertha_ideas as $key => $idea) {
            if(get_post_meta($idea->ID, 'bertha_favourate_added', true)) {
                $favourite =  'Favourite added';
                $favourate_added = 'favourate_added';
            } else {
                $favourite = 'Add to favourite';
                $favourate_added = '';
            }
            $tax = get_the_terms( $idea->ID, 'idea_template' );
            $key += 1;
            $hjhgh .= '<div class="ber-mb-3 bertha-content-element">
                                    <div class="ber-d-grid ber-gap-2">
                                        <div class="ber-action-icon-wrap">
                                            <div class="bertha-copied-container ber-action-icon">
                                                <button class="bertha_idea_copy" data-value="'.$idea->ID.'"><i class="ber-i-copy"></i></button>
                                                <span class="bertha-copied-text" id="berthaCopied">Copy to clipboard</span>
                                            </div>
                                            <div class="bertha-favourite-container ber-action-icon">
                                                <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$idea->ID.'"><i class="ber-i-heart"></i></button>
                                                <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                            </div>
                                            <div class="bertha-trash-container ber-action-icon">
                                                <button class="bertha_idea_trash" data-value="'.$idea->ID.'"><i class="ber-i-trash"></i></button>
                                                <span class="bertha-trash-text" id="berthaTrash">Delete</span>
                                            </div>
                                            <div class="bertha-report-container ber-action-icon">
                                                <button class="bertha_idea_report" data-value="'.$idea->ID.'"><i class="ber-i-flag-alt"></i></button>
                                                <span class="bertha-report-text" id="berthaReport">Report</span>
                                            </div>
                                        </div>
                                        <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key.'" autocomplete="off" data-block="">
                                        <label class="bertha-btn bertha_idea" for="option'.$key.'"><span class="bertha_idea_number">'.$tax[0]->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '', wp_strip_all_tags($idea->post_content)).'</pre></div></label>
                                    </div>
                                </div>';
        }
        $hjhgh .= '<div class="ber-overlay"></div>';
        $idea_template['response'] = 'success';
    } else {
        $idea_template['response'] = 'failed';
    }
    $idea_template['ideas'] = $hjhgh;
    print_r(json_encode($idea_template));die();
    }

    function bthai_wa_bertha_load_favourite_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_load_favourite_nonce' );

        $favourite_count = isset($_POST['favourite_count']) ? sanitize_text_field( $_POST['favourite_count'] ) : 0;
        $favourite_count += 10;

        $args = array( 
      'numberposts'     => $favourite_count,
      'post_type'       => 'idea',
      'orderby'         => 'date',
      'order'       => 'DESC',
      'meta_query'        => array(
            array(
                'key'       => 'bertha_favourate_added',
                'value'     => 1
            )
        ),
    );
    $bertha_ideas = get_posts($args);
    $idea_template =  array();
    $hjhgh = '';
    if($bertha_ideas) {
        foreach($bertha_ideas as $key => $idea) {
            if(get_post_meta($idea->ID, 'bertha_favourate_added', true)) {
                $favourite =  'Favourite added';
                $favourate_added = 'favourate_added';
            } else {
                $favourite = 'Add to favourite';
                $favourate_added = '';
            }
            $tax = get_the_terms( $idea->ID, 'idea_template' );
            $key += 1;
            $hjhgh .= '<div class="ber-mb-3">
                                    <div class="ber-d-grid ber-gap-2 bertha-content-element">
                                        <div class="ber-action-icon-wrap">
                                            <div class="bertha-copied-container ber-action-icon">
                                                <button class="bertha_idea_copy" data-value="'.$idea->ID.'"><i class="ber-i-copy"></i></button>
                                                <span class="bertha-copied-text" id="berthaCopied">Copy to clipboard</span>
                                            </div>
                                            <div class="bertha-favourite-container ber-action-icon">
                                                <button class="bertha_idea_favourite '.$favourate_added.'" data-value="'.$idea->ID.'"><i class="ber-i-heart"></i></button>
                                                <span class="bertha-favourite-text" id="berthaFavourite">'.$favourite.'</span>
                                            </div>
                                            <div class="bertha-trash-container ber-action-icon">
                                                <button class="bertha_idea_trash" data-value="'.$idea->ID.'"><i class="ber-i-trash"></i></button>
                                                <span class="bertha-trash-text" id="berthaTrash">Delete</span>
                                            </div>
                                            <div class="bertha-report-container ber-action-icon">
                                                <button class="bertha_idea_report" data-value="'.$idea->ID.'"><i class="ber-i-flag-alt"></i></button>
                                                <span class="bertha-report-text" id="berthaReport">Report</span>
                                            </div>
                                        </div>
                                        <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key.'" autocomplete="off" data-block="">
                                        <label class="ber-btn bertha_idea" for="option'.$key.'"><span class="bertha_idea_number">'.$tax[0]->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '', wp_strip_all_tags($idea->post_content)).'</pre></div></label>
                                    </div>
                                </div>';
        }
        $hjhgh .= '<div class="ber-overlay"></div>';
        $idea_template['response'] = 'success';
    } else {
        $idea_template['response'] = 'failed';
    }
    $idea_template['ideas'] = $hjhgh;
    print_r(json_encode($idea_template));die();
    }

    function bthai_wa_bertha_load_draft_callback() {

        check_ajax_referer( 'bertha_templates_nonce', 'bertha_load_draft_nonce' );

        $drft_count = isset($_POST['drft_count']) ? sanitize_text_field( $_POST['drft_count'] ) : 0;
        $drft_count += 10;

        $args = array( 
          'numberposts'     => $drft_count,
          'post_type'       => 'backedn',
          'orderby'         => 'date',
          'order'       => 'DESC',
        );
        $backedn_drafts = get_posts($args);
        $idea_template =  array();
        $hjhgh = '';
        if($backedn_drafts) {
            foreach($backedn_drafts as $key => $draft) {
            $key += 1;
            $hjhgh .= '<div class="ber-mb-3 bertha-content-element">
                                    <div class="ber-d-grid ber-gap-2">
                                        <div class="ber-action-icon-wrap">
                                            <div class="bertha-copied-container ber-action-icon">
                                                <button class="bertha_draft_edit" data-title="'.$draft->post_title.'" data-id="'.$draft->ID.'"><i class="ber-i-pen"></i></button>
                                                <span class="bertha-copied-text" id="berthaCopied">Edit Draft</span>
                                            </div>
                                            <div class="bertha-trash-container ber-action-icon">
                                                <button class="bertha_idea_trash" data-value="'.$draft->ID.'"><i class="ber-i-trash"></i></button>
                                                <span class="bertha-trash-text" id="berthaTrash">Delete</span>
                                            </div>
                                        </div>
                                        <input type="radio" class="ber-btn-check ber-idea-btn-check" name="options" id="option'.$key.'" autocomplete="off" data-block="">
                                        <label class="ber-btn bertha_draft" for="option'.$key.'"><span class="bertha_draft_number">'.$draft->post_title.'</span><div class="bertha_draft_body"><pre>'.preg_replace('/\\\\/', '', wp_strip_all_tags($draft->post_content)).'</pre></div></label>
                                    </div>
                                </div>';
            }
            $hjhgh .= '<div class="ber-overlay"></div>';
            $idea_template['response'] = 'success';
        } else {
            $idea_template['response'] = 'failed';
        }
        $idea_template['ideas'] = $hjhgh;
        print_r(json_encode($idea_template));die();
    }

    function bthai_free_create_purchase_callback() {
        if (!isset($_POST['bertha_ber_create_nonce']) || !wp_verify_nonce($_POST['bertha_ber_create_nonce'], 'bertha_ber_create_form')) {
               die();
        }

        $ber_free_name = isset($_POST['ber_free_name']) ? sanitize_user( $_POST['ber_free_name'] ) : "";
        $ber_free_email = isset($_POST['ber_free_email']) ? sanitize_email( $_POST['ber_free_email'] ) : "";

        $url = 'https://bertha.ai/wp-json/free/purchase';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'ber_name' => $ber_free_name, 'ber_email' => $ber_free_email ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args);
        if (!is_wp_error($response) && isset($response['body'])) {
            print_r(json_decode($response['body']));
        } else {
            print_r('failed');
        }
        die();
    }

    function bthai_free_create_purchase_submit_callback() {
        if (!isset($_POST['bertha_ber_free_create_nonce']) || !wp_verify_nonce($_POST['bertha_ber_free_create_nonce'], 'bertha_ber_free_create_form')) {
               die();
        }
        
        $website_for = isset($_POST['website_for']) ? sanitize_text_field( $_POST['website_for'] ) : "";
        $about_website = isset($_POST['about_website']) ? sanitize_text_field( $_POST['about_website'] ) : "";
        $free_user = isset($_POST['free_user']) ? sanitize_text_field( $_POST['free_user'] ) : "";
     
        $url = 'https://bertha.ai/wp-json/free/purchase_submit';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'website_for' => $website_for, 'about_website' => $about_website, 'free_user' => $free_user ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args);
        if (!is_wp_error($response) && isset($response['body'])) {
            print_r('success');
        } else {
            print_r('failed');
        }
        die();
    }

}
