<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />

    @if(Setting::getLocale() == 'en')
        {!! Html::style('assets/css/front-style-en.css') !!}
    @else
        {!! Html::style('assets/css/front-style.css') !!}
    @endif
    <script language="javascript">
        function base_url($ext) {
            if(!$ext) $ext = "" ;
            var $result = '{{ URL::to('/') }}' + $ext ;
            return $result  ;
        }
    </script>
    <title>@yield('page_title')</title>

@if(Setting::getLocale() == 'en')
    <body class="ltr">
@else
    <body>
@endif
@include('front.persian.frame.header_navbar')
@include('front.persian.frame.header_menu')