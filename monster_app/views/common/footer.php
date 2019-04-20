<?php 
$query = $this->db->query("SELECT * FROM ".SETTINGS_MASTER." WHERE settings_name='footer_settings'");
$footer_settings_str=$query->row();
$footer_settings=unserialize($footer_settings_str->settings);
?>
<footer class="sitefooter">
		<div class="container">
			<div class="f_top">
				<div class="row">
					<div class="col-sm-5">
						<div class="logo_social clearfix">
							<div class="f_logo">
								<a href="<?php echo base_url(); ?>" title="Monster">
								<?php if(!empty($footer_settings['logo'])){
									$logo_url=site_url('/').'/uploads/settings/'.$footer_settings['logo'];//str_replace(dirname(FCPATH),dirname(base_url()),UPLOADS_SETTINGS).$footer_settings['logo'];
									?>
									<img src="<?php echo $logo_url;?>" alt="">
									<?php
								}else{?>
								<img src="<?php echo base_url();?>/assets/images/f_logo.png" alt="">
								<?php } ?>
								
								</a>
							</div>
							<div class="keep_touch">
								<h2 class="subheading">keep in touch</h2>
								<p><?php echo !empty($footer_settings['keep_in_touch'])?$footer_settings['keep_in_touch']:'';?></p>
								<div class="social">
									<?php if(!empty($footer_settings['facebook_url'])){?>
									<a href="<?php echo $footer_settings['facebook_url'];?>" class="fb" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
									<?php } ?>
									<?php if(!empty($footer_settings['twitter_url'])){?>
									<a href="<?php echo $footer_settings['twitter_url'];?>" class="twtr" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
									<?php } ?>
									<?php if(!empty($footer_settings['instagram_url'])){?>
									<a href="<?php echo $footer_settings['instagram_url'];?>" class="insta" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="quick_link">
							<h2 class="subheading">links</h2>
							<?php if(!empty($footer_settings['menu'])){?>
							<ul>
								<?php
							foreach($footer_settings['menu'] as $menu)
							{
								$menu_url=$menu_title='';
								if($menu->id=='home'){
									$menu_url=base_url();
									$menu_title='Home';
								}
								else if($menu->id=='blog'){
									$menu_url=base_url('/blog');
									$menu_title='Blog';
								}
								else{
									$menu_url=base_url('/'.$menu->id);
									$page=$this->pages_model->get_page_by_slug($menu->id);
									$menu_title=$page->name;
								}
								?>
								<li><a href="<?php echo $menu_url;?>"><?php echo $menu_title; ?></a></li>
								<?php
							}
							
							?>
							</ul>
							<?php } ?>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="devices">
							<h2 class="subheading">device</h2>
							<?php if(!empty($footer_settings['product_menu'])){?>
							<ul>
								<?php
								foreach($footer_settings['product_menu'] as $menu)
								{
									$product_details=$this->catalog_model->get_product_related_details($menu->id);
									?>
									<li><a href="<?php echo base_url('/').$product_details->category_slug.'/'.$product_details->product_slug.'/'.$product_details->model_slug;?>"><?php echo $product_details->model_name.' '.$product_details->product_name; ?></a></li>
									<?php
								}
								?>
							</ul>
							<?php } ?>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="f_cntct">
							<h2 class="subheading">Contact</h2>
							<?php if(!empty($footer_settings['address'])){?>
							<div class="address">
								<img src="<?php echo base_url();?>/assets/images/map.png" alt="">
								<p><?php echo $footer_settings['address'];?></p>
							</div>
							<?php } ?>
							<?php if(!empty($footer_settings['contact_number'])){?>
							<div class="ph">
								<img src="<?php echo base_url();?>/assets/images/call.png" alt="">
								<a href="tel:<?php echo $footer_settings['contact_number'];?>">Call us toll-free <?php echo $footer_settings['contact_number'];?></a>
							</div>
							<?php } ?>
							<?php if(!empty($footer_settings['contact_email'])){?>
							<div class="address">
								<img src="<?php echo base_url();?>/assets/images/mail.png" alt="">
								<a href="mailto:<?php echo $footer_settings['contact_email'];?>"><?php echo $footer_settings['contact_email'];?></a>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<div class="copyright">
				<p><?php echo !empty($footer_settings['copyright_text'])?$footer_settings['copyright_text']:'';?></p>
			</div>
		</div>
	</footer>	
	<?php echo put_footers();?>
</body>

</html>