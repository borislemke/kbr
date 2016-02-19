@extends('index')
@section('content')
<div class="bg-auth">
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
          <div class="auth-holder">
              <div class="register">
                  <div class="auth-title">
                      <h3>Register</h3>
                  </div>

                  {!! Form::open(array('url' => route('register.store', trans('url.register')), 'id' => 'form-register')) !!}
                  <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="email" required>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input class="form-control" type="password" name="password" id="password" placeholder="password" required>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputPassword1">Password Confirmation</label>
                      <input class="form-control" type="password" name="password_confirmation" id="password" placeholder="password confirmation" required>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputPassword1">First Name</label>
                      <input class="form-control" type="text" name="firstname" placeholder="first name" required>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputPassword1">Last Name</label>
                      <input class="form-control" type="text" name="lastname" placeholder="last name" required>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputPassword1">Address</label>
                      <input class="form-control" type="text" name="address" placeholder="address" required>
                  </div>


                  <div class="form-group">
                      <label for="exampleInputPassword1">City</label>

                      <select name="city" class="form-control select-city" placeholder="City" style="width: 100%">

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

                  <div class="goto">
                      <p>ALREADY HAVE AN ACCOUNT? <a href="{{ route('login', trans('url.login')) }}"> LOGIN</a></p>
                  </div>
              </div>
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

  $(document).ready(function() {
    
    $('#form-register').submit(function(event) {
      /* Act on the event */
      event.preventDefault();

      $('button[type=submit]').html('Sending...');

      var url = $(this).attr('action');
      var data = $(this).serialize();

      $.post(url, data, function(data, textStatus, xhr) {
        /*optional stuff to do after success */

        if (data.status == 200) {

          $('input[name=email]').val('');
          $('input[name=password]').val('');
          $('input[name=password_confirmation]').val('');
          $('input[name=firstname]').val('');
          $('input[name=lastname]').val('');
          $('input[name=address]').val('');

          var html = ''          
            + '<div class="flash-message">'
                + '<p class="alert alert-success">'
                + data.monolog.message
                  + '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>'
            + '</div>';

          $('.panel-body').prepend(html);

        }

        if (data.status == 500) {

          if (data.monolog.message.email)
            $('input[name=email]').closest('.form-group').addClass('has-error');

          if (data.monolog.message.password)
            $('input[name=password]').closest('.form-group').addClass('has-error');

          if (data.monolog.message.firstname)
            $('input[name=firstname]').closest('.form-group').addClass('has-error');

          if (data.monolog.message.city)
            $('select[name=city]').closest('.form-group').find('.select2-selection').css('border', '1px solid #a94442');
        }

        $('button[type=submit]').html('Register');

      });

    });

  });

</script>

<script>
    Kibarer.home();
</script>

@endsection
