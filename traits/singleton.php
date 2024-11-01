<?php
namespace Wpcafe_Oxygen_Addon\Traits;

defined( 'ABSPATH' ) || exit;

/**
 * Instance of class
 */
trait Singleton {
    
    private static $instance;

    /**
     * Wpc_Singleton trait
     *
     */
    public static function instance() {
        if ( !self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}
