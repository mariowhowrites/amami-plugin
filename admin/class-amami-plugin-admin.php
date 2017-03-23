<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       ceibaweb.com
 * @since      1.0.0
 *
 * @package    Amami_Plugin
 * @subpackage Amami_Plugin/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Amami_Plugin
 * @subpackage Amami_Plugin/admin
 * @author     Mario Vega <mario@ceibaweb.com>
 */
class Amami_Plugin_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 *
	 * @param      string $plugin_name The name of this plugin.
	 * @param      string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Amami_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Amami_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/amami-plugin-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Amami_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Amami_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/amami-plugin-admin.js', array( 'jquery' ), $this->version, false );

	}

	function amami_register_carbon_fields() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/amami-register-carbon-fields.php';
	}

	function amami_after_save_post_meta( $post_id ) {
		$post_type = get_post_type( $post_id );
		switch ( $post_type ) {
			case "products":
				$title = carbon_get_post_meta( $post_id, 'product_title' );
				break;
			case "services":
				$title = carbon_get_post_meta( $post_id, 'service_title' );
				break;
			default:
				break;
		}

		if ( isset( $title ) ) {
			$post_id = wp_update_post(
				array(
					'ID'         => $post_id,
					'post_title' => strip_tags( $title )
				),
				true );

			if ( is_wp_error( $post_id ) ) {
				$errors = $post_id->get_error_messages();
				foreach ( $errors as $error ) {
					echo $error;
				}
			}
		}

	}

	function amami_register_rest_meta_fields() {
	    register_rest_field( 'documents', 'document_description', array(
	        'get_callback'  =>  function( $post ) {
	            $document_description   =   carbon_get_post_meta( $post['id'], 'document_description' );
	            return (string) $document_description;
            },
            'schema'    =>  array(
                'description'   =>  __( 'Document description' )
            )
        )
    );
}
}