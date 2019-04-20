
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo site_url('/dashboard');?>">Monster Admin</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
               
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo site_url('/user/edit/'.get_current_user_id());?>"><i class="fa fa-user fa-fw"></i> Profile</a>
                        </li>                       
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url('/logout');?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="<?php echo site_url('/dashboard'); ?>" class="<?php echo $active_menu=='dashboard'?'active':'';?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
						<li>
                            <a href="#"><i class="fa fa-cog"></i> Header & Footer<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level <?php echo $active_menu=='header-settings' || $active_menu=='footer-settings' || $active_menu=='home-settings'?'collapse in':'';?>">
                                <li >
                                    <a href="<?php echo site_url('settings/header-settings'); ?>" class="<?php echo $active_menu=='header-settings'?'active':'';?>">Header</a>
                                </li>																
								<li>
                                    <a href="<?php echo site_url('settings/footer-settings'); ?>" class="<?php echo $active_menu=='footer-settings'?'active':'';?>">Footer</a>
                                </li>
								<!--<li>
                                    <a href="<?php //echo site_url('settings/home-settings'); ?>" class="<?php echo $active_menu=='home-settings'?'active':'';?>">Home Page</a>
                                </li>	-->							
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						<li>
                            <a href="#"><i class="fa fa-cart-plus"></i> Catalogs<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level <?php echo $active_menu=='categories' || $active_menu=='providers' || $active_menu=='models' || $active_menu=='products'?'collapse in':'';?>">
                                <li >
                                    <a href="<?php echo site_url('categories'); ?>" class="<?php echo $active_menu=='categories'?'active':'';?>">Categories</a>
                                </li>																
								<li>
                                    <a href="<?php echo site_url('providers'); ?>" class="<?php echo $active_menu=='providers'?'active':'';?>">Providers</a>
                                </li>
								<li>
                                    <a href="<?php echo site_url('models'); ?>" class="<?php echo $active_menu=='models'?'active':'';?>">Models</a>
                                </li>
								<li>
                                    <a href="<?php echo site_url('products'); ?>" class="<?php echo $active_menu=='products'?'active':'';?>">Products</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						<li>
                            <a href="<?php echo site_url('users'); ?>" class="<?php echo $active_menu=='users'?'active':'';?>"><i class="fa fa-users"></i> Users</a>
                            
                            <!-- /.nav-second-level -->
                        </li>
						<li>
                            <a href="<?php echo site_url('/orders'); ?>" class="<?php echo $active_menu=='orders'?'active':'';?>"><i class="fa fa-first-order"></i> Orders</a>
                        </li>
						<li>
                            <a href="<?php echo site_url('/pages'); ?>" class="<?php echo $active_menu=='pages'?'active':'';?>"><i class="fa fa-bars"></i> Pages</a>
                        </li>
                                                
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>