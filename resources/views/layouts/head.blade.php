<!-- Title -->
<title> Coding System - Dashboard Template </title>
<!-- Favicon -->
<link rel="icon" href="{{URL::asset('assets/img/brand/favicon.png')}}" type="image/x-icon"/>
<!--  Custom Scroll bar-->
<link href="{{URL::asset('assets/plugins/mscrollbar/jquery.mCustomScrollbar.css')}}" rel="stylesheet"/>
<!--  Sidebar css -->
<link href="{{URL::asset('assets/plugins/sidebar/sidebar.css')}}" rel="stylesheet">


@yield('css')


@if (App::getLocale() == 'ar')
    <!-- Icons css -->
    <link href="{{URL::asset('assets/css-rtl/icons.css')}}" rel="stylesheet">
    <!-- Sidemenu css -->
    <link rel="stylesheet" href="{{URL::asset('assets/css-rtl/sidemenu.css')}}">
    <!--- Style css -->
    <link href="{{URL::asset('assets/css-rtl/style.css')}}" rel="stylesheet">
    <!--- Style-dark css -->
    <link href="{{URL::asset('assets/css-rtl/style-dark.css')}}" rel="stylesheet">
    <!---Skin-modes css-->
    <link href="{{URL::asset('assets/css-rtl/skin-modes.css')}}" rel="stylesheet">
@else
    <!-- Icons css -->
    <link href="{{URL::asset('assets/css/icons.css')}}" rel="stylesheet">
    <!-- Sidemenu css -->
    <link rel="stylesheet" href="{{URL::asset('assets/css/sidemenu.css')}}">
    <!--- Style css -->
    <link href="{{URL::asset('assets/css/style.css')}}" rel="stylesheet">
    <!--- Style-dark css -->
    <link href="{{URL::asset('assets/css/style-dark.css')}}" rel="stylesheet">
    <!---Skin-modes css-->
    <link href="{{URL::asset('assets/css/skin-modes.css')}}" rel="stylesheet">
@endif