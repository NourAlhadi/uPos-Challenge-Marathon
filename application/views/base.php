<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Login Project for uPos">
    <meta name="author" content="Nour Alhadi Mahmoud">

    <title>Welcome to uPos</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/css/sb-admin.css" rel="stylesheet">


    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    <style>

        .content-holder{
            color:black;
        }

        .side-nav *:hover {
            background-color: #8e44ad;
        }

    </style>

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url();?>">uPos</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">

            <?php if($user->role > 0): ?>
                <li>
                    <a href="<?php echo base_url();?>dashboard/add_product"><i class="fa fa-plus-circle"></i> Add Product</a>
                </li>
            <?php endif; ?>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $user->fullname; ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo base_url(); ?>dashboard/shopping_list"><i class="fa fa-shopping-cart" style="font-size: 17px; width: 24px"></i>Shopping List</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="<?php echo base_url(); ?>dashboard/logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                </ul>
            </li>

        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <?php if(!isset($tag_active)):?>
                    <li class="active">
                <?php else: ?>
                    <li>
                <?php endif; ?>
                    <a href="<?php echo base_url(); ?>"><i class="fa fa-fw fa fa-shopping-cart"></i> Products list</a>
                </li>


            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">

        <div class="container-fluid"  style="min-height: 500px">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="alert alert-info"> This is a minimized version: each and every element (Views, Models, etc..) Are Minimized to simply just achieve the goal of the challenge no less no more, it could be much more bigger and better if needed!! </h4>
                </div>
            </div>
            <?=$body?>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>


</body>

</html>