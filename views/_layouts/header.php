<?php 
namespace app\assets;
$bodyClass = isset($this->_params['bodyClass']) ? $this->_params['bodyClass'] : null;

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
	<title></title>
	<script type="text/javascript" src="<?= URL_BASE ?>/static/jquery-3.3.1.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <base href="https://demos.telerik.com/kendo-ui/datetimepicker/rangeselection"> -->
    <style>html { font-size: 14px; font-family: Arial, Helvetica, sans-serif; }</style>
    <title></title>
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2019.1.220/styles/kendo.common-material.min.css" />
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2019.1.220/styles/kendo.material.min.css" />
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2019.1.220/styles/kendo.material.mobile.min.css" />
    <script src="https://kendo.cdn.telerik.com/2019.1.220/js/jquery.min.js"></script>
    <!-- <script src="https://kendo.cdn.telerik.com/2019.1.220/js/kendo.all.min.js"></script> -->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Main Styles -->
    <link rel="stylesheet" href="<?php echo URL_BASE;?>/assets/styles/style.min.css">
    
    <!-- Material Design Icon -->
    <link rel="stylesheet" href="<?php echo URL_BASE;?>/assets/fonts/material-design/css/materialdesignicons.css">

    <!-- mCustomScrollbar -->
    <link rel="stylesheet" href="<?php echo URL_BASE;?>/assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.min.css">

    <!-- Waves Effect -->
    <link rel="stylesheet" href="<?php echo URL_BASE;?>/assets/plugin/waves/waves.min.css">

    <!-- Sweet Alert -->
    <link rel="stylesheet" href="<?php echo URL_BASE;?>/assets/plugin/sweet-alert/sweetalert.css">
    
    <!-- Morris Chart -->
    <link rel="stylesheet" href="<?php echo URL_BASE;?>/assets/plugin/chart/morris/morris.css">

    <!-- FullCalendar -->
    <link rel="stylesheet" href="<?php echo URL_BASE;?>/assets/plugin/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo URL_BASE;?>/assets/plugin/fullcalendar/fullcalendar.print.css" media='print'>

    <!-- Dark Themes -->
    <link rel="stylesheet" href="<?php echo URL_BASE;?>/assets/styles/style-black.min.css">

    <!-- Waves Effect -->
    <link rel="stylesheet" href="<?php echo URL_BASE;?>/assets/plugin/waves/waves.min.css">

    <!--William CSS File -->
    <link rel="stylesheet" href="<?php echo URL_BASE;?>/assets/styles/style2.css">

</head>
<body<?=$bodyClass ? ' class="' . implode(' ', $bodyClass) . '"' : null?>>