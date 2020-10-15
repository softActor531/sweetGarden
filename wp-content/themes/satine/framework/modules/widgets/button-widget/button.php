<?php

class SatineElatedButtonWidget extends SatineElatedWidget {
	public function __construct() {
		parent::__construct(
			'eltdf_button_widget',
			esc_html__('Elated Button Widget', 'satine'),
			array( 'description' => esc_html__( 'Add button element to widget areas', 'satine'))
		);

		$this->setParams();
	}

	/**
	 * Sets widget options
	 */
	protected function setParams() {
		$this->params = array(
			array(
				'type'    => 'dropdown',
				'name'    => 'type',
				'title'   => esc_html__('Type', 'satine'),
				'options' => array(
					'solid'   => esc_html__('Solid', 'satine'),
					'outline' => esc_html__('Outline', 'satine'),
					'simple'  => esc_html__('Simple', 'satine')
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'size',
				'title'   => esc_html__('Size', 'satine'),
				'options' => array(
					'small'  => esc_html__('Small', 'satine'),
					'medium' => esc_html__('Medium', 'satine'),
					'large'  => esc_html__('Large', 'satine'),
					'huge'   => esc_html__('Huge', 'satine')
				),
				'description' => esc_html__('This option is only available for solid and outline button type', 'satine')
			),
			array(
				'type'    => 'textfield',
				'name'    => 'text',
				'title'   => esc_html__('Text', 'satine'),
				'default' => esc_html__('Button Text', 'satine')
			),
			array(
				'type'  => 'textfield',
				'name'  => 'link',
				'title' => esc_html__('Link', 'satine')
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'target',
				'title'   => esc_html__('Link Target', 'satine'),
				'options' => satine_elated_get_link_target_array()
			),
			array(
				'type'  => 'textfield',
				'name'  => 'color',
				'title' => esc_html__('Color', 'satine')
			),
			array(
				'type'  => 'textfield',
				'name'  => 'hover_color',
				'title' => esc_html__('Hover Color', 'satine')
			),
			array(
				'type'        => 'textfield',
				'name'        => 'background_color',
				'title'       => esc_html__('Background Color', 'satine'),
				'description' => esc_html__('This option is only available for solid button type', 'satine')
			),
			array(
				'type'        => 'textfield',
				'name'        => 'hover_background_color',
				'title'       => esc_html__('Hover Background Color', 'satine'),
				'description' => esc_html__('This option is only available for solid button type', 'satine')
			),
			array(
				'type'        => 'textfield',
				'name'        => 'border_color',
				'title'       => esc_html__('Border Color', 'satine'),
				'description' => esc_html__('This option is only available for solid and outline button type', 'satine')
			),
			array(
				'type'        => 'textfield',
				'name'        => 'hover_border_color',
				'title'       => esc_html__('Hover Border Color', 'satine'),
				'description' => esc_html__('This option is only available for solid and outline button type', 'satine')
			),
			array(
				'type'        => 'textfield',
				'name'        => 'margin',
				'title'       => esc_html__('Margin', 'satine'),
				'description' => esc_html__('Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'satine')
			)
		);
	}

	/**
	 * Generates widget's HTML
	 *
	 * @param array $args args from widget area
	 * @param array $instance widget's options
	 */
	public function widget($args, $instance) {
		$params = '';

		if (!is_array($instance)) { $instance = array(); }

		// Filter out all empty params
		$instance = array_filter($instance, function($array_value) { return trim($array_value) != ''; });

		// Default values
		if (!isset($instance['text'])) { $instance['text'] = 'Button Text'; }

		// Generate shortcode params
		foreach($instance as $key => $value) {
			$params .= " $key='$value' ";
		}

		echo '<div class="widget eltdf-button-widget">';
			echo do_shortcode("[eltdf_button $params]"); // XSS OK
		echo '</div>';
	}
}