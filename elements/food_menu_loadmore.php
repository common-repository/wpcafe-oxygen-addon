<?php
namespace Oxygen\WpcafeElements;

class Food_Menu_Loadmore extends \Oxy_Wpcafe_El {

    private $query_params = array(
		'style'    				 => ' ',
		'wpc_menu_order'         => '',
		'no_of_product'          => '',
		'wpc_food_categories'    => '',
		'wpc_show_desc' 		 => '',
		'wpc_desc_limit'         => '',
		'title_link_show'        => '',
		'show_item_status'       => '',
		'show_thumbnail'      	 => '',
		'wpc_cart_button'        => '',
		'wpc_delivery_time_show' => '',
    );

	function name() {
		return 'Food Menu Loadmore (Pro)';
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

        $shortcode = '[wpc_pro_food_menu_loadmore '.$atts_string.']';
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
		)->setValue(array('style-1'));
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
				"slug" => 'show_thumbnail',
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
				"name" => esc_html__('Delivery Time Show', 'wpcafe-oxygen-addon'),
				"slug" => 'wpc_delivery_time_show',
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

		/* Thubmnail Style */
		$thumb_style = $style_sections->addControlSection("thumb_style", esc_html__("Thumbnail Style" , 'wpcafe-oxygen-addon'), " ", $this);
		$thumb_selector = $selector." .wpc-food-menu-thumb";
		$thumb_style->addStyleControls(
			array(
				array(
					"selector" => $thumb_selector,
					"name" => esc_html__('Thumbnail Width' , 'wpcafe-oxygen-addon'),
                    "property" => 'width',
                ),			
				array(
					"selector" =>  $thumb_selector,
					"name" => esc_html__('Thumbnail Height' , 'wpcafe-oxygen-addon'),
                    "property" => 'height',
                ),
				array(
					"selector" => $thumb_selector,
					"name" => esc_html__('Border Radius' , 'wpcafe-oxygen-addon'),
                    "property" => 'border-radius',
                )
			)
		);

		/* Item Status Style */
		$item_status_style = $style_sections->addControlSection("item_status_style", esc_html__("Item Status Style", 'wpcafe-oxygen-addon'), " ", $this);
		$item_status_selector = $selector." .wpc-menu-tag li";
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
				)			
			)
		);

		$item_status_style->addPreset(
            "padding"," ", esc_html__("Padding"), $item_status_selector
		);

		/* Title Style */
		$title_style = $style_sections->addControlSection("title_style", esc_html__("Title Style", 'wpcafe-oxygen-addon'), " ", $this);
		$title_selector = $selector." .wpc-post-title";
		$title_selector_link = $selector." .wpc-post-title a";
		$title_selector_hover = $title_selector.":hover";
		$title_style->addStyleControls(
			array(
			 
				array(
					"selector" => $title_selector_link,
					"property" => 'color',
				),
				array(
					"selector" => $title_selector_link,
					"property" => 'color',
					"name" => esc_html__('Title Hover Color' , 'wpcafe-oxygen-addon'),
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
            "margin"," ", esc_html__("Title Margin","wpcafe-oxygen-addon"), $title_selector
		);

		/* Price Style */
		$price_style = $style_sections->addControlSection("price_style", esc_html__("Price Style" , 'wpcafe-oxygen-addon'), " ", $this);
		$price_selector = $selector." .wpc-food-inner-content .wpc-menu-currency, .woocommerce-Price-amount.amount";
		$price = $selector." .wpc-price";

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
				array(
					"selector" => $price,
					"property" => 'background-color',
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

		$description_style->addPreset(
            "padding"," ", esc_html__("Description Padding", "wpcafe-oxygen-addon"), $description_selector
		);

		$description_style->addPreset(
            "margin"," ", esc_html__("Description Margin", "wpcafe-oxygen-addon"), $description_selector
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
				array(
					"selector" => $cart_btn_selector,
					"property" => 'border-radius',
				)
			)
		);
		
		$cart_btn_style->addPreset(
            "padding"," ", esc_html__("Padding","wpcafe-oxygen-addon"), $cart_btn_selector
		);

		/* Loadmore Button Style */
		$loadmore_btn_style = $style_sections->addControlSection("cart_btn_style", esc_html__("Loadmore Button Style" , 'wpcafe-oxygen-addon'), " ", $this);
		$loadmore_btn_selector = $selector." .wpc-btn";
		$loadmore_btn_style->addStyleControls(
			array(
				array(
					"selector" => $loadmore_btn_selector,
					"property" => 'color',
				),
				array(
					"selector" => $loadmore_btn_selector,
					"property" => 'background-color',
				),
				array(
					"selector" => $loadmore_btn_selector.":hover",
					"name" => esc_html__('Hover BG Color', 'wpcafe-oxygen-addon'),
					"property" => 'background-color',
				),
				array(
					"selector" => $loadmore_btn_selector,
					"property" => 'font-size',
				),
				array(
					"selector" => $loadmore_btn_selector,
					"property" => 'font-family',
				),
				array(
					"selector" => $loadmore_btn_selector,
					"property" => 'border-color',
				),
				array(
					"selector" => $loadmore_btn_selector,
					"property" => 'border-width',
				),
				array(
					"selector" => $loadmore_btn_selector,
					"property" => 'border-radius',
				)
			)
		);
		$loadmore_btn_style->addPreset(
            "padding"," ", esc_html__("Padding","wpcafe-oxygen-addon"), $loadmore_btn_selector
		);

		/* Advanced Style */
		$advanced_style = $style_sections->addControlSection("advanced_style", esc_html__("Advanced Style","wpcafe-oxygen-addon"), " ", $this);
		$advanced_style->addStyleControls(
			array(		
				array(
					"selector" => $selector,
					"name" => esc_html__('Border Color' , 'wpcafe-oxygen-addon'),
                    "property" => 'border-color',
                ),	
			)
		);

		$advanced_style->addPreset(
            "margin"," ", esc_html__("Margin","wpcafe-oxygen-addon"), $selector
		);

		$advanced_style->addPreset(
            "padding"," ", esc_html__("Padding","wpcafe-oxygen-addon"), $selector,'.wpc-menu-list-style2 .wpc-food-inner-content',
		);
	}
}

new Food_Menu_Loadmore();