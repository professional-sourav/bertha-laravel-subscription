<?php

class WA_Bertha_AI_Admin {

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

        add_action('plugins_loaded', array(&$this, 'bthai_menu_init'));
    }

    function bthai_menu_init() {
		add_action('admin_menu', array(&$this, 'bthai_menu_submenu'));
	}

	function bthai_menu_submenu() {
		$plugin_type = '';
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
	            $plugin_type = $data->bertha_plugin_type;
	            $free_option = json_decode($data->free_templates);
	            $long_form_free = isset($free_option->long_form_version) ? true : false;
	        }
	    }

	    add_menu_page('Dashboard', __('Bertha AI', 'bertha-ai'), 'manage_options', 'bertha-ai-setting', 'bertha_ai_menu_redirect', plugin_dir_url( $this->file ).'assets/images/Bertha_icon_white.svg', 59);
	    add_submenu_page('bertha-ai-setting', __('Launch Bertha', 'bertha-ai'), __('Launch Bertha', 'bertha-ai'), 'manage_options', 'bertha-ai-setting', false);
	    if( ($plugin_type && $plugin_type != 'pro' && $long_form_free) || ($plugin_type && $plugin_type == 'pro') ) {
	    	add_submenu_page('bertha-ai-setting', __('Long Form Content', 'bertha-ai'), __('Long Form Content', 'bertha-ai'), 'manage_options', 'bertha-ai-backend-bertha', array( $this, 'bthai_backend_bertha_callback' ));
	    }
	    add_submenu_page('bertha-ai-setting', __('Content Settings', 'bertha-ai'), __('Content Settings', 'bertha-ai'), 'manage_options', 'bertha-ai-content-setting', array( $this, 'bthai_dashboard_callback' ));
	    add_submenu_page('bertha-ai-setting', __('License Settings', 'bertha-ai'), __('License Settings', 'bertha-ai'), 'manage_options', 'bertha-ai-license-setting', array( $this, 'bthai_dashboard_license_callback' ));
	    add_submenu_page('bertha-ai-setting', __('License', 'bertha-ai'), __('License', 'bertha-ai'), 'manage_options', 'bertha-ai-license', array( $this, 'bthai_license_cb' ));
	    if($plugin_type && $plugin_type != 'pro') {
	    	add_submenu_page('bertha-ai-setting', __('Want More?', 'bertha-ai'), __('Want More?', 'bertha-ai'), 'manage_options', 'bertha-ai-want-more', array( $this, 'bthai_want_more_cb' ));
	    }
	    add_submenu_page(null, __('Onboarding Dashboard', 'bertha-ai'), __('Onboard Dashboard', 'bertha-ai'), 'manage_options', 'wa-onboard-dashboard', array( $this, 'bthai_onboard_dashboard_callback' ));

	    /*free */
	    add_submenu_page(null, __('Onboarding Free Dashboard', 'bertha-ai'), __('Onboard Free Dashboard', 'bertha-ai'), 'manage_options', 'wa-free-onboard-dashboard', array( $this, 'bthai_onboard_free_dashboard_callback' ));
	}

	function bertha_ai_menu_redirect() {
	    wp_safe_redirect( admin_url( 'admin.php?page=bertha-ai-general-setting' ) );
	    exit;
	}

	function bthai_dashboard_callback() {
		global $wp_roles;
		if(isset($_POST['bertha_generat_content_settings'])) {

			if ( ! isset( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'bertha-general-content-setting' ) ) return;

			$setup_wizard = array();
		    $setup_wizard['brand_name'] = isset($_POST['berbrand']) ? sanitize_text_field(str_replace("\'", "'", $_POST['berbrand'])) : "";
		    $setup_wizard['customer_details'] = isset($_POST['berdescription']) ? sanitize_textarea_field(str_replace("\'", "'", $_POST['berdescription'])) : "";
		    $setup_wizard['ideal_customer'] = isset($_POST['beraudience']) ? sanitize_text_field(str_replace("\'", "'", $_POST['beraudience'])) : "";
		    $setup_wizard['sentiment'] = isset($_POST['bersentiment']) ? sanitize_text_field(str_replace("\'", "'", $_POST['bersentiment'])) : "";
		 
		    update_option('bertha_ai_options', $setup_wizard);
		}
		$Setting = get_option('bertha_ai_options') ? (array) get_option('bertha_ai_options') : array();
		$berbrand = isset($Setting['brand_name']) ? esc_attr($Setting['brand_name']) : '';
		$berdescription = isset($Setting['customer_details']) ? esc_attr($Setting['customer_details']) : '';
		$beraudience = isset($Setting['ideal_customer']) ? esc_attr($Setting['ideal_customer']) : '';
		$bersentiment = isset($Setting['sentiment']) ? esc_attr($Setting['sentiment']) : '';
		
		$plugin_type = '';
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
	            $plugin_type = $data->bertha_plugin_type;
	        }
	    }

	    $long_form_redirect = ($plugin_type && $plugin_type != 'pro') ? esc_url(admin_url( 'admin.php?page=bertha-ai-want-more' )) : esc_url(admin_url( 'admin.php?page=bertha-ai-backend-bertha' ));
		?>
		<div class="ber_page_header">
			<div class="ber_logo_head">
				<img src="<?php echo plugin_dir_url( $this->file ); ?>assets/images/Bertha_icon_purple_line.svg" alt="Bertha Logo" class="bertha_logo" />
			</div>
			<div class="ber_title_head">
				<div class="ber_title"><?php echo esc_html_e('Content Settings', 'bertha-ai'); ?></div> 
			</div>
			<div class="ber_menu_head">
				<a href="<?php echo esc_attr($long_form_redirect); ?>">Long-Form</a> <a href="#" class="ber_current_page"><?php echo esc_html_e('Content Settings', 'bertha-ai'); ?></a> <a href="<?php echo esc_url(admin_url( 'admin.php?page=bertha-ai-license-setting' )); ?>"><?php echo esc_html_e('License Settings', 'bertha-ai'); ?></a> <a target="_blank" href="https://bertha.ai/support/?plugin=1"><?php echo esc_html_e('Support', 'bertha-ai'); ?></a> <a target="_blank" href="https://bertha.ai/pricing/?plugin=1"><?php echo esc_html_e('Upgrade', 'bertha-ai'); ?></a>
			</div>
		</div>
		<div class="ber_page_wrap">
		<div class="ber_settings_form">
		<p class="ber_p_desc ber_page_info"><?php echo esc_html_e('Add the details of your brand below to help Bertha to know you better.', 'bertha-ai'); ?><br><?php echo esc_html_e('This will be used to help Bertha generate content ideas that are unique to your brand and preferences.', 'bertha-ai'); ?></p>
		<form method="post">
			<?php wp_nonce_field( 'bertha-general-content-setting' ); ?>
			<div class="ber_form">
			    <div class="ber_form_group ber_brand">
			        <label for="berbrand" class="ber_label"><?php echo esc_html_e('Brand Name', 'bertha-ai'); ?><span class="ber_required">*</span><span class="ber-tooltip-element"  data-toggle="tooltip" data-placement="top" title="<?php echo esc_html_e('Your company or brand name', 'bertha-ai'); ?>">?</span></label>
			        <input type="text" class="ber_field" name="berbrand" access="false" maxlength="100" id="berbrand" title="<?php echo esc_html_e('Your company or brand name', 'bertha-ai'); ?>" required="required" aria-required="true" value="<?php echo esc_attr($berbrand); ?>">
			    </div>
			    <div class="ber_form_group ber_description">
			        <label for="berdescription" class="ber_label"><?php echo esc_html_e('Company Description', 'bertha-ai'); ?><span class="ber_required">*</span><span class="ber-tooltip-element" data-toggle="tooltip" data-placement="top" title="<?php echo esc_html_e('Describe what you do, where you started, your products or services and the benefits you bring to the market', 'bertha-ai'); ?>">?</span></label>
			        <textarea type="textarea" class="ber_field" name="berdescription" access="false" maxlength="800" rows="10" id="berdescription" title="<?php echo esc_html_e('Describe what you do, where you started, your products or services and the benefits you bring to the market', 'bertha-ai'); ?>" required="required" aria-required="true"><?php echo esc_attr($berdescription); ?></textarea>
			    </div>
			    <div class="ber_form_group ber_audience">
			        <label for="beraudience" class="ber_label"><?php echo esc_html_e('Ideal Customer', 'bertha-ai'); ?><span class="ber_required">*</span><span class="ber-tooltip-element" data-toggle="tooltip" data-placement="top" title="<?php echo esc_html_e('Describe the group/s of people you are serving or targeting', 'bertha-ai'); ?>">?</span></label>
			        <input type="text" class="ber_field" name="beraudience" access="false" maxlength="100" id="beraudience" title="<?php echo esc_html_e('Describe the group/s of people you are serving or targeting', 'bertha-ai'); ?>" required="required" aria-required="true" value="<?php echo esc_attr($beraudience); ?>">
			    </div>
			    <div class="ber_form_group ber-field-bersentiment">
			        <label for="bersentiment" class="ber_label"><?php echo esc_html_e('Tone of Voice', 'bertha-ai'); ?><span class="ber_required">*</span><span class="ber-tooltip-element" data-toggle="tooltip" data-placement="top" title="<?php echo esc_html_e('One word to describe the vibe you want Bertha to bring to your copy', 'bertha-ai'); ?>">?</span></label>
			        <input type="text" placeholder="Witty" class="ber_field" name="bersentiment" access="false" maxlength="20" id="bersentiment" title="<?php echo esc_html_e('One word to describe the vibe you want Bertha to bring to your copy', 'bertha-ai'); ?>" required="required" aria-required="true" value="<?php echo esc_attr($bersentiment); ?>">
			    </div>
			    <div class="ber_form_group ber_savechanges">
			        <input type="submit" class="ber_button bertha_generat_settings" name="bertha_generat_content_settings" access="false" id="bersavechanges" value="<?php echo esc_html_e('Save Changes', 'bertha-ai'); ?>">
			    </div>
			</div>
		</form>
		<style><?php echo $role_style; ?></style>
		</div>
		<div class="ber_settings_sidebar">
		    <div class="ber_nicebox ber_metrix">
		        <div class="ber_title"><span class="ber_setting_icons">&#128640;</span> <?php echo esc_html_e('Usage Metrics', 'bertha-ai'); ?></div>
	            <?php
	            $plugin_type = '';
	            if($this->license_key) {
	                $url = 'https://bertha.ai/wp-json/license/limit';
	                $args = array(
	                        'method' => 'POST',
	                        'body'   => json_encode( array( 'license_key' => $this->license_key, 'home_url' => home_url() ) ),
	                        'headers' => [
	                                        'Content-Type' =>  'application/json',
	                                    ],
	                );
	                $response = wp_remote_post($url, $args);
	                if (!is_wp_error($response) && isset($response['body'])) {
	                    $data = json_decode($response['body']);
	                    $plugin_type = $data->bertha_plugin_type;
	                    $limit_percentage = ( $data->limit_used * 100 ) / $data->limit;
	                    $limit_percentage = $limit_percentage >= 0 ? $limit_percentage : 100;
	                    if($limit_percentage < 50) {
	                        $meter = 'success';
	                    }elseif($limit_percentage >= 50 && $limit_percentage < 80) {
	                        $meter = 'warning';
	                    }elseif($limit_percentage >= 80) {
	                        $meter = 'danger';
	                    }
	                    $bertha_limit_left =  ($data->limit_used.' / '. $data->limit);
	                }
	                ?>
	                <style>
	                    .ber-progress-bar::after {
	                        content: "<?php echo esc_attr($bertha_limit_left);?>";
	                        position: absolute;
	                        left: 50%;
	                        color: black;
	                    }
	                </style>
	                <div class="ber_metrix_bar">
	                    <?php
	                    if($data->limit_used >= $data->limit) { ?>
	                        <a class="ber_btn" href="https://bertha.ai/ran-out-of-words/?plugin=1" target="_blank">Upgrade Now</a> <?php
	                    } else { ?>
	                        <div class="ber-progress">
	                            <div class="ber-progress-bar bg-<?php echo $meter; ?>" role="ber-progressbar" style="width: <?php echo esc_attr($limit_percentage); ?>%" aria-valuenow="<?php echo esc_attr($limit_percentage); ?>" aria-valuemin="0" aria-valuemax="100"></div>
	                        </div> <?php
	                    }
	                    ?>
	                </div>
	                <?php
	            }
	            if($plugin_type != 'pro') {
		            ?>
			        <div class="ber_title"><?php echo esc_html_e('Unlock More Features & More Words', 'bertha-ai'); ?></div>
			        <p><?php echo esc_html_e('Save time by writing better content in less time, and take the guesswork out of deciding what to post on your website with many more writing models and even unlimited usage to take your content creation to the next level!', 'bertha-ai'); ?></p>
			        <a class="ber_btn" href="https://bertha.ai/pricing/?plugin=1" target="_blank"><?php echo esc_html_e('Upgrade Now', 'bertha-ai'); ?></a>
			    <?php } ?>
		    </div>
		    <div class="ber_nicebox ber_fbgroup">
		        <div class="ber_title"><span class="ber_setting_icons">&#129309;</span> <?php echo esc_html_e('Join Bertha\'s Community', 'bertha-ai'); ?></div>
		        <p><?php echo esc_html_e('Our community of business owners, writers and content marketers are constantly sharing their knowledge to help you become a better writer.', 'bertha-ai'); ?></p>
		        <a class="ber_btn" href="https://www.facebook.com/groups/340991974145634" target="_blank"><?php echo esc_html_e('Join The Facebook Community', 'bertha-ai'); ?></a>
		    </div>
		    <div class="ber_nicebox ber_review">
		        <div class="ber_title"><span class="ber_setting_icons">&#11088;</span> <?php echo esc_html_e('Show Bertha Some Love', 'bertha-ai'); ?></div>
		        <p><?php echo esc_html_e ('Use Bertha to write a review in just 3 clicks - This helps her spread the word of the work she is doing', 'bertha-ai'); ?> &#128588;</p>
		        <a class="ber_btn" href="https://wordpress.org/support/plugin/bertha-ai-free/reviews/#new-post" target="_blank"><?php echo esc_html_e('Post a Review', 'bertha-ai'); ?></a>
		    </div>
		    <div class="ber_nicebox ber_refer">
		        <div class="ber_title"><span class="ber_setting_icons">&#128075;</span> <?php echo esc_html_e('Refer Bertha to a Friend', 'bertha-ai'); ?></div>
		        <p><?php echo esc_html_e('Help your friends, clients and partners create better content for their website to', 'bertha-ai'); ?> <b><?php echo esc_html_e('generate substantial recurring revenue', 'bertha-ai'); ?></b>.</p>
		        <a class="ber_btn" href="https://bertha.ai/partners/?plugin=1" target="_blank"><?php echo esc_html_e('Become Bertha\'s Partner', 'bertha-ai'); ?></a>
		    </div>
		</div>
		    
		</div>
		<?php
	}

	function bthai_dashboard_license_callback() {
		global $wp_roles;
		if(isset($_POST['bertha_generat_license_settings'])) {

			if ( ! isset( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'bertha-general-license-setting' ) ) return;

			$setup_wizard = array();
		    $setup_wizard['bereverywhere'] = isset($_POST['bereverywhere']) ? sanitize_text_field($_POST['bereverywhere']) : "";
		    $setup_wizard['ber_frontend_backend'] = isset($_POST['ber_frontend_backend']) ? (array) ($_POST['ber_frontend_backend']) : "";
	 		$setup_wizard['ber_select_users'] = isset($_POST['berselect_users']) ? (array) ($_POST['berselect_users']) : array('administrator');
		 
		    update_option('bertha_ai_license_options', $setup_wizard);
		}
		$Setting = get_option('bertha_ai_license_options') ? (array) get_option('bertha_ai_license_options') : array();
		$ber_everywhere = isset($Setting['bereverywhere']) ? esc_attr($Setting['bereverywhere']) : 'yes';
		$ber_frontend_backend = isset($Setting['ber_frontend_backend']) ? (array) ($Setting['ber_frontend_backend']) : array('yes', 'no');
		$ber_select_users = isset($Setting['ber_select_users']) ? (array) ($Setting['ber_select_users']) : array('administrator');
		
		$plugin_type = '';
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
	            $plugin_type = $data->bertha_plugin_type;
	        }
	    }

	    $long_form_redirect = ($plugin_type && $plugin_type != 'pro') ? esc_url(admin_url( 'admin.php?page=bertha-ai-want-more' )) : esc_url(admin_url( 'admin.php?page=bertha-ai-backend-bertha' ));
		?>
			<div class="ber_page_header">
				<div class="ber_logo_head">
					<img src="<?php echo plugin_dir_url( $this->file ); ?>assets/images/Bertha_icon_purple_line.svg" alt="Bertha Logo" class="bertha_logo" />
				</div>
				<div class="ber_title_head">
					<div class="ber_title"><?php echo esc_html_e('License Settings', 'bertha-ai'); ?></div> 
				</div>
				<div class="ber_menu_head">
					<a href="<?php echo esc_attr($long_form_redirect); ?>">Long-Form</a> <a href="<?php echo esc_url(admin_url( 'admin.php?page=bertha-ai-content-setting' )); ?>"><?php echo esc_html_e('Content Settings', 'bertha-ai'); ?></a> <a href="#" class="ber_current_page"><?php echo esc_html_e('License Settings', 'bertha-ai'); ?></a> <a target="_blank" href="https://bertha.ai/support/?plugin=1"><?php echo esc_html_e('Support', 'bertha-ai'); ?></a> <a target="_blank" href="https://bertha.ai/pricing/?plugin=1"><?php echo esc_html_e('Upgrade', 'bertha-ai'); ?></a>
				</div>
			</div>
			<div class="ber_page_wrap">
				<div class="ber_settings_form">
					<p class="ber_p_desc ber_page_info"><?php echo esc_html_e('Add the details of your brand below to help Bertha to know you better.', 'bertha-ai'); ?><br><?php echo esc_html_e('This will be used to help Bertha generate content ideas that are unique to your brand and preferences.', 'bertha-ai'); ?></p>
					<form method="post">
						<?php wp_nonce_field( 'bertha-general-license-setting' ); ?>
						<div class="ber_form">
							<div class="ber_form_group ber_everywhere">
						        <label for="bereverywhere" class="ber_label"><?php echo esc_html_e('Bertha Everywhere', 'bertha-ai'); ?><span class="ber-tooltip-element" data-toggle="tooltip" data-placement="top" title="<?php echo esc_html_e('Choose Bertha everywhere if you want Bertha to appear in each text field. If not - choose to only have Bertha available when you click on the side bar.', 'bertha-ai'); ?>">?</span></label>
						        <label>Everywhere</label><input type="radio" class="ber_field" name="bereverywhere" access="false" id="bereverywhere" required="required" aria-required="true" value="yes" <?php echo ($ber_everywhere == 'yes') ?  "checked" : "" ;  ?>/>
						        <label>Not Everywhere</label><input type="radio" class="ber_field" name="bereverywhere" access="false" id="bereverywhere_not" required="required" aria-required="true" value="no" <?php echo ($ber_everywhere == 'no') ?  "checked" : "" ;  ?>/>
						    </div>
						    <div class="ber_form_group ber_frontend_backend">
						        <label for="ber_frontend_backend" class="ber_label"><?php echo esc_html_e('Bertha Visibility', 'bertha-ai'); ?><span class="ber-tooltip-element" data-toggle="tooltip" data-placement="top" title="<?php echo esc_html_e('Choose Bertha everywhere if you want Bertha to appear in each text field. If not - choose to only have Bertha available when you click on the side bar.', 'bertha-ai'); ?>">?</span></label>
						        <label>Frontend</label><input type="checkbox" class="ber_field" name="ber_frontend_backend[]" access="false" id="ber_frontend" aria-required="true" value="yes" <?php echo (in_array('yes', $ber_frontend_backend)) ?  "checked" : "" ;  ?>/>
						        <label>Backend</label><input type="checkbox" class="ber_field" name="ber_frontend_backend[]" access="false" id="ber_Backend" aria-required="true" value="no" <?php echo (in_array('no', $ber_frontend_backend)) ?  "checked" : "" ;  ?>/>
						    </div>
						    <div class="ber_form_group ber_select_users">
						    	<label for="ber_select_users" class="ber_label"><?php echo esc_html_e("User's Restriction", "bertha-ai"); ?><span class="ber-tooltip-element" data-toggle="tooltip" data-placement="top" title="<?php echo esc_html_e('Exclude users from seeing Bertha AI Icon . Use the SHIFT Key to select user role.', 'bertha-ai'); ?>">?</span></label>
						    	<select multiple="true" name="berselect_users[]" id="berselect_users">
						        	<?php
						        	foreach($wp_roles->roles as $key => $role) {
						        		?><option value="<?php echo $key; ?>" <?php echo (in_array($key, $ber_select_users)) ?  "selected" : "" ;  ?>><?php echo $key; ?></option><?php
						        	}
						        	?>
						        </select>
						    </div>
						    <div class="ber_form_group ber_savechanges">
						        <input type="submit" class="ber_button bertha_generat_settings" name="bertha_generat_license_settings" access="false" id="bersavechanges" value="<?php echo esc_html_e('Save Changes', 'bertha-ai'); ?>">
						    </div>
						</div>
					</form>
				</div>
			</div>
		<?php
	}

	function bthai_backend_bertha_callback() {
		$options = get_option( 'bertha_ai_options' );
		?>
		<div id="bertha_backend_canvas">
		<div class="ber_page_header">
			<div class="ber_logo_head">
				<img src="<?php echo plugin_dir_url( $this->file ); ?>assets/images/Bertha_icon_purple_line.svg" alt="Bertha Logo" class="bertha_logo" />
			</div>
			<div class="ber_title_head">
				<div class="ber_title"><?php echo esc_html_e('Long-Form Content Generator', 'bertha-ai'); ?></div> 
			</div>
			<div class="ber_menu_head">
				<a class="ber_current_page" href="#"><?php echo esc_html_e('Long-Form', 'bertha-ai'); ?></a> <a href="<?php echo esc_url(admin_url( 'admin.php?page=bertha-ai-general-setting' )); ?>"><?php echo esc_html_e('Settings', 'bertha-ai'); ?></a> <a target="_blank" href="https://bertha.ai/support/?plugin=1"><?php echo esc_html_e('Support', 'bertha-ai'); ?></a> <a target="_blank" href="https://bertha.ai/pricing/?plugin=1"><?php echo esc_html_e('Upgrade', 'bertha-ai'); ?></a>
			</div>
		</div>
		<div class="ber_page_wrap">
		<div class="ber_full_side">
			<div class="ber_full_header">
			</div>
		<?php
		$disabled = $ran_word1 = $ran_word2 = '';
		$plugin_type = $premium_tag = '';
	    $usp_version = $heading_version = $benefit_title_version = $title_version = $paragraph_version = $content_version = $service_version = $company_version = $company_mission_version =  $testimonial_version = $bullet_version = $personal_bio_version = $topic_ideas_version = $intro_para_version = $post_outline_version =  $conclusion_version = $action_version = $child_input_version = $benefit_list_version = $seo_title_version = $seo_description_version = $aida_marketing_version = $seo_city_version = $buisiness_name_version = $bridge_version = $pas_framework_version = $faq_list_version = $faq_answer_version = $summary_version = $contact_blurb_version = $seo_keyword_version = $evil_bertha_version = $real_estate_version = $press_blurb_version = $case_study_version = '';
	    if(BTHAI_LICENSE_KEY) {
	        $url = 'https://bertha.ai/wp-json/license/limit';
	        $args = array(
	                'method' => 'POST',
	                'body'   => json_encode( array( 'license_key' => BTHAI_LICENSE_KEY, 'home_url' => home_url() ) ),
	                'headers' => [
	                                'Content-Type' =>  'application/json',
	                            ],
	        );
	        $response = wp_remote_post($url, $args);
	        if (!is_wp_error($response) && isset($response['body'])) {
	            $data = json_decode($response['body']);
	            $plugin_type = $data->bertha_plugin_type;
	            if($plugin_type != 'pro') {
	            	$premium_tag = '<span class="bertha_power">Premium</span>';
	            	$free_option = json_decode($data->free_templates);
	            	if(!isset($free_option->usp_version)) $usp_version = $premium_tag;
	            	if(!isset($free_option->heading_version)) $heading_version = $premium_tag; 
	            	if(!isset($free_option->benefit_title_version)) $benefit_title_version = $premium_tag;
	            	if(!isset($free_option->title_version)) $title_version = $premium_tag;
	            	if(!isset($free_option->paragraph_version)) $paragraph_version = $premium_tag;
	            	if(!isset($free_option->content_version)) $content_version = $premium_tag;
	            	if(!isset($free_option->service_version)) $service_version = $premium_tag;
	            	if(!isset($free_option->company_version)) $company_version = $premium_tag;
	            	if(!isset($free_option->company_mission_version)) $company_mission_version = $premium_tag;
	            	if(!isset($free_option->testimonial_version)) $testimonial_version = $premium_tag;
	            	if(!isset($free_option->bullet_version)) $bullet_version = $premium_tag;
	            	if(!isset($free_option->personal_bio_version)) $personal_bio_version = $premium_tag;
	            	if(!isset($free_option->topic_ideas_version)) $topic_ideas_version = $premium_tag;
	            	if(!isset($free_option->intro_para_version)) $intro_para_version = $premium_tag;
	            	if(!isset($free_option->post_outline_version)) $post_outline_version = $premium_tag;
	            	if(!isset($free_option->conclusion_version)) $conclusion_version = $premium_tag;
	            	if(!isset($free_option->action_version)) $action_version = $premium_tag;
	            	if(!isset($free_option->child_input_version)) $child_input_version = $premium_tag;
	            	if(!isset($free_option->benefit_list_version)) $benefit_list_version = $premium_tag;
	            	if(!isset($free_option->seo_title_version)) $seo_title_version = $premium_tag;
	            	if(!isset($free_option->seo_description_version)) $seo_description_version = $premium_tag;
	            	if(!isset($free_option->aida_marketing_version)) $aida_marketing_version = $premium_tag;
	            	if(!isset($free_option->seo_city_version)) $seo_city_version = $premium_tag;
	            	if(!isset($free_option->buisiness_name_version)) $buisiness_name_version = $premium_tag;
	            	if(!isset($free_option->bridge_version)) $bridge_version = $premium_tag;
	            	if(!isset($free_option->pas_framework_version)) $pas_framework_version = $premium_tag;
	            	if(!isset($free_option->faq_list_version)) $faq_list_version = $premium_tag;
	            	if(!isset($free_option->faq_answer_version)) $faq_answer_version = $premium_tag;
	            	if(!isset($free_option->summary_version)) $summary_version = $premium_tag;
	            	if(!isset($free_option->contact_blurb_version)) $contact_blurb_version = $premium_tag;
	            	if(!isset($free_option->seo_keyword_version)) $seo_keyword_version = $premium_tag;
	            	if(!isset($free_option->evil_bertha_version)) $evil_bertha_version = $premium_tag;
	            	if(!isset($free_option->real_estate_version)) $real_estate_version = $premium_tag;
	            	if(!isset($free_option->press_blurb_version)) $press_blurb_version = $premium_tag;
	            	if(!isset($free_option->case_study_version)) $case_study_version = $premium_tag;
	            }
	            $limit_percentage = ( $data->limit_used * 100 ) / $data->limit;
	            $limit_percentage = $limit_percentage >= 0 ? $limit_percentage : 100;
	            if($limit_percentage < 50) {
	                $meter = 'success';
	            }elseif($limit_percentage >= 50 && $limit_percentage < 80) {
	                $meter = 'warning';
	            }elseif($limit_percentage >= 80) {
	                $meter = 'danger';
	            }
	        }
	        $template ='<div class="ber_metrix_bar">';
	        if($data->limit_used >= $data->limit) {
	            $template .=  '<a class="ber_btn" href="https://bertha.ai/ran-out-of-words/?plugin=1" target="_blank">'.__('Upgrade Now', 'bertha-ai').'</a>';
	            $disabled = 'disabled';
	            $ran_word1 = '<a target="_blank" href="https://bertha.ai/ran-out-of-words/?plugin=1">';
	            $ran_word2 = '</a>';
	        } else {
	            $template .= '<style>
	                    .ber-progress-bar::after {
	                        content: "'.$data->limit_used.' / '.$data->limit.'";
	                         position: absolute;
	                        left: 50%;
	                        color: black;
	                    }
	                </style>
	                        <div class="ber-progress">
	                          <div class="ber-progress-bar bg-'.$meter.'" role="ber-progressbar" style="width: '.$limit_percentage.'%" aria-valuenow="'.$limit_percentage.'" aria-valuemin="0" aria-valuemax="100"></div>
	                        </div>';
	            $disabled = '';
	        }
	        $template .= '</div>';
	    }
	$template .= '<div class="ber_icons_wrap">
	                    <button type="button" class="ber_icon bertha-back" style="display:none;"><span class="dashicons dashicons-arrow-left-alt2"></span></button>
	                </div>
	            <ul class="ber-nav ber-nav-tabs" id="myTab" role="tablist">
	              <li class="ber-nav-item" role="presentation">
	                	<button class="ber-nav-link ber-active" id="long-form-tab" data-bs-toggle="tab" data-bs-target="#LongForm" type="button" role="tab" aria-controls="LongForm" aria-selected="true">'.__('Long Form', 'bertha-ai').'</button>
	              </li>
	              <li class="ber-nav-item" role="presentation">
	                <button class="ber-nav-link" id="templates-tab" data-bs-toggle="tab" data-bs-target="#templates" type="button" role="tab" aria-controls="templates" aria-selected="true">'.__('Templates', 'bertha-ai').'</button>
	              </li>
	              <li class="ber-nav-item" role="presentation">
	                <button class="ber-nav-link" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button" role="tab" aria-controls="history" aria-selected="false">'.__('History', 'bertha-ai').'</button>
	              </li>
	              <li class="ber-nav-item" role="presentation">
	                <button class="ber-nav-link" id="favourite-tab" data-bs-toggle="tab" data-bs-target="#favourite" type="button" role="tab" aria-controls="favourite" aria-selected="false">'.__('Favourites', 'bertha-ai').'</button>
	              </li>
	              <li class="ber-nav-item" role="presentation">
	                <button class="ber-nav-link" id="backedn-tab" data-bs-toggle="tab" data-bs-target="#backedn" type="button" role="tab" aria-controls="backedn" aria-selected="false">'.__('Drafts', 'bertha-ai').'</button>
	              </li>
	            </ul>
	            <div class="ber-tab-content" id="myTabContent">
	              <div class="ber-tab-pane ber-fade ber-show ber-active" id="LongForm" role="tabpanel" aria-labelledby="long-form-tab">
	                <div class="input_details" id="long_form_fields">
		                <div class="ber-offcanvas-title">'.__('Long Form Details', 'bertha-ai').'</div>
		                <div class="ber_inner_p">'.__('Every Long Form Draft is saved in your history so that you may re use as you wish', 'bertha-ai').'</div>
		               	<form  id="form2">
		               	<div class="long_form_inputs">
	                        <div class="ber-mb-3">
	                            <label for="title" class="ber-form-label">'.__('Title / Subject', 'bertha-ai').'</label>
	                            <input type="text" class="ber-form-control long_form_title" maxlength="100" id="title" placeholder="'.__('Title / Subject', 'bertha-ai').'">
	                        </div>
	                        <div class="ber-mb-3">
	                            <label for="bertha_desc" class="ber-form-label">In your own words, describe what this article is about</label>
	                            <textarea class="ber-form-control long_form_desc" maxlength="800" id="bertha_desc" rows="10" placeholder="'.__('Write a short sentence or paragraph to help Bertha generate the best content for your article', 'bertha-ai').'"></textarea>
	                        </div>
	                        <div class="ber-mb-3">
	                            <label for="audience" class="ber-form-label">Target Audience</label>
	                            <input type="text" class="ber-form-control long_form_audience" maxlength="100" id="audience" placeholder="'.__('Target Audience', 'bertha-ai').'" value="'.esc_attr( $options['ideal_customer'] ).'">
	                        </div>
	                        <div class="ber-mb-3">
	                            <label for="tone" class="ber-form-label">Tone of Voice</label>
	                            <input type="text" class="ber-form-control long_form_tone" maxlength="20" id="tone" placeholder="'.__('Tone of Voice', 'bertha-ai').'" value="'.esc_attr( $options['sentiment'] ).'">
	                        </div>
	                        <div class="ber-mb-3">
	                            <label for="keywords" class="ber-form-label">'.__('Keywords (Seperate with Comma)', 'bertha-ai').'</label>
	                            <input type="text" class="ber-form-control long_form_keyword" maxlength="100" id="keywords" placeholder="'.__('Keywords (Seperate with Comma)', 'bertha-ai').'">
	                        </div>
	                        <div class="ber-overlay"></div>
	                    </div>
	                    <div class="ber-mb-3 bertha-template-video-container">
                            <label for="bertha-template-video-title" class="ber-form-label">'.__('How It Works', 'bertha-ai').'</label>
                            <div class="bertha-template-description-video"><iframe src="https://www.youtube.com/embed/6Gp74Wne68o"></iframe></div>
                        </div>
	                    </form>
	                </div>
	              </div>
	              <div class="ber-tab-pane ber-fade" id="templates" role="tabpanel" aria-labelledby="templates-tab">
	              <div class="ber-offcanvas-title" id="ber-offcanvasExampleLabel">'.__('What are we writing?', 'bertha-ai').'</div>
	                <div class="ber_inner_ber-offcanvas"></div>
	                <div id="template_selection" class="input_details">
	                <div class="ber_search"><span><i class="ber-i-search"></i></span><input type="text" class="ber_history_filter" id="bertha_template_filter" placeholder="'.__('Search Templates', 'bertha-ai').'"></div>
	                	<div class="ber_search_template">
	                		<input type="submit" class="ber_search_tag all" data-id="all" value="'.__('All', 'bertha-ai').'" />
	                		<input type="submit" class="ber_search_tag website" data-id="website" value="'.__('Website', 'bertha-ai').'" />
	                		<input type="submit" class="ber_search_tag blog" data-id="blog" value="'.__('Blog', 'bertha-ai').'" />
	                		<input type="submit" class="ber_search_tag seo" data-id="seo" value="'.__('SEO', 'bertha-ai').'" />
	                		<input type="submit" class="ber_search_tag marketing" data-id="marketing" value="'.__('Marketing', 'bertha-ai').'" />
	                		<input type="submit" class="ber_search_tag speciality" data-id="speciality" value="'.__('Speciality', 'bertha-ai').'" />
	                		<input type="submit" class="ber_search_tag useful_extra" data-id="useful_extra" value="'.__('Extras', 'bertha-ai').'" />
	                	</div>
	                    <form  id="form3">
	                    '.wp_nonce_field( 'bertha_templates_form', 'bertha_template_nonce' ).'
	                        <div class="ber_inner_title" data-id="website">'.__('Website Copy Generation', 'bertha-ai').'<span class="dashicons dashicons-arrow-right-alt2"></span></div>
	                        <div class="ber_inner_p" data-id="website">'.__("Models to perfect the micro-copy of the website, choose the right model for each section you're working on for optimal results.", "bertha-ai").'</div>
	                        '.($ran_word1).'<div class="ber-mb-3">
	                            <div class="ber-d-grid gap-2">
	                                <input type="radio" class="ber-btn-check ber-btn-check-template" name="options" id="option8" data-id="USP" data-name="'.__('Unique Value Proposition', 'bertha-ai').'" autocomplete="off">
	                                <label class="ber-btn bertha_template '.esc_attr($disabled).'" for="option8" data-id="website"><span class="bertha_template_icon">🏆</span>'.__('Unique Value Proposition', 'bertha-ai').'<span class="bertha_power">'.__('Premium', 'bertha-ai').'</span><span class="bertha_template_desc">'.__('That will make you stand out form the Crowd and used as the top sentence of your website.', 'bertha-ai').'</span></label>
	                            </div>
	                        </div>
	                        <div class="ber-mb-3">
	                            <div class="ber-d-grid ber-gap-2">
	                                <input type="radio" class="ber-btn-check ber-btn-check-template" name="options" id="option9" data-id="Headline" data-name="'.__('Website Sub-Headline', 'bertha-ai').'" autocomplete="off">
	                                <label class="ber-btn bertha_template '.esc_attr($disabled).'" for="option9" data-id="website"><span class="bertha_template_icon">🥈</span>'.__('Website Sub-Headline', 'bertha-ai').''.esc_attr($heading_version).'<span class="bertha_template_desc">'.__('A converting description that will go below your USP on the website - great for H2 Headings and SEO.', 'bertha-ai').'</span></label>
	                            </div>
	                        </div>
	                        <div class="ber-mb-3">
	                            <div class="ber-d-grid ber-gap-2">
	                                <input type="radio" class="ber-btn-check ber-btn-check-template" name="options" id="option21" data-id="blog-action" data-name="'.__('Button Call to Action', 'bertha-ai').'" autocomplete="off">
	                                <label class="ber-btn bertha_template '.esc_attr($disabled).'" for="option21" data-id="website"><span class="bertha_template_icon">🎯</span>'.__('Button Call to Action', 'bertha-ai').''.esc_attr($action_version).'<span class="bertha_template_desc">'.__('With Bertha, you can generate a call to action button that\'s guaranteed to convert. No more guessing what words will convert best!', 'bertha-ai').'</span></label>
	                            </div>
	                        </div>
	                        <div class="ber-mb-3">
	                            <div class="ber-d-grid ber-gap-2">
	                                <input type="radio" class="ber-btn-check ber-btn-check-template" name="options" id="option10" data-id="Title" data-name="'.__('Section Title Generator', 'bertha-ai').'" autocomplete="off">
	                                <label class="ber-btn bertha_template '.esc_attr($disabled).'" for="option10" data-id="website"><span class="bertha_template_icon">🏹</span>'.__('Section Title Generator', 'bertha-ai').''.$title_version.'<span class="bertha_template_desc">'.__('Creative titles for each section of your website. No more boring "About us" type of titles.', 'bertha-ai').'</span></label>
	                            </div>
	                        </div>
	                        <div class="ber-mb-3">
	                            <div class="ber-d-grid ber-gap-2">
	                                <input type="radio" class="ber-btn-check ber-btn-check-template" name="options" id="option12" data-id="Benefit-List" data-name="'.__('Benefit Lists', 'bertha-ai').'" autocomplete="off">
	                                <label class="ber-btn bertha_template '.esc_attr($disabled).'" for="option12" data-id="website"><span class="bertha_template_icon">🥰</span>'.__('Service/Product Benefit List', 'bertha-ai').''.esc_attr($benefit_list_version).'<span class="bertha_template_desc">'.__('Instantly generate a list of differentiators and benefits for your own company and brand.', 'bertha-ai').'</span></label>
	                            </div>
	                        </div>
	                        <div class="ber-mb-3">
	                            <div class="ber-d-grid ber-gap-2">
	                                <input type="radio" class="ber-btn-check ber-btn-check-template" name="options" id="option5" data-id="Benefit-Title" data-name="'.__('Title to Benefit Sections', 'bertha-ai').'" autocomplete="off">
	                                <label class="ber-btn bertha_template '.esc_attr($disabled).'" for="option5" data-id="website"><span class="bertha_template_icon">🦚</span>'.__('Title to Benefit Sections', 'bertha-ai').''.esc_attr($benefit_title_version).'<span class="bertha_template_desc">'.__('Take a benefit of your product/service and expand it to provide additional engaging details.', 'bertha-ai').'</span></label>
	                            </div>
	                        </div>
	                        <div class="ber-mb-3">
	                            <div class="ber-d-grid ber-gap-2">
	                                <input type="radio" class="ber-btn-check ber-btn-check-template" name="options" id="option6" data-id="Paragraph" data-name="'.__('Paragraph Generator', 'bertha-ai').'" autocomplete="off">
	                                <label class="ber-btn bertha_template '.esc_attr($disabled).'" for="option6" data-id="website"><span class="bertha_template_icon">💣</span>'.__('Paragraph Generator', 'bertha-ai').''.esc_attr($paragraph_version).'<span class="bertha_template_desc">'.__('Great for getting over writers block: Craft creative short paragraphs fro different areas of your website in blog posts and pages.', 'bertha-ai').'</span></label>
	                            </div>
	                        </div>
	                        <div class="ber-mb-3">
	                            <div class="ber-d-grid ber-gap-2">
	                                <input type="radio" class="ber-btn-check ber-btn-check-template" name="options" id="option7" data-id="Content-Improver" data-name="'.__('Content Improver', 'bertha-ai').'" autocomplete="off">
	                                <label class="ber-btn bertha_template '.esc_attr($disabled).'" for="option7" data-id="website"><span class="bertha_template_icon">🎢</span>'.__('Content Rephraser', 'bertha-ai').''.esc_attr($content_version).'<span class="bertha_template_desc">'.__('Not confident with what you wrote? Paste it in and let Bertha\'s magic make it all better.', 'bertha-ai').'</span></label>
	                            </div>
	                        </div>
	                        <div class="ber-mb-3">
	                            <div class="ber-d-grid ber-gap-2">
	                                <input type="radio" class="ber-btn-check ber-btn-check-template" name="options" id="option13" data-id="Service" data-name="'.__('Product/Service Description', 'bertha-ai').'" autocomplete="off">
	                                <label class="ber-btn bertha_template '.esc_attr($disabled).'" for="option13" data-id="website"><span class="bertha_template_icon">💲</span>'.__('Product/Service Description', 'bertha-ai').''.esc_attr($service_version).'<span class="bertha_template_desc">'.__('Perfect for e-commerce Stores.', 'bertha-ai').'</span></label>
	                            </div>
	                        </div>
	                        <div class="ber-mb-3">
	                            <div class="ber-d-grid ber-gap-2">
	                                <input type="radio" class="ber-btn-check ber-btn-check-template" name="options" id="option14" data-id="Company" data-name="'.__('Company Bio', 'bertha-ai').'" autocomplete="off">
	                                <label class="ber-btn bertha_template '.esc_attr($disabled).'" for="option14" data-id="website"><span class="bertha_template_icon">🏭</span>'.__('Full-on About Us Page', 'bertha-ai').'<span class="bertha_power">Premium</span><span class="bertha_template_desc">'.__('Bertha already knows you. She will write an overview, history, mission and vision for your company.', 'bertha-ai').'</span></label>
	                            </div>
	                        </div>
	                        <div class="ber-mb-3">
	                            <div class="ber-d-grid ber-gap-2">
	                                <input type="radio" class="ber-btn-check ber-btn-check-template" name="options" id="option23" data-id="Company-mission" data-name="'.__('Company Mission & Vision', 'bertha-ai').'" autocomplete="off">
	                                <label class="ber-btn bertha_template '.esc_attr($disabled).'" for="option23" data-id="website"><span class="bertha_template_icon">🚀</span>'.__('Company Mission & Vision', 'bertha-ai').'<span class="bertha_power">Premium</span><span class="bertha_template_desc">'.__('From your company description, Bertha will write inspiring Mission and Vision statements for your "About Us" page.', 'bertha-ai').'</span></label>
	                            </div>
	                        </div>
	                        <div class="ber-mb-3">
	                            <div class="ber-d-grid ber-gap-2">
	                                <input type="radio" class="ber-btn-check ber-btn-check-template" name="options" id="option16" data-id="personal-bio" data-name="'.__('Personal Bio', 'bertha-ai').'" autocomplete="off">
	                                <label class="ber-btn bertha_template '.esc_attr($disabled).'" for="option16" data-id="website"><span class="bertha_template_icon">😎</span>'.__('Personal Bio (About Me)', 'bertha-ai').''.esc_attr($personal_bio_version).'<span class="bertha_template_desc">'.__('Writing about ourselves is hard. It\'s not for Bertha - Let her do it for you and only fix what\'s needed.', 'bertha-ai').'</span></label>
	                            </div>
	                        </div>
	                        <div class="ber-mb-3">
	                            <div class="ber-d-grid ber-gap-2">
	                                <input type="radio" class="ber-btn-check ber-btn-check-template" name="options" id="option30" data-id="faq-list" data-name="'.__('FAQs List', 'bertha-ai').'" autocomplete="off">
	                                <label class="ber-btn bertha_template '.esc_attr($disabled).'" for="option30" data-id="website"><span class="bertha_template_icon">🙋‍♀️</span>'.__('FAQs List', 'bertha-ai').''.esc_attr($faq_list_version).'<span class="bertha_template_desc">'.__('Generate a list of frequently asked questions for a service or product.', 'bertha-ai').'</span></label>
	                            </div>
	                        </div>
	                        <div class="ber-mb-3">
	                            <div class="ber-d-grid ber-gap-2">
	                                <input type="radio" class="ber-btn-check ber-btn-check-template" name="options" id="option31" data-id="faq-answer" data-name="'.__('FAQ Answers', 'bertha-ai').'" autocomplete="off">
	                                <label class="ber-btn bertha_template '.esc_attr($disabled).'" for="option31" data-id="website"><span class="bertha_template_icon">😑</span>'.__('FAQ Answers', 'bertha-ai').''.esc_attr($faq_answer_version).'<span class="bertha_template_desc">'.__('Get an anwser to a question.', 'bertha-ai').'</span></label>
	                            </div>
	                        </div>
	                        <div class="ber-mb-3">
	                            <div class="ber-d-grid ber-gap-2">
	                                <input type="radio" class="ber-btn-check ber-btn-check-template" name="options" id="option33" data-id="contact-blurb" data-name="'.__('Contact Form Blurb', 'bertha-ai').'" autocomplete="off">
	                                <label class="ber-btn bertha_template '.esc_attr($disabled).'" for="option33" data-id="website"><span class="bertha_template_icon">🤝</span>Contact Form Blurb'.esc_attr($contact_blurb_version).'<span class="bertha_template_desc">'.__('Create a short description & Call to Action that will be used as the final persuasion text next to a contact form.', 'bertha-ai').'</span></label>
	                            </div>
	                        </div>'.($ran_word2).'
	                        <div class="ber_inner_title" data-id="marketing">'.__('Converting Marketing Copy', 'bertha-ai').'<span class="dashicons dashicons-arrow-right-alt2"></span></div>
	                        <div class="ber_inner_p" data-id="marketing">'.__('Create copy that converts based on battle tested content marketing frameworks that will apply to your business service or product.', 'bertha-ai').'</div>
	                        '.($ran_word1).'<div class="ber-mb-3">
	                            <div class="ber-d-grid ber-gap-2">
	                                <input type="radio" class="ber-btn-check ber-btn-check-template" name="options" id="option15" data-id="bullet-points" data-name="'.__('Persuasive Bullet Points', 'bertha-ai').'" autocomplete="off">
	                                <label class="ber-btn bertha_template '.esc_attr($disabled).'" for="option15" data-id="marketing"><span class="bertha_template_icon">✔</span>'.__('Persuasive Bullet Points', 'bertha-ai').''.esc_attr($bullet_version).'<span class="bertha_template_desc">'.__('Convince readers that your product is the best by listing all the reasons they should take action NOW.', 'bertha-ai').'</span></label>
	                            </div>
	                        </div>
	                        <div class="ber-mb-3">
	                            <div class="ber-d-grid ber-gap-2">
	                                <input type="radio" class="ber-btn-check ber-btn-check-template" name="options" id="option25" data-id="aida-marketing" data-name="'.__('AIDA Marketing Framework', 'bertha-ai').'" autocomplete="off">
	                                <label class="ber-btn bertha_template '.esc_attr($disabled).'" for="option25" data-id="marketing"><span class="bertha_template_icon">🍬</span>'.__('AIDA Marketing Framework', 'bertha-ai').''.esc_attr($aida_marketing_version).'<span class="bertha_template_desc">'.__('Awareness > Interest > Desire > Action - Structure your writing and create more compelling content.', 'bertha-ai').'</span></label>
	                            </div>
	                        </div>
	                        <div class="ber-mb-3">
	                            <div class="ber-d-grid ber-gap-2">
	                                <input type="radio" class="ber-btn-check ber-btn-check-template" name="options" id="option28" data-id="bridge" data-name="'.__('Before, After and Bridge', 'bertha-ai').'" autocomplete="off">
	                                <label class="ber-btn bertha_template '.esc_attr($disabled).'" for="option28" data-id="marketing"><span class="bertha_template_icon">🌉</span>'.__('Before, After and Bridge', 'bertha-ai').''.esc_attr($bridge_version).'<span class="bertha_template_desc">'.__('Get a short description to build a page with a before and after look, with a transition in between.', 'bertha-ai').'</span></label>
	                            </div>
	                        </div>
	                        <div class="ber-mb-3">
	                            <div class="ber-d-grid ber-gap-2">
	                                <input type="radio" class="ber-btn-check ber-btn-check-template" name="options" id="option29" data-id="pas-framework" data-name="'.__('PAS Framework', 'bertha-ai').'" autocomplete="off">
	                                <label class="ber-btn bertha_template '.esc_attr($disabled).'" for="option29" data-id="marketing"><span class="bertha_template_icon">🚥</span>'.__('PAS Framework', 'bertha-ai').''.esc_attr($pas_framework_version).'<span class="bertha_template_desc">'.__('Problem > Agitate > Solution - A framework for planning and evaluating your content marketing activities.', 'bertha-ai').'</span></label>
	                            </div>
	                        </div>
	                        '.($ran_word2).'
	                        <div class="ber_inner_title" data-id="blog">'.__('Blog Posts Creation', 'bertha-ai').'<span class="dashicons dashicons-arrow-right-alt2"></span></div>
	                        <div class="ber_inner_p" data-id="blog">'.__('Models to compile amazing blog posts. Each model is optimised for different sections of a blog post.', 'bertha-ai').'</div>
	                        '.($ran_word1).'<div class="ber-mb-3">
	                            <div class="ber-d-grid ber-gap-2">
	                                <input type="radio" class="ber-btn-check ber-btn-check-template" name="options" id="option17" data-id="blog-post-idea" data-name="'.__('Blog Post Topic Ideas', 'bertha-ai').'" autocomplete="off">
	                                <label class="ber-btn bertha_template '.esc_attr($disabled).'" for="option17" data-id="blog"><span class="bertha_template_icon">💡</span>'.__('Blog Post Topic Ideas', 'bertha-ai').'<span class="bertha_power">Premium</span><span class="bertha_template_desc">'.__('Trained with data from hundreds of thousands of blog posts, Bertha uses this data to generate a variety of creative blog post ideas.', 'bertha-ai').'</span></label>
	                            </div>
	                        </div>
	                        <div class="ber-mb-3">
	                            <div class="ber-d-grid ber-gap-2">
	                                <input type="radio" class="ber-btn-check ber-btn-check-template" name="options" id="option19" data-id="blog-post-outline" data-name="'.__('Blog Post Outline', 'bertha-ai').'" autocomplete="off">
	                                <label class="ber-btn bertha_template '.esc_attr($disabled).'" for="option19" data-id="blog"><span class="bertha_template_icon">🧐</span>'.__('Blog Post Outline', 'bertha-ai').''.esc_attr($post_outline_version).'<span class="bertha_template_desc">'.__('Map out your blog post\'s outline simply by adding the title or topic of the blog post you want to create. Bertha will take care of the rest.', 'bertha-ai').'</span></label>
	                            </div>
	                        </div>
	                        <div class="ber-mb-3">
	                            <div class="ber-d-grid ber-gap-2">
	                                <input type="radio" class="ber-btn-check ber-btn-check-template" name="options" id="option18" data-id="blog-post-intro-paragraph" data-name="'.__('Blog Post Intro Paragraph', 'bertha-ai').'" autocomplete="off">
	                                <label class="ber-btn bertha_template '.esc_attr($disabled).'" for="option18" data-id="blog"><span class="bertha_template_icon">🦅</span>'.__('Blog Post Intro Paragraph', 'bertha-ai').''.esc_attr($intro_para_version).'<span class="bertha_template_desc">'.__('Not sure how to start writing your next winning blog post? Bertha will get the ball rolling on taking your blog post topic and generate an intriguing intro paragraph.', 'bertha-ai').'</span></label>
	                            </div>
	                        </div>
	                        <div class="ber-mb-3">
	                            <div class="ber-d-grid ber-gap-2">
	                                <input type="radio" class="ber-btn-check ber-btn-check-template" name="options" id="option20" data-id="blog-post-conclusion" data-name="'.__('Blog Post Conclusion Paragraph', 'bertha-ai').'" autocomplete="off">
	                                <label class="ber-btn bertha_template '.esc_attr($disabled).'" for="option20" data-id="blog"><span class="bertha_template_icon">🦸‍♀️</span>'.__('Blog Post Conclusion Paragraph', 'bertha-ai').''.esc_attr($conclusion_version).'<span class="bertha_template_desc">'.__('Bertha can write a blog post conclusion paragraph that will help your visitors stick around to read the rest of your content.', 'bertha-ai').'</span></label>
	                            </div>
	                        </div>'.($ran_word2).'
	                        <div class="ber_inner_title" data-id="useful_extra">'.__('Useful Extras', 'bertha-ai').'<span class="dashicons dashicons-arrow-right-alt2"></span></div>
	                        <div class="ber_inner_p" data-id="useful_extra">'.__('Leverage these extras for additional content or add clarity throughout your website that will create copy that your readers can relate to.', 'bertha-ai').'</div>
	                        '.$ran_word1.'<div class="ber-mb-3">
	                            <div class="ber-d-grid ber-gap-2">
	                                <input type="radio" class="ber-btn-check ber-btn-check-template" name="options" id="option22" data-id="child-explain" data-name="'.__('Explain It To a Child', 'bertha-ai').'" autocomplete="off">
	                                <label class="ber-btn bertha_template '.esc_attr($disabled).'" for="option22" data-id="useful_extra"><span class="bertha_template_icon">👶</span>'.__('Explain It To a Child', 'bertha-ai').''.esc_attr($child_input_version).'<span class="bertha_template_desc">'.__('Taking complex concepts and simplifying them. So that everyone can get it. Get it?', 'bertha-ai').'</span></label>
	                            </div>
	                            </div>
	                        <div class="ber-mb-3">
	                            <div class="ber-d-grid ber-gap-2">
	                                <input type="radio" class="ber-btn-check ber-btn-check-template" name="options" id="option27" data-id="buisiness-name" data-name="'.__('Business or Product Name', 'bertha-ai').'" autocomplete="off">
	                                <label class="ber-btn bertha_template '.esc_attr($disabled).'" for="option27" data-id="useful_extra"><span class="bertha_template_icon">⚓</span>'.__('Business or Product Name', 'bertha-ai').''.esc_attr($buisiness_name_version).'<span class="bertha_template_desc">'.__('Create a new business or product name from scratch based on a keyword or phrase.', 'bertha-ai').'</span></label>
	                            </div>
	                         </div>
	                         <div class="ber-mb-3">
	                            <div class="ber-d-grid ber-gap-2">
	                                <input type="radio" class="ber-btn-check ber-btn-check-template" name="options" id="option32" data-id="summaries" data-name="'.__('Content Summary', 'bertha-ai').'" autocomplete="off">
	                                <label class="ber-btn bertha_template '.esc_attr($disabled).'" for="option32" data-id="useful_extra"><span class="bertha_template_icon">🪐</span>'.__('Content Summary', 'bertha-ai').''.esc_attr($summary_version).'<span class="bertha_template_desc">'.__('Create a summary of an article/website/blog post. Great for SEO and to share on social media.', 'bertha-ai').'</span></label>
	                            </div>
	                        </div>'.($ran_word2).'
	                        <div class="ber_inner_title" data-id="seo">'.__('SEO Focused Content', 'bertha-ai').'<span class="dashicons dashicons-arrow-right-alt2"></span></div>
	                        <div class="ber_inner_p" data-id="seo">'.__('Level up your search engine ranking and speed up repetitive SEO content related tasks.', 'bertha-ai').'</div>
	                        '.($ran_word1).'<div class="ber-mb-3">
	                            <div class="ber-d-grid ber-gap-2">
	                                <input type="radio" class="ber-btn-check ber-btn-check-template" name="options" id="option23" data-id="seo-title" data-name="'.__('SEO Title Tag', 'bertha-ai').'" autocomplete="off">
	                                <label class="ber-btn bertha_template '.esc_attr($disabled).'" for="option23" data-id="seo"><span class="bertha_template_icon">⛩️</span>'.__('SEO Title Tag', 'bertha-ai').''.esc_attr($seo_title_version).'<span class="bertha_template_desc">'.__('Get highly optimized title tags that will help you rank higher in search engines.', 'bertha-ai').'</span></label>
	                            </div>
	                            </div>
	                            <div class="ber-mb-3">
	                            <div class="ber-d-grid ber-gap-2">
	                                <input type="radio" class="ber-btn-check ber-btn-check-template" name="options" id="option24" data-id="seo-description" data-name="'.__('SEO Description Tag', 'bertha-ai').'" autocomplete="off">
	                                <label class="ber-btn bertha_template '.esc_attr($disabled).'" for="option24" data-id="seo"><span class="bertha_template_icon">✒️</span>'.__('SEO Description Tag', 'bertha-ai').''.esc_attr($seo_description_version).'<span class="bertha_template_desc">'.__('You are serious about SEO, But this is a tedious task that can easily be automated with Bertha.', 'bertha-ai').'</span></label>
	                            </div>
	                            </div>
	                            <div class="ber-mb-3">
	                            <div class="ber-d-grid ber-gap-2">
	                                <input type="radio" class="ber-btn-check ber-btn-check-template" name="options" id="option26" data-id="seo-city" data-name="'.__('SEO City Based Pages', 'bertha-ai').'" autocomplete="off">
	                                <label class="ber-btn bertha_template '.esc_attr($disabled).'" for="option26" data-id="seo"><span class="bertha_template_icon">🏙</span>'.__('SEO City Based Pages', 'bertha-ai').''.esc_attr($seo_city_version).'<span class="bertha_template_desc">'.__('Generate city page titles and descriptions for your city or town pages to help rank your website locally.', 'bertha-ai').'</span></label>
	                            </div>
	                            </div>
	                            <div class="ber-mb-3">
	                            <div class="ber-d-grid ber-gap-2">
	                                <input type="radio" class="ber-btn-check ber-btn-check-template" name="options" id="option34" data-id="seo-keyword" data-name="'.__('SEO Keyword Suggestions', 'bertha-ai').'" autocomplete="off">
	                                <label class="ber-btn bertha_template '.esc_attr($disabled).'" for="option34" data-id="seo"><span class="bertha_template_icon">🔑</span>'.__('SEO Keyword Suggestions', 'bertha-ai').''.esc_attr($seo_keyword_version).'<span class="bertha_template_desc">'.__('Generate suggestions of long-tail keywords that are related to your topic.', 'bertha-ai').'</span></label>
	                            </div>
	                            </div>'.($ran_word2).'
		                        <div class="ber_inner_title" data-id="speciality">'.__('Niche Specific & Edge Cases', 'bertha-ai').'<span class="dashicons dashicons-arrow-right-alt2"></span></div>
		                        <div class="ber_inner_p" data-id="speciality">'.__('Specialized content models that fit common types of content that are used for specific niches and industries.', 'bertha-ai').'</div>
		                        '.($ran_word1).'
	                            <div class="ber-mb-3">
	                            <div class="ber-d-grid ber-gap-2">
	                                <input type="radio" class="ber-btn-check ber-btn-check-template" name="options" id="option35" data-id="evil-bertha" data-name="'.__('Evil Bertha', 'bertha-ai').'" autocomplete="off">
	                                <label class="ber-btn bertha_template ber_evil '.esc_attr($disabled).'" for="option34" data-id="speciality"><span class="bertha_template_icon">😈</span>'.__('Evil Bertha', 'bertha-ai').''.esc_attr($evil_bertha_version).'<span class="bertha_template_desc">'.__('Usually Bertha is nice and friendly, but not always...', 'bertha-ai').'</span></label>
	                            </div>
	                            </div>
	                            <div class="ber-mb-3">
	                            <div class="ber-d-grid ber-gap-2">
	                                <input type="radio" class="ber-btn-check ber-btn-check-template" name="options" id="option36" data-id="real-estate" data-name="'.__('Real Estate Property Listing Description', 'bertha-ai').'" autocomplete="off">
	                                <label class="ber-btn bertha_template '.esc_attr($disabled).'" for="option34" data-id="speciality"><span class="bertha_template_icon">🏡</span>'.__('Real Estate Property Listing Description', 'bertha-ai').''.esc_attr($real_estate_version).'<span class="bertha_template_desc">'.__('Detailed and enticing property listings for your real estate websites. So you can focus on the sale.', 'bertha-ai').'</span></label>
	                            </div>
	                            </div>
	                            <div class="ber-mb-3">
	                            <div class="ber-d-grid ber-gap-2">
	                                <input type="radio" class="ber-btn-check ber-btn-check-template" name="options" id="option37" data-id="press-blurb" data-name="'.__('Press Mention Blurb', 'bertha-ai').'" autocomplete="off">
	                                <label class="ber-btn bertha_template '.esc_attr($disabled).'" for="option34" data-id="speciality"><span class="bertha_template_icon">📰</span>'.__('Press Mention Blurb', 'bertha-ai').''.esc_attr($press_blurb_version).'<span class="bertha_template_desc">'.__('Provide the press mention title and publication to craft a press mention blurb.', 'bertha-ai').'</span></label>
	                            </div>
	                            </div>
	                            <div class="ber-mb-3">
	                            <div class="ber-d-grid ber-gap-2">
	                                <input type="radio" class="ber-btn-check ber-btn-check-template" name="options" id="option38" data-id="case-study" data-name="'.__('Case Study Generator (STAR Method)', 'bertha-ai').'" autocomplete="off">
	                                <label class="ber-btn bertha_template '.esc_attr($disabled).'" for="option34" data-id="speciality"><span class="bertha_template_icon">👨‍🎓</span>'.__('Case Study Generator (STAR Method)', 'bertha-ai').''.esc_attr($case_study_version).'<span class="bertha_template_desc">'.__('Generate a case study based on a client name and a problem they wanted to solve.', 'bertha-ai').'</span></label>
	                            </div>
	                            </div>
	                        '.($ran_word2).'
	 						<div class="ber-overlay">'.__('Please wait ....', 'bertha-ai').'</div>
	                    </form>
	                    <a href="https://bertha.ai/suggest/?plugin=1" target="_blank"><div class="bertha_template_suggesion"><span class="bertha_template_icon">💌</span>'.__('Suggest a Template', 'bertha-ai').'<span class="bertha_template_desc">'.__('Did Bertha miss anything that can help you perfect your website content generation? Let her know here.', 'bertha-ai').'</span></div></a>
	                </div>
	                <div id="template_description" class="input_details " ></div>
	                <div id="samsa" class="input_details " ></div>
	              </div>
	              <div class="ber-tab-pane ber-fade" id="history" role="tabpanel" aria-labelledby="history-tab">
	                <div class="ber-offcanvas-title">Previously Created Content</div>
	                <div class="ber_inner_p">Every output Bertha has generated is saved here for easy re-use.</div>
	                <select name="history_filter" class="ber_history_filter" id="history_filter">
	                    <option value="all">'.__('All Templates', 'bertha-ai').'</option>  
	                    <option value="idea-usp">'.__('Unique Value Proposition', 'bertha-ai').'</option>
	                    <option value="sub-headline">'.__('Website Sub-Headline', 'bertha-ai').'</option>
	                    <option value="blog-action-idea">'.__('Button Call to Action', 'bertha-ai').'</option>
	                    <option value="section-title">'.__('Section Title Generator', 'bertha-ai').'</option>
	                    <option value="benefit-title">'.__('Title to Benefit Sections', 'bertha-ai').'</option>
	                    <option value="idea-paragraph">'.__('Paragraph Generator', 'bertha-ai').'</option>
	                    <option value="content-improver">'.__('Content Rephraser', 'bertha-ai').'</option>
	                    <option value="idea-benefit">'.__('Service/Product Benefit List', 'bertha-ai').'</option>
	                    <option value="product-service-description">'.__('Product/Service Description', 'bertha-ai').'</option>
	                    <option value="bullet-points">'.__('Persuasive Bullet Points', 'bertha-ai').'</option>
	                    <option value="company-bio">'.__('Full-on About Us Page', 'bertha-ai').'</option>
	                    <option value="Company-mission">'.__('Company Mission & Vision', 'bertha-ai').'</option>
	                    <option value="personal-bio">'.__('Personal Bio (About Me)', 'bertha-ai').'</option>
	                    <option value="blog-post-idea">'.__('Blog Post Topic Ideas', 'bertha-ai').'</option>
	                    <option value="post-outline-idea">'.__('Blog Post Outline', 'bertha-ai').'</option>
	                    <option value="intro-para-idea">'.__('Blog Post Intro Paragraph', 'bertha-ai').'</option>
	                    <option value="conclusion-para-idea">'.__('Blog Post Conclusion Paragraph', 'bertha-ai').'</option>
	                    <option value="child-input">'.__('Explain It To a Child', 'bertha-ai').'</option>
	                    <option value="bertha-seo-title">'.__('SEO Title Tag', 'bertha-ai').'</option>
	                    <option value="bertha-seo-description">'.__('SEO Description Tag', 'bertha-ai').'</option>
	                    <option value="bertha-aida-marketing">'.__('AIDA Marketing Framework', 'bertha-ai').'</option>
	                    <option value="bertha-seo-city">'.__('SEO City Based Pages', 'bertha-ai').'</option>
	                    <option value="bertha-buisiness-name">'.__('Business or Product Name', 'bertha-ai').'</option>
	                    <option value="bertha-bridge">'.__('Before, After and Bridge', 'bertha-ai').'</option>
	                    <option value="bertha-pas-framework">'.__('PAS Framework', 'bertha-ai').'</option>
	                    <option value="bertha-faq-list">'.__('FAQs List', 'bertha-ai').'</option>
	                    <option value="bertha-faq-answer">'.__('FAQ Answers', 'bertha-ai').'</option>
	                    <option value="bertha-summary">'.__('Content Summary', 'bertha-ai').'</option>
	                    <option value="bertha-contact-blurb">'.__('Contact Form Blurb', 'bertha-ai').'</option>
	                    <option value="bertha-seo-keyword">'.__('SEO Keyword Suggestions', 'bertha-ai').'</option>
	                    <option value="bertha-evil-bertha">'.__('Evil Bertha', 'bertha-ai').'</option>
	                    <option value="bertha-real-eastate">'.__('Real Estate Property Listing Description', 'bertha-ai').'</option>
	                    <option value="bertha-press-blurb">'.__('Press Mention Blurb', 'bertha-ai').'</option>
	                    <option value="bertha-case-study">'.__('Case Study Generator (STAR Method)', 'bertha-ai').'</option>
	                  </select>
	                  <div class="idea-history">'.get_bertha_history_ideas().'</div>
	              </div>
	              <div class="ber-tab-pane ber-fade" id="favourite" role="tabpanel" aria-labelledby="favourite-tab">
	                <div class="ber-offcanvas-title">'.__('Favourite Ideas', 'bertha-ai').'</div>
	                <div class="ber_inner_p">'.__('Every Favourite idea has added is saved here for easy re-use.', 'bertha-ai').'</div>
	                  <div class="favourite-idea">'.get_bertha_favourite_ideas().'<div class="ber-overlay"></div></div>
	              </div>
	              <div class="ber-tab-pane ber-fade" id="backedn" role="tabpanel" aria-labelledby="backedn-tab">
	                <div class="ber-offcanvas-title">'.__('Long Form Drafts', 'bertha-ai').'</div>
	                <div class="ber_inner_p">'.__('Every Long Form Draft is saved in your history so that you may re use as you wish', 'bertha-ai').'</div>
	                  <div class="bertha-backend-content">'.get_bertha_backedn_drafts().'<div class="ber-overlay"></div></div>
	              </div>
	            </div>';
	            echo $template;
			?>
			</div>
		<div class="ber_full_content">
			<form method="post">
				<?php wp_nonce_field( 'bertha_long_form', 'bertha_long_form_nonce' ); ?>
	      		<input id="bertha_backend_title" name="bertha_backend_title" placeholder="Draft Title" type="text" class="ber_title_field">
	      		<?php
	      			wp_editor( '' , 'bertha_backend_body', $settings = array(
					      'media_buttons' => false,
					      'quicktags' => false,
					      'tabindex' => 4,
					      'tinymce' => array(
					        'toolbar1' => 'bold, italic, underline, strikethrough, formatselect, alignleft, aligncenter, alignright, outdent, indent, bullist, numlist,',
					      ),
	    				) 
					); 
				?>
				<input type="hidden" name="edited_draft" id="edited_draft" value="">
				<div class="bertha_draft_format_notice" style="display:none;"><?php echo esc_html_e('For better results, please format the generated text before pushing the button again.', 'bertha-ai') ; ?></div>
				<button class="ber-btn ber-btn-primary wa-generate-long-form ber_half" id="wa-generate-long-form"><?php echo esc_html_e('Generate Text', 'bertha-ai'); ?></button>
				<button class="ber_ber-btn ber_icon wa-redo-long-form" id="wa-redo-long-form"><span><i class="ber-i-redo"></i></span></button>
	      		<button name="bertha_backend_body_save" type="submit" class="ber-btn bertha_sec_btn bertha_backend_body_save long-form ber_half"><?php echo esc_html_e('Save Changes', 'bertha-ai'); ?></button>
			</form>
			<div class="ber-overlay"></div>
		</div>
	</div>
</div>

		<?php
	}

	function bthai_license_cb() {
		$version = '';
		if(get_option('WEB_ACE_DASHBOARD_license_key')) {
			$license = get_option('WEB_ACE_DASHBOARD_license_key');
			$api_params = array(
				'edd_action' => 'get_version',
				'license'    => $license ? $license : '',
				'item_name'  => BTHAI_ITEM_NAME,
				'item_id'    => BTHAI_ITEM_ID,
				'version'    => BTHAI_VERSION,
				'slug'       => basename( __FILE__, '.php' ),
				'author'     => BTHAI_AUTHOR_NAME,
				'url'        => home_url(),
			);

			$request    = wp_remote_post( BTHAI_STORE_URL, array( 'timeout' => 15, 'sslverify' => true, 'body' => $api_params ) );

			if (!is_wp_error($request) && isset($request['body'])) {
				$version = json_decode($request['body']);
			}
		}

		$plugin_type = '';
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
	            $plugin_type = $data->bertha_plugin_type;
	        }
	    }

	    $long_form_redirect = ($plugin_type && $plugin_type != 'pro') ? esc_url(admin_url( 'admin.php?page=bertha-ai-want-more' )) : esc_url(admin_url( 'admin.php?page=bertha-ai-backend-bertha' ));
		?>
		<div class="ber_page_header">
			<div class="ber_logo_head">
				<img src="<?php echo plugin_dir_url( $this->file ); ?>assets/images/Bertha_icon_purple_line.svg" alt="Bertha Logo" class="bertha_logo" />
			</div>
			<div class="ber_title_head">
				<div class="ber_title"><?php echo esc_html_e('License Verification', 'bertha-ai'); ?></div> 
			</div>
			<div class="ber_menu_head">
				<a href="<?php echo $long_form_redirect; ?>">Long-Form</a> <a href="<?php echo esc_url(admin_url( 'admin.php?page=bertha-ai-general-setting' )); ?>">Settings</a> <a target="_blank" href="https://bertha.ai/support/?plugin=1">Support</a> <a target="_blank" href="https://bertha.ai/pricing/?plugin=1">Upgrade</a>
			</div>
		</div>
		<?php
	    echo '<div class="ber_page_wrap"><div id="icon-tools" class="icon32"></div>';
	    echo '<div class="ber_title">'.__('License Verification', 'bertha-ai').'</div>';
	    echo '<p class="ber_p_desc">'.__('Manage your license activation with 1 click.', 'bertha-ai').'</p>';

	    echo '<div>' . BTHAI_ITEM_NAME . ' - V' . BTHAI_VERSION . '</div>';
	    if ( $version && isset( $version->new_version ) ) {
	    	echo '<div>Latest Version : ' . esc_attr($version->new_version) . '</div>';
	    }

	    echo '<div id="poststuff">';

	    echo '<div id="post-body" class="metabox-holder columns-2">';

	    echo '<form method="POST">';

	    if( isset( $_POST['bertha_license_deactivate'] ) ) {

	    	if ( ! isset( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'bertha-license-setup' ) ) return;

	        // retrieve the license from the database
	        $license = trim(get_option('WEB_ACE_DASHBOARD_license_key'));


	        // data to send in our API request
	        $api_params = array(
	            'edd_action'=> 'deactivate_license',
	            'license'   => $license,
	            'item_id' => BTHAI_ITEM_ID, // the name of our product in EDD
	            'url'       => home_url()
	        );

	        // Call the custom API.
	        $response = wp_remote_post( BTHAI_STORE_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );
	        
	        // make sure the response came back okay
	        if ( is_wp_error( $response ) )
	            return false;

	        // decode the license data
	        $license_data = json_decode( wp_remote_retrieve_body( $response ) );
	        //print_r($response);die;     
	        // $license_data->license will be either "deactivated" or "failed"
	        //if( $license_data->license == 'deactivated' ) {
	            delete_option( 'WEB_ACE_DASHBOARD_license_status' );
	            delete_option( 'WEB_ACE_DASHBOARD_license_key' );
	            delete_option('WEB_ACE_DASHBOARD_license_data');

	            wp_clear_scheduled_hook( 'bertha_add_every_thirty_days' );
	            delete_option('bertha_reniewal_start');
	        //}

	    }

	    $license = get_option('WEB_ACE_DASHBOARD_license_key');
	    $status = get_option('WEB_ACE_DASHBOARD_license_status');
	    $expires = get_option('WEB_ACE_DASHBOARD_license_data');

	    wp_nonce_field( 'bertha-license-setup' );

	    echo '<div class="postbox bertha-license-container ber_nicebox">
                    <div class="ber_title">Plugin Licensing</div>
                    <div class="inside">';

	    if ($status !== false && $status == 'valid') {
	            echo '<p><span class="bertha_active" style="color:#0aaf3a;">' . __('License Active') . '</span></p>';
	            echo '<p>Expiry: ' . esc_attr($expires) . '</p>';
	            echo '<input type="submit" class="button-secondary bertha_deactivate_button" name="bertha_license_deactivate" value="'.__('Deactivate License', 'bertha-ai').'"/>';
	        } else {
	            $home_url = 'http://msh-subscription.loc/activate?activation_callback='.Base64_encode(home_url()).'&activation_item='.Base64_encode(BTHAI_ITEM_NAME).'&activation_item_id='.Base64_encode(BTHAI_ITEM_ID).'&activation_price_id='.Base64_encode(BTHAI_LICENSE_PRICE_ID).'&plugin=1';
	            echo '<a href="'.$home_url.'"><button type="button" class="ber_button bersavechanges" name="bersavechanges" access="false" id="ber_page4_save">'.__('Activate', 'bertha-ai').'</button></a>';
	        }
	    echo '</div></div>';

	    echo '</form>';

	    echo '</div>';
	    echo '</div>';

	    echo '</div>';
	}

	function bthai_want_more_cb() {
		?>
			<div class="ber_page_header">
				<div class="ber_logo_head">
					<img src="<?php echo plugin_dir_url( $this->file ); ?>assets/images/Bertha_icon_purple_line.svg" alt="Bertha Logo" class="bertha_logo" />
				</div>
				<div class="ber_title_head">
					<div class="ber_title"><?php echo esc_html_e('Want More? Here\'s What You\'re Missing', 'bertha-ai'); ?></div> 
				</div>
				<div class="ber_menu_head">
					<a class="ber_current_page" href="#"><?php echo esc_html_e('Long-Form', 'bertha-ai'); ?></a> <a href="<?php echo esc_url(admin_url( 'admin.php?page=bertha-ai-general-setting' )); ?>"><?php echo esc_html_e('Settings', 'bertha-ai'); ?></a> <a target="_blank" href="https://bertha.ai/support/?plugin=1"><?php echo esc_html_e('Support', 'bertha-ai'); ?></a> <a target="_blank" href="https://bertha.ai/pricing/?plugin=1"><?php echo esc_html_e('Upgrade', 'bertha-ai'); ?></a>
				</div>
			</div>
			<div class="ber_page_wrap">
				<div class="ber_settings_form">
					<p class="ber_p_desc"><?php echo esc_html_e('While we try to be as genereous as possible with the Lite version of Bertha, what you are seeing is just the tip of the iceberg!', 'bertha-ai'); ?></p>
					<div class="ber_more_feature ber_nicebox">
						<div class="ber_more_feature_inner_left">
							<div class="ber_title"><?php echo esc_html_e('Long Form Content Generator', 'bertha-ai'); ?></div>
							<p class="ber_p_desc"><?php echo esc_html_e('Bertha\'s AI-Based Long Form content generator - Allowing you to click the button and generate full, SEO Driven, blog posts, articles, landing pages and any other type of long form content that you can imagine.', 'bertha-ai'); ?></p>
						<div class="ber_bullet"><span class="dashicons dashicons-yes-alt"></span><div class="ber_bullet_desc"><?php echo esc_html_e('The first Long form content generator that is fully automated allowing you to create full articles within minutes.', 'bertha-ai'); ?></div></div>
						<div class="ber_bullet"><span class="dashicons dashicons-yes-alt"></span><div class="ber_bullet_desc"><?php echo esc_html_e('Create quality, engaging content that will connect with your audience and increase your sales conversions.', 'bertha-ai'); ?></div></div>
						<div class="ber_bullet"><span class="dashicons dashicons-yes-alt"></span><div class="ber_bullet_desc"><?php echo esc_html_e('Add a whole new dimension to your business and provide a competitive edge against your competitors.', 'bertha-ai'); ?></div></div>
						</div>
						<div class="ber_more_feature_inner_right">
							<img class="ber_longform_gif" src="https://bertha.ai/wp-content/uploads/2021/12/BerLongFormGif.gif" alt="Long-Form Content Generator" /></div>					
					</div>
					<div class="ber_more_feature ber_nicebox">
						<div class="ber_more_feature_inner_left">
							<div class="ber_title"><?php echo esc_html_e('SEO Features', 'bertha-ai'); ?></div>
							<p class="ber_p_desc"><?php echo esc_html_e('We all know that SEO is important. Bertha AI works so well with all SEO for WordPress plugins, we know you are going to love optimising pages to be the absolute best they can be.', 'bertha-ai'); ?></p>
<div class="ber_bullet"><span class="dashicons dashicons-yes-alt"></span><div class="ber_bullet_desc"><?php echo esc_html_e('Whether it\'s Yoast, Rank Math, ALL in One SEO or any of your favorite SEO plugins. Bertha generated content will help you reach the right score for all of your content.', 'bertha-ai'); ?> </div></div>
						<div class="ber_bullet"><span class="dashicons dashicons-yes-alt"></span><div class="ber_bullet_desc"><?php echo esc_html_e('Stuck on what SEO suggestions you need? No more. Bertha has  been built just for you. With her suggestions,  you will surely rank higher than your competitors.', 'bertha-ai'); ?>
							</div></div>
						<div class="ber_bullet"><span class="dashicons dashicons-yes-alt"></span><div class="ber_bullet_desc"><?php echo esc_html_e('Get Bertha AI Pro today and change the way you write content for users, for search engines and to rank higher than ever before for blogs, landing pages, products and most importantly for local business listings too.', 'bertha-ai'); ?></div></div>						</div>
						<div class="ber_more_feature_inner_right">
							<img class="ber_img_more" src="https://bertha.ai/wp-content/uploads/2021/12/ber_SEO_templates-1.png" alt="SEO Related Content Templates" /></div>					
					</div>
					<div class="ber_more_feature ber_nicebox">
						<div class="ber_more_feature_inner_left">
							<div class="ber_title"><?php echo esc_html_e('More Words and Templates', 'bertha-ai'); ?></div>
							<p class="ber_p_desc"><?php echo esc_html_e('Bertha Pro gives you so much more. NO Commands or recipes to learn, no technical key stokes to complete. 
Simply tell Her what you want, where you want it and Voila! You have optimised content which needs only the slightest editing to ensure complete copy that your readers will love as much as the search engines.', 'bertha-ai'); ?> </p>
<div class="ber_bullet"><span class="dashicons dashicons-yes-alt"></span><div class="ber_bullet_desc"><?php echo esc_html_e('With more words, you can let Bertha free with creative suggestions. Create stunning descriptions, experiment and totally smash your Copy writing skills.', 'bertha-ai'); ?> </div></div>
						<div class="ber_bullet"><span class="dashicons dashicons-yes-alt"></span><div class="ber_bullet_desc"><?php echo esc_html_e('Bertha\'s Extra templates help you create a wide variety of content around your chosen subject matter. No more hesitation when trying to think of an AIDA or PAS description for your marketing copy.', 'bertha-ai'); ?> </div></div>
						<div class="ber_bullet"><span class="dashicons dashicons-yes-alt"></span><div class="ber_bullet_desc"><?php echo esc_html_e('Write FAQ\'s like a Pro and give your customers the guidance they need to purchase, make a decision or recommend your product or service over others.', 'bertha-ai'); ?> </div></div>
						</div>
						<div class="ber_more_feature_inner_right">
							<img class="ber_img_more" src="https://bertha.ai/wp-content/uploads/2021/12/ber_PRO_templates-1.png" alt="Additional Content Templates" /></div>			
					</div>
					<div class="ber_more_feature ber_nicebox">
						<div class="ber_more_feature_inner_left">
							<div class="ber_title"><?php echo esc_html_e('Premium Support', 'bertha-ai'); ?></div>
							<p class="ber_p_desc"><?php echo esc_html_e('We hear so often that Support lets down a great product. Our premium Pro Users get the fastest support possible and we have a 100% fix rate within 24 hours. It really is quite simple, great products deserve great support and Bertha gives her all, as do the people that are behind her!', 'bertha-ai'); ?></p>
<div class="ber_bullet"><span class="dashicons dashicons-yes-alt"></span><div class="ber_bullet_desc"><?php echo esc_html_e('Our team of WordPress and AI experts are happy to help with any question, wehter it\'s a Bertha related problem on the website or just some advice on how to get the most our of this amazing technology. As soon as you upgrade your account you have access to our quality support team.', 'bertha-ai'); ?></div></div>
						<div class="ber_bullet"><span class="dashicons dashicons-yes-alt"></span><div class="ber_bullet_desc"><?php echo esc_html_e('Bertha values you and we value her. Support is supplied via our premium options first and frankly, that is the way it should be.', 'bertha-ai'); ?></div></div>
						<div class="ber_bullet"><span class="dashicons dashicons-yes-alt"></span><div class="ber_bullet_desc"><?php echo esc_html_e('We love our mantra of customers come first and if you have an issue. You can use our support links here and if you are a free or Pro user, take advantage of joining our Facebook group and get peer to peer support as well as helpful tips and suggestions from our founders and Pro Users.', 'bertha-ai'); ?></div></div>
						</div>
						<div class="ber_more_feature_inner_right">
							<img class="ber_img_more" src="https://bertha.ai/wp-content/uploads/2021/12/ber_support.png" alt="Premium Support" /></div>			
					</div>
				</div>
				<div class="ber_settings_sidebar">
					<div class="ber_nicebox ber_unlock">
						<div class="ber_title"><img draggable="false" role="img" class="emoji" alt="🚀" src="https://s.w.org/images/core/emoji/13.1.0/svg/1f680.svg"><?php echo esc_html_e('Unlock Everything!', 'bertha-ai'); ?></div>
		        		<p><?php echo esc_html_e('Upgrade today to experience the true power of Bertha AI.', 'bertha-ai'); ?><</p>
		        		<a class="ber_btn" href="https://bertha.ai/pricing/?plugin=1" target="_blank">Get More With Bertha PRO</a>
						<div class="ber_did_it"><?php echo esc_html_e('The content on this page was generated with the help of Bertha\'s PRO Features.', 'bertha-ai'); ?></div>
		    		</div>
				</div>
			</div>
		<?php
	}

	function bthai_onboard_dashboard_callback() {
	    global $current_user;
	    $user_email = isset($_GET['email']) ? $_GET['email'] : '';
	    if($user_email) {
	    	$home_url = 'http://msh-subscription.loc/activate?activation_callback='.Base64_encode(home_url()).'&activation_item='.Base64_encode(BTHAI_ITEM_NAME).'&activation_item_id='.Base64_encode(BTHAI_ITEM_ID).'&activation_price_id='.Base64_encode(BTHAI_LICENSE_PRICE_ID).'&plugin=1&email='.Base64_encode($user_email);
	    } else {
    		$home_url = 'http://msh-subscription.loc/activate?activation_callback='.Base64_encode(home_url()).'&activation_item='.Base64_encode(BTHAI_ITEM_NAME).'&activation_item_id='.Base64_encode(BTHAI_ITEM_ID).'&activation_price_id='.Base64_encode(BTHAI_LICENSE_PRICE_ID).'&plugin=1';
    	}
		?>
		<div class="ber_wizard_wrap">
		    <div id="ber_page1" class="ber_wizard_page">
		        <div class="ber_title">Hey, <?php echo esc_attr($current_user->display_name); ?>!<br><?php echo esc_html_e('I\'m Bertha, your new writing assistant', 'bertha-ai'); ?></div>
		        <p class="ber_p_desc"><?php echo esc_html_e('Watch this short video to learn what I can do for you and your writing experience.', 'bertha-ai'); ?><br><?php echo esc_html_e('The more we get to know each other, the better results I can provide for you and your business', 'bertha-ai'); ?></p>
		        <iframe src="https://player.vimeo.com/video/592386362?h=1ad6666098" width="640" height="323" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
		        <div class="ber_form">
		            <div class="ber_form_group ber_savechanges">
		                <button type="button" class="ber_button bersavechanges" name="bersavechanges" access="false" id="ber_page1_save"><?php echo esc_html_e('Next', 'bertha-ai'); ?></button>
		            </div>
		        </div>
		    </div>
		    <div id="ber_page3" class="ber_wizard_page" style="display:none;">
		        <div class="ber_title"><?php echo esc_html_e('Your Brand Settings', 'bertha-ai'); ?></div>
		        <p class="ber_p_desc"><?php echo esc_html_e('This will be used to help Bertha generate content ideas that are unique to your brand and preferences.', 'bertha-ai'); ?></p>
		        <div class="ber_form">
		        	<?php wp_nonce_field( 'bertha_wizzard_setup_form', 'bertha_wizzard_setup_nonce' ); ?>
		            <div class="ber_form_group ber_brand">
		                <label for="berbrand" class="ber_label"><?php echo esc_html_e('Brand Name', 'bertha-ai'); ?><span class="ber_required">*</span><span class="ber-tooltip-element"  data-toggle="tooltip" data-placement="top" title="<?php echo esc_html_e('Your company or brand name', 'bertha-ai'); ?>">?</span></label>
		                <input type="text" class="ber_field" name="berbrand" access="false" id="berbrand" title="<?php echo esc_html_e('Your company or brand name', 'bertha-ai'); ?>" required="required" aria-required="true">
		            </div>
		            <div class="ber_form_group ber_description">
		                <label for="berdescription" class="ber_label"><?php echo  esc_html_e('Company Description', 'bertha-ai'); ?><span class="ber_required">*</span><span class="ber-tooltip-element" data-toggle="tooltip" data-placement="top" title="<?php echo esc_html_e('Describe what you do, where you started, your products or services and the benefits you bring to the market', 'bertha-ai'); ?>">?</span></label>
		                <textarea type="textarea" class="ber_field" name="berdescription" access="false" rows="10" id="berdescription" title="<?php echo  esc_html_e('Describe what you do, where you started, your products or services and the benefits you bring to the market', 'bertha-ai'); ?>" required="required" aria-required="true"></textarea>
		            </div>
		            <div class="ber_form_group ber_audience">
		                <label for="beraudience" class="ber_label"><?php echo esc_html_e('Ideal Customer', 'bertha-ai'); ?><span class="ber_required">*</span><span class="ber-tooltip-element" data-toggle="tooltip" data-placement="top" title="<?php echo esc_html_e('Describe the group/s of people you are serving or targeting', 'bertha-ai'); ?>">?</span></label>
		                <input type="text" class="ber_field" name="beraudience" access="false" id="beraudience" title="<?php echo esc_html_e('Describe the groups of people you are serving or targeting', 'bertha-ai'); ?>" required="required" aria-required="true">
		            </div>
		            <div class="ber_form_group ber-field-bersentiment">
		                <label for="bersentiment" class="ber_label"><?php echo esc_html_e('Tone of Voice', 'bertha-ai'); ?><span class="ber_required">*</span><span class="ber-tooltip-element" data-toggle="tooltip" data-placement="top" title="<?php echo esc_html_e('One word to describe the vibe you want Bertha to bring to your copy', 'bertha-ai'); ?>">?</span></label>
		                <input type="text" placeholder="Witty" class="ber_field" name="bersentiment" access="false" id="bersentiment" title="<?php echo esc_html_e('One word to describe the vibe you want Bertha to bring to your copy', 'bertha-ai'); ?>" required="required" aria-required="true">
		            </div>
		            <div class="ber_form_group ber_savechanges">
		                <button type="submit" class="ber_button bersavechanges" name="bersavechanges" access="false" id="ber_page3_save"><?php echo esc_html_e('Save Changes', 'bertha-ai'); ?></button>
		            </div>
		        </div>
		    </div>
		    <div id="ber_page4" class="ber_wizard_license ber_wizard_page" style="display:none;">
		        <div class="ber_title"><?php echo esc_html_e('Final Step, Let\'s Activate Your License', 'bertha-ai'); ?></div>
		        <p class="ber_p_desc"><?php echo esc_html_e('Click the button below to confirm your license and connect to Bertha\'s AI engine.', 'bertha-ai'); ?></p>
				<img src="<?php echo plugin_dir_url( $this->file ); ?>assets/images/Bertha_working.svg" alt="Bertha Working" class="bertha_working" />
		        <div class="ber_form">
		            <div class="ber_form_group ber_savechanges">
		                <a href="<?php echo esc_attr($home_url); ?>"><button type="button" class="ber_button bersavechanges" name="bersavechanges" access="false" id="ber_page4_save"><?php echo esc_html_e('Activate', 'bertha-ai'); ?></button></a>
		            </div>
		        </div>
			</div>
		</div>
		<?php
	}

	function bthai_onboard_free_dashboard_callback() {
		global $current_user;
	    $home_url = 'http://msh-subscription.loc/activate?activation_callback='.Base64_encode(home_url()).'&activation_item='.Base64_encode(BTHAI_ITEM_NAME).'&activation_item_id='.Base64_encode(BTHAI_ITEM_ID).'&activation_price_id='.Base64_encode(BTHAI_LICENSE_PRICE_ID);
		?>
		<div class="ber_wizard_wrap">
		    <div id="ber_page1" class="ber_wizard_page">
		        <div class="ber_title"><?php printf( esc_html__('Hey, %s!', 'bertha-ai'), $current_user->display_name); ?><br><?php echo esc_html_e("Let's get you on board!", "bertha-ai"); ?> 👋</div>
		        <p class="ber_p_desc"><?php echo esc_html_e('Bertha is excited to start and to become your helper in generating quality content for your WordPress website.', 'bertha-ai'); ?></p>
		        <div class="ber_form">
		            <div class="ber_form_group ber_brand">
		                <label for="berbrand" class="ber_label"><?php echo esc_html_e('First Name', 'bertha-ai'); ?><span class="ber_required">*</span></label>
		                <input type="text" class="ber_field" name="ber_free_name" access="false" id="ber_free_name" title="<?php echo esc_html_e('Your company or brand name', 'bertha-ai'); ?>" required="required" aria-required="true">
		            </div>
		            <div class="ber_form_group ber_brand">
		                <label for="berbrand" class="ber_label"><?php echo esc_html_e('Email', 'bertha-ai'); ?><span class="ber_required">*</span></label>
		                <input type="text" class="ber_field" name="ber_free_email" access="false" id="ber_free_email" title="<?php echo esc_html_e('Your company or brand name', 'bertha-ai'); ?>" required="required" aria-required="true">
		            </div>
		            <div class="ber_form_group ber_brand">
		            	<p for="ber_already_account" class="ber_label"><a href="<?php echo esc_url(admin_url( 'index.php?page=wa-onboard-dashboard' )); ?>"><?php echo esc_html_e('Already have an account', 'bertha-ai'); ?></a><span class="ber-tooltip-element" data-toggle="tooltip" data-placement="top" title="<?php echo esc_html_e('Choose Bertha everywhere if you want Bertha to appear in each text field. If not - choose to only have Bertha available when you click on the side bar.', 'bertha-ai'); ?>">?</span></p>
		            </div>
		        </div>
		        <div class="ber_form">
		            <div class="ber_form_group ber_savechanges">
		            	<?php wp_nonce_field( 'bertha_ber_create_form', 'bertha_ber_create_nonce' ); ?>
		                <button type="button" class="ber_button bersavechanges" name="ber_create_user" access="false" id="ber-create-user"><?php echo esc_html_e('Next', 'bertha-ai'); ?></button>
		            </div>
		        </div>
		    </div>
		    <div id="ber_page2" class="ber_wizard_page" style="display:none;">
		        <div class="ber_title"><?php echo esc_html_e('Help me get to know you better', 'bertha-ai'); ?></div>
		        <p class="ber_p_desc"><?php echo esc_html_e('I have just a few questions for you that will calibrate my engines and help me improve our collaborative experience.', 'bertha-ai'); ?><br><?php echo esc_html_e('This should take about 2 minutes.', 'bertha-ai'); ?></p>
		        <div class="ber_form">
		            <div class="ber_form_group field_ber_where">
		                <label for="ber_where" class="ber_label">
		                    <div><?php echo esc_html_e("I'm installing Bertha on the website of...", "bertha-ai"); ?></div><span class="ber_required">*</span></label>
		                <div class="ber_radio_group">
		                    <div class="ber_radio">
		                        <input class="ber_field ber_where ber_wizzard_main" name="ber_where" access="false" id="ber_where-0" required="required" aria-required="true" value="mine" type="radio">
		                        <label for="ber_where-0"><?php echo esc_html_e("My business / Myself", "bertha-ai"); ?></label>
		                    </div>
		                    <div class="ber_radio">
		                        <input class="ber_field ber_where ber_wizzard_main" name="ber_where" access="false" id="ber_where-1" required="required" aria-required="true" value="client" type="radio">
		                        <label for="ber_where-1"><?php echo esc_html_e('A client', 'bertha-ai'); ?></label>
		                    </div>
		                    <div class="ber_radio">
		                        <input class="ber_field ber_where ber_wizzard_main" name="ber_where" access="false" id="ber_where-2" required="required" aria-required="true" value="my-work" type="radio">
		                        <label for="ber_where-2"><?php echo esc_html_e('A company I work for', 'bertha-ai'); ?></label>
		                    </div>
		                    <div class="ber_radio">
		                        <input class="ber_field ber_where ber_wizzard_main" name="ber_where" access="false" id="ber_where-3" required="required" aria-required="true" value="someone-else" type="radio">
		                        <label for="ber_where-3"><?php echo esc_html_e('For someone else', 'bertha-ai'); ?></label>
		                    </div>
		                </div>
		            </div>
		            <div class="ber_form_group field_ber_what" style="display:none;">
		                <label for="ber_what" class="ber_label">
		                    <div><?php echo esc_html_e('The website is a...', 'bertha-ai'); ?></div><span class="ber_required">*</span></label>
		                <div class="ber_radio_group">
		                <div class="ber_radio">
		                    <input class="ber_field ber_what ber_wizzard_main" name="ber_what" access="false" id="ber_what-0" required="required" aria-required="true" value="business" type="radio">
		                    <label for="ber_what-0"><?php echo esc_html_e('Business website', 'bertha-ai'); ?></label>
		                </div>
		                <div class="ber_radio">
		                    <input class="ber_field ber_what ber_wizzard_main" name="ber_what" access="false" id="ber_what-1" required="required" aria-required="true" value="blog" type="radio">
		                    <label for="ber_what-1"><?php echo esc_html_e('Content website (blog/articles)', 'bertha-ai'); ?></label>
		                </div>
		                <div class="ber_radio">
		                        <input class="ber_field ber_what ber_wizzard_main" name="ber_what" access="false" id="ber_what-2" required="required" aria-required="true" value="shop" type="radio">
		                        <label for="ber_what-2"><?php echo esc_html_e('Ecommerce platform (WooCommerce)', 'bertha-ai'); ?></label>
		                    </div>
		                    <div class="ber_radio">
		                        <input class="ber_field ber_what ber_wizzard_main" name="ber_what" access="false" id="ber_what-3" required="required" asria-required="true" value="soemething_else" type="radio">
		                        <label for="ber_what-3"><?php echo esc_html_e('Something else', 'bertha-ai'); ?></label>
		                    </div>
		                    <input type="hidden" class="bertha-free-user" value=''>
		                </div>
		            </div>
		            <div class="ber_form_group ber_what_savechanges" style="display:none;">
		            	<?php wp_nonce_field( 'bertha_ber_free_create_form', 'bertha_ber_free_create_nonce' ); ?>
		                <button type="submit" class="ber_button bersavechanges" name="bersavechanges" access="false" id="ber_page2_save"><?php echo esc_html_e('Next', 'bertha-ai'); ?></button>
		            </div>
		        </div>
		    </div>
		</div>
		<?php
	}

}