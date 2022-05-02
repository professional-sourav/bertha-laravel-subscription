<?php
/*
 * Plugin Name: Bertha AI With Subscription
 * Plugin URI:  https://bertha.ai/
 * Description: Bertha is an AI-based writing assistant that has been trained on hundreds of billions of lines of content to help you write better content on your WordPress website. In just a few clicks, you can have a variety of content for your website that’s guaranteed to convert – from blog posts to landing pages, to product pages.
 * Author:      Bertha.ai
 * Version:     1.0.0
 * Author URI:  https://bertha.ai/
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: bertha-ai-with-subscription
 * Domain Path: /languages
*/
$status = get_option('WEB_ACE_DASHBOARD_license_status');
if($status !== false && $status == 'valid') $license = get_option('WEB_ACE_DASHBOARD_license_key');
else $license = '';

define('BTHAI_VERSION', '1.8.6.1');
define('BTHAI_STORE_URL', 'https://bertha.ai');
define('BTHAI_ITEM_NAME', 'Bertha AI');
define('BTHAI_AUTHOR_NAME', 'Web-Ace');
define('BTHAI_ITEM_ID', 835);
define('BTHAI_FILE', __FILE__);
define('BTHAI_LICENSE_KEY', $license);
define('BTHAI_LICENSE_PRICE_ID', 9);

if(!class_exists('WA_Bertha_AI')) {
	require_once( 'classes/class-bertha-ai.php' );
    new WA_Bertha_AI(__FILE__);
}

if(!class_exists('WA_Bertha_AI_Admin')) {
    require_once( 'classes/class-bertha-ai-admin.php' );
    new WA_Bertha_AI_Admin(__FILE__);
}

if(!class_exists('WA_Bertha_AI_Ajax')) {
    require_once( 'classes/class-bertha-ai-ajax.php' );
    new WA_Bertha_AI_Ajax(__FILE__);
}

function get_bertha_history_ideas() {
    $idea_template = '<form  id="form4">';
    $args = array( 
      'numberposts'     => 20,
      'post_type'       => 'idea',
      'orderby'         => 'date',
      'order'       => 'DESC',
    );
    $bertha_ideas = get_posts($args);
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
            $idea_template .= '<div class="ber-mb-3 bertha-content-element">
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
    } else {
        $idea_template .= '<div class="ber_notice">Your previously generated Ideas will appear here.</div>';
    }
    $idea_template .= '<div class="ber-overlay"></div></form>';
    return $idea_template;
}

function get_bertha_favourite_ideas() {
    $idea_template = '<form  id="form4">';
    $args = array( 
      'numberposts'     => 20,
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
            $idea_template .= '<div class="ber-mb-3 bertha-content-element">
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
                                        <label class="ber-btn bertha_idea" for="option'.$key.'"><span class="bertha_idea_number">'.$tax[0]->name.'</span><div class="bertha_idea_body"><pre>'.preg_replace('/\\\\/', '', wp_strip_all_tags($idea->post_content)).'</pre></div></label>
                                    </div>
                                </div>';
            }
            $idea_template .= '<div class="ber-overlay"></div>';
    } else {
        $idea_template .= '<div class="ber_notice">Your Favourite Ideas will appear here.</div>';
    }
    $idea_template .= '</form>';
    return $idea_template;
}

function get_bertha_backedn_drafts() {
    $backedn_template = '<form  id="form4">';
    $args = array( 
      'numberposts'     => 20,
      'post_type'       => 'backedn',
      'orderby'         => 'date',
      'order'       => 'DESC',
    );
    $backedn_drafts = get_posts($args);
    if($backedn_drafts) {
        foreach($backedn_drafts as $key => $draft) {
            $key += 1;
            $backedn_template .= '<div class="ber-mb-3 bertha-content-element">
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
            $backedn_template .= '<div class="ber-overlay"></div>';
    } else {
        $backedn_template .= '<div class="ber_notice">Your Long Form Drafts will appear here.</div>';
    }
    $backedn_template .= '</form>';
    return $backedn_template;
}

function bertha_license_holder_details() {
    $details = array();
    $user_email = $account_email = $user_name = '';
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
        $details['user_email'] = json_decode($response['body']);
        $details['account_email'] = $details['user_email'];
    }
    $url = 'https://bertha.ai/wp-json/license/customername';
    $response = wp_remote_post($url, $args); 
    if (!is_wp_error($response) && isset($response['body'])) {
        $details['user_name'] = json_decode($response['body']);
    }
    return $details;
}

add_filter( 'cron_schedules', 'isa_add_every_three_minutes' );
function isa_add_every_three_minutes( $schedules ) {
    $schedules['every_three_minutes'] = array(
            'interval'  => 172800,
            'display'   => __( 'Every 3 Minutes', 'textdomain' )
    );
    return $schedules;
}

add_filter( 'cron_schedules', 'bertha_add_every_thirty_days' );
function bertha_add_every_thirty_days( $schedules ) {
    $schedules['every_thirty_days'] = array(
            'interval'  => 2635200,
            'display'   => __( 'Every 30 days', 'textdomain' )
    );
    return $schedules;
}

register_activation_hook( __FILE__, 'cyb_activation' );
function cyb_activation() {
    if( ! wp_next_scheduled( 'isa_add_every_three_minutes' ) ) {
        wp_schedule_event( time(), 'every_three_minutes', 'isa_add_every_three_minutes' );
    }

}

register_deactivation_hook( __FILE__, 'cyb_deactivation' );
function cyb_deactivation() {
    wp_clear_scheduled_hook( 'isa_add_every_three_minutes' );
}
// Hook into that action that'll fire every three minutes
add_action( 'isa_add_every_three_minutes', 'every_three_minutes_event_func' );
function every_three_minutes_event_func() {
    global $current_user;
    if(BTHAI_LICENSE_KEY) {
        $url = 'https://bertha.ai/wp-json/license/limit';
        $args = array(
                'method' => 'POST',
                'body'   => json_encode( array( 'license_key' => BTHAI_LICENSE_KEY ) ),
                'headers' => [
                                'Content-Type' =>  'application/json',
                            ],
        );
        $response = wp_remote_post($url, $args);
        if (!is_wp_error($response) && isset($response['body'])) {
            $data = json_decode($response['body']);
            $limit_percentage = ( $data->limit_used * 100 ) / $data->limit;
            if($limit_percentage <= 1) {
                $url = 'https://hooks.zapier.com/hooks/catch/1713289/b4x1o58/?bertha_email='.$current_user->user_email.'&bertha_license='.BTHAI_LICENSE_KEY;
                wp_remote_get($url);
            }
        }
    }
}

add_action( 'bertha_add_every_thirty_days', 'bertha_add_every_thirty_days_cb' );
function bertha_add_every_thirty_days_cb() {
    if(BTHAI_LICENSE_KEY) {
        if(get_option('bertha_reniewal_start')) {
            $url = 'https://bertha.ai/wp-json/license/reset';
            $args = array(
                    'method' => 'POST',
                    'body'   => json_encode( array( 'license_key' => BTHAI_LICENSE_KEY, 'home_url' => home_url() ) ),
                    'headers' => [
                                    'Content-Type' =>  'application/json',
                                ],
            );
            $response = wp_remote_post($url, $args);
        } else {
            update_option('bertha_reniewal_start', 'true');
        }
    }
}

if(BTHAI_LICENSE_KEY) {
    $url = 'https://bertha.ai/wp-json/license/limit';
    $args = array(
            'method' => 'POST',
            'body'   => json_encode( array( 'license_key' => BTHAI_LICENSE_KEY ) ),
            'headers' => [
                            'Content-Type' =>  'application/json',
                        ],
    );
    $response = wp_remote_post($url, $args);
    if (!is_wp_error($response) && isset($response['body'])) {
        $data = json_decode($response['body']);
        $create_date = Date('Y-m-d', strtotime($data->license_created));
        if( ! wp_next_scheduled( 'bertha_add_every_thirty_days' ) ) {
            wp_schedule_event( strtotime($create_date), 'every_thirty_days', 'bertha_add_every_thirty_days' );
        }
    }
}

function your_boo_bar_function() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu( 'new-idea' );
    $wp_admin_bar->remove_menu( 'new-backedn' );
}
add_action( 'wp_before_admin_bar_render', 'your_boo_bar_function' );