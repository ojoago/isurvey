<body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark stick_header">
			<button class="btn btn-link btn-sm order-2 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <a class="navbar-brand" href="<?php echo URLROOT;?>/admins"><?php echo SITENAME;?></a>
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                 <div class="input-group">
                    <input class="form-control" type="text" placeholder="Order Id..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <ul class="navbar-nav ml-auto ml-auto navbar-right">
                <li><a href="<?php echo URLROOT?>/carts" class="nav-link"><i class="fa fa-fw fa-shopping-cart fa-1x"></i> SHOP</a>	</li>
               <!-- <li class="dropdown small">
                    <a class="nav-link" href="index.php"> <i class="fa fa-home fa-1x"></i> HOME</a>
                </li>-->
            </ul>
			 <!-- <a style="color:#fff;" ><php echo strtoupper($_SESSION['shafa_mail']); ?></a> -->
			<ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#"><i class = "fa fa-cog"></i> Settings</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#updatepassword" aria-expanded="false" aria-controls="pagesCollapseAuth"><i class = "fa fa-key"></i> Update</a>
                        <a class="dropdown-item" href="#"><i class = "fa fa-magnet"></i> Activity Log</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php //echo URLROOT;?>/users/logout"> <i class="fa fa-sign-in"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
