<?php
 if ( ! defined( 'ABSPATH' ) ) exit; 
?>


<div class="mt-3 row ">	
	<div class="col-md-4">
		<span class="toptitle-sub"><?php esc_html_e('Profil', 'listfoliopro'); ?></span>
	</div>
	<div class="col-md-8">
		
		<ul class="nav nav-pills  float-right" id="pills-tab" role="tablist">
			<li class="nav-item">
				 <a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#tab_info" role="tab" aria-controls="pills-home" aria-selected="true"><?php   esc_html_e("Shaxsiy ma'lumot",'listfoliopro');?> </a>
			</li>
			<li class="nav-item">
				 <a class="nav-link " id="pills-add-tab" data-toggle="pill" href="#tab_pass" role="tab" aria-controls="pills-home" ><?php   esc_html_e('Parolni tiklash','listfoliopro');?></a>
				 
				
			</li>
			
		</ul>
	</div>
	<div class="col-md-12"> <p class="border-bottom"> </p></div>
</div>		

<div class="tab-content">
	<div class="tab-pane active" id="tab_info">
		<form role="form" name="profile_setting_form" id="profile_setting_form" action="#">
			<?php
				include('author-edit-profile.php');				
				
			?>
		</form>
	</div>	
	<div class="tab-pane" id="tab_pass">
		<form action="" name="pass_word" id="pass_word">
			<div class="form-group">
				<label class="control-label"><?php   esc_html_e('Joriy Parol','listfoliopro');?> </label>
				<input type="password" id="c_pass" name="c_pass" class="form-control"/>
			</div>
			<div class="form-group">
				<label class="control-label"><?php   esc_html_e('Yangi parolni kiriting ','listfoliopro');?> </label>
				<input type="password" id="n_pass" name="n_pass" class="form-control"/>
			</div>
			<div class="form-group">
				<label class="control-label"><?php   esc_html_e('Yangi Parolni qayta kiriting','listfoliopro');?> </label>
				<input type="password" id="r_pass" name="r_pass" class="form-control"/>
			</div>
			<div class="margin-top-10">
				<div class="" id="update_message_pass"></div>
				<button type="button" onclick="listfoliopro_update_password();"  class="btn green-haze"><?php   esc_html_e("Parolni o'zgartirish",'listfoliopro');?> </button>
			</div>
		</form>
	</div>	
</div>	








	  