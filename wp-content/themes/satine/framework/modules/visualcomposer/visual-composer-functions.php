<?php

if(!function_exists('satine_elated_get_vc_version')) {
	/**
	 * Return Visual Composer version string
	 *
	 * @return bool|string
	 */
	function satine_elated_get_vc_version() {
		if(satine_elated_visual_composer_installed()) {
			return WPB_VC_VERSION;
		}

		return false;
	}
}