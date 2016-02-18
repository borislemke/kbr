@extends('index')
@section('content')
<div class="bc-bg">
    <ul class="breadcrumb container">
        <li><a href="{{ baseUrl() }}">Home</a></li>
        <li class="active">Register</li>
    </ul>
</div>
<div class="line-top"><h3><small>{{ 'register' }}</small></h3></div>
<br>
<div class="container">


  @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif

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
          {!! Form::open(array('url' => route('register.store', trans('url.register')))) !!}
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input class="form-control" type="email" name="email" value="{{ old('email') }}">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" type="password" name="password" id="password">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password Confirmation</label>
            <input class="form-control" type="password" name="password_confirmation" id="password">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">First Name</label>
            <input class="form-control" type="text" name="firstname">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Last Name</label>
            <input class="form-control" type="text" name="lastname">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Address</label>
            <input class="form-control" type="text" name="address">
          </div>


          <div class="form-group">
            <label for="exampleInputPassword1">City</label>

              <select name="city" class="form-control select-city" placeholder="City">

                <option value=""></option>

                @foreach(\App\City::orderBy('city_name', 'asc')->get() as $city)
                <option value="{{ $city->city_name }}">{{ $city->city_name }}</option>
                @endforeach

              </select>
          </div>


          <div class="form-group">
            <div class="g-recaptcha" data-sitekey="6LcdHRcTAAAAAMUKsjZDzArdb0e8Fk2HU-duNhJP"></div>
          </div>
          <!-- 
          <div class="form-group">
            <label for="exampleInputPassword1">Province / State</label>
            <input class="form-control" type="text" name="province">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Country</label>
            <input class="form-control" type="text" name="country">
          </div>
           -->
          <button type="submit" class="btn btn-primary">Register</button>
          {!! Form::close() !!}

          <p class="pull-right"><a href="{{ route('login', trans('url.login')) }}">Login</a></p>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="assets/js/select2.js"></script>
<script type="text/javascript">

  $(".select-city").select2({
    placeholder: "Select a city",
    allowClear: true
  });

</script>

<script>
    Kibarer.home();
</script>

@endsection
