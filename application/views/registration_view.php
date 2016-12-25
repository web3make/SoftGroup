<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('blocks/header_view');?>
    <section id="title" class="emerald">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb pull-right">
                        <li><a href="<?=base_url();?>">Головна</a></li>
                        <li><a href="<?=base_url();?>auth">Аутентифікація</a></li>
                        <li class="active">Реєстрація</li>
                    </ul>
                </div>
            </div>
        </div>
    </section><!--/#title-->     

    <section id="registration" class="container">
        <form class="center" method="post">
            <fieldset class="registration-form">
                <div class="form-group">
                    <input type="text" id="username" name="user_name" placeholder="Username" class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" placeholder="Password" class="form-control">
                </div>
                <div class="form-group">
                    <button class="btn btn-success btn-md btn-block">Register</button>
                </div>
            
                <div class="form-group">
                    <a href="#">Login</a> or <a href="#">Forgot password</a>
                </div>
            </fieldset>
        </form>
    </section><!--/#registration-->

<?php $this->load->view('blocks/footer_view');?>