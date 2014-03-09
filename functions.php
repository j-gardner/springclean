<?php
// Start Genesis
include_once( get_template_directory() . '/lib/init.php' );

// Set Child Theme info
define( 'CHILD_THEME_VERSION', '1.0.0' );
define( 'CHILD_THEME_NAME', 'SpringClean' );

// Add Theme Supports
add_theme_support( 'html5' );
add_theme_support( 'genesis-responsive-viewport' );
add_theme_support( 'post-formats', array( 'image', 'link', 'quote', 'video' ) );

// Remove Theme Supports
remove_theme_support( 'genesis-menus' );

// Remove unsupported layouts
genesis_unregister_layout( 'content-sidebar' );
genesis_unregister_layout( 'sidebar-content' );
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Remove unsupported sidebars
unregister_sidebar( 'sidebar' );
unregister_sidebar( 'sidebar-alt' );

// Actions
add_action( 'wp_enqueue_scripts', 'springclean_nq' );
add_action( 'genesis_entry_content', 'springclean_post_format_icons', 9 );
remove_action( 'genesis_meta', 'genesis_load_favicon' );

// Filters
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
add_filter( 'genesis_footer_backtotop_text', '__return_empty_string' );
add_filter( 'genesis_footer_creds_text', 'springclean_footer_creds' );



/**
 * Enqueue Scripts and Styles necessary for the theme
 *
 * @return null
 * @since  1.0.0
 */
function springclean_nq() {

    // Include Font Awesome
    wp_enqueue_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css', false, '4.0.3' );

    // Include Google Fonts
    wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Oxygen|Bitter', false, $CHILD_THEME_VERSION );

    // Include our JS menu file
    wp_enqueue_script( 'header-menu', get_stylesheet_directory_uri() . '/includes/js/menu.js', array( 'jquery' ), $CHILD_THEME_VERSION );

}

/**
 * Modify the footer credit text
 * 
 * @param  string $creds
 * @return string
 * @since  1.0.0
 */
function springclean_footer_creds( $creds ) {

    $t = '<a class="fa fa-twitter" href="http://twitter.com/j_gardner"></a>';
    $gp = '<a class="fa fa-google-plus-square" href="http://arcnx.co/gplus"></a>';
    $fb = '<a class="fa fa-facebook" href="http://facebook.com/jgardner4"></a>';
    $i = '<a class="fa fa-instagram" href="http://instagram.com/jgardner03"></a>';
    $li = '<a class="fa fa-linkedin" href="http://linkedin.com/in/jgardner4"></a>';
    $gh = '<a class="fa fa-github" href="http://arcnx.co/git"></a>';


    $creds = '<p>[footer_copyright] <a href="' . $CHILD_URL . '">John Gardner</a> &bull; Powered by <a href="http://wordpress.org">WordPress</a> &bull; Designed by <a href="http://arcnx.co/1">Arconix Computers</a> &bull; Hosted by <a href="http://arcnx.co/ix">IX Webhosting</a> &bull; [footer_loginout]</p>';
    $creds .= '<p>' . $t . $fb . $gp . $gh . $i . $li . '</p>';

    return $creds;
}


function springclean_post_format_icons() {

    $url = home_url();
    $format = get_post_format();

    switch( $format ) {

        case 'standard':
            echo '<a class="fa fa-lg fa-file-o" href="' . $url . '/type/' . $format . '"></a>';
            break;

        case 'image':
            echo '<a class="fa fa-lg fa-picture-o" href="' . $url . '/type/' . $format . '"></a>';
            break;

        case 'link':
            echo '<a class="fa fa-lg fa-link" href="' . $url . '/type/' . $format . '"></a>';
            break;

        case 'quote':
            echo '<a class="fa fa-lg fa-quote-left" href="' . $url . '/type/' . $format . '"></a>';
            break;

        case 'video':
            echo '<a class="fa fa-lg fa-video-camera" href="' . $url . '/type/' . $format . '"></a>';
            break;

        default:
            break;
    }

}
