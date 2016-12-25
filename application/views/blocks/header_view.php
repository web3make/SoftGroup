<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $this->title;?></title>
    <link href="<?=base_url();?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url();?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?=base_url();?>css/prettyPhoto.css" rel="stylesheet">
    <link href="<?=base_url();?>css/animate.css" rel="stylesheet">
    <link href="<?=base_url();?>css/main.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="<?=base_url();?>js/html5shiv.js"></script>
    <script src="<?=base_url();?>js/respond.min.js"></script>
    <![endif]-->
</head><!--/head-->
<body>
    <header class="navbar navbar-inverse navbar-fixed-top wet-asphalt" role="banner">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=base_url();?>"><?php echo($this->default_engine->site_name);?></a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
				
                    <li <?php if($this->nav =="home") echo("class='active'");?>><a href="<?=base_url();?>">Головна</a></li>
                    <li <?php if($this->nav =="news") echo("class='active'");?>><a href="<?=base_url();?>news">Новини</a></li>
					<!----------------------------------------------->
                    <li class="dropdown <?php if($this->nav =="blog") echo("active");?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Блог <i class="icon-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?=base_url();?>blog">Всі категорії</a></li>
                            <li class="divider"></li>
							<?php foreach($this->blog_category as $category){
									echo("<li><a href=".base_url()."blog/".$category->category.">".$category->title."</a></li>");
							}?>
                        </ul>
                    </li>
					<!----------------------------------------------->
                    <li <?php if($this->nav =="contacts") echo("class='active'");?>><a href="<?=base_url();?>contacts">Контакти</a></li>
					<!----------------------------------------------->
					<?php if($this->session->userdata('id_user')):?>
						<li class="dropdown <?php if($this->nav =="auth") echo("active");?>">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <?php echo($this->user->user_name);?> <i class="icon-angle-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="<?=base_url();?>logout">Exit</a></li>
<!-------------------------------------------------->
							<?php if($this->session->userdata('role')=='admin'):?>
                            <li class="divider"></li>
                            <li><a href="<?=base_url();?>admin">Панель адміністратора</a></li>
                            <?php endif;?>
<!-------------------------------------------------->								
							</ul>
						</li>
					<?php else:?>
						<li class="dropdown <?php if($this->nav =="auth") echo("active");?>">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Аутентифікація <i class="icon-angle-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="<?=base_url();?>login">Вхід</a></li>
								<li class="divider"></li>
								<li><a href="<?=base_url();?>registration">Реєстрація</a></li>
								<li><a href="<?=base_url();?>forgot_password">Відновлення пароля</a></li>
							</ul>
						</li>					
					<?php endif;?>
					<!----------------------------------------------->
                </ul>
            </div>
        </div>
    </header><!--/header-->