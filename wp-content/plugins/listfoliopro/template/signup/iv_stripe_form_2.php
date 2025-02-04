<?php
	if ( ! defined( 'ABSPATH' ) ) exit; 
?>
<?php
	$newpost_id='';
	$post_name='listfoliopro_stripe_setting';
	$row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_name = '%s' ", $post_name));
	if(isset($row->ID )){
		$newpost_id= $row->ID;
	}
	$stripe_mode=get_post_meta( $newpost_id,'listfoliopro_stripe_mode',true);
	if($stripe_mode=='test'){
		$stripe_publishable =get_post_meta($newpost_id, 'listfoliopro_stripe_publishable_test',true);
		}else{
		$stripe_publishable =get_post_meta($newpost_id, 'listfoliopro_stripe_live_publishable_key',true);
	}
	wp_enqueue_script('stripe', 'https://js.stripe.com/v2/');
?>
<div id="payment-errors"></div>
<div class="row form-group">
	<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"><?php   esc_html_e('Package Name','listfoliopro');?></label>
	<div class="col-md-8 col-xs-4 col-sm-8 "> 	
		<?php
			$api_currency= get_option('listfoliopro_api_currency');
			if( $package_name==""){													
				$listfoliopro_pack='listfoliopro_pack';
				$sql=$wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_type = '%s'  and post_status='draft' ",$listfoliopro_pack);
				$membership_pack = $wpdb->get_results($sql);
				$total_package=count($membership_pack);											
				if(sizeof($membership_pack)>0){
					$i=0;
					echo'<select name="package_sel" id ="package_sel" class=" form-control">';
					foreach ( $membership_pack as $row )
					{	
						$recurring_text='  ';
						if(get_post_meta($row->ID, 'listfoliopro_package_cost', true)=='0' or get_post_meta($row->ID, 'listfoliopro_package_cost', true)==""){
							$amount= 'Free';
							}else{
							$amount= $api_currency.' '. get_post_meta($row->ID, 'listfoliopro_package_cost', true);
							$amount_only= get_post_meta($row->ID, 'listfoliopro_package_cost', true);
						}
						$recurring_text=$amount;						
						$recurring= get_post_meta($row->ID, 'listfoliopro_package_recurring', true);
						if($recurring == 'on'){
							$amount= $api_currency.' '. get_post_meta($row->ID, 'listfoliopro_package_recurring_cost_initial', true);
							$amount_only= get_post_meta($row->ID, 'listfoliopro_package_recurring_cost_initial', true);
							$count_arb=get_post_meta($row->ID, 'listfoliopro_package_recurring_cycle_count', true);
							if($count_arb=="" or $count_arb=="1"){
								$recurring_text=$recurring_text.' per '.$count_arb.' '.get_post_meta($row->ID, 'listfoliopro_package_recurring_cycle_type', true).esc_html__(', Auto recurring ','listfoliopro') ;
								$recurring_text=$recurring_text.', '.get_post_meta($row->ID,'package_subtitle',true);
								}else{
								$recurring_text=$recurring_text.' per '.$count_arb.' '.get_post_meta($row->ID, 'listfoliopro_package_recurring_cycle_type', true).'s'.esc_html__(', Auto recurring ','listfoliopro') ;
								$recurring_text=$recurring_text.' '.get_post_meta($row->ID,'package_subtitle',true);
							}
							}else{ 
							$recurring_text=$recurring_text.', '.esc_html__('Package Expire After ','listfoliopro' ).get_post_meta($row->ID, 'listfoliopro_package_initial_expire_interval', true).' '.get_post_meta($row->ID, 'listfoliopro_package_initial_expire_type', true).', '. get_post_meta($row->ID,'package_subtitle',true);
						}
						echo '<option value="'. esc_attr($row->ID).'" >'. esc_html($row->post_title).' | '.esc_html($recurring_text).'</option>';
						if($i==0){$package_id=$row->ID;}
						$i++;
					}	
					echo '</select>';	
					$package_id= $membership_pack[0]->ID;
					$recurring= get_post_meta($package_id, 'listfoliopro_package_recurring', true);
					if($recurring == 'on'){
						$package_amount=get_post_meta($package_id, 'listfoliopro_package_recurring_cost_initial', true);
						}else{
						$package_amount=get_post_meta($package_id, 'listfoliopro_package_cost',true);
					}	
				}	
				}else{
				echo '<label class="control-label"> '.$package_name.'</label>';
				$recurring= get_post_meta($package_id, 'listfoliopro_package_recurring', true);
				if($recurring == 'on'){
					$package_amount=get_post_meta($package_id, 'listfoliopro_package_recurring_cost_initial', true);
					}else{
					$package_amount=get_post_meta($package_id, 'listfoliopro_package_cost',true);
				}
			}
		?>
	</div>
</div>
<div class="row form-group">
	<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"><?php   esc_html_e('Amount','listfoliopro');?></label>
	<div class="col-md-8 col-xs-8 col-sm-8 " id="p_amount"> <label class="control-label"> <?php echo esc_html($package_amount).' '.esc_html($api_currency); ?> </label>
	</div>										
</div>
<?php
	if( get_option('epjblistfoliopro_payment_coupon')==""){
	?>
	<div class="row form-group" id="show_hide_div">
		<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"></label>
		<div class="col-md-8 col-xs-8 col-sm-8 " > 
			<button type="button" onclick="listfoliopro_show_coupon();"  class="btn btn-small-ar center"><?php   esc_html_e('Have a coupon?','listfoliopro');?></button>
		</div>
	</div>
	<?php
		require_once(listfoliopro_ep_template.'signup/coupon_form_2.php');
	}
?>
<div class="row form-group">
	<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"><?php   esc_html_e('Card Number','listfoliopro');?></label>
	<div class="col-md-8 col-xs-8 col-sm-8 " >  
		<input type="text" name="card_number" id="card_number"  data-validation="creditcard required"  class="form-control ctrl-textbox" placeholder="<?php esc_html_e( 'Enter card number', 'listfoliopro' );?>"  data-validation-error-msg="<?php esc_html_e( 'Invalid Card Number', 'listfoliopro' );?>" >
	</div>										
</div>
<div class="row form-group">
	<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"><?php   esc_html_e('Card CVV ','listfoliopro');?></label>
	<div class="col-md-8 col-xs-8 col-sm-8 " >  
		<input type="text" name="card_cvc" id="card_cvc" class="form-control ctrl-textbox"   data-validation="number" 
		data-validation-length="2-6" data-validation-error-msg="<?php esc_html_e( 'Invalid CVV Number', 'listfoliopro' );?>"placeholder="<?php esc_html_e( 'Enter card CVV', 'listfoliopro' );?>" >
	</div>
</div>	
<div class="row form-group">
	<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"><?php   esc_html_e('Expiration (MM/YYYY)','listfoliopro');?></label>
	<div class="col-md-4 col-xs-4 col-sm4" >  
		<select name="card_month" id="card_month"  class="card-expiry-month stripe-sensitive required form-control">
			<option value="01" selected="selected"><?php esc_html_e( '01', 'listfoliopro' );?></option>
			<option value="02"><?php esc_html_e( '02', 'listfoliopro' );?></option>
			<option value="03"><?php esc_html_e( '03', 'listfoliopro' );?></option>
			<option value="04"><?php esc_html_e( '04', 'listfoliopro' );?></option>
			<option value="05"><?php esc_html_e( '05', 'listfoliopro' );?></option>
			<option value="06"><?php esc_html_e( '06', 'listfoliopro' );?></option>
			<option value="07"><?php esc_html_e( '07', 'listfoliopro' );?></option>
			<option value="08"><?php esc_html_e( '08', 'listfoliopro' );?></option>
			<option value="09"><?php esc_html_e( '09', 'listfoliopro' );?></option>
			<option value="10"><?php esc_html_e( '10', 'listfoliopro' );?></option>
			<option value="11"><?php esc_html_e( '11', 'listfoliopro' );?></option>
			<option value="12" selected ><?php esc_html_e( '12', 'listfoliopro' );?></option>
		</select>
	</div>
	<div class="col-md-4 col-xs-4 col-sm-4 " >  
		<select name="card_year"  id="card_year"  class="card-expiry-year stripe-sensitive  form-control">
		</select>		
	</div>								
</div>	
<?php
	$listfoliopro_payment_terms=get_option('listfoliopro_payment_terms');
	$term_text='I have read & accept the Terms & Conditions';
	if( get_option( 'listfoliopro_payment_terms_text' ) ) {
		$term_text= get_option('listfoliopro_payment_terms_text');
	}
	if($listfoliopro_payment_terms=='yes'){
	?>
	<div class="row">
		<div class="col-md-4 col-xs-4 col-sm-4 "> 
		</div>
		<div class="col-md-8 col-xs-8 col-sm-8 "> 
			<label>
				<input type="checkbox" data-validation="required" 
				data-validation-error-msg="<?php esc_html_e( 'You have to agree to our terms', 'listfoliopro' );?> "  name="check_terms" id="check_terms"> <?php echo esc_html($term_text); ?>
			</label>
			<div class="text-danger" id="error_message" > </div>
		</div>									
	</div>
	<?php
	}	 
?>	
<input type="hidden" name="package_id" id="package_id" value="<?php echo esc_attr($package_id); ?>">	
<input type="hidden" name="form_reg" id="form_reg" value="">
<input type="hidden" name="action" value="stripe"/>
<input type="hidden" name="redirect" value="<?php echo get_permalink(); ?>"/>
<input type="hidden" name="stripe_nonce" value="<?php echo wp_create_nonce('stripe-nonce'); ?>"/>
<div class="row form-group">
	<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"></label>
	<div class="col-md-8 col-xs-8 col-sm-8 " > 
		<div id="errormessage" class="alert alert-danger mt-2 displaynone" role="alert"></div>
		<div id="loading-3" class="none"><img src='<?php echo esc_url(listfoliopro_ep_URLPATH. 'admin/files/images/loader.gif'); ?>' /></div>
		<?php
			if($eprecaptcha_api==''){
			?>
			<button  id="submit_listfoliopro_payment"  type="submit" class="btn btn-info ctrl-btn"  > <?php   esc_html_e('Submit','listfoliopro');?> </button>
			<?php
				}else{
			?>
			<button  id="submit_listfoliopro_payment" name="submit_listfoliopro_payment"  class="btn btn-secondary g-recaptcha" data-sitekey="<?php echo esc_html($eprecaptcha_api); ?>"  data-callback='listfoliopro_epluginrecaptchaSubmit' data-action='submit' >
				<?php  esc_html_e('Submit','listfoliopro');?>
			</button>
			<?php
			}
		?>
	</div>
</div>	