<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Gopet-App | Petshop</title>

    {{--Your css--}}
    @include('user-petshop.partials.style')
    {{--End your css--}}

    {{--This is for additional css only in every page--}}
    {{--If you do not need additional css in any page, you can skip it--}}
    @yield('additional-styles')
    {{--End of additional-style--}}

</head>

<body class="fix-header card-no-border">
{{--Preloader - style you can find in spinners.css--}}
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
    </svg>
</div>
{{--Main wrapper - style you can find in pages.scss--}}

<div id="main-wrapper">

    {{--Your Header--}}
    @include('user-petshop.partials.header')
    {{--End your header--}}

    {{--Your sidebar--}}
    @include('user-petshop.partials.sidebar')
    {{--End your sidebar--}}

    <div class="page-wrapper">

        {{--Your Main Content --}}
        @yield('content')
        {{--End your main content--}}

        {{--Your Footer--}}
        @include('user-petshop.partials.footer')
        {{--End Your footer--}}
    </div>
</div>

{{--Your Scripts--}}
@include('user-petshop.partials.scripts')
{{--End your scripts--}}

{{--This is for additional script only in every page--}}
{{--If you do not need additional script in any page, you can skip it--}}
@yield('additional-scripts')
{{--End of additional-scripts--}}

</body>

</html>
