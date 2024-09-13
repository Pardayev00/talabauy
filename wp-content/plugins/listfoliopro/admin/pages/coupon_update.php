<?php
	global $wpdb;
	$id='';	$title='';
	if(isset($_REQUEST['id'])){
		$id=sanitize_text_field($_REQUEST['id']);
	}
	$row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE Id = '%s' ",$id));
	if(isset($row->post_title )){
		$title= $row->post_title;
	}	
?>
<?php
	 include('header.php');
?>
<div class="card col-md-12 col-lg-6 mb-3">
			<div class="card-body">
		
		<div class="row">
			<div class="col-md-12"><h3 class="page-header"><?php esc_html_e( 'Update Coupon', 'listfoliopro' );?> </h3>
			</div>	
		</div> 
		<form id="coupon_form_iv" name="coupon_form_iv"   onsubmit="return false;">
			<div class="form-group row">
				<label for="text" class="col-sm-2 control-label"></label>
				<div id="iv-loading"></div>
			</div>	
			<div class="form-group ">
				<label for="text" class="control-label"><?php esc_html_e( 'Coupon Name', 'listfoliopro' );?></label>				
				<input type="text" class="form-control" name="coupon_name" id="coupon_name" value="<?php echo esc_attr($title); ?>" placeholder="<?php esc_attr_e( 'Enter Coupon Name Or Coupon Code', 'listfoliopro' );?>">
				
			</div>	
			<div class="form-group ">
				<label for="text" class=" control-label"><?php esc_html_e( 'Discount Type', 'listfoliopro' );?></label>
				
					<?php
						$dis_type= esc_attr(get_post_meta($id, 'listfoliopro_coupon_type', true)); 
					?>
					<select  name="coupon_type" id ="coupon_type" class="form-control">
						<option value="amount" 		<?php echo ($dis_type=='amount' ? 'selected' : '' ); ?> ><?php esc_html_e( 'Fixed Amount', 'listfoliopro' );?></option>
						<option value="percentage"  <?php echo ($dis_type=='percentage' ? 'selected' : '' ); ?> ><?php esc_html_e( 'Percentage', 'listfoliopro' );?></option>
					</select>
				
			</div> 
			<div class="form-group ">
				<label for="text" class="control-label"><?php esc_html_e( 'Select Package', 'listfoliopro' );?></label>
			
					<?php
						global $wpdb, $post;
						$listfoliopro_pack='listfoliopro_pack';		
						$sql=$wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_type =%s",$listfoliopro_pack );
						$membership_pack = $wpdb->get_results($sql);
						$current_pac=get_post_meta($id, 'listfoliopro_coupon_pac_id', true);
						$current_pac_arr=explode(",",$current_pac);
						if(sizeof($membership_pack)>0){
							$i=0;
							echo'<select multiple name="package_id" id ="package_id" class="form-control">';
							foreach ( $membership_pack as $row )
							{
								$recurring= get_post_meta( $row->ID,'listfoliopro_package_recurring',true);
								$pac_cost= get_post_meta( $row->ID,'listfoliopro_package_cost',true);
								if($recurring!='on' and $pac_cost!="" ){ ?>
								<option value="<?php echo esc_attr($row->ID); ?>" <?php echo (in_array( $row->ID, $current_pac_arr) ? 'selected' : '') ?>><?php echo esc_html($row->post_title); ?></option>
								<?php
								}
							}	
							echo '</select>';	
						}	
					?>
				
			</div> 
			<div class="form-group ">
				<label for="inputEmail3" class="control-label"><?php esc_html_e( 'Usage Limit', 'listfoliopro' );?></label>
				
					<input type="text" class="form-control" id="coupon_count" name="coupon_count" value="<?php echo esc_attr(get_post_meta($id, 'listfoliopro_coupon_limit', true)); ?>"  placeholder="<?php esc_html_e( 'Enter Usage Limit Number', 'listfoliopro' );?>">
				
			</div>
			<div class="form-group " >									
				<label for="text" class=" control-label"><?php esc_html_e( 'Start Date', 'listfoliopro' );?></label>
			
					<input type="text"  readonly name="start_date"   id="start_date" class="form-control ctrl-textbox"  placeholder="<?php esc_html_e( 'Select Date', 'listfoliopro' );?>" value="<?php echo esc_attr(get_post_meta($id, 'listfoliopro_coupon_start_date', true)); ?>">
				
			</div>							  
			<div class="form-group ">
				<label for="inputEmail3" class=" control-label"><?php esc_html_e( 'Expire Date', 'listfoliopro' );?></label>
				
					<input type="text" class="form-control" readonly id="end_date" name="end_date" value="<?php echo esc_attr(get_post_meta($id, 'listfoliopro_coupon_end_date', true)); ?>"  placeholder="<?php esc_attr_e( 'Select Date', 'listfoliopro' );?>">
			
			</div>
			<div class="form-group ">
				<label for="inputEmail3" class=" control-label"><?php esc_html_e( 'Amount', 'listfoliopro' );?></label>
			
					<input type="text" class="form-control" id="coupon_amount" name="coupon_amount" value="<?php echo esc_attr(get_post_meta($id, 'listfoliopro_coupon_amount', true)); ?>"  placeholder="<?php esc_attr_e( 'Coupon Amount [ Only Amount no Currency ]', 'listfoliopro' );?>">
				
			</div>
			
			<div class="form-group ">
				<label for="inputEmail3" class=" control-label"></label>
				
					<button class="btn btn-info mt-2" onclick="return listfoliopro_update_coupon();"><?php esc_html_e( 'Update Coupon', 'listfoliopro' );?></button>
					<a href="<?php echo listfoliopro_ep_ADMINPATH; ?>admin.php?page=listfoliopro-settings&coupons" class="btn btn-info mt-2" ><?php esc_html_e( '<< Back', 'listfoliopro' );?></a>
				
			</div>
			
			<input type="hidden"  id="coupon_id" name="coupon_id" value="<?php echo esc_attr($id); ?>"  >
		</form>
		<div class=" col-md-12  bs-callout bs-callout-info">		
			<?php esc_html_e( 'Note : Coupon will work on "One Time Payment" only. Coupon will not work on recurring payment and it will not support 100% discount.		', 'listfoliopro' );?>
		</div>
		
	</div>						
</div>	