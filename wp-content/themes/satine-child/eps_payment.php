<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/prototype.js"></script>
<script language="JavaScript">
	function addTax() {

	  var tax = 0.03;
	  var amt = parseFloat( document.getElementById("inputAmount").value ) * (1 + tax);

	  amt = Math.round(amt*100)/100;
	//alert(amt);
	  $("amount").value = amt;
	  $("total").value = amt;
	  $("total2").innerHTML = amt;

	  return true;	//I think you need this -- false will cancel the submit
	}

            </script>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<div class="bodyText">
  <span class="style10"><br />
  
  <span class="style25">Please enter the invoice amount: $</span></span><br>
  <input type="text" name="inputAmount" id="inputAmount"><br>
  <input type="hidden" name="amount" id="amount">
<input type="hidden" name="on0" value="Invoice Number">
<span class="style10"><span class="style25">Please enter your Name:</span> </span><br> 
<input type="text" name="os0" maxlength="200">
</div><br>
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="info@sweetgarden.ca">
<input type="hidden" name="item_name" value="Sweet Garden Invoice">
<input type="hidden" name="item_number" value="Invoice Payment">

<input type="hidden" name="no_shipping" value="1">
<input type="hidden" name="return" value="http://www.sweetgarden.ca">
<input type="hidden" name="cancel_return" value="http://www.sweetgarden.ca">
<input type="hidden" name="cn" value="Additional Comments">
<input type="hidden" name="currency_code" value="CAD">
<input type="hidden" name="lc" value="CAD">
<input type="hidden" name="bn" value="PP-BuyNowBF">
<input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but6.gif" border="0" name="submit" onclick="addTax();" alt="Make payments with PayPal - it's fast, free and secure!">
</form>   
