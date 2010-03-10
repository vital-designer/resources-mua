<?php

/**
* This is your child theme's functions.php file.
* You should make edits and add additional code above this point.
* Only change the functions below if you know what you're doing.
*/

/********************************************************/

// Load theme textdomain
	load_theme_textdomain( 'collage', get_stylesheet_directory() );

// Actions
	add_action( 'hybrid_after_page_nav', 'get_search_form' );
	add_action('hybrid_before_container', 'collage_splash');
	add_action( 'init', 'collage_initialize' );
	add_action( 'hybrid_after_content', 'collage_navigation_links' );
	add_action( 'wp_print_styles', 'collage_enqueue_style' );

// Filters
	add_filter( 'previous_post_link', 'collage_previous_post_link', 10, 2 );
	add_filter( 'next_post_link', 'collage_next_post_link', 10, 2 );
	add_filter( 'hybrid_entry_meta', 'collage_entry_meta' );
	add_filter( 'hybrid_byline', 'collage_remove_byline' );
	add_filter( 'breadcrumb_trail', 'collage_remove_breadcrumb' );
	add_filter( 'wp_page_menu_args', 'collage_page_menu_args' );
	add_filter( 'sidebars_widgets', 'collage_remove_widgets' );

/**
 * Initializing some stuff at the start of the theme.
 * Remove navigation links on archive pages.
 * Register Life Collage custom widget areas.
 *
 * @since 0.1
 */
function collage_initialize() {
	if ( !function_exists( 'wp_pagenavi' ) && !is_singular() )
		remove_action( 'hybrid_after_content', 'hybrid_navigation_links' );

	register_sidebar( array( 'name' => __('Utility: Splash', 'collage'), 'id' => 'utility-splash', 'before_widget' => '<div id="%1$s" class="widget %2$s widget-%2$s"><div class="widget-inside">', 'after_widget' => '</div></div>', 'before_title' => '<h3 class="widget-title">', 'after_title' => '</h3>' ) );
	register_sidebar( array( 'name' => __('Utility: Lifestream Template', 'collage'), 'id' => 'utility-lifestream', 'before_widget' => '<div id="%1$s" class="widget %2$s widget-%2$s"><div class="widget-inside">', 'after_widget' => '</div></div>', 'before_title' => '<h3 class="widget-title">', 'after_title' => '</h3>' ) );
}

/**
 * Function that handles the page menu arguments.
 * Sets the depth to 4 so we can have drop-downs.
 *
 * @since 0.1
 */
function collage_page_menu_args( $args ) {
	$args['depth'] = 4;
	return $args;
}

/**
 * Loads the stylesheet for the Lifestream template.
 *
 * @since 0.1
 */
function collage_enqueue_style() {
	if ( is_page_template( 'lifestream.php' ) )
		wp_enqueue_style( 'collage-lifestream', get_stylesheet_directory_uri() . '/lifestream.css', false, 0.1, 'screen' );
}

/**
 * Disables widget areas.
 * Remove Primary and Secondary for the Lifestream template.
 *
 * @since 0.1
 */
function collage_remove_widgets( $sidebars_widgets ) {

	if ( is_page_template( 'lifestream.php' ) ) :
		$sidebars_widgets['primary'] = false;
		$sidebars_widgets['secondary'] = false;
	endif;

	return $sidebars_widgets;
}

/**
 * Loads the 'splash' area above the content.
 * Load 'Utility: Splash' widgets.
 * Normally, we'd check for widgets before loading the containing
 * 'div', but here we want to show the splash area with or without
 * the widgets.
 *
 * @since 0.1
 */
function collage_splash() {
	echo '<div id="splash">';
		dynamic_sidebar( 'utility-splash' );
	echo '</div>';
	}

/**
 * Navigation links for archive-type pages.
 *
 * @since 0.1
 */
function collage_navigation_links() {
	if ( !function_exists( 'wp_pagenavi' ) && !is_singular() && !is_404() ) :
		echo '<div class="navigation-links">';
		posts_nav_link(
			'',
			'<span class="previous">' . __('Previous', 'collage') . '</span>',
			'<span class="next">' . __('Next', 'collage') . '</span>'
		);
		echo '</div>';
	endif;
}

/**
 * Filters the previous post link.
 *
 * @since 0.1
 */
function collage_previous_post_link($post_link_string, $link) {
	return '<span class="previous">' . preg_replace( "/>(.+?)</", '>' . __('Previous', 'collage') . '<', $link ) . '</span>';
}

/**
 * Filters the next post link.
 *
 * @since 0.1
 */
function collage_next_post_link($post_link_string, $link) {
	return '<span class="next">' . preg_replace( "/>(.+?)</", '>' . __('Next', 'collage') . '<', $link ) . '</span>';
}

/**
 * Filters the entry metadata of posts.
 * Since we're not using a byline with this theme, we need
 * to add the 'Edit' link to the metadata section.
 *
 * @since 0.1
 */
function collage_entry_meta( $metadata ) {

	if ( !is_page() && !is_attachment() && current_user_can( 'edit_posts' ) ) :
		$edit .= ' <span class="separator">|</span> <span class="edit"><a href="' . get_edit_post_link( $post->ID ) . '" title="' . __('Edit post', 'collage') . '">' . __('Edit', 'collage') . '</a></span>';
		$metadata = str_replace( '</p>', $edit . '</p>', $metadata );
	endif;

	return $metadata;
}

/**
 * Removes the byline for posts.
 *
 * @since 0.1
 */
function collage_remove_byline( $byline ) {
	return false;
}

/**
 * Removes the breadcrumb trail.
 *
 * @since 0.1
 */
function collage_remove_breadcrumb( $breadcrumb ) {
	return false;
}

?>