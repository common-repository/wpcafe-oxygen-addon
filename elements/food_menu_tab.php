<?php
namespace Oxygen\WpcafeElements;

class Food_Menu_Tab extends \Oxy_Wpcafe_El {

    private $query_params = array(
		'style'    				 => ' ',
		'wpc_food_categories'    => '',
		'wpc_menu_order'         => '',
		'no_of_product'          => '',
		'wpc_show_desc' 		 => '',
		'wpc_desc_limit'         => '',
		'title_link_show'        => '',
		'product_thumbnail'      => '',
		'wpc_cart_button'        => '',
		'wpc_price_show'         => '',
		'show_item_status'         => '',

    );

	function name() {
		return 'Food Menu Tab';
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

        $shortcode = '[wpc_food_menu_tab '.$atts_string.']';
      
		echo do_shortcode($shortcode);

	}


	
	public function controls() {
		/* Course Query Section */
		$product_query = $this->addControlSection("product_query", esc_html__('Product Query', 'wpcafe-oxygen-addon'), "", $this);
		$product_query->addOptionControl(
			array(
				"type" => 'textfield',
				"name" => esc_html__('Include Category IDs', 'wpcafe-oxygen-addon'),
				"slug" => 'wpc_food_categories',
			)
		);
		$product_query->addOptionControl(
			array(
				"type" => 'dropdown',
				"name" => esc_html__('Style ', 'wpcafe-oxygen-addon'),
				"slug" => 'style',
				'default' => 'style-1',
			)
		)->setValue(array('style-1', 'style-2'));

		$product_query->addOptionControl(
			array(
				"type" => 'buttons-list',
				"name" => esc_html__('Order', 'wpcafe-oxygen-addon'),
				"slug" => 'wpc_menu_order',
				'default' => 'DESC',
			)
		)->setValue(array('DESC', 'ASC'));



		$product_query->addOptionControl(
			array(
				"type" => 'textfield',
				"name" => esc_html__('Product Limit', 'wpcafe-oxygen-addon'),
				"slug" => 'no_of_product',
			)
		);
		$product_query->addOptionControl(
			array(
				"type" => 'buttons-list',
				"name" => esc_html__('Show Description', 'wpcafe-oxygen-addon'),
				"slug" => 'wpc_show_desc',
				'default' => 'yes',

			)
		)->setValue(array('yes', 'no'));
	

		$product_query->addOptionControl(
			array(
				"type" => 'textfield',
				"name" => esc_html__('Desc Limit' , 'wpcafe-oxygen-addon'),
				"slug" => 'wpc_desc_limit',
				"condition" => 'wpc_show_desc=yes',

			)
		);
		$product_query->addOptionControl(
			array(
				"type" => 'buttons-list',
				"name" => esc_html__('Title Link enable', 'wpcafe-oxygen-addon'),
				"slug" => 'title_link_show',
				'default' => 'yes',

			)
		)->setValue(array('yes', 'no'));
		$product_query->addOptionControl(
			array(
				"type" => 'buttons-list',
				"name" => esc_html__('Show Thumbnail', 'wpcafe-oxygen-addon'),
				"slug" => 'product_thumbnail',
				'default' => 'yes',

			)
		)->setValue(array('yes', 'no'));
		$product_query->addOptionControl(
			array(
				"type" => 'buttons-list',
				"name" => esc_html__('Show Cart Button', 'wpcafe-oxygen-addon'),
				"slug" => 'wpc_cart_button',
				'default' => 'yes',

			)
		)->setValue(array('yes', 'no'));

		$product_query->addOptionControl(
			array(
				"type" => 'buttons-list',
				"name" => esc_html__('Show Price', 'wpcafe-oxygen-addon'),
				"slug" => 'wpc_price_show',
				'default' => 'yes',

			)
		)->setValue(array('yes', 'no'));

		$product_query->addOptionControl(
			array(
				"type" => 'buttons-list',
				"name" => esc_html__('Show Item Status', 'wpcafe-oxygen-addon'),
				"slug" => 'show_item_status',
				'default' => 'yes',

			)
		)->setValue(array('yes', 'no'));


		/* Style section */
		$selector = '.wpc-food-menu-item';
		$style_sections = $this->addControlSection("style_sections", esc_html__("Style Sections", 'wpcafe-oxygen-addon'), " ", $this);

		/* Title Style */
		$title_style = $style_sections->addControlSection("title_style", esc_html__("Title Style", 'wpcafe-oxygen-addon'), " ", $this);
		$title_selector = $selector." .wpc-food-inner-content .wpc-post-title";
		$title_selector_color = $selector." .wpc-food-inner-content .wpc-post-title a";
		$title_style->addStyleControls(
			array(
			 
				array(
					"selector" => $title_selector_color,
					"property" => 'color',
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



		/* Price Style */
		$price_style = $style_sections->addControlSection("price_style", esc_html__("Price Style" , 'wpcafe-oxygen-addon'), " ", $this);
		$price_selector = $selector." .wpc-food-inner-content .wpc-menu-currency, .woocommerce-Price-amount.amount";
		$price_style->addStyleControls(
			array(
			 
				array(
					"selector" => $price_selector,
					"property" => 'color',
				),
				array(
					"selector" => $price_selector,
					"property" => 'font-size',
				),
				array(
					"selector" => $price_selector,
					"property" => 'font-family',
				),
			
			)
		);



		/* Description Style */
		$description_style = $style_sections->addControlSection("description_style", esc_html__("Description Style" , 'wpcafe-oxygen-addon'), " ", $this);
		$description_selector = $selector." .wpc-food-inner-content p";
		$description_style->addStyleControls(
			array(
				array(
					"selector" => $description_selector,
					"property" => 'color',

				),
				array(
					"selector" => $description_selector,
					"property" => 'font-size',

				),
				array(
					"selector" => $description_selector,
					"property" => 'font-family',
				),
			
			)
		);
				/* item status Style */
				$item_status_style = $style_sections->addControlSection("item_status_style", esc_html__("Item Status Style" , 'wpcafe-oxygen-addon'), " ", $this);
				$item_status_selector = $selector."  .wpc-menu-tag li";
				$item_status_style->addStyleControls(
					array(
					 
						array(
							"selector" => $item_status_selector,
							"property" => 'color',
						),
						array(
							"selector" => $item_status_selector,
							"property" => 'background-color',
						),
						array(
							"selector" => $item_status_selector,
							"property" => 'font-size',
						),
						array(
							"selector" => $item_status_selector,
							"property" => 'font-family',
						),
					
					)
				);

		/* Cart Button Style */
		$cart_btn_style = $style_sections->addControlSection("cart_btn_style", esc_html__("Cart Button Style" , 'wpcafe-oxygen-addon'), " ", $this);
		$cart_btn_selector = $selector." .wpc-add-to-cart a";
		$cart_btn_style->addStyleControls(
			array(
			 
				array(
					"selector" => $cart_btn_selector,
					"property" => 'color',
				),
				array(
					"selector" => $cart_btn_selector,
					"property" => 'background-color',
				),
			
				array(
					"selector" => $cart_btn_selector,
					"property" => 'font-size',
				),
				array(
					"selector" => $cart_btn_selector,
					"property" => 'font-family',
				),
				array(
					"selector" => $cart_btn_selector,
					"property" => 'border-color',
				),
				array(
					"selector" => $cart_btn_selector,
					"property" => 'border-width',
				),
			
			)
		);

	
	}

}

new Food_Menu_Tab();