<?php

namespace Wpcafe_Oxygen_Addon;

defined( 'ABSPATH' ) || exit;

use Wpcafe_Oxygen_Addon\Autoloader;

/**
 * Autoload all classes
 */
require_once plugin_dir_path( __FILE__ ) . '/autoloader.php';

class Bootstrap{
    
    private static $instance;

    /**
     * Register action
     */
    public function __construct() {
        // load autoload method
        Autoloader::run();
    }

    public function init(){
        
        // activation and deactivation hook
        register_activation_hook( __FILE__, [$this, 'active'] );
        register_deactivation_hook( __FILE__, [$this, 'deactive'] );
        
        if ( ! function_exists( 'is_plugin_active' ) ){
            require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
        }
        
        if ( !is_plugin_active( 'wp-cafe/wpcafe.php' ) ) {
            add_action( 'admin_notices', [$this, 'notice_wpcafe_not_active'] );
            return;
        }

        if ( ! class_exists('OxyEl')){
			//Required Oxygen Plugin
			add_action( 'admin_notices', [$this, 'notice_oxygen_not_active'] );
            return;
		}

        //enqueue file
        \Wpcafe_Oxygen_Addon\Core\Enqueue\Enqueue::instance()->init();

        // load all elements
        $this->load_elements_files();

		// Register +Add wpcafe section
		add_action('oxygen_add_plus_sections', array($this, 'register_add_plus_section'));

		// Register +Add wpcafe subsections
		// oxygen_add_plus_{$id}_section_content
		add_action('oxygen_add_plus_wpcafe_section_content', array($this, 'register_add_plus_subsections'));

    }

	public function load_elements_files(){
		include_once \Wpcafe_Oxygen_Addon::plugin_dir().'elements/oxy_wpcafe_el.php';

		/**
		 * food Menu Elements
		 */
		include_once \Wpcafe_Oxygen_Addon::plugin_dir().'elements/food_menu_list.php';
		include_once \Wpcafe_Oxygen_Addon::plugin_dir().'elements/food_menu_tab.php';
		include_once \Wpcafe_Oxygen_Addon::plugin_dir().'elements/menu_filter_with_location.php';
		include_once \Wpcafe_Oxygen_Addon::plugin_dir().'elements/food_location_filter.php';
        
        //food Reservation
		include_once \Wpcafe_Oxygen_Addon::plugin_dir().'elements/reservation_form.php';

        if(class_exists('Wpcafe_Pro')){
            include_once \Wpcafe_Oxygen_Addon::plugin_dir().'elements/reservation_with_food.php';
            include_once \Wpcafe_Oxygen_Addon::plugin_dir().'elements/category_list_pro.php';
            include_once \Wpcafe_Oxygen_Addon::plugin_dir().'elements/food_menu_loadmore.php';
            include_once \Wpcafe_Oxygen_Addon::plugin_dir().'elements/business_hour_pro.php';
            include_once \Wpcafe_Oxygen_Addon::plugin_dir().'elements/menu_location_list_pro.php';
            include_once \Wpcafe_Oxygen_Addon::plugin_dir().'elements/menu_tab_with_slider.php';
            include_once \Wpcafe_Oxygen_Addon::plugin_dir().'elements/menu_slider_pro.php';
            include_once \Wpcafe_Oxygen_Addon::plugin_dir().'elements/food_menu_list_pro.php';
            include_once \Wpcafe_Oxygen_Addon::plugin_dir().'elements/food_menu_tab_pro.php';
            //food Reservation
            include_once \Wpcafe_Oxygen_Addon::plugin_dir().'elements/reservation_form_pro.php';
            include_once \Wpcafe_Oxygen_Addon::plugin_dir().'elements/reservation_with_food_tab_view.php';

        }

	}

    // section add
	public function register_add_plus_section() {
		\CT_Toolbar::oxygen_add_plus_accordion_section("wpcafe", esc_html__("WPCafe", 'wpcafe-oxygen-addon'));
	}

    // sub section add 
	public function register_add_plus_subsections() { ?>

		<h2>
            <?php esc_html_e("Food Menu", 'wpcafe-oxygen-addon');?>
        </h2>	
		<?php do_action("oxygen_add_plus_wpcafe_food_menu"); ?>

        <h2>
            <?php esc_html_e("Reservation", 'wpcafe-oxygen-addon');?>
        </h2>	
		<?php do_action("oxygen_add_plus_wpcafe_reservation_form"); ?>
        
	    <?php 
    }

    /**
     * do stuff on active
     *
     * @return void
     */
    public function active() {
        
    }

    /**
     * do stuff on deactive
     *
     * @return void
     */
    public function deactive() {
        flush_rewrite_rules();
    }

    /**
     * Singleton Instance
     *
     * @return void
     */
    public static function instance() {

        if ( !self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function notice_wpcafe_not_active(){
        $class = 'notice notice-warning';
		$message = esc_html__( 'In order to use WPCafe Oxygen Addon, you must have installed and activated WPCafe Plugin', 'wpcafe-oxygen-addon' );
		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
    }

    public function notice_oxygen_not_active(){
        $class = 'notice notice-warning';
		$message = esc_html__( 'In order to use WPCafe Oxygen Addon, you must have installed and activated Oxygen Builder Plugin', 'wpcafe-oxygen-addon' );
		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
    }
    
}