@extends('index')
@section('content')
<div class="bg-auth">
    <div class="container">


        <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
            @endforeach
        </div> <!-- end .flash-message -->

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="col-md-6 col-sm-6">
                    <div class="auth-holder">
                        <div class="login">
                            <p>
                            
                                Porttitor feugiat mus cras quisque pharetra sagittis non laoreet augue nulla lectus auctor accumsan cubilia sollicitudin mattis leo vel morbi class sollicitudin cubilia quisque penatibus dictumst faucibus dui natoque ultricies montes congue pellentesque aliquet lectus dictum est volutpat class odio elementum quis commodo dolor ultrices scelerisque montes class curabitur class <br> <br> <br>
                                Porttitor feugiat mus cras quisque pharetra sagittis non laoreet augue nulla lectus auctor accumsan cubilia sollicitudin mattis leo vel morbi class sollicitudin cubilia quisque penatibus dictumst faucibus dui natoque ultricies montes congue faucibus dui natoque ultricies montes congue <br>

                            DON'T HAVE AN ACCOUNT?<a href="{{ route('register', trans('url.register')) }}"> CREATE NOW</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-6">
                    <div class="auth-holder">
                        <div class="login">
                            <div class="auth-title">
                                <h3>Login</h3>
                            </div>
                            {!! Form::open(['url' => route('login.attempt', trans('url.login'))]) !!}
                            <div class="form-group">
                                <input class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="email" required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" name="password" id="password" placeholder="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">LOGIN</button>
                            {!! Form::close() !!}

                            <div class="goto">
                                <p>DON'T HAVE AN ACCOUNT?<a href="{{ route('register', trans('url.register')) }}"> CREATE NOW</a></p>
                            </div>
                        </div>
                    </div>
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
