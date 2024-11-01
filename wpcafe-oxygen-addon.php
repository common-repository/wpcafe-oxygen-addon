<?php

/**
 *  @package wpcafe-oxygen-addon
 */
/**
 * Plugin Name:        WPCafe Oxygen Addon
 * Plugin URI:         https://product.themewinter.com/wpcafe
 * Description:        Oxygen Builder Integration - WPCafe is a wordPress restaurant solution plugin to launch Restaurant Websites. You can design pages by Oxygen Builder and WPCafe.
 * Version:            1.1.2
 * Author:             Themewinter
 * Author URI:         http://themewinter.com/
 * License:            GPL-2.0+
 * License URI:        http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:        wpcafe-oxygen-addon
 * Domain Path:       /languages
 */

defined( 'ABSPATH' ) || exit;

final class Wpcafe_Oxygen_Addon {

    /**
     * Plugin Version
     *
     * @since 1.0.0
     * 
     * @var string The plugin version.
     */
    static function version(){
        return '1.1.2';
    }
    
    /**
     * Instance of self
     *
     * @since 1.0.0
     * 
     * @var Wpcafe_Oxygen_Addon
     */
    private static $instance = null;
    
    /**
     * Initializes the Wpcafe_Oxygen_Addon() class
     *
     * Checks for an existing Wpcafe_Oxygen_Addon() instance
     * and if it doesn't find one, creates it.
     */
    public static function init() {

        if ( self::$instance === null ) {
            self::$instance = new self();
        }

        return self::$instance;
    }
    
    /**
     * Instance of Wpcafe_Oxygen_Addon
     */
    private function __construct() {

		// Load translation
		add_action( 'init', [$this, 'i18n'] );

        // Instantiate Base Class after plugins loaded
        add_action( 'plugins_loaded', [$this, 'initialize_modules'], 99999 );
	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 * Fired by `init` action hook.
	 *
	 */
	public function i18n() {
        load_plugin_textdomain( 'wpcafe-oxygen-addon', false, dirname( self::plugins_basename( ) ) . '/languages/' );
	}
    

    /**
     * Initialize Modules
     *
     * @since 1.0.0
     */
    public function initialize_modules() {
        
        do_action( 'wpcoa/before_load' );

        require_once self::plugin_dir() . 'bootstrap.php';

        // action plugin instance class
        $plugin_bootstrap = new \Wpcafe_Oxygen_Addon\Bootstrap();
        $plugin_bootstrap->init();

        do_action( 'wpcoa/after_load' );
    }

    /**
     * Assets Directory Url
     *
     * @return void
     */
    public static function assets_url(){
        return trailingslashit( self::plugin_url() . 'assets' );
    }

    /**
     * Assets Folder Directory Path
     * 
     * @since 1.0.0
     *
     * @return void
     */
    public static function assets_dir(){
        return trailingslashit( self::plugin_dir() . 'assets' );
    }

    /**
     * Plugin Core File Directory Url
     * 
     * @since 1.0.0
     *
     * @return void
     */
    public static function core_url(){
        return trailingslashit( self::plugin_url() . 'core' );
    }

    /**
     * Plugin Core File Directory Path
     * 
     * @since 1.0.0
     *
     * @return void
     */
    public static function core_dir(){
        return trailingslashit( self::plugin_dir() . 'core' );
    }

    /**
     * Plugin Url
     * 
     * @since 1.0.0
     *
     * @return void
     */
    public static function plugin_url(){
        return trailingslashit( plugin_dir_url( self::plugin_file() ) );
    }

    /**
     * Plugin Directory Path
     * 
     * @since 1.0.0
     *
     * @return void
     */
    public static function plugin_dir(){
        return trailingslashit( plugin_dir_path( self::plugin_file() ) );
    }

    /**
     * Plugins Basename
     * 
     * @since 1.0.0

     */
    public static function plugins_basename(){
        return plugin_basename( self::plugin_file() );
    }
    
    /**
     * Plugin File
     * 
     * @since 1.0.0
     *
     * @return void
     */
    public static function plugin_file(){
        return __FILE__;
    }
}

/**
 * Load Wpcafe Oxygen Addon when all plugins are loaded
 *
 * @return Wpcafe_Oxygen_Addon
 */
function wpcafe_oxygen_addon(){
    return Wpcafe_Oxygen_Addon::init();
}

// Let's Go...
wpcafe_oxygen_addon();