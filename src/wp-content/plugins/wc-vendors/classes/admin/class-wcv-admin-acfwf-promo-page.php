<?php
/**
 * Class WCV_Admin_ACFWF_Promo_Page
 * Promotion page for Advanced Coupons for WooCommerce.
 *
 * @since 2.5.1
 */
class WCV_Admin_ACFWF_Promo_Page {

    /**
     * Is ACFWF installed.
     *
     * @since 2.5.1
     * @var bool $is_acfwf_installed
     */
    private $is_acfwf_installed;

    /**
     * Is ACFWF active.
     *
     * @since 2.5.1
     * @var bool $is_acfwf_active
     */
    private $is_acfwf_active;


    /**
     * ACFWF plugin file.
     *
     * @since 2.5.1
     * @var string $acfwf_plugin_file
     */
    private $acfwf_plugin_file;


    /**
     * Constructor.
     *
     * @since 2.5.1
     */
    public function __construct() {
        $this->acfwf_plugin_file  = 'advanced-coupons-for-woocommerce-free/advanced-coupons-for-woocommerce-free.php';
        $this->is_acfwf_installed = wcv_is_plugin_installed( $this->acfwf_plugin_file );
        $this->is_acfwf_active    = is_plugin_active( $this->acfwf_plugin_file );
        if ( ! $this->is_acfwf_installed || ( $this->is_acfwf_installed && ! $this->is_acfwf_active ) ) {
            add_action( 'admin_menu', array( $this, 'add_menu' ) );
        }
    }

    /**
     * Add menu.
     *
     * @since 2.5.1
     */
    public function add_menu() {
        add_submenu_page(
            'woocommerce-marketing',
            __( 'Advanced Coupons', 'advanced-coupons-for-woocommerce' ),
            __( 'Advanced Coupons', 'advanced-coupons-for-woocommerce' ),
            'manage_woocommerce',
            'advanced-coupons-promo',
            array( $this, 'output' )
        );
    }

    /**
     * Output.
     *
     * @since 2.5.1
     */
    public function output() {
        $is_plugin_installed = $this->is_acfwf_installed;
        $is_plugin_active    = $this->is_acfwf_active;
        include_once 'views/html-admin-acfwf-promo-page.php';
    }
}
