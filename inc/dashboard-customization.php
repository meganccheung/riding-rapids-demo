<?php

/**
 * Dashboard Customization.
 */
function rrc_remove_all_dashboard_metaboxes() {
    // Remove Welcome panel
    remove_action( 'welcome_panel', 'wp_welcome_panel' );
    // Remove the rest of the dashboard widgets
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
    remove_meta_box( 'health_check_status', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
    remove_meta_box( 'woocommerce_dashboard_recent_reviews', 'dashboard', 'normal');
    remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'normal');
}
add_action( 'wp_dashboard_setup', 'rrc_remove_all_dashboard_metaboxes' );

/**
 * Add a widget to the dashboard.
 *
 * This function is hooked into the 'wp_dashboard_setup' action below.
 */
function rrc_add_dashboard_widgets() {
    wp_add_dashboard_widget(
        'rrc_dashboard_welcome_widget',                          // Widget slug.
        esc_html__( 'Welcome', 'rrc' ), // Title.
        'rrc_dashboard_welcome_widget_render'                    // Display function.
	); 

    /* Right Side Widgets */

    // Tutorial 1: Adding and Editing Website Content
	add_meta_box( 
		'rrc_dashboard_tutorial_one_widget', 
		esc_html__( 'Tutorial: Adding and Editing Website Content', 'rrc' ), 
		'rrc_dashboard_tutorial_one_widget_render', 
		'dashboard', 
		'side', 'high'
    );
    
    // Tutorial 2: Editing Pages
	add_meta_box( 
		'rrc_dashboard_tutorial_two_widget', 
		esc_html__( 'Tutorial: Editing Page Content', 'rrc' ), 
		'rrc_dashboard_tutorial_two_widget_render', 
		'dashboard', 
		'side', 'high'
    );
    
    // Tutorial 3: Adding Media
	add_meta_box( 
		'rrc_dashboard_tutorial_three_widget', 
		esc_html__( 'Tutorial: Adding Media', 'rrc' ), 
		'rrc_dashboard_tutorial_three_widget_render', 
		'dashboard', 
		'side', 'high'
    );
    
    // Tutorial 4: Add or Edit Product
	add_meta_box( 
		'rrc_dashboard_tutorial_four_widget', 
		esc_html__( 'Tutorial: Add or Edit Product', 'rrc' ), 
		'rrc_dashboard_tutorial_four_widget_render', 
		'dashboard', 
		'side', 'high'
    );

	// Globalize the metaboxes array, this holds all the widgets for wp-admin.
    global $wp_meta_boxes;
     
    // Get the regular dashboard widgets array 
    // (which already has our new widget but appended at the end).
    $default_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
     
    // Backup and delete our new dashboard widget from the end of the array.
    $example_widget_backup = array( 'rrc_dashboard_welcome_widget' => $default_dashboard['rrc_dashboard_welcome_widget'] );
    unset( $default_dashboard['rrc_dashboard_welcome_widget'] );
  
    // Merge the two arrays together so our widget is at the beginning.
    $sorted_dashboard = array_merge( $example_widget_backup, $default_dashboard );
  
    // Save the sorted array back into the original metaboxes. 
    $wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
}
add_action( 'wp_dashboard_setup', 'rrc_add_dashboard_widgets' );

/**
 * Create the function to output the content of our Dashboard Widget.
 */
function rrc_dashboard_welcome_widget_render() {
	// Display whatever you want to show.
	?>
	 <style type="text/css">
	 	#rrc_dashboard_welcome_widget .dashboard-welcome-heading {
			font-size: 1.5rem;
			color: #0e5158;
		 }

		 #rrc_dashboard_welcome_widget .postbox-header {
			background-color: #082f33;
		 }
		 
		 #rrc_dashboard_welcome_widget .postbox-header h2 {
			color: #ffffff;
		 }
		 
	</style>

    <h3 class="dashboard-welcome-heading"><?php esc_html_e( "&#128075; Hello! Welcome to the Riding Rapids site manager.", "rrc" ); ?> </h3> 
    <p class="dashboard-welcome-message"><?php esc_html_e( "On the dashboard, you can view video tutorials showing how to add or edit content and tours. You can also view a summary of the bookings and sales in the WooCommerce Status widget.", "rrc" ); ?> </p> 
    <?php
}

function rrc_dashboard_tutorial_one_widget_render() {
	echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/oUhDWWDODzw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
}

function rrc_dashboard_tutorial_two_widget_render() {
	echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/v7IxwxFTtVM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
}

function rrc_dashboard_tutorial_three_widget_render() {
	echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/7V30XGKW_WE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
}

function rrc_dashboard_tutorial_four_widget_render() {
	echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/i_bGeBjRbXE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
}