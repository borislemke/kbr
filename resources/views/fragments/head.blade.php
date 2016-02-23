<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <base href="{{ asset('/') }}" target="_top">
    <title>{{ env('APP_NAME', 'Matter') }}</title>

    <meta name="description" content="@yield('meta_description')">
    <meta name="keywords" content="@yield('meta_keyword')">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <link rel="apple-touch-icon" href="{{ url('/') }}/assets/img/common/apple-touch-icon.png">
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/animate.css">
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/simple-line-icons.css">
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/bootstrap.css">
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/responsive-slider.css">
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/normalize.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/styles_old.css">
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/mediaqueries.css">
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/styles.css">
    <link rel="stylesheet" href="{{ url('/') }}/bower/ion.rangeslider/css/ion.rangeSlider.css">
    <link rel="stylesheet" href="{{ url('/') }}/bower/ion.rangeslider/css/ion.rangeSlider.skinNice.css">
    <link href='https://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">


    <!--Start of Zopim Live Chat Script-->
    <script type="text/javascript">
    window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
    d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
    _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
    $.src="//v2.zopim.com/?3eEPLuN4tnQHtUKGtqj2t85I1vkvncn2";z.t=+new Date;$.
    type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
    </script>
    <!--End of Zopim Live Chat Script-->
</head>
