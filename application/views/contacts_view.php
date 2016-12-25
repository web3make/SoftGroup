<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('blocks/header_view');?>

    <section id="title" class="emerald">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb pull-right">
                        <li><a href="index.html">Головна</a></li>
                        <li class="active">Контакти</li>
                    </ul>
                </div>
            </div>
        </div>
    </section><!--/#title-->

    <section id="about-us" class="container">
        <div class="gap"></div>
        <h1 class="center">Контакти</h1>
		<div class="gap"></div>
        <div id="meet-the-team" class="row">
			<?php foreach($hero as $h):?>
            <div class="col-md-3 col-xs-6">
                <div class="center">
                    <p><a href="<?=base_url();?>contacts/person/<?php echo($h->contact);?>"><img class="img-responsive img-thumbnail img-circle" src="<?=base_url();?>images/<?php echo($h->photo);?>" alt="<?php echo($h->about);?>" ></a></p>
                    <h5><a href="<?=base_url();?>contacts/person/<?php echo($h->contact);?>"><?php echo($h->name);?></a><small class="designation muted"><?php echo($h->about);?></small></h5>
					<!--<?php if($this->session->userdata('role')=='admin'):?>
						<p><a class="btn btn-default" href="<?=base_url();?>contacts/edit/<?php echo($h->contact);?>"><i class="icon-edit"></i> Edit contact</a></p>
					<?php endif;?>-->
                    <p><?php echo($h->slogan);?></p>
                    <p>email: <?php echo($h->email);?></p>
                    <a class="btn btn-social btn-facebook" href="<?php echo($h->soc_fb);?>"><i class="icon-facebook"></i></a>
					<a class="btn btn-social btn-google-plus" href="<?php echo($h->soc_gp);?>"><i class="icon-google-plus"></i></a>
					<a class="btn btn-social btn-twitter" href="<?php echo($h->soc_tw);?>"><i class="icon-twitter"></i></a>
					<a class="btn btn-social btn-linkedin" href="<?php echo($h->soc_in);?>"><i class="icon-linkedin"></i></a>
                </div>
            </div>
			<?php endforeach;?>
        </div><!--/#meet-the-team-->
    </section><!--/#about-us-->
<?php $this->load->view('blocks/footer_view');?>