<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('blocks/header_view');?>


    <section id="title" class="emerald">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb pull-right">
                        <li><a href="<?=base_url();?>">Home</a></li>
                        <li class="active">Blog</li>
                    </ul>
                </div>
            </div>
        </div>
    </section><!--/#title-->     

    <section id="blog" class="container">
        <div class="row">
            <aside class="col-sm-4 col-sm-push-8">
                 <div class="widget categories">
                    <h3>Категорії блогу</h3>
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="arrow">
								<?php foreach($this->blog_category as $category){
									echo("<li><a href=".base_url()."blog/".$category->category.">".$category->title."</a></li>");
								}?>
                            </ul>
                        </div>
                    </div>                     
                </div><!--/.categories-->

            </aside>        
            <div class="col-sm-8 col-sm-pull-4">
                <div class="blog">
					<?php $current = time();
							foreach($articles as $article):?>
                    <div class="blog-item">
                        <a href="<?=base_url();?>blog/article<?php echo($article->id);?>"><img class="img-responsive img-blog" src="<?=base_url();?>images/blog/<?php echo($article->photo);?>" width="100%" alt="" /></a>
                        <div class="blog-content">
                            <a href="<?=base_url();?>blog/article<?php echo($article->id);?>"><h3><?php echo($article->title);?></h3></a>
                            <div class="entry-meta">
                                <span><i class="icon-calendar"></i>  <?php echo $this->timeword->convert($article->create, $current); ?> ago</span>
                            </div>
                            <p><?php echo($article->descript);?></p>
                            <a class="btn btn-default" href="<?=base_url();?>blog/article<?php echo($article->id);?>">Read More <i class="icon-angle-right"></i></a>
							<!--<?php if($this->session->userdata('role')=='admin'):?>
							 <a class="btn btn-default" href="<?=base_url();?>blog/edit_article/<?php echo($article->id);?>"><i class="icon-edit"></i> Edit article</a>
							<?php endif;?>-->
                        </div>
                    </div>
					<?php endforeach;?>

					<?php echo @$pages;?>

                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->


<?php $this->load->view('blocks/footer_view');?>