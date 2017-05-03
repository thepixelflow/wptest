<?php 


function business_one_one_setup() {	

	global $content_width;
	if ( ! isset( $content_width ) ){
		$content_width = 663; 
	}
	
	load_theme_textdomain( 'business-one', get_template_directory() . '/lang' );
	
	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );	

	add_theme_support('custom-background');

	add_theme_support('custom-header');	

	add_theme_support( 'post-thumbnails' );	

	add_theme_support( 'title-tag' );

	register_nav_menus(array(
		'homepage-menu' => __('Homepage Top & Sticky Menu','business-one'),
		'top-menu' => __( 'Blog Menu', 'business-one' ),
		'footer-menu' => __( 'Footer Menu', 'business-one' ),
		));
	
}
add_action( 'after_setup_theme', 'business_one_one_setup' );




function business_one_scripts_styles() {
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	wp_enqueue_script('bootstrap',get_template_directory_uri().'/js/bootstrap.js',array('jquery'),'',true);

	wp_enqueue_script('imagesloaded',get_template_directory_uri().'/js/imagesloaded.js',array('jquery'),'',true);	

	wp_enqueue_script('slickslider',get_template_directory_uri().'/js/slick.js',array('jquery'),'',true);

	wp_enqueue_script('smoothscroll',get_template_directory_uri().'/js/smoothscroll.js',array('jquery'),'',true);

	wp_enqueue_script('masonry');

	wp_enqueue_script('fittext',get_template_directory_uri().'/js/fittext.js',array('jquery'),'',true);

	wp_enqueue_script('fitvids',get_template_directory_uri().'/js/fitvids.js',array('jquery'),'',true);

	wp_enqueue_script('parallax',get_template_directory_uri().'/js/parallax.js',array('jquery'),'',true);

	wp_enqueue_script('business-custom',get_template_directory_uri().'/js/business-custom.js',array('jquery','jquery-effects-core'),'',true);



	wp_enqueue_style( 'business-style', get_stylesheet_uri());

	wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/css/bootstrap.css');

	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/font-awesome.css');

	wp_enqueue_style( 'slick', get_template_directory_uri().'/css/slick.css');

	wp_enqueue_style( 'style', get_template_directory_uri().'/css/style.css');

	wp_enqueue_style( 'blog', get_template_directory_uri().'/css/blog.css');


	wp_enqueue_style('googleOpenSans','//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,600,700');
	
}
add_action( 'wp_enqueue_scripts', 'business_one_scripts_styles' );



function business_one_excerpt_length() {
	return 40;
}
add_filter( 'excerpt_length', 'business_one_excerpt_length');


function business_one_excerpt_more() {
	return ' .....';
}
add_filter('excerpt_more', 'business_one_excerpt_more');


function business_one_pagenavi(){
    global $wp_query;

    $big = 999999999;

    echo paginate_links( array(
      'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
      'format' => '?paged=%#%',
      'current' => max( 1, get_query_var('paged') ),
      'total' => $wp_query->max_num_pages,
      'prev_text'    => '<i class="fa fa-angle-left"></i>',
	  'next_text'    => '<i class="fa fa-angle-right"></i>'
    ) );

}




function business_one_sidebar(){


	register_sidebar(array(
		'id'          => 'sidebar',
	    'name'        => __( 'Blog Sidebar', 'business-one' ),
	    'description' => __( 'This widget is used for blog page.', 'business-one' ),
	    'before_widget' => '<div class="widget-wrap">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4><div class="widget-line"></div><div class="widget-content">',
		));

}



add_action('widgets_init','business_one_sidebar');




function business_one_menufb(){ ?>

	<nav class="col-sm-9 clearfix">
		
		<ul class="nav navbar-nav">
			
			<li><a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Home','business-one'); ?></a></li>

		</ul>

	</nav>

<?php }



function business_one_footerfb(){ ?>

	<nav class="col-sm-5">
		
		<ul class="nav">
			
			<?php wp_list_pages(array(

				'title_li' => '',
				'depth' => 1

			)); ?>

		</ul>

	</nav>

<?php }




function business_one_logo(){

	global $business;

	if(isset($business['logo']['url'])){ 

		if($business['logo']['url']){ ?>

			<a href="<?php echo esc_url(home_url('/')); ?>" class="u-photo" title="<?php bloginfo('name'); ?>">

				<img src="<?php echo $business['logo']['url']; ?>" alt="logo">

			</a>

	<?php } }

}




function businessone_fixed_menu(){ ?>


	<div class="fixed-menu">
				
		<div class="container">
					
			<div class="col-sm-3">
					
				<figure class="fixed-menu-logo">
							
					<?php business_one_logo(); ?>

				</figure>

			</div>


			<div class="col-sm-9">
						
				<?php wp_nav_menu(array(

					'theme_location' => 'homepage-menu',
					'menu_class' => 'nav navbar-nav',
					'container' => 'div',							
					'depth' => 2,
					'fallback_cb' => 'business_one_menufb'

				)); ?>

			</div>

		</div>

	</div> <!-- end fixed-menu -->


<?php }





/************************************************************************
// Redux Framework Calling
*************************************************************************/
require_once(get_template_directory() . '/admin/options-init.php');
require_once( get_template_directory().'/admin/tgm/tgm-init.php' );




/************************************************************************
// ACF
*************************************************************************/
define('ACF_LITE',true);


if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_client-image',
		'title' => 'Client Image',
		'fields' => array (
			array (
				'key' => 'field_53c77c9485561',
				'label' => 'Image',
				'name' => 'client_image',
				'type' => 'image',
				'instructions' => 'Upload a logo about the client. Maximum image height should be 100px.',
				'save_format' => 'object',
				'preview_size' => 'full',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'clients',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_contact-information',
		'title' => 'Contact Information',
		'fields' => array (
			array (
				'key' => 'field_53c7891764f20',
				'label' => 'Google Map',
				'name' => 'google_map',
				'type' => 'text',
				'instructions' => 'Put your shortcode of WP Google Map plugin here',
				'center_lat' => 39,
				'center_lng' => 42,
				'zoom' => 6,
				'height' => '',
			),
			array (
				'key' => 'field_53ca2423ef5da',
				'label' => 'Company Name',
				'name' => 'company_name',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'e.g : WordPress Inc',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53ca24c7ef5db',
				'label' => 'Address',
				'name' => 'address',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53ca2539ef5dc',
				'label' => 'City Name',
				'name' => 'city',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53ca2556ef5dd',
				'label' => 'Country Name',
				'name' => 'country',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53ca257bef5de',
				'label' => 'Postal Code',
				'name' => 'postal_code',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53ca2632ef5df',
				'label' => 'Phone Number',
				'name' => 'phone_number',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53ca272cef5e0',
				'label' => 'Fax',
				'name' => 'fax',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'section-contact.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_job-column',
		'title' => 'Job Column',
		'fields' => array (
			array (
				'key' => 'field_53c649fe8addd',
				'label' => 'Job Describe',
				'name' => 'job_describe_one',
				'type' => 'textarea',
				'instructions' => 'Explain what you do briefly',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'br',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'about',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_progress-bar-5',
		'title' => 'Progress Bar',
		'fields' => array (
			array (
				'key' => 'field_53ca607a17e28',
				'label' => 'Progress Bar Rate',
				'name' => 'progress_bar_rate_1',
				'type' => 'number',
				'default_value' => '',
				'placeholder' => 'e.g : 80',
				'prepend' => '',
				'append' => '',
				'min' => 5,
				'max' => 100,
				'step' => 5,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'skill',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_service-column',
		'title' => 'Service Column',
		'fields' => array (
			array (
				'key' => 'field_53c6be37c0daa',
				'label' => 'Image',
				'name' => 'image_1',
				'type' => 'image',
				'instructions' => 'Upload a image for service. Default height is 60px.',
				'save_format' => 'object',
				'preview_size' => 'full',
				'library' => 'all',
			),
			
			array (
				'key' => 'field_53c6c1fe3593a',
				'label' => 'Description',
				'name' => 'description_1',
				'type' => 'textarea',
				'instructions' => 'Description for Service',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'br',
			),
			array (
				'key' => 'field_53c6c2173593b',
				'label' => 'Link',
				'name' => 'link_1',
				'type' => 'text',
				'instructions' => 'Link for service page',
				'default_value' => '',
				'placeholder' => 'e.g : burak-aydin.com',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'services',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_social-media',
		'title' => 'Social Media',
		'fields' => array (
			array (
				'key' => 'field_53ca2e69ee8d4',
				'label' => 'Facebook',
				'name' => 'facebook',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53ca2e82ee8d5',
				'label' => 'Twitter',
				'name' => 'twitter',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53ca2e91ee8d6',
				'label' => 'WordPress.org',
				'name' => 'wordpress',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53ca2ea8ee8d7',
				'label' => 'Behance',
				'name' => 'behance',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53ca2eb0ee8d8',
				'label' => 'LinkedIn',
				'name' => 'linkedin',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53ca2ec5ee8d9',
				'label' => 'Digg',
				'name' => 'digg',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'section-contact.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_team-member',
		'title' => 'Team Member',
		'fields' => array (
			array (
				'key' => 'field_53c772ee05042',
				'label' => 'Image',
				'name' => 'team_image',
				'type' => 'image',
				'instructions' => 'Upload a team members\' photo.',
				'save_format' => 'object',
				'preview_size' => 'full',
				'library' => 'all',
			),
			array (
				'key' => 'field_53c7777305043',
				'label' => 'Name & Last Name',
				'name' => 'team_name',
				'type' => 'text',
				'instructions' => 'Type the team name and last name',
				'default_value' => '',
				'placeholder' => 'e.g : Burak Aydin',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53c7787b05044',
				'label' => 'Profession',
				'name' => 'profession',
				'type' => 'text',
				'instructions' => 'What do the team member do ?',
				'default_value' => '',
				'placeholder' => 'e.g : Developer',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53c7791305045',
				'label' => 'Facebook',
				'name' => 'facebook_link',
				'type' => 'text',
				'instructions' => 'Paste the social media link of the team member. ',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53c779c405046',
				'label' => 'Twitter',
				'name' => 'twitter_link',
				'type' => 'text',
				'instructions' => 'Paste the social media link of the team member. ',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53c779d605047',
				'label' => 'LinkedIn',
				'name' => 'linkedin_link',
				'type' => 'text',
				'instructions' => 'Paste the social media link of the team member. ',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'team',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	
}





function business_one_options(){ 

	global $business;		

		if(isset($business['favicon']['url'])){

		echo '<link rel="shortcut icon" href="'.esc_url($business['favicon']['url']).'">';
		
		}		

 ?> <style>

	<?php echo strip_tags($business['opt-ace-editor-css']); ?>

	<?php 

		if(isset($business['divider-bg']['url'])){

		if($business['divider-bg']['url']){

	 ?>

		.section-divider-one{
			background:url('<?php echo $business["divider-bg"]["url"]; ?>') center center no-repeat fixed;
		}

	<?php } } ?>


	<?php 

		if(isset($business['service-bg']['url'])){

		if($business['service-bg']['url']){

	 ?>

	.section-service{
				background: url('<?php echo $business["service-bg"]["url"]; ?>') center center no-repeat fixed;
			}

	<?php } } ?>


	<?php 

		if(isset($business['client-bg']['url'])){

		if($business['client-bg']['url']){ ?>


	.section-client{
				background: url('<?php echo $business["client-bg"]["url"]; ?>') center center no-repeat fixed;
			}


	<?php } } ?>	


	<?php if(get_header_image()){ ?>

		.custom-header{
			background:url('<?php header_image(); ?>') no-repeat center center fixed;
		}

	<?php } ?>


 </style> <?php 

	

}

add_action('wp_head','business_one_options');




function business_one_footer(){

	global $business;

	if(isset($business['opt-ace-editor-js'])){

		echo '<script>'.$business['opt-ace-editor-js'].'</script>';

	}
	
}

add_action('wp_footer','business_one_footer',30);


include_once(get_template_directory().'/admin/quick-info.php');