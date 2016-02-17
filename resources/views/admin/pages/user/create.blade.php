@extends('admin.master')
@section('page', 'accounts')

@section('content')
<h3>Add User</h3>
<br>

{!! Form::open(['url' => route('api.user.store')]) !!}


    <div class="m-input-group fwidth flexbox justify-between">
        <div class="m-input-wrapper w50-6">
            <input type="text" name="firstname" required>
            <label for="title">firstname</label>
        </div>
        <div class="m-input-wrapper w50-6">
            <input type="text" name="lastname" required>
            <label for="title">lastname</label>
        </div>
    </div>

    <div class="m-input-group fwidth flexbox justify-between">
        <div class="m-input-wrapper w50-6">
            <input type="text" name="phone" required>
            <label for="title">phone</label>
        </div>
        <div class="m-input-wrapper w50-6">
            <input type="text" name="email" required>
            <label for="title">email</label>
        </div>
    </div>

    <div class="m-input-group fwidth flexbox justify-between">
        <div class="m-input-wrapper w50-6">
            <input type="text" name="address" required>
            <label for="title">address</label>
        </div>
        <div class="m-input-wrapper w50-6">
            <input type="password" name="password" required>
            <label for="title">password</label>
        </div>
    </div>

    <div class="m-input-group fwidth flexbox justify-between">
        <div class="m-input-wrapper w50-6">
            <select name="branch_id">

                @foreach(\App\Branch::all() as $branch)
                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                @endforeach

            </select>
            <label for="title">branch</label>
        </div>
        <div class="m-input-wrapper w50-6">
            <select name="city">

                @foreach(\App\City::all() as $city)
                <option value="{{ $city->city_name }}">{{ $city->city_name }}</option>
                @endforeach

            </select>
            <label for="title">city</label>
        </div>
    </div>

    <div class="m-input-group fwidth flexbox justify-between">
        <div class="m-input-wrapper w50-6">
            <select name="role_id">

                @foreach(\App\Role::all() as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach

            </select>
            <label for="title">role</label>
        </div>
    </div>

    <m-buttons flexbox justify-end>
        <m-button plain onclick="window.history.back()">cancel</m-button>
        <m-button save-form plain>save</m-button>
    </m-buttons>

{!! Form::close() !!}

@endsection

@section('scripts')
<script>

    $(document).ready(function() {
        
        $(document).on('click', '[save-form]', function(event) {
            event.preventDefault();
            
            console.log('save clicked!');

            var url = "{{ route('api.user.store') }}";
            var fd = new FormData($('form')[0]);

            NProgress.start();

            Ajax.post(url, fd, saved);
            

            NProgress.done();
        });
    });

    function saved() {

        $('input').val('');

        $('textarea').val('');

        location.reload();
    }

</script>
@endsection
