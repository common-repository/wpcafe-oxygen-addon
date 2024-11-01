<?php
namespace Oxygen\WpcafeElements;

class Reservation_Form extends \Oxy_Wpcafe_El {

    private $query_params = array(
		'form_style'    		=> ' ',
		'wpc_image_url'     => '',
    );

	function name() {
		return 'Reservation Form';
	}

	public function wpcafe_button_place() {
		return "reservation_form";
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

        $shortcode = '[wpc_reservation_form '.$atts_string.']';
		echo do_shortcode($shortcode);

	}


	public function controls() {
		/* Course Query Section */
		$general = $this->addControlSection("general", __('General', 'wpcafe'), "assets/icon.png", $this);

		$general->addOptionControl(
			array(
				"type" => 'dropdown',
				"name" => __('Style '),
				"slug" => 'form_style',
				'default' => '1',				
			)
		)->setValue(array('1', '2'));

		$general->addOptionControl(
			array(
				"type" => 'mediaurl',
				"name" => __('Image URL '),
				"slug" => 'wpc_image_url',
				"condition" => 'form_style=1',
			)
		)->setValue(array());

		/* Style section */
		$main_selector = '.wpc_reservation_form';
		$selector = '.wpc-reservation-field';
		$style_sections = $this->addControlSection("style_sections", __("Style Sections"), " ", $this);

		/* Input Style */
		$input_field = $style_sections->addControlSection("input_field", __("Input field"), " ", $this);
		$input_selector = $selector." .wpc-form-control";
		$input_field->addStyleControls(
			array(
			 
				array(
					"selector" => $selector. ' label',
					"property" => 'color',
					"name" 		=> esc_html__('Label Color','wpcafe-oxygen-addon'),
				),

				array(
					"selector" => $selector. ' label',
					"property" => 'font-size',
					"name" 		=> esc_html__('Label Font Size','wpcafe-oxygen-addon'),
				),

				array(
					"selector" => $input_selector,
					"property" => 'color',
				),
				array(
					"selector" => $input_selector,
					"property" => 'background-color',
				),
				array(
					"selector" => $input_selector.'::placeholder',
					"property" => 'color',
					"name" 		=> esc_html__('Input Placeholder Color','wpcafe-oxygen-addon'),
				),
				array(
					"selector" => $input_selector,
					"property" => 'font-family',
				),
				array(
					"selector" => $input_selector,
					"property" => 'font-size',
				),
				array(
					"selector" => $input_selector,
					"property" => 'font-weight',
				),
				array(
					"selector" => $input_selector,
					"property" => 'line-height',
				),
				array(
					"selector" => $input_selector,
					"property" => 'text-transform',
				)
			)
		);
		$input_field->addPreset(
            "padding"," ", esc_html__("Padding","wpcafe-oxygen-addon"), $input_selector
		);

		/* Button Style */
		$button_style = $style_sections->addControlSection("button_style", esc_html__("Button","wpcafe-oxygen-addon"), " ", $this);
		$button_selector = $main_selector." .wpc-btn";
		$button_style->addStyleControls(
			array(
				array(
					"selector" => '#wpc_book_table,#wpc_cancel_request',
					"property" => 'color',
					"name" 		=> esc_html__('Button Link Color','wpcafe-oxygen-addon'),
				),
				array(
					"selector" => $button_selector,
					"property" => 'color',
					"name" 		=> esc_html__('Button Color','wpcafe-oxygen-addon'),
				),
				array(
					"selector" 	=> $button_selector.':hover',
					"property" => 'color',
					"name" 		=> esc_html__('Button Hover Color','wpcafe-oxygen-addon'),
				),
				array(
					"selector" => $button_selector,
					"property" => 'background-color',
					"name" 		=> esc_html__('Button Background color','wpcafe-oxygen-addon'),
				),
				array(
					"selector" 	=> $button_selector.':hover',
					"property" => 'background-color',
					"name" 		=> esc_html__('Button BG Hover Color','wpcafe-oxygen-addon')
				)
			)
		);
		$button_style->addPreset(
            "padding"," ", esc_html__("Button Padding","wpcafe-oxygen-addon"), $button_selector
		);

		/* Advanced Style */
		$ad_selector = '.reservation_section';
		$calendar_style = $style_sections->addControlSection("calendar_style", esc_html__("Calendar Style","wpcafe-oxygen-addon"), " ", $this);
		$calendar_selector = $ad_selector." .wpc-reservation-form";
		$calendar_style->addStyleControls(
			array(
				array(
					"selector" => '.wpc-reservation-field.date.wpc-reservation-calender-field',
					"property" => 'background-color',
					"name" 		=> esc_html__('Calender BG color','wpcafe-oxygen-addon'),
				),
				array(
					"selector" => '.wpc-reservation-field.date .flatpickr-day, .wpc-food-menu-item.style2:hover',
					"property" => 'border-color',
				),
			)
		);
		$calendar_style->addPreset(
            "padding"," ", esc_html__("Box Padding"), $calendar_selector
		);
	}

}

new Reservation_Form();