<?php

return array(
	'id'          => 'wcbox_widget_id',
	'types'       => array('wcbox'),
	'title'       => __('Wcbox Sidebar Options', 'wcbox'),
	'priority'    => 'low',
	'context'     => 'side',
	'template'    => array(
		array(
		'type'      => 'group',
		'repeating' => false,
		'length'    => 1,
		'name'      => 'group',
		'title'     => __('Enable Widget', 'wcbox'),
		'fields'    => array(
			array(
				'type' => 'radiobutton',
				'name' => 'enable_widget',
				'label' => __(' ', 'wcbox'),
				'description' => __('Please Use this options if you want to use this  [shortcode] into Any sidebar', 'wcbox'),
				'items' => array(
					array(
						'value' => 'yes',
						'label' => 'Yes',
					),
					array(
						'value' => 'no',
						'label' => 'No',
					),
				
				),
				'default' => 'no'
				),
		
			array(
				'type' => 'radiobutton',
				'name' => 'ss_check',
				'label' => __('Options', 'wcbox'),
				'dependency' => array(
						'field'    => 'enable_widget',
						'function' => 'vp_dep_is_widget_en',
					),
				'items' => array(
					array(
						'value' => 'static',
						'label' => 'Static',
					),
					array(
						'value' => 'slider',
						'label' => 'Slider',
					),
				
				),
				'default' => 'static'
				),
					
		),
		),

		

	),
);

/**
 * EOF
 */