<?php

if ( ! function_exists('satine_elated_like') ) {
	/**
	 * Returns SatineElatedLike instance
	 *
	 * @return SatineElatedLike
	 */
	function satine_elated_like() {
		return SatineElatedLike::get_instance();
	}
}

function satine_elated_get_like() {

	echo wp_kses(satine_elated_like()->add_like(), array(
		'span' => array(
			'class' => true,
			'aria-hidden' => true,
			'style' => true,
			'id' => true
		),
		'i' => array(
			'class' => true,
			'style' => true,
			'id' => true
		),
		'a' => array(
			'href' => true,
			'class' => true,
			'id' => true,
			'title' => true,
			'style' => true
		)
	));
}

if ( ! function_exists('satine_elated_like_latest_posts') ) {
	/**
	 * Add like to latest post
	 *
	 * @return string
	 */
	function satine_elated_like_latest_posts() {
		return satine_elated_like()->add_like();
	}
}

if ( ! function_exists('satine_elated_like_portfolio_list') ) {
	/**
	 * Add like to portfolio project
	 *
	 * @param $portfolio_project_id
	 * @return string
	 */
	function satine_elated_like_portfolio_list($portfolio_project_id) {
		return satine_elated_like()->add_like_portfolio_list($portfolio_project_id);
	}
}

if ( ! function_exists('satine_elated_like_portfolio_single') ) {
    /**
     * Add like to portfolio project
     *
     * @param $portfolio_project_id
     * @return string
     */
    function satine_elated_like_portfolio_single() {
        return satine_elated_like()->add_like_portfolio_single();
    }
}