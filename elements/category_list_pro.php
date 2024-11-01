<?php
namespace Oxygen\WpcafeElements;

class Category_List_Pro extends \Oxy_Wpcafe_El {

    private $query_params = array(
		'style'    				=> ' ',
		'wpc_food_categories'  	=> '',
		'hide_empty'    		=> '',
		'category_limit'    	=> '',
		'show_count'    		=> '',
		'grid_column'    		=> '',
    );

	function name() {
		return 'Category List Pro';
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

        $shortcode = '[wpc_pro_menu_category_list '.$atts_string.']';
		echo do_shortcode($shortcode);
	}


	
	public function controls() {
		/* Course Query Section */
		$category_query = $this->addControlSection("category_query", esc_html__('Category Query', 'wpcafe-oxygen-addon'), "", $this);
		$category_query->addOptionControl(
			array(
				"type" => 'textfield',
				"name" => esc_html__('Include Category IDs', 'wpcafe-oxygen-addon'),
				"slug" => 'wpc_food_categories',
			)
		);
		$category_query->addOptionControl(
			array(
				"type" => 'dropdown',
				"name" => esc_html__('Style ', 'wpcafe-oxygen-addon'),
				"slug" => 'style',
				'default' => '1',
			)
		)->setValue(array('1', '2', '3', '4'));

		$category_query->addOptionControl(
			array(
				"type" => 'textfield',
				"name" => esc_html__('Category Limit', 'wpcafe-oxygen-addon'),
				"slug" => 'category_limit',
			)
		);

		$category_query->addOptionControl(
			array(
				"type" => 'buttons-list',
				"name" => esc_html__('Hide Empty?', 'wpcafe-oxygen-addon'),
				"slug" => 'hide_empty',
				'default' => '',
			)
		)->setValue(array('yes', 'no'));

		$category_query->addOptionControl(
			array(
				"type" => 'buttons-list',
				"name" => esc_html__('Show Count', 'wpcafe-oxygen-addon'),
				"slug" => 'show_count',
				'default' => 'yes',
			)
		)->setValue(array('yes', 'no'));
	
		$category_query->addOptionControl(
			array(
				"type" => 'dropdown',
				"name" => esc_html__('Grid Column', 'wpcafe-oxygen-addon'),
				"slug" => 'grid_column',
				'default' => '1',
			)
		)->setValue(array('1', '2', '3', '4'));

		/* Style section */
		$selector = '.wpc-food-menu-item';
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
		$thumb_selector = $selector." .wpc-food-inner-content .wpc-menu-currency, .woocommerce-Price-amount.amount";
		$thumb_style->addStyleControls(
			array(
				array(
					"name" => esc_html__('Thumbnail Width' , 'wpcafe-oxygen-addon'),
					"selector" => '.wpc-cat-thumb',
                    "property" => 'width',
                ),			
				array(
					"name" => esc_html__('Thumbnail Height' , 'wpcafe-oxygen-addon'),
					"selector" => '.wpc-cat-thumb',
                    "property" => 'height',
                ),			
			)
		);

		
		/* Advanced Style */
		$advanced_style = $style_sections->addControlSection("advanced_style", esc_html__("Advanced Style","wpcafe-oxygen-addon"), " ", $this);
		$advanced_selector = ".wpc-single-cat-item";
		
		$advanced_style->addStyleControls(
			array(
				array(
					"selector" => $advanced_selector,
					"name" => esc_html__('Box BG Color' , 'wpcafe-oxygen-addon'),
                    "property" => 'background-color',
					"condition" => 'style=4',
                ),		
				array(
					"selector" => $advanced_selector.':hover',
					"name" => esc_html__('Box Hover BG Color' , 'wpcafe-oxygen-addon'),
                    "property" => 'background-color',
					"condition" => 'style=4',
                ),		
				array(
					"selector" => $advanced_selector,
					"name" => esc_html__('Border Radius' , 'wpcafe-oxygen-addon'),
                    "property" => 'border-radius',
                ),	
			)
		);

		$advanced_style->addPreset(
            "margin"," ", esc_html__("Box Margin","wpcafe-oxygen-addon"), $advanced_selector
		);
	}
}

new Category_List_Pro();