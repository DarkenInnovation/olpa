<!DOCTYPE html>
<html lang="en">
<head>
    <!-- META SECTION -->
    <title>OLPA-BI</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="icon" href="<?php echo base_url(); ?>assets/images/icon.png" type="image/x-icon"/>

    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>"/>

    <!-- EOF CSS INCLUDE -->
</head>
<body>
<!-- START PAGE CONTAINER -->
<div class="page-container">

    <!-- START PAGE SIDEBAR -->
    <div class="page-sidebar">
        <!-- START X-NAVIGATION -->
        <ul class="x-navigation">
            <li class="xn-logo">
                <a href="admin">OLPA-BI</a>
                <a href="#" class="x-navigation-control"></a>
            </li>
            <li class="xn-openable <?php if(isset($menu)){if($menu == 'dashboard') { echo 'active'; }} ?>">
                <a href="#"><span class="fa fa-dashboard"></span> <span class="xn-text">Dashboard</span></a>
                <ul>
                    <li class="<?php if(isset($submenu)){if($submenu == 'admin') { echo 'active'; }} ?>"><a href="<?php echo base_url();?>admin"><span class="fa fa-caret-right"></span> Election Dashboard</a></li>
                    <li class="<?php if(isset($submenu)){if($submenu == 'poll-dashboard') { echo 'active'; }} ?>"><a href="<?php echo base_url();?>admin/poll-dashboard"><span class="fa fa-caret-right"></span> Poll Dashboard</a></li>
                </ul>
            </li>
            <li class="xn-openable <?php if(isset($menu)){if($menu == 'student') { echo 'active'; }} ?>">
                <a href="#"><span class="fa fa-users"></span> <span class="xn-text">Students</span></a>
                <ul>
                    <li class="<?php if(isset($submenu)){if($submenu == 'student') { echo 'active'; }} ?>"><a href="<?php echo base_url();?>admin/student"><span class="fa fa-caret-right"></span> Student List</a></li>
                    <li class="<?php if(isset($submenu)){if($submenu == 'grade-section') { echo 'active'; }} ?>"><a href="<?php echo base_url();?>admin/grade-section"><span class="fa fa-caret-right"></span> Grade & Section</a></li>
                </ul>
            </li>
            <li class="xn-openable <?php if(isset($menu)){if($menu == 'election') { echo 'active'; }} ?>">
                <a href="#"><span class="fa fa-tasks"></span> <span class="xn-text">Elections</span></a>
                <ul>
                    <li class="<?php if(isset($submenu)){if($submenu == 'ssg') { echo 'active'; }} ?>"><a href="<?php echo base_url();?>admin/ssg"><span class="fa fa-caret-right"></span> SSG</a></li>
                    <li class="<?php if(isset($submenu)){if($submenu == 'candidate') { echo 'active'; }} ?>"><a href="<?php echo base_url();?>admin/candidate"><span class="fa fa-caret-right"></span> Candidates</a></li>
                    <li class="<?php if(isset($submenu)){if($submenu == 'position') { echo 'active'; }} ?>"><a href="<?php echo base_url();?>admin/position"><span class="fa fa-caret-right"></span> Position</a></li>
                    <li class="<?php if(isset($submenu)){if($submenu == 'partylist') { echo 'active'; }} ?>"><a href="<?php echo base_url();?>admin/partylist"><span class="fa fa-caret-right"></span> Partylist</a></li>
                    <li class="<?php if(isset($submenu)){if($submenu == 'polling') { echo 'active'; }} ?>"><a href="<?php echo base_url();?>admin/polling-question"><span class="fa fa-caret-right"></span> Polling Questions</a>
                    <li class="<?php if(isset($submenu)){if($submenu == 'coc-request') { echo 'active'; }} ?>"><a href="<?php echo base_url();?>admin/coc-request"><span class="fa fa-caret-right"></span> COC Request</a></li>
                </ul>
            </li>
            <li class="xn-openable <?php if(isset($menu)){if($menu == 'result') { echo 'active'; }} ?>">
                <a href="#"><span class="fa fa-folder-open-o"></span> <span class="xn-text">Results</span></a>
                <ul>
                    <li class="<?php if(isset($submenu)){if($submenu == 'total-votes') { echo 'active'; }} ?>"><a href="<?php echo base_url();?>admin/total-votes"><span class="fa fa-caret-right"></span> Total Votes</a></li>
                    <li class="<?php if(isset($submenu)){if($submenu == 'year-sec-votes') { echo 'active'; }} ?>"><a href="<?php echo base_url();?>admin/year-and-section-votes"><span class="fa fa-caret-right"></span> Yr. & Sec. Votes</a></li>
                </ul>
            </li>
        </ul>
        <!-- END X-NAVIGATION -->
    </div>
    <!-- END PAGE SIDEBAR -->

    <!-- PAGE CONTENT -->
    <div class="page-content">
        <!-- START X-NAVIGATION VERTICAL -->
        <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
            <!-- SIGN OUT -->
            <li class="xn-icon-button pull-right">
                <a href="<?php echo base_url(); ?>" ><span class="fa fa-sign-out"></span></a>
            </li>
            <!-- END SIGN OUT -->.

            <!-- SEARCH -->
            <li class="pull-right">
                <p>Welcome, <b>Admin</b></p>
            </li>
            <!-- END SEARCH -->

        </ul>
