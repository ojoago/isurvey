<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/custom/style.css">
    <link rel="shortcut icon" href="<?php echo URLROOT; ?>/isurveyimages/logo.png">
    <title><?php echo SITENAME;?></title>
</head>
<body >

  <nav class="sb-topnav navbar navbar-expand stick_header">
    <a class="navbar-brand" href="<?php echo URLROOT; ?>"><img src="<?php echo URLROOT; ?>/isurveyimages/logo.png" width="40" id="logo" alt="<?php echo SITENAME;?>"> </a>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo URLROOT;?>">HOME <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo URLROOT;?>/pages/about">ABOUT</a>
      </li>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo URLROOT;?>/pages/help">HELP</a>
    </li>
    </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT;?>/guests/login"><i class="fa fa-sign-in-alt" aria-hidden="true"></i> LOGIN <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT;?>/guests/register"><span class="fa fa-user"></span> SIGN UP</a>
        </li>
      </ul>


  </nav>
