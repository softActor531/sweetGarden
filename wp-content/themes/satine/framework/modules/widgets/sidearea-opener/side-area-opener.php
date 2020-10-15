<?php

class SatineElatedSideAreaOpener extends SatineElatedWidget {
    public function __construct() {
        parent::__construct(
            'eltdf_side_area_opener',
	        esc_html__('Elated Side Area Opener', 'satine'),
	        array( 'description' => esc_html__( 'Display a "hamburger" icon that opens the side area', 'satine'))
        );

        $this->setParams();
    }
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'        => 'textfield',
				'name'        => 'icon_color',
				'title'       => esc_html__('Side Area Opener Color', 'satine'),
				'description' => esc_html__('Define color for side area opener', 'satine')
			),
			array(
				'type'        => 'textfield',
				'name'        => 'icon_hover_color',
				'title'       => esc_html__('Side Area Opener Hover Color', 'satine'),
				'description' => esc_html__('Define hover color for side area opener', 'satine')
			),
			array(
				'type'        => 'textfield',
				'name'        => 'widget_margin',
				'title'       => esc_html__('Side Area Opener Margin', 'satine'),
				'description' => esc_html__('Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'satine')
			),
			array(
				'type' => 'textfield',
				'name' => 'widget_title',
				'title' => esc_html__('Side Area Opener Title', 'satine')
			)
		);
	}
	
	public function widget($args, $instance) {
		$holder_styles = array();
		if (!empty($instance['icon_color'])) {
			$holder_styles[] = 'color: ' . $instance['icon_color'].';';
		}
		if (!empty($instance['widget_margin'])) {
			$holder_styles[] = 'margin: ' . $instance['widget_margin'];
		}
		?>
		<a class="eltdf-side-menu-button-opener eltdf-icon-has-hover" <?php echo satine_elated_get_inline_attr($instance['icon_hover_color'], 'data-hover-color'); ?> href="javascript:void(0)" <?php satine_elated_inline_style($holder_styles); ?>>
			<?php if (!empty($instance['widget_title'])) { ?>
				<h5 class="eltdf-side-menu-title"><?php echo esc_html($instance['widget_title']); ?></h5>
			<?php } ?>
			<span class="eltdf-side-menu-lines">
        		<span class="eltdf-side-menu-line eltdf-line-1"></span>
        		<span class="eltdf-side-menu-line eltdf-line-2"></span>
                <span class="eltdf-side-menu-line eltdf-line-3"></span>
        	</span>
		</a>
	<?php }
}