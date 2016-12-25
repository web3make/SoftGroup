<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('blocks/header_view');?>
    <section id="title" class="emerald">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
				<!--<?php if($this->session->userdata('role')=='admin'):?>
					<a class="btn btn-default" href="<?=base_url();?>news/create"><i class="icon-edit"></i> Створити новину</a>
				<?php endif;?>-->
                    <ul class="breadcrumb pull-right">
                        <li><a href="<?=base_url();?>">Головна</a></li>
                        <li class="active">Новини</li>					
                    </ul>					
                </div>
            </div>
        </div>
    </section><!--/#title-->     

    <section id="blog" class="container">
        <div class="row">		
            <div class="col-sm-12">
			    <div class="blog">				
					<?php $current = time();
							foreach($news as $new):?>
                    <div class="blog-item">
                        <div class="blog-content">
                            <a href="<?=base_url();?>news/id<?php echo($new->id);?>"><h3><?php echo($new->title);?></h3></a>
                            <div class="entry-meta">
                                <span><i class="icon-user"></i> <a href="#">John</a></span>
                                <span><i class="icon-calendar"></i> <?php echo $this->timeword->convert($new->create, $current); ?></span>
                            </div>
                            <p><?php echo($new->descript);?></p>
                            <a class="btn btn-default" href="<?=base_url();?>news/id<?php echo($new->id);?>"">Read More <i class="icon-angle-right"></i></a>
							<!--<?php if($this->session->userdata('role')=='admin'):?>
							 <a class="btn btn-default" href="<?=base_url();?>news/edit/<?php echo($new->id);?>"><i class="icon-edit"></i> Edit news</a>
							<?php endif;?>-->
                        </div>
                    </div><!--/.blog-item-->
                    <?php endforeach;?>
                    
					<?php echo @$pages;?>
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->
<?php $this->load->view('blocks/footer_view');?>