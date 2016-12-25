<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('blocks/header_view');?>
    <section id="title" class="emerald">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
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
					<?php if($new):?>
<!---------------------------------->
					<h3>Редагувати новину</h3>
					<form class="form-horizontal" role="form" action="" method="post">
					<!-- -->
						<div class="form-group">
							<div class="col-sm-9">
								<input type="text" class="form-control" placeholder="Name">
							</div>
							<div class="col-sm-3">
								<select class="form-control" >
								  <option>Пункт 1</option>
								  <option>Пункт 2</option>
								</select>
							</div>
						</div>
					<!-- -->
						
						<div class="form-group">
							<div class="col-sm-12">
								<input type="text"  name="title" class="form-control" placeholder="Title" value="<?php echo($new->title);?>">
							</div>
						</div>						
						<div class="form-group">
							<div class="col-sm-12">
								<textarea rows="8" name="descript" class="form-control" placeholder="Descript"><?php echo($new->descript);?></textarea>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-12">
								<textarea rows="8" name="text" class="form-control" placeholder="Text"><?php echo($new->text);?></textarea>
							</div>
						</div>
						<button type="submit"  name="submit" class="btn btn-danger btn-lg">Submit Comment</button>
					</form>
<!---------------------------------->
                    <?php endif;?>
                    
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->
<?php $this->load->view('blocks/footer_view');?>