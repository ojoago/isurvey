<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.82.0">
    <title><?php echo SITENAME;?></title>
    <link rel="shortcut icon" href="<?php echo URLROOT; ?>/isurveyimages/logo.png">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/custom/style.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/dist/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="<php echo URLROOT; ?>/fontawesome/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <header class="navbar bg-inverse header">
      <nav class="container-fluid">
        <span class="navbar-brand"><i class="fa fa-bars mr-3 pointer" id="sidebarToggle"></i> <a href="<?php echo URLROOT ?>/dashboards"><?php echo SITENAME ?></a> </span>
        <div class="float-right">
          <?php echo userName() ?>
          <a href="<?php echo URLROOT ?>/pages/logout" id="logout">Logout</a>
        </div>

      </nav>
    </header>

    <?php include_once( APPROOT .'/views/inc/sidebar.php');?>
    <div class="page-content">
