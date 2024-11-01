<?php
namespace Oxygen\WpcafeElements;

class Food_Location_Filter extends \Oxy_Wpcafe_El {

    private $query_params = array(
		'location_alignment '    => ' ',
    );



	function name() {
		return 'Location Filter';
	}

	public function wpcafe_button_place() {
		return "food_menu";
	}
	function icon() {
		return '';
	}

	function render($options, $defaults, $content) {
		 	
        $shortcode_props = shortcode_atts($this->query_params, $options);

		$atts_string = '';

		foreach ($shortcode_props as $name => $value) {
			if ($value) {
				$atts_string .= ' '.$name.'='.$value;
			}
		}

        $shortcode = '[food_location_filter '.$atts_string.']';
      
		echo do_shortcode($shortcode);

	}


	
	public function controls() {
		/* Course Query Section */
		$product_query = $this->addControlSection("product_query", esc_html__('Location Query', 'wpcafe-oxygen-addon'), "", $this);
	
		$product_query->addOptionControl(
			array(
				"type" => 'dropdown',
				"name" => esc_html__('Alignment ', 'wpcafe-oxygen-addon'),
				"slug" => 'location_alignment',
				'default' => 'center',
			)
		)->setValue(array('center', 'left', 'right'));

		/* Style section */
		$selector = '.filter-location';
		$style_sections = $this->addControlSection("style_sections", esc_html__("Style Sections", 'wpcafe-oxygen-addon'), " ", $this);
	

		$style_sections->addPreset(
            "padding"," ", esc_html__("Padding","wpcafe-oxygen-addon"), $selector
		);

	}

}

new Food_Location_Filter();