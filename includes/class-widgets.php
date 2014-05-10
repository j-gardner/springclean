<?php
/**
 * Social Icons Widget
 *
 * @since 1.1.0
 */
class SpringClean_Social_Widget extends WP_Widget {
    /**
     * Holds widget settings defaults, populated in constructor.
     *
     * @var array defaults
     *
     * @since 1.1.0
     */
    protected $defaults = array();

    /**
     * Constructor. Set the default widget options and create widget.
     *
     * @since 1.1.0
     */
    function __construct() {
        $this->defaults = array(
            'title' => '',
            'tw'    => '',
            'gp'    => '',
            'fb'    => '',
            'li'    => '',
            'gh'    => '',
            'ig'    => ''
        );

        $widget_ops = array(
            'classname'     => 'springclean_social_widget',
            'description'   => __( 'Display social icons', 'springclean' ),
        );
        parent::__construct( 'springclean-social-links', __( 'SpringClean - Social Links', 'springclean' ), $widget_ops );
    }

    /**
     * Widget Display
     *
     * @param array $args
     * @param array $instance
     *
     * @since 1.1.0
     */
    function widget( $args, $instance ) {
        extract( $args, EXTR_SKIP );

        // Merge with defaults
        $instance = wp_parse_args( $instance, $this->defaults );

        // Before widget (defined by themes).
        echo $before_widget;

        // Title of widget (before and after defined by themes).
        if ( ! empty( $instance['title'] ) )
            echo $before_title . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $after_title;

        foreach ( $instance as $site => $url ) {

            switch ( $site ) {
                case 'tw' :
                    if ( ! empty( $url ) )
                        echo '<a class="fa fa-lg fa-twitter" href="' . esc_url( $url ) . '"></a>';
                    break;

                case 'fb' :
                    if ( ! empty( $url ) )
                        echo '<a class="fa fa-lg fa-facebook" href="' . esc_url( $url ) . '"></a>';
                    break;

                case 'gp' :
                    if ( ! empty( $url ) )
                        echo '<a class="fa fa-lg fa-google-plus-square" href="' . esc_url( $url ) . '"></a>';
                    break;

                case 'gh' :
                    if ( ! empty( $url ) )
                        echo '<a class="fa fa-lg fa-github-square" href="' . esc_url( $url ) . '"></a>';
                    break;

                case 'li' :
                    if ( ! empty( $url ) )
                        echo '<a class="fa fa-lg fa-linkedin" href="' . esc_url( $url ) . '"></a>';
                    break;

                case 'ig' :
                    if ( ! empty( $url ) )
                        echo '<a class="fa fa-lg fa-instagram" href="' . esc_url( $url ) . '"></a>';
                    break;
            }

        }

        // After widget (defined by themes).
        echo $after_widget;
    }

    /**
     * Update a particular instance.
     *
     * @param  array $new_instance New settings for this instance as input by the user via form()
     * @param  array $old_instance Old settings for this instance
     *
     * @return array Settings to save or bool false to cancel saving
     *
     * @since  1.1.0
     */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['tw'] = esc_url( $new_instance['tw'] );
        $instance['fb'] = esc_url( $new_instance['fb'] );
        $instance['li'] = esc_url( $new_instance['li'] );
        $instance['gp'] = esc_url( $new_instance['gp'] );
        $instance['gh'] = esc_url( $new_instance['gh'] );
        $instance['ig'] = esc_url( $new_instance['ig'] );


        return $instance;
   }

    /**
     * Widget form
     *
     * @param array $instance Current Settings
     *
     * @since 1.1.0
     */
    function form( $instance ) {

        /* Merge with defaults */
        $instance = wp_parse_args( $instance, $this->defaults ); ?>

        <!-- Title: Text Input -->
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'springclean' ); ?>:</label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
        </p>
        <!-- Twitter: Text Input -->
        <p>
            <label for="<?php echo $this->get_field_id( 'tw' ); ?>"><?php _e( 'Twitter', 'springclean' ); ?>:</label>
            <input id="<?php echo $this->get_field_id( 'tw' ); ?>" name="<?php echo $this->get_field_name( 'tw' ); ?>" type="text" value="<?php echo esc_attr( $instance['tw'] ); ?>" class="widefat" />
        </p>
        <!-- Facebook: Text Input -->
        <p>
            <label for="<?php echo $this->get_field_id( 'fb' ); ?>"><?php _e( 'Facebook', 'springclean' ); ?>:</label>
            <input id="<?php echo $this->get_field_id( 'fb' ); ?>" name="<?php echo $this->get_field_name( 'fb' ); ?>" type="text" value="<?php echo esc_attr( $instance['fb'] ); ?>" class="widefat" />
        </p>
        <!-- G+: Text Input -->
        <p>
            <label for="<?php echo $this->get_field_id( 'gp' ); ?>"><?php _e( 'Google Plus', 'springclean' ); ?>:</label>
            <input id="<?php echo $this->get_field_id( 'gp' ); ?>" name="<?php echo $this->get_field_name( 'gp' ); ?>" type="text" value="<?php echo esc_attr( $instance['gp'] ); ?>" class="widefat" />
        </p>
        <!-- GitHub: Text Input -->
        <p>
            <label for="<?php echo $this->get_field_id( 'gh' ); ?>"><?php _e( 'GitHub', 'springclean' ); ?>:</label>
            <input id="<?php echo $this->get_field_id( 'gh' ); ?>" name="<?php echo $this->get_field_name( 'gh' ); ?>" type="text" value="<?php echo esc_attr( $instance['gh'] ); ?>" class="widefat" />
        </p>
        <!-- Linkedin: Text Input -->
        <p>
            <label for="<?php echo $this->get_field_id( 'li' ); ?>"><?php _e( 'LinkedIn', 'springclean' ); ?>:</label>
            <input id="<?php echo $this->get_field_id( 'li' ); ?>" name="<?php echo $this->get_field_name( 'li' ); ?>" type="text" value="<?php echo esc_attr( $instance['li'] ); ?>" class="widefat" />
        </p>
        <!-- Instagram: Text Input -->
        <p>
            <label for="<?php echo $this->get_field_id( 'ig' ); ?>"><?php _e( 'Instagram', 'springclean' ); ?>:</label>
            <input id="<?php echo $this->get_field_id( 'ig' ); ?>" name="<?php echo $this->get_field_name( 'ig' ); ?>" type="text" value="<?php echo esc_attr( $instance['ig'] ); ?>" class="widefat" />
        </p>


        <?php
    }

}