<?php

/*** Child Theme Function  ***/

function satine_elated_child_theme_enqueue_scripts() {
	$parent_style = 'satine_elated_default_style';

	wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');

	wp_enqueue_style('satine_elated_child_style',
		get_stylesheet_directory_uri() . '/style.css',
		array($parent_style),
		wp_get_theme()->get('Version')
	);
}

add_action( 'wp_enqueue_scripts', 'satine_elated_child_theme_enqueue_scripts' );


function mytheme_add_woocommerce_support() {
add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

add_filter( 'default_checkout_billing_state', 'bbloomer_change_default_checkout_state' );
  
function bbloomer_change_default_checkout_state() {
  return 'ON'; // state code
}

// Put cart page table on checkout page

add_action( 'woocommerce_before_checkout_form', 'bbloomer_cart_on_checkout_page_only', 5 );
 
function bbloomer_cart_on_checkout_page_only() {
 
if ( is_wc_endpoint_url( 'order-received' ) ) return;
 
// NOTE: I had to change the name of the shortcode below...
// ...as it would have displayed this site's Cart...
// ... make sure to use "woocommerce_cart" inside "[]":
 
echo do_shortcode('[woocommerce_cart]');
 
}

// Redirect to homepage if checkout is empty

add_action( 'template_redirect', 'bbloomer_redirect_empty_cart_checkout_to_home' );
 
function bbloomer_redirect_empty_cart_checkout_to_home() {
    if ( is_cart() && is_checkout() && 0 == WC()->cart->get_cart_contents_count() && ! is_wc_endpoint_url( 'order-pay' ) && ! is_wc_endpoint_url( 'order-received' ) ) {
        wp_safe_redirect( home_url() );
        exit;
    }
}


// Add shipping calculator on checkout page

add_action( 'wp_enqueue_scripts', 'test_test' );
    function test_test() {
    if( is_checkout() ) {
        if( wp_script_is( 'wc-cart', 'registered' ) && !wp_script_is( 'wc-cart', 'enqueued' ) ) {
        wp_enqueue_script( 'wc-cart' );
        }
    }   
}
  function woocommerce_shipping_calculator( $button_text = '' ) {
    if ( 'no' === get_option( 'woocommerce_enable_shipping_calc' ) || ! WC()->cart->needs_shipping() ) {
      return;
    }
    wp_enqueue_script( 'wc-country-select' );
    wc_get_template(
      'cart/shipping-calculator.php',
      array(
        'button_text' => $button_text,
      )
    );
  }

add_filter( 'woocommerce_ship_to_different_address_checked', '__return_true' );

add_filter( 'woocommerce_shipping_package_name', 'custom_shipping_package_name' );
function custom_shipping_package_name( $name ) {
    return 'Delivery';
}
function wps_payment_page()
{  
   ob_start();
  require_once('eps_payment.php');
  return ob_get_clean();
}

add_shortcode('wps_payment_page','wps_payment_page');


function vs_shipping_method( $rates ) {
    $free = array();
	foreach ( $rates as $rate_id => $rate ) {
		if ( 'advanced_shipping' === $rate->method_id ) {
			$free[ $rate_id ] = $rate;
			break;
		}
	}
	return ! empty( $free ) ? $free : $rates;
}
add_filter( 'woocommerce_package_rates', 'vs_shipping_method', 100 );