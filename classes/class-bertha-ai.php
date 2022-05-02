<?php

class WA_Bertha_AI {

	private $plugin_url;
    public $plugin_path;
    public $license_key;
    public $price_id;
    public $dashboard_url;
    public $item_id;
    public $theme;

	public function __construct($file) {
		global $pagenow;
        $this->file = $file;
        $this->plugin_url = trailingslashit(plugins_url('', $plugin = $file));
        $this->plugin_path = trailingslashit(dirname($file));
        $this->license_key = BTHAI_LICENSE_KEY;
        $this->price_id = BTHAI_LICENSE_PRICE_ID;
        $this->dashboard_url = BTHAI_STORE_URL;
        $this->item_id = BTHAI_ITEM_ID;
        $this->theme = wp_get_theme();
        $this->current_page = isset($_GET['page']) ? sanitize_text_field($_GET['page']) : '';

        add_action('init', array(&$this, 'bthai_init'), 0);
        add_action('wp_head', array(&$this, 'bthai_noindex_for_companies'));
        add_filter( 'http_request_timeout', array(&$this, 'bthai_wp9838c_timeout_extend' ));
        add_action('admin_footer', array(&$this, 'bthai_modal_content'));
        add_action('wp_footer', array(&$this, 'bthai_modal_content'));
        add_action('admin_init', array(&$this, 'bthai_setup_wizard_callback'));
        add_filter('post_type_link', array(&$this, 'bthai_filter_post_type_link'), 10, 2);
        add_action('elementor/editor/after_enqueue_scripts', array(&$this, 'bthai_scripts'));
		add_action('elementor/editor/after_enqueue_scripts', array(&$this, 'bthai_admin_scripts')); 
		if ( 'Divi' == $this->theme->name || 'Divi' == $this->theme->parent_theme || isset($_GET['fl_builder']) || isset($_GET['ct_builder']) || isset($_GET['tve']) ) {
		    if ( isset($_GET['fl_builder']) || isset($_GET['ct_builder']) || isset( $_GET['et_fb'] ) || ( isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'et_fb_ajax_render_shortcode' ) || isset($_GET['tve']) ) {
		        add_action('wp_enqueue_scripts', array(&$this, 'bthai_admin_scripts'), 99999);
		        add_action('wp_enqueue_scripts', array(&$this, 'bthai_scripts'), 99999);
		    }
		}
		if( !in_array( $this->current_page, array( 'bertha-ai-backend-bertha', 'bertha-ai-general-setting' ) ) ) {
		    add_action('wp_enqueue_scripts', array(&$this, 'bthai_admin_scripts'), 99999);
		    add_action('admin_enqueue_scripts', array(&$this, 'bthai_admin_scripts'), 99999);
		}
		add_action('wp_enqueue_scripts', array(&$this, 'bthai_scripts'));
		add_action('admin_enqueue_scripts', array(&$this, 'bthai_scripts'));
    }

    function bthai_init() {

    	if(isset($_GET['page']) && $_GET['page'] == 'bertha-ai-setting') {
    		wp_safe_redirect( esc_url(admin_url( 'admin.php?page=bertha-ai-general-setting' )) );
	    	exit;
    	}
    	$labels = array(
	        'name'                => __( 'Idea', 'Post Type General Name', 'bertha-ai' ),
	        'singular_name'       => __( 'Idea', 'Post Type Singular Name', 'bertha-ai' ),
	        'menu_name'           => __( 'Idea', 'bertha-ai' ),
	        'parent_item_colon'   => __( 'Parent Idea', 'bertha-ai' ),
	        'all_items'           => __( 'Ideas', 'bertha-ai' ),
	        'view_item'           => __( 'View Idea', 'bertha-ai' ),
	        'add_new_item'        => __( 'Add New Idea', 'bertha-ai' ),
	        'add_new'             => __( 'Add New', 'bertha-ai' ),
	        'edit_item'           => __( 'Edit Idea', 'bertha-ai' ),
	        'update_item'         => __( 'Update Idea', 'bertha-ai' ),
	        'search_items'        => __( 'Search Idea', 'bertha-ai' ),
	        'not_found'           => __( 'Not Found', 'bertha-ai' ),
	        'not_found_in_trash'  => __( 'Not found in Trash', 'bertha-ai' ),
	    );
	          
	    $args = array(
	        'label'               => __( 'Idea', 'bertha-ai' ),
	        'description'         => __( 'Idea', 'bertha-ai' ),
	        'labels'              => $labels,
	        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ), 
	        'taxonomies' => array( 'idea_template' ),
	        'hierarchical'        => false,
	        'public'              => false,
	        'show_ui'             => true,
	        'show_in_menu'        => false,
	        'show_in_ber-nav_menus'   => true,
	        'show_in_admin_bar'   => true,
	        'menu_position'       => 5,
	        'rewrite' => array( 'slug' => 'idea/%idea_template%', 'with_front' => FALSE ),
	        'can_export'          => true,
	        'has_archive'         => true,
	        'exclude_from_search' => true,
	        'publicly_queryable'  => true,
	        'capability_type'     => 'post',
	        'ber-show_in_rest' => true,
	 
	    );
        register_post_type( 'Idea', $args );

        $labels = array(
	        'name'                => __( 'Backedn', 'Post Type General Name', 'bertha-ai' ),
	        'singular_name'       => __( 'Backedn', 'Post Type Singular Name', 'bertha-ai' ),
	        'menu_name'           => __( 'Backedn', 'bertha-ai' ),
	        'parent_item_colon'   => __( 'Parent Backedn', 'bertha-ai' ),
	        'all_items'           => __( 'Backedn', 'bertha-ai' ),
	        'view_item'           => __( 'View Backedn', 'bertha-ai' ),
	        'add_new_item'        => __( 'Add New Backedn', 'bertha-ai' ),
	        'add_new'             => __( 'Add New', 'bertha-ai' ),
	        'edit_item'           => __( 'Edit Backedn', 'bertha-ai' ),
	        'update_item'         => __( 'Update Backedn', 'bertha-ai' ),
	        'search_items'        => __( 'Search Backedn', 'bertha-ai' ),
	        'not_found'           => __( 'Not Found', 'bertha-ai' ),
	        'not_found_in_trash'  => __( 'Not found in Trash', 'bertha-ai' ),
	    );
	          
	    $args = array(
	        'label'               => __( 'Backedn', 'bertha-ai' ),
	        'description'         => __( 'Backedn', 'bertha-ai' ),
	        'labels'              => $labels,
	        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ), 
	        'hierarchical'        => false,
	        'public'              => false,
	        'show_ui'             => true,
	        'show_in_menu'        => false,
	        'show_in_ber-nav_menus'   => true,
	        'show_in_admin_bar'   => true,
	        'menu_position'       => 5,
	        'can_export'          => true,
	        'has_archive'         => true,
	        'exclude_from_search' => true,
	        'publicly_queryable'  => true,
	        'capability_type'     => 'post',
	        'ber-show_in_rest' => true,
	 
	    );
        register_post_type( 'Backedn', $args );

    	register_taxonomy(
	        'idea_template',  // The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
	        'idea',             // post type name
	        array(
	            'hierarchical' => true,
	            'label' => 'Templates', // display name
	            'query_var' => true,
	            'rewrite' => array(
	                'slug' => 'idea',    // This controls the base slug that will display before each term
	                'with_front' => false  // Don't display the category base before
	            )
	        )
	    );

	    wp_insert_term( '🏆 Unique Value Proposition', 'idea_template', array(
	        'slug' => 'idea-usp',
	        'description' => 'That will make you stand out form the Crowd and used as the top sentence of your website.'
	    ) );
	    wp_insert_term( '💣 Blurb Generator', 'idea_template', array(
	        'slug' => 'idea-paragraph',
	        'description' => 'Great for getting over writers block: Craft creative short paragraphs fro different areas of your website in blog posts and pages.'
	    ) );
	    wp_insert_term( '🏹 Section Title Generator', 'idea_template', array(
	        'slug' => 'section-title',
	        'description' => 'Creative titles for each section of your website. No more boring "About us" type of titles.'
	    ) );
	    wp_insert_term( '💲 Product/Service Description', 'idea_template', array(
	        'slug' => 'product-service-description',
	        'description' => 'Perfect for e-commerce Stores.'
	    ) );
	    wp_insert_term( '🥈 Website Sub-Headline', 'idea_template', array(
	        'slug' => 'sub-headline',
	        'description' => 'A converting description that will go below your USP on the website - great for H2 Headings and SEO.'
	    ) );
	    wp_insert_term( '🏭 Full-on About Us Page (Company Bio)', 'idea_template', array(
	        'slug' => 'company-bio',
	        'description' => 'Bertha already knows you. She will write an overview, history, mission and vision for your company.'
	    ) );
	    wp_insert_term( '🚀 Company Mission & Vision', 'idea_template', array(
	        'slug' => 'Company-mission',
	        'description' => "From your company description, Bertha will write inspiring Mission and Vision statements for your 'About Us' page."
	    ) );
	    // wp_insert_term( '🥂 Testimonial Generator', 'idea_template', array(
	    //     'slug' => 'idea-testimonial',
	    //     'description' => 'Chasing clients to write testimonials is a pain. Generate them for them and ask their approval to use them.'
	    // ) );
	    wp_insert_term( '🥰 Service/Product Benefit List', 'idea_template', array(
	        'slug' => 'idea-benefit',
	        'description' => 'Instantly generate a list of differentiators and benefits for your own company and brand.'
	    ) );
	    wp_insert_term( '🎢 Content Rephraser', 'idea_template', array(
	        'slug' => 'content-improver',
	        'description' => 'Not confident with what you wrote? Paste it in and let Berthas magic make it all better.'
	    ) );
	    wp_insert_term( '🦚 Title to Benefit Sections', 'idea_template', array(
	        'slug' => 'benefit-title',
	        'description' => 'Take a benefit of your product/service and expand it to provide additional engaging details.'
	    ) );
	    wp_insert_term( '✔ Persuasive Bullet Points', 'idea_template', array(
	        'slug' => 'bullet-points',
	        'description' => 'Convince readers that your product is the best by listing all the reasons they should take action NOW.'
	    ) );
	    wp_insert_term( '😎 Personal Bio (About Me)', 'idea_template', array(
	        'slug' => 'personal-bio',
	        'description' => "Writing about ourselves is hard. It's not for Bertha - Let her do it for you and only fix what's needed."
	    ) );
	    wp_insert_term( '💡 Blog Post Topic Ideas', 'idea_template', array(
	        'slug' => 'blog-post-idea',
	        'description' => 'Trained with data from hundreds of thousands of blog posts, Bertha uses this data to generate a variety of creative blog post ideas.'
	    ) );
	    wp_insert_term( '🦅 Blog Post Intro Paragraph', 'idea_template', array(
	        'slug' => 'intro-para-idea',
	        'description' => 'Not sure how to start writing your next winning blog post? Bertha will get the ball rolling on taking your blog post topic and generate an intriguing intro paragraph.'
	    ) );
	    wp_insert_term( '🧐 Blog Post Outline', 'idea_template', array(
	        'slug' => 'post-outline-idea', 
	        'description' => "Map out your blog post's outline simply by adding the title or topic of the blog post you want to create. Bertha will take care of the rest."
	    ) );
	    wp_insert_term( '🦸‍♀️ Blog Post Conclusion Paragraph', 'idea_template', array(
	        'slug' => 'conclusion-para-idea',
	        'description' => 'Bertha can write a blog post conclusion paragraph that will help your visitors stick around to read the rest of your content.'
	    ) );
	    wp_insert_term( '🎯 Button Call to Action', 'idea_template', array(
	        'slug' => 'blog-action-idea',
	        'description' => "With Bertha, you can generate a call to action button that's guaranteed to convert. No more guessing what words will convert best!"
	    ) );
	    wp_insert_term( '👶 Explain It To a Child', 'idea_template', array(
	        'slug' => 'child-input',
	        'description' => 'Taking complex concepts and simplifying them. So that everyone can get it. Get it?'
	    ) );
	    wp_insert_term( '⛩️ SEO Title Tag', 'idea_template', array(
	        'slug' => 'bertha-seo-title',
	        'description' => 'Get highly optimized title tags that will help you rank higher in search engines.'
	    ) );
	    wp_insert_term( '✒️ SEO Description Tag', 'idea_template', array(
	        'slug' => 'bertha-seo-description',
	        'description' => 'You are serious about SEO, But this is a tedious task that can easily be automated with Bertha.'
	    ) );
	    wp_insert_term( '🍬 AIDA Marketing Framework', 'idea_template', array(
	        'slug' => 'bertha-aida-marketing',
	        'description' => 'Awareness > Interest > Desire > Action - Structure your writing and create more compelling content.'
	    ) );
	    wp_insert_term( '🏙 SEO City Based Pages', 'idea_template', array(
	        'slug' => 'bertha-seo-city',
	        'description' => 'Generate city page titles and descriptions for your city or town pages to help rank your website locally.'
	    ) );
	    wp_insert_term( '⚓ Business or Product Name', 'idea_template', array(
	        'slug' => 'bertha-buisiness-name',
	        'description' => 'Create a new business or product name from scratch based on a keyword or phrase.'
	    ) );
	    wp_insert_term( '🌉 Before, After and Bridge', 'idea_template', array(
	        'slug' => 'bertha-bridge',
	        'description' => 'Get a short description to build a page with a before and after look, with a transition in between.'
	    ) );
	    wp_insert_term( '🚥 PAS Framework', 'idea_template', array(
	        'slug' => 'bertha-pas-framework',
	        'description' => 'Problem > Agitate > Solution - A framework for planning and evaluating your content marketing activities.'
	    ) );
	    wp_insert_term( '🙋‍♀️ FAQs List', 'idea_template', array(
	        'slug' => 'bertha-faq-list',
	        'description' => 'Generate a list of frequently asked questions for a service or product.'
	    ) );
	    wp_insert_term( '😑 FAQ Answers', 'idea_template', array(
	        'slug' => 'bertha-faq-answer',
	        'description' => 'Get an anwser to a question.'
	    ) );
	    wp_insert_term( '🪐 Content Summary', 'idea_template', array(
	        'slug' => 'bertha-summary',
	        'description' => 'Create a summary of an article/website/blog post. Great for SEO and to share on social media.'
	    ) );
	    wp_insert_term( '🤝 Contact Form Blurb', 'idea_template', array(
	        'slug' => 'bertha-contact-blurb',
	        'description' => 'Create a short description & Call to Action that will be used as the final persuasion text next to a contact form.'
	    ) );
	    wp_insert_term( '🔑 SEO Keyword Suggestions', 'idea_template', array(
	        'slug' => 'bertha-seo-keyword',
	        'description' => 'Generate suggestions of long-tail keywords that are related to your topic.'
	    ) );
	    wp_insert_term( '😈 Evil Bertha', 'idea_template', array(
	        'slug' => 'bertha-evil-bertha',
	        'description' => 'Usaully Bertha is nice and friendly, but not always...'
	    ) );
	    wp_insert_term( '🏡 Real Estate Property Listing Description', 'idea_template', array(
	        'slug' => 'bertha-real-eastate',
	        'description' => 'Detailed and enticing property listings for your real estate websites. So you can focus on the sale.'
	    ) );
	    wp_insert_term( '📰 Press Mention Blurb', 'idea_template', array(
	        'slug' => 'bertha-press-blurb',
	        'description' => 'Provide the press mention title and publication to craft a press mention blurb.'
	    ) );
	    wp_insert_term( '👨‍🎓 Case Study Generator (STAR Method)', 'idea_template', array(
	        'slug' => 'bertha-case-study',
	        'description' => 'Generate a case study based on a client name and a problem they wanted to solve.'
	    ) );

	    $term = get_term_by('slug', 'idea-paragraph', 'idea_template');
	    wp_update_term( $term->term_id, 'idea_template', array('name' => '💣 Paragraph Generator') );
    }

    function bthai_modal_content() {
    	if(is_admin()) {
	    	echo '<div class="ber-modal ber-fade ber_modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				  <div class="ber-modal-dialog ber-modal-dialog-centered" role="document">
				    <div class="ber-modal-content">
				      <div class="ber-modal-body">
				        <div class="ber_inner_title">'.__('Click ', 'bertha-ai').'<u>'.__('Any', 'bertha-ai').'</u> '.__('Text Area Within Your Website To Start Generating Content', 'bertha-ai').'</div>
						<img src="'.plugin_dir_url( $this->file ).'assets/images/Bertha_start.gif" alt="Bertha Guide" class="bertha_gif" />
				      </div>
				      <div class="ber-modal-footer">
				        <button type="button" class="ber-btn ber-btn-primary bertha_close_modal" data-dismiss="ber-modal">'.__('Start Generating Content', 'bertha-ai').'</button>
				      </div>
				    </div>
				  </div>
				</div>';
		}
		echo '<div class="ber-modal ber-fade ber_modal" id="ber_idea_report_modal" tabindex="-1" role="dialog" aria-labelledby="berIdeaTitle" aria-hidden="true">
			  <div class="ber-modal-dialog ber-modal-dialog-centered" role="document">
			    <div class="ber-modal-content">
			    	<div class="ber-modal-header">
				        <div class="ber-modal-title" id="berIdeaLongTitle">
				        	<div class="ber-report-primary-title">'.__('Thanks for letting us know!', 'bertha-ai').'</div>
				        	<div class="ber-report-secondary-title">'.__('This is how we improve bertha', 'bertha-ai').'</div>
				        </div>
				        <button type="button" class="ber-report-btn-close ber-report-close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				    </div>
			      <div class="ber-modal-body">
			        <div class="ber_inner_title">'.__('What did you expect to happen?', 'bertha-ai').'</div>
					<textarea id="ber_report_body" name="ber_report_body" rows="6" cols="70"></textarea>
			      </div>
			      <div class="ber-modal-footer">
			        <button type="button" class="ber-btn ber-btn-primary ber_report_submit" data-dismiss="ber-modal">'.__('Send a report', 'bertha-ai').'</button>
			      </div>
			      <div class="ber-overlay"></div>
			    </div>
			  </div>
			</div>';
    }

    function bthai_setup_wizard_callback() {
    	/*free bertha*/
    	if(!get_option('bertha_setup_wizard_added')) {
	        update_option('bertha_setup_wizard_added', true);
	        wp_safe_redirect( esc_url(admin_url( 'index.php?page=wa-free-onboard-dashboard' )) );
	        exit;
	    }
	 	/*free bertha*/

	    if(isset($_GET['bertha_success_response']) && isset($_GET['bertha_key_expires'])) {
	    	$success_response = sanitize_text_field( base64_decode($_GET['bertha_success_response']) );
	    	$expire_key = sanitize_key( base64_decode($_GET['bertha_key_expires']) );
	        update_option('WEB_ACE_DASHBOARD_license_key', $success_response);
	        update_option('WEB_ACE_DASHBOARD_license_status', 'valid');
	        update_option('WEB_ACE_DASHBOARD_license_data', $expire_key);
	    } 

	    if ( is_plugin_active('wp-rocket/wp-rocket.php') ) {
	        $bthai_rocket_settings = get_option('wp_rocket_settings');
	        $bthai_rocket_settings['exclude_css'][] = plugin_dir_url( $this->file ) . 'assets/css/(.*).css';
	        $bthai_rocket_settings['exclude_js'][] = plugin_dir_url( $this->file ) . 'assets/js/(.*).js';
	        if(get_option('wp_bthai_check')==""){
	            update_option('wp_rocket_settings',$bthai_rocket_settings);
	            update_option('wp_bthai_check','true');
	        }
	    }
	}

	function bthai_wp9838c_timeout_extend( $time ) {
	    return 35;
	}

	function bthai_noindex_for_companies() {
	    if ( is_singular( 'idea' ) || is_tax('idea_template') ) {
	        return '<meta name="robots" content="noindex, follow">';
	    }
	}

	function bthai_filter_post_type_link( $link, $post ) {
	    if ( $post->post_type !== 'idea' )
	        return $link;

	    if ( $cats = get_the_terms($post->ID, 'idea_template') )
	        $link = str_replace('%idea_template%', array_pop($cats)->slug, $link);

	    return $link;
	}

	function bthai_scripts() {
	    $disabled = $ran_word1 = $ran_word2 = '';
	    if(function_exists('get_site_data_by_key')){
	    	$wpf_global_settings = get_site_data_by_key('wpf_global_settings');
        	$get_logoid = get_site_data_by_key('wpfeedback_logo');
			if ($wpf_global_settings == 'yes') {
				$logo_class = 'ber-atarim-head';
            	$get_logo_url = $get_logoid;
        	} else {
            	if($get_logoid!=''){
            		$logo_class = 'ber-atarim-head';
					$get_logo_url = $get_logoid;
            	} else{
            		$logo_class = '';
	                $get_logo_url = plugin_dir_url( $this->file ).'assets/images/Bertha_logo_white_small.svg';
	            }
        	}
	    } else {
	    	$logo_class = '';
	    	$get_logo_url = plugin_dir_url( $this->file ).'assets/images/Bertha_logo_white_small.svg';
	    }
	    $template = '<div class="ber-offcanvas ber-offcanvas-end bertha-ai" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" aria-labelledby="ber-offcanvasExampleLabel" id="bertha_canvas">
	            <div class="ber-offcanvas-header bertha-header '.$logo_class.'">
	            <button type="button" class="ber-btn-close ber-text-reset berthaclose" data-bs-toggle="offcanvas" aria-controls="offcanvasExample" href="#bertha_canvas"></button>
	                <div class="bertha_logo_container">
	                    <img src="'.$get_logo_url.'" alt="Bertha Logo" class="bertha_logo" />           
	                    
	                </div>
	                <div class="bertha_sidebar_heading">';
	    $disabled = $ran_word1 = $ran_word2 = '';
	    $plugin_type = $premium_tag = '';
	    $usp_version = $heading_version = $benefit_title_version = $title_version = $paragraph_version = $content_version = $service_version = $company_version = $company_mission_version =  $testimonial_version = $bullet_version = $personal_bio_version = $topic_ideas_version = $intro_para_version = $post_outline_version =  $conclusion_version = $action_version = $child_input_version = $benefit_list_version = $seo_title_version = $seo_description_version = $aida_marketing_version = $seo_city_version = $buisiness_name_version = $bridge_version = $pas_framework_version = $faq_list_version = $faq_answer_version = $summary_version = $contact_blurb_version = $seo_keyword_version = $evil_bertha_version = $real_estate_version = $press_blurb_version = $case_study_version = '';
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
	            if($plugin_type != 'pro') {
	            	$premium_tag = '<span class="bertha_power">'.__('Premium', 'bertha-ai').'</span>';
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
	            // $limit_percentage = ( $data->limit_used * 100 ) / $data->limit;
	            // $limit_percentage = $limit_percentage >= 0 ? $limit_percentage : 100;
	            // if($limit_percentage < 50) {
	            //     $meter = 'success';
	            // }elseif($limit_percentage >= 50 && $limit_percentage < 80) {
	            //     $meter = 'warning';
	            // }elseif($limit_percentage >= 80) {
	            //     $meter = 'danger';
	            // }
	        }
	        // $template .='<div class="ber_metrix_bar">';
	        if($data->limit_used >= $data->limit) {
	            //$template .=  '<a class="ber_btn" href="https://bertha.ai/ran-out-of-words/" target="_blank">Upgrade Now</a>';
	            $disabled = 'disabled';
	            $ran_word1 = '<a target="_blank" href="https://bertha.ai/ran-out-of-words/">';
	            $ran_word2 = '</a>';
	        } 
	        //else {
	        //     $template .= '<style>
	        //             .ber-progress-bar::after {
	        //                 content: "'.$data->limit_used.' / '.$data->limit.'";
	        //                  position: absolute;
	        //                 left: 50%;
	        //                 color: black;
	        //             }
	        //         </style>
	        //                 <div class="ber-progress">
	        //                   <div class="ber-progress-bar bg-'.$meter.'" role="ber-progressbar" style="width: '.$limit_percentage.'%" aria-valuenow="'.$limit_percentage.'" aria-valuemin="0" aria-valuemax="100"></div>
	        //                 </div>';
	        //     $disabled = '';
	        // }
	        // $template .= '</div>';
	    }
	  	$template .=  '
	                </div>
	            </div>
	            <div class="ber-offcanvas-body">
	                <div class="ber_icons_wrap">
	                    <button type="button" class="ber_icon bertha-back" style="display:none;"><span><i class="ber-i-chevron-left"></i></span></button>
	                    <button class="ber_ber-btn ber_icon ber-sidebar_expension"><span><i class="ber-i-arrows-expand-left-alt"></i></span></button>
	                </div>
	            <ul class="ber-nav ber-nav-tabs" id="myTab" role="tablist">
	              <li class="ber-nav-item" role="presentation">
	                <button class="ber-nav-link ber-active" id="templates-tab" data-bs-toggle="tab" data-bs-target="#templates" type="button" role="tab" aria-controls="templates" aria-selected="true">'.__('Templates', 'bertha-ai').'</button>
	              </li>
	              <li class="ber-nav-item" role="presentation">
	                <button class="ber-nav-link" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button" role="tab" aria-controls="history" aria-selected="false">'.__('History', 'bertha-ai').'</button>
	              </li>
	              <li class="ber-nav-item" role="presentation">
	                <button class="ber-nav-link" id="favourite-tab" data-bs-toggle="tab" data-bs-target="#favourite" type="button" role="tab" aria-controls="favourite" aria-selected="false">'.__('Favourites', 'bertha-ai').'</button>
	              </li>
	            </ul>
	            <div class="ber-tab-content" id="myTabContent">
	              <div class="ber-tab-pane ber-fade ber-show ber-active" id="templates" role="tabpanel" aria-labelledby="templates-tab">
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
	                                <label class="ber-btn bertha_template '.esc_attr($disabled).'" for="option19" data-id="blog"><span class="bertha_template_icon">🧐</span>'.__('Blog Post Outline', 'bertha-ai').''.esc_attr($post_outline_version).'<span class="bertha_template_desc">'.__('Map out your blog post\'s outline simply by adding the title or topic of the blog post you want to create. Bertha will take care of the rest.', "bertha-ai").'</span></label>
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
	                <div class="ber-offcanvas-title">'.__('Previously Created Content', 'bertha-ai').'</div>
	                <div class="ber_inner_p">'.__('Every output Bertha has generated is saved here for easy re-use.', 'bertha-ai').'</div>
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
	            </div>                
	            </div>';
			if($plugin_type && $plugin_type != 'pro') {
	            $template .= '<div class="ber-offcanvas-footer">
	                <a class="bertha_upgrade"href="https://bertha.ai/pricing/?plugin=1" target="_blank" rel="noopener"><span class="bertha_go_pro">'.__('Go PRO', 'bertha-ai').'</span><span class="bertha_go_pro_text">'.__('Unlock additional templates &amp; features to get more out of Bertha', 'bertha-ai').'</span></a><img src="'.plugin_dir_url( $this->file ).'assets/images/Bertha_hi_black.svg" alt="Bertha Upgrade" class="bertha_hi" />
	            </div>';
	        }
	        $template .= '</div>';
	    $current_page = isset($_GET['page']) ? sanitize_text_field($_GET['page']) : ''; 

	    if(function_exists('get_site_data_by_key')){
	    	$guest_mode_on = get_option('wpf_allow_guest');
	    } else { 
	    	$guest_mode_on = 'no';
	    }

	    if(is_admin() || is_user_logged_in() || $guest_mode_on == 'yes') {
		    wp_enqueue_style( 'divi-ssa', plugin_dir_url( $this->file ) . 'assets/css/ss.css', array(), '1.0' );
		    wp_enqueue_style( 'bertha-icon', plugin_dir_url( $this->file ) . 'assets/css/bertha-icons.css', array(), '1.0' );
		    wp_enqueue_style( 'divi-side1', plugin_dir_url( $this->file ) . 'assets/css/bertha-admin.css', array(), '1.0' );
		    wp_enqueue_style( 'divi-side3', plugin_dir_url( $this->file ) . 'assets/css/offcanvas.css', array(), '1.0' );
		    wp_enqueue_script( 'divi-ssajs11111', plugin_dir_url( $this->file ) . 'assets/js/typewriter.js', array(), '1.0' );
		    wp_enqueue_script( 'divi-ssajs1', plugin_dir_url( $this->file ) . 'assets/js/bertha-admin-min.js', array(), '1.0' );
	    	wp_enqueue_script( 'bertha-modal', plugin_dir_url( $this->file ) . 'assets/js/bertha-frontend-min.js', array(), '1.0' );
		    wp_enqueue_script( 'divi-ssajs111', plugin_dir_url( $this->file ) . 'assets/js/sidebars.js', array('jquery'), '1.0' );

		    wp_enqueue_script( 'bertha-setup', plugin_dir_url( $this->file ) . 'assets/js/setup.js', array('jquery', 'wp-editor', 'wp-data'), '1.0' );
		    wp_localize_script( 'bertha-setup', 'bertha_setup_object', array( 'ajax_url' => esc_url(admin_url( 'admin-ajax.php')), 'bertha_sound' => plugin_dir_url( $this->file ).'assets/js/Bertha_Typing.mp3', 'template_nonce' => wp_create_nonce('bertha_templates_nonce'), 'new_page' => esc_url(admin_url( 'post-new.php?post_type=page' )), 'admin_email' => get_bloginfo('admin_email'), 'nonce' => wp_create_nonce( 'wp_rest' ), 'wa_template' => $template, 'current_page' => $current_page, 'onboard_page' => esc_url(admin_url( 'index.php?page=wa-onboard-dashboard' )) ) );
		}

		wp_enqueue_style( 'bertha-modal', plugin_dir_url( $this->file ) . 'assets/css/bertha-modal.css', array(), '1.0' );
		/*lazy loading*/
		wp_enqueue_script( 'bertha-modalsss', plugin_dir_url( $this->file ) . 'assets/js/jquery.lazyscrollloading.js', array(), '1.0' );

	    if ( function_exists( 'get_admin_page_title' ) && get_admin_page_title() == 'Long Form Content' ) {
	    	wp_enqueue_script( 'bertha-backed-in', plugin_dir_url( $this->file ) . 'assets/js/backed-bertha.js', array(), '1.0' );
	    	wp_localize_script( 'bertha-backed-in', 'bertha_backedn_object', array( 'ajax_url' => esc_url(admin_url( 'admin-ajax.php')), 'draft_sound' => plugin_dir_url( $this->file ).'assets/js/Bertha_Typing.mp3', 'draft_nonce' => wp_create_nonce('bertha_draft_nonce'), 'edit_darft_nonce' => wp_create_nonce('bertha_templates_nonce')));
	    }

	}

	function bthai_admin_scripts() {
	    global $pagenow;
	    $current_user = wp_get_current_user();
	    $Setting = get_option('bertha_ai_license_options') ? (array) get_option('bertha_ai_license_options') : array();
	    $ber_everywhere = isset($Setting['bereverywhere']) ? esc_attr($Setting['bereverywhere']) : 'yes';

		$ber_select_users = isset($Setting['ber_select_users']) ? (array) ($Setting['ber_select_users']) : array('administrator');
		$ber_frontend_backend = isset($Setting['ber_frontend_backend']) ? (array) ($Setting['ber_frontend_backend']) : array('yes', 'no');

	    if(isset( $_GET['et_fb'] ) || isset( $_GET['vc_action'] )) {
	        $visual = 'true';
	    } else {
	        $visual = 'false';
	    }
	    if(function_exists('get_site_data_by_key')){
	    	$guest_mode_on = get_option('wpf_allow_guest');
	    } else { 
	    	$guest_mode_on = 'no';
	    }
	   	$is_divi = isset( $_GET['et_fb'] ) ?  'true' : 'false';
	    $is_beaver = isset($_GET['fl_builder']) ? 'true' : 'false';
	    $is_oxygen = isset($_GET['ct_builder']) ? 'true' : 'false';
	    $is_thrive = isset($_GET['tve']) ? 'true' :'flase';
	    $is_composer = isset($_GET['vcv-action']) ? 'true' :'flase';
	    $is_elementor = (isset($_GET['action']) && $_GET['action'] == 'elementor') ? 'true' :'flase';
	    $is_admin = is_admin() ? 'true' : 'false';
	    if(is_admin() || is_user_logged_in() || $guest_mode_on == 'yes') {
	    	if((in_array('yes', $ber_frontend_backend) && !is_admin()) || (in_array('no', $ber_frontend_backend) && is_admin())) {
		    	if( ($current_user->roles && !empty(array_intersect($current_user->roles, $ber_select_users))) ) {
			    	wp_enqueue_script( 'divi-ssajs', plugin_dir_url( $this->file ) . 'assets/js/ss.js', array('jquery'), '1.0' );
			    	wp_localize_script( 'divi-ssajs', 'bertha_object', array( 'ajax_url' => esc_url(admin_url( 'admin-ajax.php')), 'bertha_sound' => plugin_dir_url( $this->file ).'assets/js/Bertha_Typing.mp3', 'current_page' => $pagenow, 'is_visual' => $visual, 'is_divi' => $is_divi, 'is_beaver' => $is_beaver, 'is_oxygen' => $is_oxygen, 'is_thrive' => $is_thrive, 'is_composer' => $is_composer, 'ber_everywhere' => $ber_everywhere, 'is_elementor' => $is_elementor, 'is_admin' => $is_admin, 'guest_mode_on' => $guest_mode_on, 'is_user_logged_in' => is_user_logged_in() ) );
			    }
			}
		}
	}

}