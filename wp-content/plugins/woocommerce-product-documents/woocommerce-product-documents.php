<?php
/**
 * Plugin Name: WooCommerce Product Documents
 * Plugin URI: http://www.woothemes.com/products/woocommerce-product-documents/
 * Description: Adds a product documents element to WooCommerce product pages
 * Author: SkyVerge
 * Author URI: http://www.skyverge.com
 * Version: 1.1.1
 * Text Domain: woocommerce-product-documents
 * Domain Path: /i18n/languages/
 *
 * Copyright: (c) 2013-2014 SkyVerge, Inc. (info@skyverge.com)
 *
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 * @package   WC-Product-Documents
 * @author    SkyVerge
 * @copyright Copyright (c) 2013-2014, SkyVerge, Inc.
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Required functions
if ( ! function_exists( 'woothemes_queue_update' ) ) {
	require_once( 'woo-includes/woo-functions.php' );
}

// Plugin updates
woothemes_queue_update( plugin_basename( __FILE__ ), 'bc35cf9f51c735e4d6b2befe8ab048bb', '238848' );

// WC active check
if ( ! is_woocommerce_active() ) {
	return;
}

// Required library class
if ( ! class_exists( 'SV_WC_Framework_Bootstrap' ) ) {
	require_once( 'lib/skyverge/woocommerce/class-sv-wc-framework-bootstrap.php' );
}

SV_WC_Framework_Bootstrap::instance()->register_plugin( '2.0.2', __( 'WooCommerce Product Documents', 'woocommerce-product-documents' ), __FILE__, 'init_woocommerce_product_documents' );

function init_woocommerce_product_documents() {

/**
 * # WooCommerce Product Documents Main Plugin Class
 *
 * ## Plugin Overview
 *
 * This plugin adds the ability to add/manage documents (files) to WooCommerce
 * products and display the files in an accordion widget on the frontend.
 *
 * ## Admin Considerations
 *
 * This plugin adds a new global config section to WooCommerce > Settings >
 * Catalog named 'Product Documents' where the default title text for the product
 * documents element can be set.
 *
 * This plugin adds a new Product Data tab named "Product Documents" to the
 * Product admin edit page.  The product documents element default title can be
 * overridden for a particular product, and the documents element can be enabled
 * to automatically display on the product page.  Document "sections" can be
 * created and ordered, and documents (files) can be added to sections and also
 * ordered.
 *
 * ## Frontend Considerations
 *
 * Any documents and sections can be displayed on the product page for the product.
 * A shortcode named [woocommerce_product_documents] and a widget are available for
 * rendering the document list anywhere no the frontend.
 *
 * ## Database
 *
 * The product documents and sections are persisted as a postmeta with the
 * following data structure:
 *
 * Array (
 *   Array (
 *     name      => string Section name,
 *     default   => boolean true if section should be open by default,
 *     documents =>
 *       Array (
 *         Array (
 *           label         => string Displayed file name,
 *           file_location => string Path or URL to file
 *         )
 *       )
 *   )
 * )
 *
 * ### Product Postmeta
 *
 * + `_wc_product_documents_title` - Product documents title, used for the product
 *   documents element on the product page if _wc_product_documents_display is enabled,
 *   or as the default for the widget/shortcode if not set
 * + `_wc_product_documents_display` - If enabled a product documents element will be
 *   automatically rendered on the product page
 * + `_wc_product_documents` - Hold the product documents, see above section for data structure
 *
 * ### Global Settings
 *
 * + `wc_product_documents_title` - Default product documents section title
 */
class WC_Product_Documents extends SV_WC_Plugin {


	/** plugin version number */
	const VERSION = '1.1.1';

	/** plugin text domain */
	const TEXT_DOMAIN = 'woocommerce-product-documents';

	/** string the plugin id */
	const PLUGIN_ID = 'product_documents';

	/** @var WC_Product_Documents_Admin the plugin admin */
	private $admin;


	/**
	 * Initializes the plugin
	 *
	 * @since 1.0
	 */
	public function __construct() {

		parent::__construct(
			self::PLUGIN_ID,
			self::VERSION,
			self::TEXT_DOMAIN
		);

		// include required files
		$this->includes();

		// load templates
		add_action( 'init', array( $this, 'include_template_functions' ), 25 );

		// perform any tasks that require WC to be loaded
		add_action( 'woocommerce_init', array( $this, 'init' ) );

		// register widgets
		add_action( 'widgets_init', array( $this, 'register_widgets' ) );

		// display any product documents on the product pages
		add_action( 'woocommerce_single_product_summary', array( $this, 'render_product_documents' ), 25 );
	}


	/**
	 * Initialize the plugin
	 *
	 * @since 1.0
	 */
	public function init() {

		if ( ! is_admin() || ! defined( 'DOING_AJAX' ) ) {

			// add accordion shortcode
			add_shortcode( 'woocommerce_product_documents', array( $this, 'product_documents_shortcode' ) );
		}

	}


	/**
	 * Register product documents widgets
	 *
	 * @since 1.0
	 */
	public function register_widgets() {

		// load widget
		require_once( 'includes/widgets/class-wc-product-documents-widget-documents.php' );

		// register widget
		register_widget( 'WC_Product_Documents_Widget_Documents' );
	}


	/**
	 * Product Documents shortcode.  Renders the product documents UI element
	 *
	 * @since 1.0
	 * @param array $atts associative array of shortcode parameters
	 * @return string shortcode content
	 */
	public function product_documents_shortcode( $atts ) {

		require_once( 'includes/shortcodes/class-wc-product-documents-shortcode.php' );

		return SV_WC_Plugin_Compatibility::shortcode_wrapper( array( 'WC_Product_Documents_Shortcode', 'output' ) );
	}


	/**
	 * Include required files
	 *
	 * @since 1.0
	 */
	private function includes() {

		require_once( 'includes/class-wc-product-documents-collection.php' );

		if ( is_admin() ) {
			$this->admin_includes();
		}
	}


	/**
	 * Include required admin files
	 *
	 * @since 1.0
	 */
	private function admin_includes() {

		require_once( 'includes/admin/class-wc-product-documents-admin.php' );
		$this->admin = new WC_Product_Documents_Admin();
	}


	/**
	 * Handle localization, WPML compatible
	 *
	 * @since 1.0
	 * @see SV_WC_Plugin::load_translation()
	 */
	public function load_translation() {

		// localization in the init action for WPML support
		load_plugin_textdomain( 'woocommerce-product-documents', false, dirname( plugin_basename( __FILE__ ) ) . '/i18n/languages' );
	}


	/**
	 * Gets the plugin configuration URL
	 *
	 * @since 1.0-1
	 * @see SV_WC_Plugin::get_settings_url()
	 * @param string $_ unused
	 * @return string plugin settings URL
	 */
	public function get_settings_url( $_ = '' ) {

		if ( SV_WC_Plugin_Compatibility::is_wc_version_gte_2_1() ) {
			return admin_url( 'admin.php?page=wc-settings&tab=products' );
		} else {
			return admin_url( 'admin.php?page=woocommerce_settings&tab=catalog' );
		}
	}


	/**
	 * Function used to init WooCommerce Product Documents template functions,
	 * making them pluggable by plugins and themes.
	 *
	 * @since 1.0
	 */
	public function include_template_functions() {

		require_once( 'includes/wc-product-documents-template.php' );
	}


	/** Frontend methods ******************************************************/


	/**
	 * Renders any product documents
	 *
	 * @since 1.0
	 */
	public function render_product_documents() {

		global $post;

		if ( $this->render_documents_on_product_page( $post->ID ) ) {
			woocommerce_product_documents_template( $post->ID, $this->get_documents_title_text( $post->ID ) );
		}
	}


	/** Helper methods ******************************************************/


	/**
	 * Returns the plugin name, localized
	 *
	 * @since 1.1
	 * @see SV_WC_Plugin::get_plugin_name()
	 * @return string the plugin name
	 */
	public function get_plugin_name() {

		return __( 'WooCommerce Product Documents', self::TEXT_DOMAIN );
	}


	/**
	 * Returns __FILE__
	 *
	 * @since 1.1
	 * @see SV_WC_Plugin::get_file
	 * @return string the full path and filename of the plugin file
	 */
	protected function get_file() {

		return __FILE__;
	}


	/**
	 * Returns the documents title text for the identified product, if any
	 *
	 * @since 1.1
	 * @param int $product_id product identifier
	 * @return string documents title text
	 */
	public function get_documents_title_text( $product_id ) {

		// title configured for product?
		$title = get_post_meta( $product_id, '_wc_product_documents_title', true );

		// use global default
		if ( ! $title ) {
			$title = get_option( 'wc_product_documents_title' );
		}

		return $title;
	}


	/**
	 * Returns true if the product documents element should be rendered on the
	 * product page
	 *
	 * @since 1.0
	 * @param int $product_id product identifier
	 * @return boolean true if any product documents should be rendered on the product page
	 */
	public function render_documents_on_product_page( $product_id ) {

		return 'yes' == get_post_meta( $product_id, '_wc_product_documents_display', true );
	}


} // end \WC_Product_Documents class


/**
 * The WC_Product_Documents global object
 * @name $wc_product_documents
 * @global WC_Product_Documents $GLOBALS['wc_product_documents']
 */
$GLOBALS['wc_product_documents'] = new WC_Product_Documents();

} // init_woocommerce_product_documents()
