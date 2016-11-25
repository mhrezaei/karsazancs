<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
    {!! Html::style('assets/css/front-style.css') !!}
    <script language="javascript">
        function base_url($ext) {
            if(!$ext) $ext = "" ;
            var $result = '{{ URL::to('/') }}' + $ext ;
            return $result  ;
        }
    </script>
    <title>@yield('page_title')</title>

</head>
<body>
@include('front.persian.frame.header_navbar')
@include('auth.frame.header_content')