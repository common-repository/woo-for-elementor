<?php
/**
 * WooCommerce_For_Elementor setup
 *
 * @package  WooCommerce_For_Elementor
 * @since    1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Main WooCommerce_For_Elementor Class.
 *
 * @class WooCommerce_For_Elementor
 */
final class WooCommerce_For_Elementor {

	/**
	 * The single instance of the class.
	 *
	 * @var WooCommerce_For_Elementor
	 * @since 1.0.0
	 */
	protected static $_instance = null;

	/**
	 * Main WooCommerce_For_Elementor Instance.
	 *
	 * Ensures only one instance of WooCommerce_For_Elementor is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see WC()
	 * @return WooCommerce_For_Elementor - Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __clone() {
		wc_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'woocommerce-for-elementor' ), WFE_VERSION );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __wakeup() {
		wc_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'woocommerce-for-elementor' ), WFE_VERSION );
	}

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->includes();
		$this->init_hooks();

		do_action( 'woocommerce_for_elementor_loaded' );
	}

	/**
	 * Include required core files used in admin and on the frontend.
	 */
	public function includes() {
		require_once WFE_PATH . 'vendor/autoload.php';
	}

	/**
	 * Hook into actions and filters.
	 *
	 * @since 1.0.0
	 */
	private function init_hooks() {
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	}

	/**
	 * Init WooCommerce For Elementor when WordPress Initialises.
	 */
	public function init() {
		// Before init action.
		do_action( 'before_woocommerce_for_elementor_init' );

		// Set up localisation.
		$this->load_plugin_textdomain();

		add_action('elementor/init', [ $this, 'add_elementor_category' ], 1 );

		add_action('elementor/frontend/after_register_styles', [ $this, 'register_frontend_styles' ], 10 );

		add_action('elementor/frontend/after_register_scripts', [ $this, 'register_frontend_scripts' ], 10 );

		add_action('elementor/frontend/after_enqueue_styles', [ $this, 'enqueue_frontend_styles' ], 10 );

		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_elementor_widget' ] );

		// Init action.
		do_action( 'woocommerce_for_elementor_init' );
	}

	/**
	 * Add Elementor category.
	 */
	public function add_elementor_category() {
    \Elementor\Plugin::instance()->elements_manager->add_category(
      'wfe-elements',
      array(
				'title' => __('WooCommerce For Elementor', 'woocommerce-for-elementor'),
				'icon'  => 'fa fa-plug',
      ) );
	}

	/**
	 * Registers Widget.
	 */
	public function register_elementor_widget( $widgets_manager ) {
		$widgets_manager->register_widget_type( new WFE\Modules\Products() );
		$widgets_manager->register_widget_type( new WFE\Modules\Products_Slider() );
	}

	/**
   * Register Frontend Styles
   *
   */
  public function register_frontend_styles() {
    wp_register_style('wfe-frontend-styles', WFE_URL . 'assets/css/app.min.css', array(), WFE_VERSION );
  }

  /**
   * Enqueue Frontend Styles
   *
   */
  public function enqueue_frontend_styles() {
    wp_enqueue_style( 'wfe-frontend-styles' );
  }

  /**
   * Register Frontend Scripts
   *
   */
  public function register_frontend_scripts() {
    wp_register_script( 'jquery-slick', WFE_URL . 'assets/js/slick.min.js', array( 'jquery' ), WFE_VERSION );
    wp_register_script( 'wfe-frontend-scripts', WFE_URL . 'assets/js/app.min.js', array( 'jquery' ), WFE_VERSION );
  }

	/**
	 * Load Localisation files.
	 *
	 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
	 *
	 * Locales found in:
	 *      - WP_LANG_DIR/woocommerce-for-elementor/woocommerce-for-elementor-LOCALE.mo
	 *      - WP_LANG_DIR/plugins/woocommerce-for-elementor-LOCALE.mo
	 */
	public function load_plugin_textdomain() {
		$locale = is_admin() && function_exists( 'get_user_locale' ) ? get_user_locale() : get_locale();
		$locale = apply_filters( 'plugin_locale', $locale, 'woocommerce-for-elementor' );

		unload_textdomain( 'woocommerce-for-elementor' );
		load_textdomain( 'woocommerce-for-elementor', WP_LANG_DIR . '/woocommerce-for-elementor/woocommerce-for-elementor-' . $locale . '.mo' );
		load_plugin_textdomain( 'woocommerce-for-elementor', false, plugin_basename( dirname( WFE_FILE ) ) . '/languages' );
	}

	/**
	 * Get the plugin url.
	 *
	 * @return string
	 */
	public function plugin_url() {
		return untrailingslashit( plugins_url( '/', WFE_FILE ) );
	}

	/**
	 * Get the plugin path.
	 *
	 * @return string
	 */
	public function plugin_path() {
		return untrailingslashit( plugin_dir_path( WFE_FILE ) );
	}

	/**
	 * Get the template path.
	 *
	 * @return string
	 */
	public function template_path() {
		return apply_filters( 'woocommerce_for_elementor_template_path', 'woocommerce-for-elementor/' );
	}
}
