@extends('index')
@section('content')
<div class="bc-bg">
    <ul class="breadcrumb container">
        <li><a href="{{ baseUrl() }}">Home</a></li>
        <li class="active">Login</li>
    </ul>
</div>
<div class="line-top"><h3><small>{{ 'login' }}</small></h3></div>
<br>
<div class="container">


  <div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
  </div> <!-- end .flash-message -->
  
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-primary">
        
        <div class="panel-body">
          {!! Form::open(['url' => route('login.attempt', trans('url.login'))]) !!}
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input class="form-control" type="text" name="email" value="{{ old('email') }}">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" type="password" name="password" id="password">
          </div>
          <button type="submit" class="btn btn-primary">Login</button>
          {!! Form::close() !!}

          <p class="pull-right"><a href="{{ route('register', trans('url.register')) }}">Register</a></p>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
    Kibarer.home();
</script>
@endsection
