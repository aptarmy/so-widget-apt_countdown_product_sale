<?php

/*
Widget Name: APT Countdown Product Sale
Description: Count down product sale
Author: Mr.Pakpoom Tiwakornkit
Author URI: https://github.com/aptarmy
Widget URI: https://aptarmy.github.io/apt-news.io/hello-world-widget-docs,
Video URI: https://aptarmy.github.io/apt-news.io/hello-world-widget-video
*/

// this class will be used to register a widget
// siteorigin_wiget class was extended from WP_widget class
// so we can use constructor available in WP_widge class
class APT_Countdown_Product_Sale extends APT_Widget {
	
	function __construct() {
		//Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.
		
		//Call the parent constructor with the required arguments.
		parent::__construct(
			// The unique id for your widget.
			'apt_countdown_product_sale',

			// The name of the widget for display purposes.
			__('APT Countdown Product Sale', 'apt'),

			// The $widget_options array, which is passed through to WP_Widget.
			// It has a couple of extras like the optional help URL, which should link to your sites help or support page.
			array(
				'description' => __('Show count down in selected sale product.', 'apt'),
				'panels_groups' => array('apt_widgets'),
			),

			//The $control_options array, which is passed through to WP_Widget
			array(
			),

			//The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
			array(
				'post' => array(
			        'type' => 'posts',
			        'label' => __('Select your sale product', 'apt'),
			    ),
				$this->get_float_id() => $this->get_float_options(),
				$this->get_media_query_id() => $this->get_media_query_options(),
			),

			//The $base_folder path string.
			plugin_dir_path(__FILE__)
		);
	}
		
	/* Get template file */
    function get_template_name($instance) {
		return 'template';
    }

	/* Get less file */
    function get_style_name($instance) {
        return 'style';
    }
	
	/* set less variable */
	function get_less_variables($instance){
		return array(
			
		);
	}
}
// siteorigin_widget_register($desired_widget_id, $path_to_widget, $class_used_to_create_widget)
siteorigin_widget_register('apt_countdown_product_sale', __FILE__, 'APT_Countdown_Product_Sale');