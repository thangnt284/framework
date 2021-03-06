<?php
vc_map(array(
    "name" => 'CMS Search Book',
    "base" => "cms_search_book",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CmsSuperheroes Shortcodes', "book-junky"),
    "params" => array(
    	array(
		    'type' => 'k2_images_param',
		    'heading' => esc_html__( 'Fancybox Style', 'book-junky' ),
		    'values' => 
			    array(
			    	'fancybox-1' => get_template_directory_uri().'/inc/elements/images/fancy-1.jpg',
			    	'fancybox-2' => get_template_directory_uri().'/inc/elements/images/fancy-2.jpg',
			    	'fancybox-3' => get_template_directory_uri().'/inc/elements/images/fancy-3.jpg',
			    	'fancybox-4' => get_template_directory_uri().'/inc/elements/images/fancy-4.jpg',
			    ),
		    'param_name' => 'fancybox_style',
		    "group" => esc_html__("Template", 'book-junky'),
		    'weight' => 1,
		),

		array(
            "type" => "textfield",
            "heading" => esc_html__("Button Border Radius", "book-junky"),
            "param_name" => "btn_radius",
            "description" => "Enter: ...px",
            "group" => esc_html__("Button Settings", "book-junky"),
        ),
    )
));

class WPBakeryShortCode_cms_search_book extends K2ShortCode
{   

    protected function content($atts, $content = null)
    {
        extract(shortcode_atts(array(), $atts));

        $html_id = cmsHtmlID('cms_button');
        $atts['template'] = 'template-'.str_replace('.php','',$atts['cms_template']);
        $atts['html_id'] = $html_id;
        return parent::content($atts, $content);
    }
}



