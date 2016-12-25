<!DOCTYPE html>
<html>
    <head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin panel</title>
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.min.css')?>" rel="stylesheet">
<!--    <link href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head> 
<body>
    <div class="container">
        <h1 style="font-size:20pt">Admin panel</h1>
 <a class="btn btn-default" href="<?=base_url();?>admin/articles/">		Articles data</a>
 <a class="btn btn-default" href="<?=base_url();?>admin/categories/">	Categories data</a>
 <a class="btn btn-default" href="<?=base_url();?>admin/contacts/">		Contacts data</a>
 <a class="btn btn-default" href="<?=base_url();?>admin/def/">			Default engine data</a>
 <a class="btn btn-default" href="<?=base_url();?>admin/news/">			News data</a>
 <a class="btn btn-default" href="<?=base_url();?>admin/promo/">		Promo data</a>
 <a class="btn btn-default" href="<?=base_url();?>admin/users/">		Users data</a>