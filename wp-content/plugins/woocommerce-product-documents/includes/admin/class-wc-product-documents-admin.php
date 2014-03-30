<?php
/**
 * WooCommerce Product Documents
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file license.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@skyverge.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade WooCommerce Product Documents to newer
 * versions in the future. If you wish to customize WooCommerce Product Documents for your
 * needs please refer to http://docs.woothemes.com/document/woocommerce-product-documents/ for more information.
 *
 * @package   WC-Product-Documents/Classes
 * @author    SkyVerge
 * @copyright Copyright (c) 2013-2014, SkyVerge, Inc.
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Admin class
 *
 * Load / saves admin settings
 *
 * @since 1.0
 */
class WC_Product_Documents_Admin {


	/**
	 * Setup admin class
	 *
	 * @since 1.0
	 */
	public function __construct() {

		// load filters after WC loads
		add_action( 'sv_wc_framework_plugins_loaded', array( $this, 'load_filters' ) );

		// load styles/scripts
		add_action( 'admin_enqueue_scripts', array( $this, 'load_styles_scripts' ) );

		// add product tab
		add_action( 'woocommerce_product_write_panel_tabs', array( $this, 'add_product_tab' ), 11 );

		// add product tab data
		add_action( 'woocommerce_product_write_panels', array( $this, 'add_product_tab_options' ), 11 );

		// save product tab data
		add_action( 'woocommerce_process_product_meta',   array( $this, 'save_product_tab_options' ) );
	}


	/**
	 * Add filters that require WC to be loaded first so the version can be checked and the proper filter used
	 *
	 * @since 1.0-1
	 */
	public function load_filters() {

		// add global settings & check what version of WC
		if ( SV_WC_Plugin_Compatibility::is_wc_version_gte_2_1() ) {

			add_filter( 'woocommerce_product_settings', array( $this, 'add_global_settings' ) );

		} else {

			add_filter( 'woocommerce_catalog_settings', array( $this, 'add_global_settings' ) );
		}

	}

	/**
	 * Inject global settings into the Settings > Catalog page, immediately after the 'Product Data' section
	 *
	 * @since 1.0-1
	 * @param array $settings associative array of WooCommerce settings
	 * @return array associative array of WooCommerce settings
	 */
	public function add_global_settings( $settings ) {

		if ( SV_WC_Plugin_Compatibility::is_wc_version_gte_2_1() ) {
			$setting_id = 'product_data_options';
		} else {
			$setting_id = 'product_review_options';
		}

		$updated_settings = array();

		foreach ( $settings as $setting ) {

			$updated_settings[] = $setting;

			if ( isset( $setting['id'] ) && $setting_id === $setting['id']
				 && isset( $setting['type'] ) && 'sectionend' === $setting['type'] ) {
				$updated_settings = array_merge( $updated_settings, self::get_global_settings() );
			}
		}

		return $updated_settings;
	}


	/**
	 * Returns the global settings array for the plugin
	 *
	 * @since 1.0
	 * @return array the global settings
	 */
	public static function get_global_settings() {

		return apply_filters( 'wc_product_documents_settings', array(
			// section start
			array(
				'name' => __( 'Product Documents', WC_Product_Documents::TEXT_DOMAIN ),
				'type' => 'title',
				'desc' => '',
				'id' => 'wc_product_documents_catalog_options',
			),

			// documents title text
			array(
				'title'    => __( 'Product Documents Default Title', WC_Product_Documents::TEXT_DOMAIN ),
				'desc_tip' => __( 'This text will be shown above the product documents section unless overridden at the product level.', WC_Product_Documents::TEXT_DOMAIN ),
				'id'       => 'wc_product_documents_title',
				'css'      => 'width:200px;',
				'default'  => __( 'Product Documents', WC_Product_Documents::TEXT_DOMAIN ),
				'type'     => 'text',
			),

			// section end
			array( 'type' => 'sectionend', 'id' => 'wc_product_documents_catalog_options' ),
		) );
	}


	/**
	 * Load admin js/css
	 *
	 * @since 1.0
	 * @param string $hook_suffix the current URL filename, ie edit.php, post.php, etc
	 */
	public function load_styles_scripts( $hook_suffix ) {

		global $wc_product_documents, $post_type;

		// load admin css/js only on edit product/new product pages
		if ( 'product' == $post_type && ( 'post.php' == $hook_suffix || 'post-new.php' == $hook_suffix ) ) {

			// requires image upload capability
			wp_enqueue_media();

			$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

			// admin CSS
			wp_enqueue_style( 'wc-product-documents-admin', $wc_product_documents->get_plugin_url() . '/assets/css/admin/wc-product-documents.min.css', array( 'woocommerce_admin_styles' ), WC_Product_Documents::VERSION );

			// admin JS
			wp_enqueue_script( 'wc-product-documents-admin', $wc_product_documents->get_plugin_url() . '/assets/js/admin/wc-product-documents' . $suffix . '.js', WC_Product_Documents::VERSION );

			wp_enqueue_script( 'jquery-ui-sortable' );

			// add script data
			$new_section  = $this->document_section_markup( new WC_Product_Documents_Section(), '{index}' );
			$new_document = $this->document_markup( new WC_Product_Documents_Document(), '{index}', '{sub_index}' );

			$wc_product_documents_admin_params = array(
				'new_section'                  => str_replace( array( "\n", "\t" ), '', $new_section ),  // cleanup the markup a bit
				'new_document'                 => str_replace( array( "\n", "\t" ), '', $new_document ),
				'confirm_remove_section_text'  => __( 'Are you sure you want to remove this section?', WC_Product_Documents::TEXT_DOMAIN ),
				'confirm_remove_document_text' => __( 'Are you sure you want to remove this document?', WC_Product_Documents::TEXT_DOMAIN ),
				'select_file_text'             => __( 'Select a File', WC_Product_Documents::TEXT_DOMAIN ),
				'set_file_text'                => __( 'Set File', WC_Product_Documents::TEXT_DOMAIN ),
			);

			wp_localize_script( 'wc-product-documents-admin', 'wc_product_documents_admin_params', $wc_product_documents_admin_params );
		}
	}


	/**
	 * Add 'Product Documents' tab to product data writepanel
	 *
	 * @since 1.0
	 */
	public function add_product_tab() {

		?><li class="wc-product-documents-tab<?php echo SV_WC_Plugin_Compatibility::is_wc_version_gte_2_1() ? '' : '-2-0-compat'; ?>"><a href="#wc-product-documents-data"><?php _e( 'Product Documents', WC_Product_Documents::TEXT_DOMAIN ); ?></a></li><?php

	}


	/**
	 * Add product documents options to product writepanel
	 *
	 * @since 1.0
	 */
	public function add_product_tab_options() {

		global $wc_product_documents, $post;

		$documents = new WC_Product_Documents_Collection( $post->ID );

		?><div id="wc-product-documents-data" class="panel woocommerce_options_panel">

			<?php
			// documents title
			woocommerce_wp_text_input(
				array(
					'id'          => '_wc_product_documents_title',
					'label'       => __( 'Product Documents Title', WC_Product_Documents::TEXT_DOMAIN ),
					'description' => __( 'This text optional will be shown as the title for the product documents element.', WC_Product_Documents::TEXT_DOMAIN ),
					'desc_tip'    => true,
				)
			);

			// show documents element on product page
			woocommerce_wp_checkbox(
				array(
					'id'          => '_wc_product_documents_display',
					'label'       => __( 'Show Product Documents', WC_Product_Documents::TEXT_DOMAIN ),
					'description' => __( 'Enable this to automatically display any documents for this product on the product page.  Product documents can also be displayed anywhere via the widget or shortcode.', WC_Product_Documents::TEXT_DOMAIN ),
					'default'     => 'yes',
				)
			);
			?>

			<div class="wc-metaboxes-wrapper">

				<p class="toolbar">
					<a href="#" class="close_all"><?php _e( 'Close all', WC_Product_Documents::TEXT_DOMAIN ); ?></a><a href="#" class="expand_all"><?php _e( 'Expand all', WC_Product_Documents::TEXT_DOMAIN ); ?></a>
				</p>

				<div class="wc-product-documents-sections wc-metaboxes">

					<?php
						// render all sections, even those without documents
						foreach ( $documents->get_sections( true ) as $index => $section ) :
							echo $this->document_section_markup( $section, $index );
						endforeach;
					?>

				</div>

				<div class="toolbar">
					<button type="button" class="button add-new-product-documents-section button-primary"><?php _e( 'New Section', WC_Product_Documents::TEXT_DOMAIN ); ?></button>
				</div>

			</div>

		</div>
		<?php
	}


	/**
	 * Returns the markup for a document section panel
	 *
	 * @since 1.0
	 * @param WC_Product_Documents_Section $section the section data
	 * @param int $index the section index
	 * @return string the document section markup
	 */
	public function document_section_markup( $section, $index ) {
		ob_start();

		?>
		<div class="wc-product-documents-section wc-metabox closed">
			<h3>
				<button type="button" class="remove-wc-product-documents-section button"><?php _e( 'Remove', WC_Product_Documents::TEXT_DOMAIN ); ?></button>
				<div class="handlediv" title="<?php _e( 'Click to toggle', WC_Product_Documents::TEXT_DOMAIN ); ?>"></div>
				<strong><?php _e( 'Name', WC_Product_Documents::TEXT_DOMAIN ); ?> &mdash;</strong> <input type="text" name="product_documents_section_name[<?php echo $index; ?>]" value="<?php echo esc_attr( $section->get_name() ); ?>" id="product_documents_section_name_<?php echo $index; ?>" class="product_documents_section_name" />
				<label for="product_documents_default_section_<?php echo $index; ?>" class="product-documents-default-section"><?php _e( 'Default', WC_Product_Documents::TEXT_DOMAIN ); ?></label><input type="radio" <?php checked( $section->is_default() ); ?> id="product_documents_default_section_<?php echo $index; ?>" class="product-documents-default-section" name="product_documents_default_section" value="<?php echo $index; ?>" />
				<input type="hidden" name="product_documents_section_position[<?php echo $index; ?>]" class="product-documents-section-position" value="<?php echo $index; ?>" />
				<input type="hidden" class="product-documents-section-index" value="<?php echo $index; ?>" />
			</h3>
			<div class="wc-metabox-content">
				<table class="widefat wc-product-documents">
					<thead>
						<tr>
							<th class="wc-product-document-draggable"></th>
							<th class="wc-product-document-label"><?php _e( 'Label', WC_Product_Documents::TEXT_DOMAIN ); ?></th>
							<th class="wc-product-document-file-location"><?php _e( 'Document Path/URL', WC_Product_Documents::TEXT_DOMAIN ); ?></th>
							<th class="wc-product-document-actions"><?php _e( 'Actions', WC_Product_Documents::TEXT_DOMAIN ); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php
						// render all documents, even those without a file location configured
						foreach ( $section->get_documents( true ) as $sub_index => $document ) :
							echo $this->document_markup( $document, $index, $sub_index );
						endforeach;
						?>
					</tbody>
					<tfoot>
						<tr>
							<th colspan="4">
								<button type="button" class="button button-secondary wc-product-documents-add-document"><?php _e( 'Add Document', WC_Product_Documents::TEXT_DOMAIN ); ?></button>
							</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
		<?php

		return ob_get_clean();
	}


	/**
	 * Returns the markup for a document row
	 *
	 * @since 1.0
	 * @param WC_Product_Documents_Document $document the document data
	 * @param int $index the section index
	 * @param int $sub_index the document index
	 * @return string the document row markup
	 */
	public function document_markup( $document, $index, $sub_index ) {
		global $wc_product_documents;

		ob_start();

		?>
		<tr class="wc-product-document">
			<td class="wc-product-document-draggable">
				<img src="<?php echo $wc_product_documents->get_plugin_url() ?>/assets/images/draggable-handle.png" />
			</td>
			<td class="wc-product-document-label">
				<input type="text" name="wc_product_document_label[<?php echo $index; ?>][<?php echo $sub_index; ?>]" value="<?php echo esc_attr( $document->get_label( true ) ); ?>" id="wc_product_document_label_<?php echo $index; ?>_<?php echo $sub_index; ?>" class="wc-product-document-label" />
				<input type="hidden" name="wc_product_document_position[<?php echo $index; ?>][<?php echo $sub_index; ?>]" class="wc-product-document-position" value="<?php echo $sub_index; ?>" />
				<input type="hidden" class="wc-product-document-sub-index" value="<?php echo $sub_index; ?>" />
			</td>
			<td class="wc-product-document-file-location">
				<input type="text" name="wc_product_document_file_location[<?php echo $index; ?>][<?php echo $sub_index; ?>]" class="wc-product-document-file-location" id="wc_product_document_file_location_<?php echo $index; ?>_<?php echo $sub_index; ?>" value="<?php echo esc_attr( $document->get_file_location() ); ?>" />
			</td>
			<td class="wc-product-document-actions">
				<button type="button" class="button wc-product-documents-set-file"><?php _e( 'Set File', WC_Product_Documents::TEXT_DOMAIN ); ?></button>
				<button type="button" class="button wc-product-documents-remove-document"><?php _e( 'Remove', WC_Product_Documents::TEXT_DOMAIN ); ?></button>
			</td>
		</tr>
		<?php

		return ob_get_clean();
	}


	/**
	 * Save product documents options at the product level
	 *
	 * @since 1.0
	 * @param int $post_id the ID of the product being saved
	 */
	public function save_product_tab_options( $post_id ) {

		// first save the simple settings:

		// documents title
		if ( isset( $_POST['_wc_product_documents_title'] ) )
			update_post_meta( $post_id, '_wc_product_documents_title', $_POST['_wc_product_documents_title'] );

		// render product documents on product page by default?
		update_post_meta(
			$post_id,
			'_wc_product_documents_display',
			isset( $_POST['_wc_product_documents_display'] ) && 'yes' === $_POST['_wc_product_documents_display'] ? 'yes' : 'no'
		);

		// then take care of any documents:
		$documents = new WC_Product_Documents_Collection();

		if ( ! empty( $_POST['product_documents_section_position'] ) && is_array( $_POST['product_documents_section_position'] ) ) {

			foreach ( $_POST['product_documents_section_position'] as $index => $position ) {

				// create the section object
				$section = new WC_Product_Documents_Section(
					$_POST['product_documents_section_name'][ $index ],
					isset( $_POST['product_documents_default_section'] ) && $index == $_POST['product_documents_default_section']
				);

				if ( ! empty( $_POST['wc_product_document_position'][ $index ] ) && is_array( $_POST['wc_product_document_position'][ $index ] ) ) {

					foreach ( $_POST['wc_product_document_position'][ $index ] as $sub_index => $document_position ) {

						// add the document object at the correct location
						$section->add_document(
							new WC_Product_Documents_Document(
								$_POST['wc_product_document_label'][ $index ][ $sub_index ],
								$_POST['wc_product_document_file_location'][ $index ][ $sub_index ]
							),
							$document_position
						);
					}

				}

				// add the document section at the correct position
				$documents->add_section( $section, $position );
			}

		}

		// persist the documents to the product
		$documents->save_to_product( $post_id );

	}


} // end \WC_Product_Documents_Admin class
