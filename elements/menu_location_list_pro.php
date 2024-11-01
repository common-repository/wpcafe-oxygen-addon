<?php
namespace Oxygen\WpcafeElements;

class Menu_Location_List_Pro extends \Oxy_Wpcafe_El {

    private $query_params = array(
		'style'    				=> ' ',
		'location_ids'  	=> '',
		'hide_empty'    		=> '',
		'location_limit'    	=> '',
		'show_count'    		=> '',
		'grid_column'    		=> '',
    );
	function name() {
		return 'Location List (Pro)';
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

        $shortcode = '[wpc_pro_menu_location_list '.$atts_string.']';
		echo do_shortcode($shortcode);
	}


	
	public function controls() {
		/* Course Query Section */
		$location_query = $this->addControlSection("location_query", esc_html__('Location Query', 'wpcafe-oxygen-addon'), "", $this);
		$location_query->addOptionControl(
			array(
				"type" => 'textfield',
				"name" => esc_html__('Include Location IDs', 'wpcafe-oxygen-addon'),
				"slug" => 'location_ids',
			)
		);
		$location_query->addOptionControl(
			array(
				"type" => 'dropdown',
				"name" => esc_html__('Style ', 'wpcafe-oxygen-addon'),
				"slug" => 'style',
				'default' => '1',
			)
		)->setValue(array('1', '2', '3', '4'));

		$location_query->addOptionControl(
			array(
				"type" => 'textfield',
				"name" => esc_html__('Location Limit', 'wpcafe-oxygen-addon'),
				"slug" => 'location_limit',
			)
		);

		$location_query->addOptionControl(
			array(
				"type" => 'buttons-list',
				"name" => esc_html__('Hide Empty?', 'wpcafe-oxygen-addon'),
				"slug" => 'hide_empty',
				'default' => '',
			)
		)->setValue(array('yes', 'no'));

		$location_query->addOptionControl(
			array(
				"type" => 'buttons-list',
				"name" => esc_html__('Show Count', 'wpcafe-oxygen-addon'),
				"slug" => 'show_count',
				'default' => 'yes',
			)
		)->setValue(array('yes', 'no'));
	
		$location_query->addOptionControl(
			array(
				"type" => 'dropdown',
				"name" => esc_html__('Grid Column', 'wpcafe-oxygen-addon'),
				"slug" => 'grid_column',
				'default' => '1',
			)
		)->setValue(array('1', '2', '3', '4'));

		/* Style section */
		$selector = '.wpc-single-cat-item';
		$style_sections = $this->addControlSection("style_sections", esc_html__("Style Sections", 'wpcafe-oxygen-addon'), " ", $this);

		/* Title Style */
		$title_style = $style_sections->addControlSection("title_style", esc_html__("Title Style", 'wpcafe-oxygen-addon'), " ", $this);
		$title_selector = ".wpc-category-title";
		$title_selector_color = $title_selector." a";
		$title_style->addStyleControls(
			array(
				array(
					"selector" => $title_selector_color,
					"property" => 'color',
				),
				array(
					"selector" => $title_selector_color,
					"property" => 'background-color',
				),
				array(
					"selector" => $title_selector,
					"property" => 'font-size',
				),
				array(
					"selector" => $title_selector,
					"property" => 'font-family',
				),
				array(
					"selector" => $title_selector,
					"property" => 'line-height',
				),
				array(
					"selector" => $title_selector,
					"property" => 'text-transform',
				)
			)
		);

		$title_style->addPreset(
            "padding"," ", esc_html__("Padding","wpcafe-oxygen-addon"), $title_selector_color
		);

		/* Thubmnail Style */
		$thumb_style = $style_sections->addControlSection("thumb_style", esc_html__("Thumbnail Style" , 'wpcafe-oxygen-addon'), " ", $this);
		$thumb_selector = $selector." .wpc-cat-thumb";
		$thumb_style->addStyleControls(
			array(
				array(
					"name" => esc_html__('Thumbnail Width' , 'wpcafe-oxygen-addon'),
					"selector" => $thumb_selector,
                    "property" => 'width',
                ),			
				array(
					"name" => esc_html__('Thumbnail Height' , 'wpcafe-oxygen-addon'),
					"selector" => $thumb_selector,
                    "property" => 'height',
                ),			
			)
		);

		
		/* Advanced Style */
		$advanced_style = $style_sections->addControlSection("advanced_style", esc_html__("Advanced Style","wpcafe-oxygen-addon"), " ", $this);
		$advanced_style->addStyleControls(
			array(
				array(
					"selector" => $selector,
					"name" => esc_html__('Box BG Color' , 'wpcafe-oxygen-addon'),
                    "property" => 'background-color',
					"condition" => 'style=4',
                ),		
				array(
					"selector" => $selector.':hover',
					"name" => esc_html__('Box Hover BG Color' , 'wpcafe-oxygen-addon'),
                    "property" => 'background-color',
					"condition" => 'style=4',
                ),		
				array(
					"selector" => $selector,
					"name" => esc_html__('Border Radius' , 'wpcafe-oxygen-addon'),
                    "property" => 'border-radius',
                ),	
			)
		);

		$advanced_style->addPreset(
            "margin"," ", esc_html__("Box Margin","wpcafe-oxygen-addon"), $selector
		);
	}
}

new Menu_Location_List_Pro();