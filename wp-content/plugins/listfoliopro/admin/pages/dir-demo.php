<?php
	global $wpdb;
	global $current_user;
	$ii=1;
	$listfoliopro_directory_url=get_option('listfoliopro_ep_url');
	if($listfoliopro_directory_url==""){$listfoliopro_directory_url='listing';}
?>
<div class="row">
	<div class="col-md-12">	
		<div class="progress ">							
			<div id="dynamic" class=" progress-bar progress-bar-success progress-bar-striped active " role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" >
				<span id="current-progress"></span>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4 none " id="cptlink12" > <a  class="btn btn-info " href="<?php echo get_post_type_archive_link( $listfoliopro_directory_url) ; ?>" target="_blank"><?php esc_html_e('View All Listing','listfoliopro');?>  </a>
			</div>
			<div class="col-md-4"></div>	
		</div>	
		<div class="row" id="importbutton">						
			<div class="col-md-12 "> 								
				<button type="button" onclick="return  listfoliopro_import_demo();" class="margin-top-10 listfoliopro-button"><?php esc_html_e('Import Demo Listing','listfoliopro');?> </button>
			</div>
		</div>					
	</div>			
</div>

