<?php
namespace Wpcafe_Oxygen_Addon\Core\Enqueue;

defined( 'ABSPATH' ) || exit;

/**
 * Enqueue all css and js file class
 */
class Enqueue {

    use \Wpcafe_Oxygen_Addon\Traits\Singleton;

    /**
     * Main calling function
     */
    public function init() {
        // frontend asset
        add_action( 'wp_enqueue_scripts',[$this, 'dequeue_common_js'] );
        add_action( 'oxygen_enqueue_frontend_scripts', [$this, 'frontend_enqueue_assets']);
    }

    /**
     * Enqueue admin js and css function
     *
     * @param  $var
     */
    function dequeue_common_js(){
        wp_dequeue_script('wpc-common');
    }
  

    /**
     * Enqueue admin js and css function
     */
    public function frontend_enqueue_assets() {
        // js
        $scripts = $this->frontend_get_scripts();

        if( !empty( $scripts ) ){
            foreach ( $scripts as $key => $value ) {
                $deps       = isset( $value['deps'] ) ? $value['deps'] : false;
                $version    = !empty( $value['version'] ) ? $value['version'] : false;
                wp_enqueue_script( $key, $value['src'], $deps, $version, true );
            }
        }

        // css
        $styles = $this->frontend_get_styles();
        if( !empty( $styles ) ){
            foreach ( $styles as $key => $value ) {
                $deps       = isset( $value['deps'] ) ? $value['deps'] : false;
                $version    = !empty( $value['version'] ) ? $value['version'] : false;
                wp_enqueue_style( $key, $value['src'], $deps, $version, 'all' );
            }
        }
    }
  

    /**
     * all js files function
     */
    public function admin_get_scripts() {
        $script_arr =  [];
        return $script_arr;
    }

    /**
     * all css files function
     *
     * @param Type $var
     */
    public function admin_get_styles() {
        $styles_arr = [];
        return $styles_arr;
    }

    /**
     * all js files function
     */
    public function frontend_get_scripts() {
        $script_arr = array(
            'wpc-common'     => array(
                'src'     => \Wpcafe::assets_url() . 'js/common.js',
                'version' => \Wpcafe::version(),
                'deps'    => ['jquery'],
            ),
        
        );
        return $script_arr;
    }

    /**
     * all css files function
     */
    public function frontend_get_styles() {
        return array(
            'owa-public-css' => array(
                'src'     => \Wpcafe_Oxygen_Addon::assets_url() . 'css/public.css',
                'version' => \Wpcafe_Oxygen_Addon::version(),
            )
        );
    }

}


