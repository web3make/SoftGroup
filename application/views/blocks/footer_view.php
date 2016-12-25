<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <section id="bottom" class="wet-asphalt">
        <div class="container">
            <div class="row">
                <!--
				<div class="col-md-3 col-sm-6">
                    <h4>About Us</h4>
                    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.</p>
                    <p>Pellentesque habitant morbi tristique senectus.</p>
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <h4>Контакти героїв</h4>
                    <div>
                        <ul class="arrow">
							<?php foreach($this->hero as $hero){
								echo("<li><a href=".base_url()."contacts/person/".$hero->contact.">".$hero->name."</a></li>");
							}?>
                        </ul>
                    </div>
                </div><!--/.col-md-3-->


                <div class="col-md-3 col-sm-6">
                    <h4>Категорії блогу</h4>
                    <div>
                        <ul class="arrow">
							<?php foreach($this->blog_category as $category){
								echo("<li><a href=".base_url()."blog/".$category->category.">".$category->title."</a></li>");
							}?>
                        </ul>
                    </div>
                </div><!--/.col-md-3-->




                <div class="col-md-6">
                    <h4>Остані новини</h4>
                    <div>
                        <ul class="row">
							<?php foreach($this->last_news as $news){
								echo("<li><a href=".base_url()."news/id".$news->id.">".$news->title."</a></li>");
							}?>
                        </ul>
                    </div>
                </div><!--/.col-md-3-->
            </div>
        </div>
    </section><!--/#bottom-->

    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; <?php echo(date('Y'));?> <a target="_blank" href="<?=base_url();?>" title="<?php echo($this->default_engine->site_name);?>"><?php echo($this->default_engine->site_name);?></a>. Всі права захишенно.
                </div>
                <div class="col-sm-6">
                    <ul class="pull-right">
                        <li><a href="<?=base_url();?>">Головна</a></li>
                        <li><a href="<?=base_url();?>blog">Блог</a></li>
                        <li><a href="<?=base_url();?>auth">Auth</a></li>

                        <li><a id="gototop" class="gototop" href="#"><i class="icon-chevron-up"></i></a></li><!--#gototop-->
                    </ul>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->

    <script src="<?=base_url();?>js/jquery.js"></script>
    <script src="<?=base_url();?>js/bootstrap.min.js"></script>
    <script src="<?=base_url();?>js/jquery.prettyPhoto.js"></script>
    <script src="<?=base_url();?>js/main.js"></script>
</body>
</html>