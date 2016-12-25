<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('blocks/header_view');?>


    <section id="title" class="emerald">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb pull-right">
                        <li><a href="<?=base_url();?>">Home</a></li>
                        <li><a href="<?=base_url();?>contacts">Contacts</a></li>
                        <li class="active"><?php echo($person->name);?></li>
                    </ul>
                </div>
            </div>
        </div>
    </section><!--/#title-->     

    <section id="blog" class="container">
        <div class="row">
            <aside class="col-sm-9 col-sm-push-3">
                <div class="widget categories">
					<h3><?php echo($person->name);?></h3>
					<h5><?php echo($person->slogan);?></h5>
					<?php echo($person->bio);?>				
				</div>
            </aside>        
            <div class="col-sm-3 col-sm-pull-9">
                <div class="blog">
					<?php if($person):?>
					<div class="col-md-12">
						<div class="center">
							<p><img class="img-responsive img-thumbnail img-circle" src="<?=base_url();?>images/<?php echo($person->photo);?>" alt="<?php echo($person->about);?>" ></p>
							<h5><a herf="#"><?php echo($person->name);?><br /></a><small class="designation muted"><?php echo($person->about);?></small></h5>

							<a class="btn btn-social btn-facebook" href="<?php echo($person->soc_fb);?>"><i class="icon-facebook"></i></a>
							<a class="btn btn-social btn-google-plus" href="<?php echo($person->soc_gp);?>"><i class="icon-google-plus"></i></a>
							<a class="btn btn-social btn-twitter" href="<?php echo($person->soc_tw);?>"><i class="icon-twitter"></i></a>
							<a class="btn btn-social btn-linkedin" href="<?php echo($person->soc_in);?>"><i class="icon-linkedin"></i></a>					
							<!--
							<p>email: <?php echo($person->email);?></p>
							<?php if($this->session->userdata('role')=='admin'):?>
								<p><a class="btn btn-default" href="<?=base_url();?>contacts/edit/<?php echo($person->contact);?>"><i class="icon-edit"></i> Edit contact</a></p>
							<?php endif;?>-->
						</div>
					</div>
					<?php endif;?>					
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->


<?php $this->load->view('blocks/footer_view');?>