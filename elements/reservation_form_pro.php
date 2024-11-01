<?php
namespace Oxygen\WpcafeElements;

class Reservation_Form_Pro extends \Oxy_Wpcafe_El {

    private $query_params = array(
		'form_style'    		=> ' ',
    );

	function name() {
		return 'Reservation Form Pro';
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

        $shortcode = '[wpc_reservation_form_pro '.$atts_string.']';
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
		)->setValue(array('1'));

		/* Style section */
		$main_selector = '.wpc-reservation-pro-wrap';
		$selector = '.wpc-reservation-pro-wrap .wpc-nav';
		$style_sections = $this->addControlSection("style_sections", __("Style Sections"), " ", $this);

		/* Form Header Style */
		$form_header = $style_sections->addControlSection("form_header", __("Form Header"), " ", $this);
		$btn_selector = ".wpc-nav li a";
		$btn_selector_active = $btn_selector.".wpc-active";
		$pagination_selector = ' #wpc-multi-step-reservation .wpc-reservation-pagination li';
		
		$form_header->addStyleControls(
			array(
				array(
					"selector" => $selector,
					"property" => 'background-color',
					"name" 		=> esc_html__('Nav Box Background color','wpcafe-oxygen-addon'),
				)
			)
		);
		
		$form_header->addOptionControl(
			array(
				"type" => 'buttons-list',
				"name" => esc_html__('Button Style', 'wpcafe-oxygen-addon'),
				"slug" => 'wpc_button_style',
				'default' => 'Normal',
			)
		)->setValue(array('Normal', 'Active'));

		$form_header->addStyleControls(
			array(
				array(
					"selector" => $btn_selector,
					"property" => 'color',
					"name" 		=> esc_html__('Button Color','wpcafe-oxygen-addon'),
					"condition" => 'wpc_button_style=Normal',
				),
				array(
					"selector" => $btn_selector,
					"property" => 'background-color',
					"name" 		=> esc_html__('Button BG Color','wpcafe-oxygen-addon'),
					"condition" => 'wpc_button_style=Normal',
				),
				array(
					"selector" => $btn_selector,
					"property" => 'border-color', 
					"condition" => 'wpc_button_style=Normal'
				),
				array(
					"selector" => $btn_selector,
					"property" => 'border-width', 
					"condition" => 'wpc_button_style=Normal'
				),
			)
		);

		$form_header->addStyleControls(
			array(
				array(
					"selector" => $btn_selector_active,
					"property" => 'color',
					"name" 		=> esc_html__('Button Color','wpcafe-oxygen-addon'),
					"condition" => 'wpc_button_style=Active',
				),
				array(
					"selector" => $btn_selector_active,
					"property" => 'background-color',
					"name" 		=> esc_html__('Button BG Color','wpcafe-oxygen-addon'),
					"condition" => 'wpc_button_style=Active',
				),
				array(
					"selector" => $btn_selector_active,
					"property" => 'border-color', 
					"condition" => 'wpc_button_style=Active'
				)
			)
		);
		$form_header->addPreset(
            "padding","header_btn", esc_html__("Button Padding","wpcafe-oxygen-addon"), $btn_selector
		);

		$form_header->addStyleControls(
			array(
				array(
					"selector" => $pagination_selector.'::before,::after',
					"property" => 'background-color',
					"name" 		=> esc_html__('Pagination BG Color','wpcafe-oxygen-addon'),
				),
				array(
					"selector" => $pagination_selector.'.active::before,.active::after',
					"property" => 'background-color',
					"name" 		=> esc_html__('Pagination Active BG Color','wpcafe-oxygen-addon'),
				),
			)
		);

		/* Input Field Style */
		$input_field = $style_sections->addControlSection("input_field", __("Input Field"), " ", $this);
		$reservation_field = ".wpc-reservation-field";
		$form_control = $reservation_field." .wpc-form-control";

		$input_field->addStyleControls(
			array(
				array(
					"selector" => $reservation_field. ' label',
					"property" => 'color',
					"name" 		=> esc_html__('Label Color','wpcafe-oxygen-addon'),
				),
				array(
					"selector" => $reservation_field. ' label',
					"property" => 'font-size',
					"name" 		=> esc_html__('Label Font Size','wpcafe-oxygen-addon'),
				),
				array(
					"selector" => $form_control,
					"property" => 'color',
					"name" 		=> esc_html__('Input Color','wpcafe-oxygen-addon'),
				),
				array(
					"selector" => $form_control,
					"property" => 'font-family',
				),
				array(
					"selector" => $form_control,
					"property" => 'font-size',
				),
				array(
					"selector" => $form_control,
					"property" => 'font-weight',
				),
				array(
					"selector" => $form_control,
					"property" => 'line-height',
				),
				array(
					"selector" => $form_control,
					"property" => 'text-transform',
				)
			)
		);

		/* Button Style */
		$button_style = $style_sections->addControlSection("button_style", esc_html__("Button","wpcafe-oxygen-addon"), " ", $this);
		$button_selector = "#wpc-multi-step-reservation .wpc-btn";
		$button_selector_hover = "#wpc-multi-step-reservation .wpc-btn:hover";

		$button_style->addOptionControl(
			array(
				"type" => 'buttons-list',
				"name" => esc_html__('Button Style', 'wpcafe-oxygen-addon'),
				"slug" => 'wpc_btn_style',
				'default' => 'Normal',
			)
		)->setValue(array('Normal', 'Hover'));

		$button_style->addStyleControls(
			array(
				array(
					"selector" => '#wpc_book_table,#wpc_cancel_request',
					"property" => 'color',
					"name" 		=> esc_html__('Button Link Color','wpcafe-oxygen-addon'),
				)
			)
		);

		$button_style->addStyleControls(
			array(
				array(
					"selector" => $button_selector,
					"property" => 'color',
					"name" 		=> esc_html__('Button Color','wpcafe-oxygen-addon'),
					"condition" => 'wpc_button_style=Normal'
				),
				array(
					"selector" => $button_selector,
					"property" => 'background-color',
					"name" 		=> esc_html__('Button Background color','wpcafe-oxygen-addon'),
					"condition" => 'wpc_button_style=Normal'
				),				
				array(
					"selector" => $button_selector,
					"property" => 'border-color', 
					"condition" => 'wpc_button_style=Normal'
				),
				array(
					"selector" => $button_selector,
					"property" => 'border-width', 
					"condition" => 'wpc_button_style=Normal'
				),
			)
		);
		$button_style->addStyleControls(
			array(
				array(
					"selector" => $button_selector_hover,
					"property" => 'color',
					"name" 		=> esc_html__('Button Color','wpcafe-oxygen-addon'),
					"condition" => 'wpc_button_style=Hover'
				),
				array(
					"selector" 	=> $button_selector_hover,
					"property" => 'background-color',
					"name" 		=> esc_html__('Button BG Hover Color','wpcafe-oxygen-addon'),
					"condition" => 'wpc_button_style=Hover'
				),
				array(
					"selector" => $button_selector_hover,
					"property" => 'border-color', 
					"condition" => 'wpc_button_style=Hover'
				)
			)
		);
		$button_style->addPreset(
            "padding"," ", esc_html__("Button Padding","wpcafe-oxygen-addon"), $button_selector
		);

		/* Notification Style */
		$notification_style = $style_sections->addControlSection("notification_style", esc_html__("Notification Message","wpcafe-oxygen-addon"), " ", $this);
		$notification_error_selector = ".wpc_error_message";
		$notification_succes_selector = ".wpc_success_message";

		$notification_style->addStyleControls(
			array(
				array(
					"selector" => $notification_error_selector,
					"property" => 'color',
					"name" 		=> esc_html__('Error notification color','wpcafe-oxygen-addon'),
				),
				array(
					"selector" => $notification_error_selector,
					"property" => 'background-color',
					"name" 		=> esc_html__('Error notification BG color','wpcafe-oxygen-addon'),
				),
				array(
					"selector" => $notification_succes_selector,
					"property" => 'color',
					"name" 		=> esc_html__('Success notification color','wpcafe-oxygen-addon'),
				),
				array(
					"selector" => $notification_succes_selector,
					"property" => 'background-color',
					"name" 		=> esc_html__('Success notification BG color','wpcafe-oxygen-addon'),
				)
			)
		);
		
		/* Advanced Style */
		$advanced_style = $style_sections->addControlSection("advanced_style", esc_html__("Advanced Style","wpcafe-oxygen-addon"), " ", $this);
		$advanced_selector = ".wpc-reservation-form";
		$advanced_padding_selector = ".wpc_reservation_form";
		
		$advanced_style->addStyleControls(
			array(
				array(
					"selector" => $advanced_selector,
					"property" => 'background-color',
					"name" 		=> esc_html__('Calender BG color','wpcafe-oxygen-addon'),
				)				
			)
		);
		$advanced_style->addPreset(
            "padding"," ", esc_html__("Box Padding"), $advanced_padding_selector
		);
	}
}

new Reservation_Form_Pro();