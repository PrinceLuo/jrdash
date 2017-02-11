<!doctype html>
<html lang="en">
    <head>
        <title>jrDash_CI</title>
        <link rel="stylesheet" href="<?php base_url() ?>public/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php base_url() ?>public/css/style.css" />
        <script src="<?php base_urL() ?>public/js/jquery.js" ></script>
        <script src="<?php base_url() ?>public/js/bootstrap.js" ></script>

    </head>
    <body>
        <!-- For more information please go to check Bootstrap Navbar -->        <nav class="navbar">
            <div class="navbar-inner">
                <span class="brand">jrDash</span>
                <ul class="nav">
                    <li><a href="#" >Dashboard</a></li> 
                    <li><a href="#" >User</a></li>
                    <li><a href="<?php echo site_url('dashboard/logout') ?>" >Logout</a></li>
                </ul>
            </div>
        </nav>
        <!-- start: wrapper -->
        <div class="wrapper">

