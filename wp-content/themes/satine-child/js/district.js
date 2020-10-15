<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
jQuery(document).ready(function () {

    jQuery('#billing_city').change(function () {
        var billing_district = jQuery('#billing_city').val();
        console.log(billing_district);
        var data = {
            action: 'woocommerce_apply_district',
            security: wc_checkout_params.apply_district_nonce,
            district: billing_district
        };

        jQuery.ajax({
            type: 'POST',
            url: wc_checkout_params.ajax_url,
            data: data,
            success: function (code) {
                if (code === '0') {
//                    $form.before(code);
                    jQuery('body').trigger('update_checkout');
                }
            },
            dataType: 'html'
        });

        return false;
    });
});

