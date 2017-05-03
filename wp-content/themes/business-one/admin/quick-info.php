<?php 



function businessone_dashboard_widget(){

	add_meta_box('businessone-w1','Business One - WordPress Theme','businessone_dashboard_widget_cb','dashboard','normal','high');

}

add_action('wp_dashboard_setup','businessone_dashboard_widget');


function businessone_dashboard_widget_cb(){
	

	echo '<p><img src="'.get_template_directory_uri().'/img/logo.png"></p>';
	

	echo '<p>You\'re currently using <strong>Business One</strong> WordPress Theme by <a href="http://burak-aydin.com" target="_blank">Burak Aydin</a></p><hr>';

	echo "<br><h4><strong>Need Support ?</strong></h4> <p>Check documentation first how to setup the theme, and then look at my video tutorials. If you get stuck, please visit Support Center.</p>";


	echo '<p><a href="https://www.youtube.com/playlist?list=PLsP_GPLamHtdepCQ5e9r03i8i7V-D_pmJ" class="button-primary" target="_blank">Video Tutorials</a> <a href="https://wordpress.org/support/theme/business-one" class="button-primary" target="_blank">Support Forum</a></p><br><hr>';

	echo '<br><h4><strong>About me</strong></h4>';

	echo "<p>I'm a freelance Web Developer who passionate to make the web a better place. </p>";

	echo '<p><a href="http://themeforest.net/user/burakkaptan/portfolio" class="button-primary" target="_blank">My Premium Themes</a>
		<a href="https://profiles.wordpress.org/burakkaptan/#content-themes" class="button-primary" target="_blank">My Free Themes</a>
		</p><br><hr>';

	echo '<br><h4><strong>Stay in Touch</strong></h4>';

	echo '<p>
		<a href="https://twitter.com/buraksdu" target="_blank"><span class="dashicons-before dashicons-twitter"></span></a> '.str_repeat('&nbsp',4).' <a href="http://burak-aydin.com" title="My Personal Page" target="_blank"><span class="dashicons-before dashicons-admin-site"></span></a>

		</p>';	


}





function businessone_admin_notices(){ ?>

	<script>

		jQuery(function($){

			var ignore=0;

			$('.businessone-hide').on('click',function(e){

				e.preventDefault();
		    	$(this).closest('.updated').slideUp(300);
		    	$.ajax({
		    		type:'get',
		    		data:{
		    			businessone_ignore:ignore
		    		}
		    	});

			});

		});

	</script> 



	<?php 

	global $current_user ;

	$user_id = $current_user->ID;
	       
	if ( ! get_user_meta($user_id, 'businessone_ignore_notice') && current_user_can('manage_options')) {

	?>


	<div class="updated">
		
		<p style="float:right;"><a href="?businessone_ignore" class="businessone-hide" style="text-decoration:none;"><span class="dashicons dashicons-dismiss"></span></a></p>

		<h3>Welcome to <?php echo wp_get_theme('Business One'); ?> !</h3>

		<p>Thanks for using my theme. <br>I really appreciate your trust and hope you will enjoy using this theme as much as i have enjoyed creating it.</p>

		<p>Cheers, <br> <a href="http://burak-aydin.com" target="_blank">Burak Aydin</a></p>

		<h2 style="font-size:35px;">Quick Tips to Start with the Theme</h2>

		<ol>
			<li>Install and Activate recommended plugins. </li>
			<li>If you want to make your website like the demo, please download this dummy content: <a href="https://www.dropbox.com/s/durjd9mwop61bf6/businessone-dummy.zip?dl=0" target="_blank">Download</a> </li>
			<li>Upload <strong>businessone-dummy.xml</strong> by using WordPress default importer. <strong>redux_options.json</strong> is Redux Framework content.</li>			
			<li>You can also look at <a href="https://www.youtube.com/watch?v=OMG8ECZ3iM0" target="_blank">this video tutorial</a> how to install the theme and dummy content.</li>
			<li>If you want to learn more about the theme, please look at <a href="https://www.youtube.com/playlist?list=PLsP_GPLamHtdepCQ5e9r03i8i7V-D_pmJ" target="_blank">this playlist</a></li>
			<li>Go to <a href="<?php echo admin_url('admin.php?page=_options'); ?>">Business One Options</a> to start customization.</li>
			<li>If you have any question, please visit my <strong><a href="https://wordpress.org/support/theme/business-one" target="_blank">Support Forum</a></strong>.</li>
		</ol>	

	
	</div>

	<?php }

}

add_action('admin_notices','businessone_admin_notices',99);



function businessone_ignore() {

    global $current_user;

    $user_id = $current_user->ID;
     
    if ( isset($_GET['businessone_ignore'])) {
          add_user_meta($user_id, 'businessone_ignore_notice', 'true', true);
    }

}

add_action('admin_init', 'businessone_ignore');