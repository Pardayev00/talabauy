<?php
	global $wpdb;
	$newpost_id='';
	$post_name='listfoliopro_stripe_setting';
	$row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_name = '%s' ", $post_name));
	if(isset($row->ID )){
		$newpost_id= $row->ID;
	}	
	$stripe_mode=get_post_meta( $newpost_id,'listfoliopro_stripe_mode',true);
?>
<?php
	 include('header.php');
?>
<div class="card col-md-12 mb-3">
	<div class="card-body">
						
		<div class="row">
			<div class="col-md-12"><h3 class=""><?php esc_html_e( 'Stripe Api Settings', 'listfoliopro' );?> </h3>
			</div>
		</div> 
	
				<form id="stripe_form_iv" name="stripe_form_iv" class="form-horizontal" role="form" onsubmit="return false;">
					<div class="form-group row">
						<label for="text" class="col-md-3 control-label"></label>
						<div id="iv-loading" class="col-md-9"></div>
					</div>		
					<div class="form-group row">
						<label for="text" class="col-md-4 control-label"><?php esc_html_e( 'Gateway Mode', 'listfoliopro' );?></label>
						<div class="col-md-8">
							<select name="stripe_mode" id ="stripe_mode" class="form-select">
								<option value="test" <?php echo ($stripe_mode == 'test' ? 'selected' : '') ?>><?php esc_html_e( 'Test Mode', 'listfoliopro' );?></option>
								<option value="live" <?php echo ($stripe_mode == 'live' ? 'selected' : '') ?>><?php esc_html_e( 'Live Mode', 'listfoliopro' );?></option>
							</select>	
						</div>
					</div> 
					<div class="form-group row">
						<label for="text" class="col-md-4 control-label"><?php esc_html_e( 'Live Secret', 'listfoliopro' );?></label>
						<div class="col-md-8">
							<input type="text" class="form-control" name="secret_key" id="secret_key" value="<?php echo esc_attr(get_post_meta($newpost_id, 'listfoliopro_stripe_live_secret_key', true)); ?>" placeholder="<?php esc_html_e( 'Enter stripe secret key', 'listfoliopro' );?>">
						</div>
					</div>						
					<div class="form-group row">
						<label for="inputEmail3" class="col-md-4 control-label"><?php esc_html_e( 'Live Publishable', 'listfoliopro' );?></label>
						<div class="col-md-8">
							<input type="text" class="form-control" id="publishable_key" name="publishable_key" value="<?php echo esc_attr(get_post_meta($newpost_id, 'listfoliopro_stripe_live_publishable_key', true)); ?>"  placeholder="<?php esc_html_e( 'Enter stripe Api publishable key', 'listfoliopro' );?>">
						</div>
					</div>
					<div class="col-md-12">
						<hr>
					</div>
					<div class="clearfix"></div>
					<div class="form-group row">
						<label for="inputEmail3" class="col-md-4 control-label"><?php esc_html_e( 'Test Secret', 'listfoliopro' );?></label>
						<div class="col-md-8">
							<input type="text" class="form-control" id="secret_key_test" name="secret_key_test" value="<?php echo esc_attr(get_post_meta($newpost_id, 'listfoliopro_stripe_secret_test', true)); ?>"  placeholder="<?php esc_html_e( 'Enter stripe Api Secret Key', 'listfoliopro' );?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="inputEmail3" class="col-md-4 control-label"><?php esc_html_e( 'Test Publishable', 'listfoliopro' );?></label>
						<div class="col-md-8">
							<input type="text" class="form-control" id="stripe_publishable_test" name="stripe_publishable_test" value="<?php echo esc_attr(get_post_meta($newpost_id, 'listfoliopro_stripe_publishable_test', true)); ?>"  placeholder="<?php esc_html_e( 'Enter stripe Api publishable Key', 'listfoliopro' );?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="inputEmail3" class="col-md-4 control-label"><?php esc_html_e( 'Stripe API Currency Code', 'listfoliopro' );?></label>
						<div class="col-md-8">
							<?php
								$currency_iv=get_post_meta($newpost_id, 'listfoliopro_stripe_api_currency', true);
							?>
							<select id="stripe_api_currency" name="stripe_api_currency" class="form-select">
								<option value="USD" <?php echo ($currency_iv=='USD' ? 'selected':'')  ?> ><?php esc_html_e( 'US Dollars ($)', 'listfoliopro' );?></option>
								<option value="EUR" <?php echo ($currency_iv=='EUR' ? 'selected':'')  ?> ><?php esc_html_e( 'Euros (&euro;)', 'listfoliopro' );?></option>
								<option value="GBP" <?php echo ($currency_iv=='GBP' ? 'selected':'')  ?> ><?php esc_html_e( 'Pounds Sterling (£)', 'listfoliopro' );?></option>
								<option value="AUD" <?php echo ($currency_iv=='AUD' ? 'selected':'')  ?> ><?php esc_html_e( 'Australian Dollars ($)', 'listfoliopro' );?></option>
								<option value="BRL" <?php echo ($currency_iv=='BRL' ? 'selected':'')  ?> ><?php esc_html_e( 'Brazilian Real (R$)', 'listfoliopro' );?></option>
								<option value="CAD" <?php echo ($currency_iv=='CAD' ? 'selected':'')  ?> ><?php esc_html_e( 'Canadian Dollars ($)', 'listfoliopro' );?></option>
								<option value="CNY" <?php echo ($currency_iv=='CNY' ? 'selected':'')  ?> ><?php esc_html_e( 'Chinese Yuan', 'listfoliopro' );?></option>
								<option value="CZK" <?php echo ($currency_iv=='CZK' ? 'selected':'')  ?> ><?php esc_html_e( 'Czech Koruna', 'listfoliopro' );?></option>
								<option value="DKK" <?php echo ($currency_iv=='DKK' ? 'selected':'')  ?> ><?php esc_html_e( 'Danish Krone', 'listfoliopro' );?></option>
								<option value="HKD" <?php echo ($currency_iv=='HKD' ? 'selected':'')  ?> ><?php esc_html_e( 'Hong Kong Dollar ($)', 'listfoliopro' );?></option>
								<option value="HUF" <?php echo ($currency_iv=='HUF' ? 'selected':'')  ?> ><?php esc_html_e( 'Hungarian Forint', 'listfoliopro' );?></option>
								<option value="INR" <?php echo ($currency_iv=='INR' ? 'selected':'')  ?> ><?php esc_html_e( 'Indian Rupee', 'listfoliopro' );?></option>
								<option value="ILS" <?php echo ($currency_iv=='ILS' ? 'selected':'')  ?> ><?php esc_html_e( 'Israeli Sheqel', 'listfoliopro' );?></option>
								<option value="JPY" <?php echo ($currency_iv=='JPY' ? 'selected':'')  ?> ><?php esc_html_e( 'Japanese Yen (¥)', 'listfoliopro' );?></option>
								<option value="MYR" <?php echo ($currency_iv=='MYR' ? 'selected':'')  ?> ><?php esc_html_e( 'Malaysian Ringgits', 'listfoliopro' );?></option>
								<option value="MXN" <?php echo ($currency_iv=='MXN' ? 'selected':'')  ?> ><?php esc_html_e( 'Mexican Peso ($)', 'listfoliopro' );?></option>
								<option value="NZD" <?php echo ($currency_iv=='NZD' ? 'selected':'')  ?> ><?php esc_html_e( 'New Zealand Dollar ($)', 'listfoliopro' );?></option>
								<option value="NOK" <?php echo ($currency_iv=='NOK' ? 'selected':'')  ?> ><?php esc_html_e( 'Norwegian Krone', 'listfoliopro' );?></option>
								<option value="PHP" <?php echo ($currency_iv=='PHP' ? 'selected':'')  ?> ><?php esc_html_e( 'Philippine Pesos', 'listfoliopro' );?></option>
								<option value="PLN" <?php echo ($currency_iv=='PLN' ? 'selected':'')  ?> ><?php esc_html_e( 'Polish Zloty', 'listfoliopro' );?></option>
								<option value="SGD" <?php echo ($currency_iv=='SGD' ? 'selected':'')  ?> ><?php esc_html_e( 'Singapore Dollar ($', 'listfoliopro' );?>)</option>
								<option value="ZAR" <?php echo ($currency_iv=='ZAR' ? 'selected':'')  ?> ><?php esc_html_e( 'South African Rand', 'listfoliopro' );?></option>
								<option value="KRW" <?php echo ($currency_iv=='KRW' ? 'selected':'')  ?> ><?php esc_html_e( 'South Korean Won', 'listfoliopro' );?></option>
								<option value="SEK" <?php echo ($currency_iv=='SEK' ? 'selected':'')  ?> ><?php esc_html_e( 'Swedish Krona', 'listfoliopro' );?></option>
								<option value="CHF" <?php echo ($currency_iv=='CHF' ? 'selected':'')  ?> ><?php esc_html_e( 'Swiss Franc', 'listfoliopro' );?></option>
								<option value="RUB" <?php echo ($currency_iv=='RUB' ? 'selected':'')  ?> ><?php esc_html_e( 'Russian Ruble', 'listfoliopro' );?></option>
								<option value="TWD" <?php echo ($currency_iv=='TWD' ? 'selected':'')  ?> ><?php esc_html_e( 'Taiwan New Dollars', 'listfoliopro' );?></option>
								<option value="THB" <?php echo ($currency_iv=='THB' ? 'selected':'')  ?> ><?php esc_html_e( 'Thai Baht', 'listfoliopro' );?></option>
								<option value="TRY" <?php echo ($currency_iv=='TRY' ? 'selected':'')  ?> ><?php esc_html_e( 'Turkish Lira', 'listfoliopro' );?></option>
							</select>											
						</div>
					</div>							
				</form>					
				<div class="row">					
					<div class="col-md-12">	
						<label for="" class="col-md-4 control-label"></label>
						<div class="col-md-8">
						<button class="btn btn-info mt-2" onclick="return update_stripe_setting();"><?php esc_html_e( 'Update Settings', 'listfoliopro' );?></button>
						<a href="<?php echo listfoliopro_ep_ADMINPATH; ?>admin.php?page=listfoliopro-settings&payment_gateways" class="btn btn-info mt-2" ><?php esc_html_e( '<< Back', 'listfoliopro' );?></a>
						</div>
						<p>&nbsp;</p>
					</div>
				</div>
				<div class=" col-md-12  bs-callout bs-callout-info">
					<b>
						<?php esc_html_e( 'Stripe Test to Live mode: When turned from Test to Live did not have any of the plans you have created on Stripe.
						When you will switch from Stripe to Paypal and PayPal to Stripe again, the connection between  the plugin and Stripe was corrected and thus the plans were re-created in the Stripe account.', 'listfoliopro' );?>
					</b><br/>
				</div>	
				
	</div>
</div>	