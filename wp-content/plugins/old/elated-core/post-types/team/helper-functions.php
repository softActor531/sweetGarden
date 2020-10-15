<?php

if(!function_exists('eltdf_core_team_meta_box_functions')) {
	function eltdf_core_team_meta_box_functions($post_types) {
		$post_types[] = 'team-member';
		
		return $post_types;
	}
	
	add_filter('satine_elated_meta_box_post_types_save', 'eltdf_core_team_meta_box_functions');
	add_filter('satine_elated_meta_box_post_types_remove', 'eltdf_core_team_meta_box_functions');
}

if(!function_exists('eltdf_core_register_team_cpt')) {
	function eltdf_core_register_team_cpt($cpt_class_name) {
		$cpt_class = array(
			'ElatedCore\CPT\Team\TeamRegister'
		);
		
		$cpt_class_name = array_merge($cpt_class_name, $cpt_class);
		
		return $cpt_class_name;
	}
	
	add_filter('eltdf_core_filter_register_custom_post_types', 'eltdf_core_register_team_cpt');
}

if(!function_exists('eltdf_core_get_single_team')) {
	/**
	 * Loads holder template for doctor single
	 */
	function eltdf_core_get_single_team() {
		$team_member_id = get_the_ID();
		
		$params = array(
			'sidebar_layout' => satine_elated_sidebar_layout(),
			'position'       => get_post_meta($team_member_id, 'eltdf_team_member_position', true),
			'birth_date'     => get_post_meta($team_member_id, 'eltdf_team_member_birth_date', true),
			'email'          => get_post_meta($team_member_id, 'eltdf_team_member_email', true),
			'phone'          => get_post_meta($team_member_id, 'eltdf_team_member_phone', true),
			'address'        => get_post_meta($team_member_id, 'eltdf_team_member_address', true),
			'education'      => get_post_meta($team_member_id, 'eltdf_team_member_education', true),
			'resume'         => get_post_meta($team_member_id, 'eltdf_team_member_resume', true),
			'social_icons'   => eltdf_core_single_team_social_icons($team_member_id),
		);
		
		eltdf_core_get_cpt_single_module_template_part('templates/single/holder', 'team', '', $params);
	}
}

if(!function_exists('eltdf_core_single_team_social_icons')) {
	function eltdf_core_single_team_social_icons($id){
		$social_icons = array();
		
		for ($i = 1; $i < 6; $i++) {
			$team_icon_pack = get_post_meta($id, 'eltdf_team_member_social_icon_pack_' . $i, true);
			if($team_icon_pack !== '') {
				$team_icon_collection = satine_elated_icon_collections()->getIconCollection(get_post_meta($id, 'eltdf_team_member_social_icon_pack_' . $i, true));
				$team_social_icon     = get_post_meta($id, 'eltdf_team_member_social_icon_pack_' . $i . '_' . $team_icon_collection->param, true);
				$team_social_link     = get_post_meta($id, 'eltdf_team_member_social_icon_' . $i . '_link', true);
				$team_social_target   = get_post_meta($id, 'eltdf_team_member_social_icon_' . $i . '_target', true);
				
				if ($team_social_icon !== '') {
					$team_icon_params = array();
					$team_icon_params['icon_pack']                  = $team_icon_pack;
					$team_icon_params[$team_icon_collection->param] = $team_social_icon;
					$team_icon_params['link']                       = !empty($team_social_link) ? $team_social_link : '';
					$team_icon_params['target']                     = !empty($team_social_target) ? $team_social_target : '_self';
					
					$social_icons[] = satine_elated_execute_shortcode('eltdf_icon', $team_icon_params);
				}
			}
		}
		
		return $social_icons;
	}
}

if(!function_exists('eltdf_core_get_team_category_list')) {
	function eltdf_core_get_team_category_list($category = '') {
		$number_of_columns = 3;
		
		$params = array(
			'number_of_columns'   => $number_of_columns
		);
		
		if(!empty($category)) {
			$params['category'] = $category;
		}
		
		$html = satine_elated_execute_shortcode('eltdf_team_list', $params);
		
		print $html;
	}
}