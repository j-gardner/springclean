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
add_action( 'genesis_before_entry_content', 'springclean_tumblog_post_content' );
add_action( 'genesis_after_entry_content', 'springclean_tumblog_link', 5 );
remove_action( 'wp_head', 'genesis_load_favicon' );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

// Filters
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
add_filter( 'genesis_post_info', 'springclean_post_info' );
add_filter( 'genesis_footer_backtotop_text', '__return_empty_string' );
add_filter( 'genesis_footer_creds_text', 'springclean_footer_creds' );


/**
 * Modify the Post Info section
 * 
 * @param  string $info
 * @return string
 * @since  1.0.0
 */
function springclean_post_info( $info ) {
    $info = '[post_date format="F jS"] [post_edit before=" | "]';
    
    return $info;
}

/**
 * Enqueue Scripts and Styles necessary for the theme
 *
 * @since  1.0.0
 */
function springclean_nq() {
    // Include Font Awesome
    wp_enqueue_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css', false, '4.0.3' );

    // Include Google Fonts
    wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Oxygen|Bitter', false, $CHILD_THEME_VERSION );

    // Include our JS file
    wp_enqueue_script( 'springclean-js', get_stylesheet_directory_uri() . '/includes/js/script.js', array( 'jquery' ), $CHILD_THEME_VERSION );
}

/**
 * Modify the footer credit text
 * 
 * @param  string $creds
 * @return string
 * @since  1.0.0
 */
function springclean_footer_creds( $creds ) {
    $t = '<a class="fa fa-lg fa-twitter" href="http://twitter.com/j_gardner"></a>';
    $gp = '<a class="fa fa-lg fa-google-plus-square" href="http://arcnx.co/gplus"></a>';
    $fb = '<a class="fa fa-lg fa-facebook" href="http://facebook.com/jgardner4"></a>';
    $i = '<a class="fa fa-lg fa-instagram" href="http://instagram.com/jgardner03"></a>';
    $li = '<a class="fa fa-lg fa-linkedin" href="http://linkedin.com/in/jgardner4"></a>';
    $gh = '<a class="fa fa-lg fa-github-square" href="http://arcnx.co/git"></a>';

    $creds = '<p>' . $t . $fb . $gp . $gh . $i . $li . '</p>';
    $creds .= '<p>[footer_copyright] <a href="' . home_url() . '">' . get_bloginfo( 'name' ) . '</a> &bull; Designed by <a href="http://arconixpc.com">Arconix Computers</a> &bull; [footer_loginout]</p>';
    

    return $creds;
}

/**
 * Set up Post Format Font Awesome icons 
 * 
 * @since  1.0.0
 * @return return early if we're on a page
 */
function springclean_post_format_icons() {
    if ( is_page() )
        return;

    $format = get_post_format();
    $url = home_url();

    switch( $format ) {
        
        case '': // Standard posts (WP returns an empty string for the format)
        case 'standard': // For when WP finally fixes the format bug
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
            echo '<a class="fa fa-lg fa-youtube-play" href="' . $url . '/type/' . $format . '"></a>';
            break;

        default:
            echo '<!-- ' . $format . '-->';
            break;
    }
}

/**
 * Output WooTumblog Content
 * 
 * @since  1.0.0
 */
function springclean_tumblog_post_content() {
    if ( function_exists( 'woo_tumblog_content' ) )
        woo_tumblog_content( $return = false ); 
}

/**
 * Add the link URL below the entry content
 * 
 * @return null  return early if it's not a link format and woo_tumblog doesn't exist
 * @since  1.0.0
 */
function springclean_tumblog_link() {
    $format = get_post_format();

    if( $format != "link" )
        return;

    $url = esc_url( get_post_meta( get_the_id(), 'link-url', true ) );

    $r = '<div class="link-wrap"><a class="external" href="' . $url . '">Continue to Full Article</a></div>';

    echo $r;
}
