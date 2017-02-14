<!doctype html>
<html lang="en">
    <head>
        <title>jrDash_CI</title>
        <link rel="icon" href="/jrdash/public/img/punch.jpg" type="image/jpg">
        <link rel="stylesheet" href="<?php base_url() ?>public/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php base_url() ?>public/css/style.css" />
        <script src="<?php base_urL() ?>public/js/jquery.js" ></script>
        <script src="<?php base_url() ?>public/js/bootstrap.js" ></script>
        <script src="<?php base_url() ?>public/js/jrdash/dashboard.js" ></script>
        <script src="<?php base_url() ?>public/js/jrdash/dashboard/template.js" ></script>
        <script src="<?php base_url() ?>public/js/jrdash/dashboard/event.js" ></script>
        <script src="<?php base_url() ?>public/js/jrdash/dashboard/result.js" ></script>
        <script>
            $(function () {
                // Initial the Dashboard Application
                var dashboard = new Dashboard();
            });
        </script>

    </head>
    <body>
        <!-- For more information please go to check Bootstrap Navbar -->        
        <nav class="navbar">
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
            <div id="error" class="alert alert-error hide"></div>
            <div id="success" class="alert alert-sucess hide"></div>

