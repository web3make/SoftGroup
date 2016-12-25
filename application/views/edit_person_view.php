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
			<form class="form-horizontal" action="" method="post">
            <aside class="col-sm-9 col-sm-push-3">
				<div class="form-group">
					<div class="col-sm-12">
						<input type="text"  name="name" class="form-control" placeholder="Title" value="<?php echo($person->name);?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-3">
						<input type="text"  name="about" class="form-control" placeholder="about" value="<?php echo($person->about);?>">
					</div>
				
					<div class="col-sm-9">
						<input type="text"  name="slogan" class="form-control" placeholder="slogan" value="<?php echo($person->slogan);?>">
					</div>
				</div>
         
				<div class="form-group">
					<div class="col-sm-1">
						<a class="btn btn-social btn-facebook"><i class="icon-facebook"></i></a>
					</div>
				
					<div class="col-sm-11">
						<input type="text"  name="soc_fb" class="form-control" placeholder="Facebook" value="<?php echo($person->soc_fb);?>">
					</div>
				</div>
					
				<div class="form-group">
					<div class="col-sm-1">
						<a class="btn btn-social btn-google-plus"><i class="icon-google-plus"></i></a>
					</div>
				
					<div class="col-sm-11">
						<input type="text"  name="soc_gp" class="form-control" placeholder="Google Plus" value="<?php echo($person->soc_gp);?>">
					</div>
				</div>
            
            
				<div class="form-group">
					<div class="col-sm-1">
						<a class="btn btn-social btn-twitter"><i class="icon-twitter"></i></a>
					</div>
				
					<div class="col-sm-11">
						<input type="text"  name="soc_tw" class="form-control" placeholder="Twitter" value="<?php echo($person->soc_tw);?>">
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-1">
						<a class="btn btn-social btn-linkedin"><i class="icon-linkedin"></i></a>
					</div>
				
					<div class="col-sm-11">
						<input type="text"  name="soc_in" class="form-control" placeholder="Linkedin" value="<?php echo($person->soc_in);?>">
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-12">
						<textarea rows="8" name="bio" class="form-control" placeholder="Bio"><?php echo($person->bio);?></textarea>
					</div>
				</div>
							
				<button type="submit"  name="submit" class="btn btn-danger btn-lg">Save</button>
				
            </aside>        
            <div class="col-sm-3 col-sm-pull-9">
                <div class="blog">
					<?php if($person):?>
					<div class="col-md-12">
						<div class="center">
							<p><img class="img-responsive img-thumbnail img-circle" src="<?=base_url();?>images/<?php echo($person->photo);?>" alt="<?php echo($person->about);?>" ></p>
						</div>
					</div>
					<?php endif;?>					
                </div>
            </div><!--/.col-md-8-->
			</form>
        </div><!--/.row-->
    </section><!--/#blog-->


<?php $this->load->view('blocks/footer_view');?>