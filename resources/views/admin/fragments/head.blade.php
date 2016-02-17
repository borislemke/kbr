<meta charset="UTF-8">
<title>{{ ucfirst(env('APP_NAME', 'matter')) }} Admin</title>

<meta name="viewport" content="initial-scale=1.0">

<base href="{{ url() }}/" target="_top">

<link rel="stylesheet" href="{{ asset('bower/normalize-css/normalize.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('bower/nprogress/nprogress.css') }}">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Product+Sans' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css">

<script>
    var development = {{ env('APP_DEBUG', 'false') }},
    baseUrl = '{{ url() }}';
</script>
