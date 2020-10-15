<script type="text/javascript">

	  jQuery("#edValue").keyup(function(){
		  $vsl=jQuery(this).val();
		 	// console.log($vsl);
		  
			// jQuery("#calc_shipping_postcode_field #calc_shipping_postcode").val($vsl); 
	
	  });
	
jQuery(document).ready(function(){	
	jQuery('#calc_shipping_country_field option').filter(function() {
        return !this.value || $.trim(this.value).length == 0;
    })
   .remove();
  jQuery("#shipping_method_0_flat_rate22").live("click", function(){
    jQuery(".woocommerce-shipping-calculator").addClass( "woocommerce-shipping-calculator-add" );
  });	
 jQuery("#shipping_method_0_local_pickup24").live("click", function(){
    jQuery(".woocommerce-shipping-calculator").addClass( "woocommerce-shipping-calculator-remove" );
  });
  jQuery(".shipping-calculator-form .button").on("click",function(){
	 
                    });
});
</script>
<?php do_action('satine_elated_get_footer_template');