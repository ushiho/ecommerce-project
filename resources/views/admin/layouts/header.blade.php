<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> {{ !empty($title) ? trans($title) : trans('admin.admin') }} </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ url('/') }}/design/bower_components/bootstrap/dist/css/bootstrap.min.css">
  @if (empty(changeDirection()))
  <link rel="stylesheet" href="{{ url('/') }}/design/dist/css/AdminLTE.min.css">
  @else
  <link rel="stylesheet" href="{{ url('/') }}/design/dist/css/rtl/bootstrap-rtl.min.css">
  <link rel="stylesheet" href="{{ url('/') }}/design/dist/css/rtl/rtl.css">
  <link rel="stylesheet" href="{{ url('/') }}/design/dist/css/rtl/AdminLTE.min.css">
  @endif  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('/') }}/design/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ url('/') }}/design/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ url('/') }}/design/dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ url('/') }}/design/bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ url('/') }}/design/bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ url('/') }}/design/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ url('/') }}/design/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ url('/') }}/design/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    
    <link rel="stylesheet" href="{{ url('/design') }}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    {{-- <link rel="stylesheet" href="{{ url('/design') }}/bower_components/datatables.net-bs/css/buttons.dataTables.min.css"> --}}
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      {{-- Google Font   --}}
      <link href="https://fonts.googleapis.com/css?family=Cairo:200,300,400,600,700,900&display=swap&subset=arabic" rel="stylesheet">
      <style>
        html, body, h1, h2, h3, h4, h5, h6{
          font-family: 'Cairo', sans-serif;
        }
      </style>
    </head>
    