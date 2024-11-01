<?php
namespace Oxygen\WpcafeElements;

class Business_Hour_Pro extends \Oxy_Wpcafe_El {

    private $query_params = array(
		'all_days_schedule'  => ''
    );
	function name() {
		return 'Business Hour';
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

        $shortcode = '[wpc_pro_business_hour '.$atts_string.']';
		echo do_shortcode($shortcode);
	}


	public function controls() {
		/* general query Section */
		$general_query = $this->addControlSection("general_query", esc_html__('Business Hours', 'wpcafe-oxygen-addon'), "", $this);
		$general_query->addOptionControl(
			array(
				"type" => 'buttons-list',
				"name" => esc_html__('All Days Schedule', 'wpcafe-oxygen-addon'),
				"slug" => 'all_days_schedule',
				'default' => 'yes',
			)
		)->setValue(array('yes', 'no'));

		/* Style section */
		$style_sections = $this->addControlSection("style_sections", __("Style Sections"), " ", $this);

		/* Business Hour Style */
		$hour_style = $style_sections->addControlSection("hour_style", esc_html__("Hour Style", 'wpcafe-oxygen-addon'), " ", $this);
		$hour_selector = ".wpc_pro_business_hour";

		$hour_style->addStyleControls(
			array(
				array(
					"selector" => $hour_selector,
					"property" => 'color',
				),
				array(
					"selector" => $hour_selector,
					"property" => 'font-size',
				),
				array(
					"selector" => $hour_selector,
					"property" => 'font-family',
				),
				array(
					"selector" => $hour_selector,
					"property" => 'line-height',
				),
				array(
					"selector" => $hour_selector,
					"property" => 'text-transform',
				)
			)
		);

		$hour_style->addPreset(
            "padding"," ", esc_html__("Padding","wpcafe-oxygen-addon"), $hour_selector
		);
	}

}

new Business_Hour_Pro();