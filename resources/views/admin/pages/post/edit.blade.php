@extends('admin.master')
@section('page', 'properties')

@section('content')
<h3>Edit Customer</h3>
<br>

{!! Form::open(['url' => route('api.customer.update', $customer->id)]) !!}

    {{ method_field('PUT') }}
    <div class="m-input-group fwidth flexbox justify-between">
        <div class="m-input-wrapper w50-6">
            <input value="{{ $customer->firstname }}" type="text" name="firstname" required>
            <label for="title">firstname</label>
        </div>
        <div class="m-input-wrapper w50-6">
            <input value="{{ $customer->lastname }}" type="text" name="lastname" required>
            <label for="title">lastname</label>
        </div>
    </div>

    <div class="m-input-group fwidth flexbox justify-between">
        <div class="m-input-wrapper w50-6">
            <input value="{{ $customer->phone }}" type="text" name="phone" required>
            <label for="title">phone</label>
        </div>
        <div class="m-input-wrapper w50-6">
            <input value="{{ $customer->email }}" type="text" name="email" required>
            <label for="title">email</label>
        </div>
    </div>

    <div class="m-input-group fwidth flexbox justify-between">
        <div class="m-input-wrapper w50-6">
            <input value="{{ $customer->address }}" type="text" name="address" required>
            <label for="title">address</label>
        </div>
        <div class="m-input-wrapper w50-6">
            <select name="city">

                @foreach(\App\City::all() as $city)
                <option value="{{ $city->city_name }}" {{ $city->city_name == $customer->city ? 'selected' : '' }}>{{ $city->city_name }}</option>
                @endforeach

            </select>
            <label for="title">city</label>
        </div>
    </div>

    <div class="m-input-group fwidth flexbox justify-between">
        <div class="m-input-wrapper w50-6">
            <input type="password" name="password" required>
            <label for="title">password</label>
        </div>
        <div class="m-input-wrapper w50-6">
            <select name="active">
                <option value="1" {{ $customer->active == 1 ? 'selected' : '' }}>active</option>
                <option value="0" {{ $customer->active == 0 ? 'selected' : '' }}>none</option>
            </select>
            <label for="title">active</label>
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

            var url = "{{ route('api.customer.update', $customer->id) }}";
            var fd = new FormData($('form')[0]);

            NProgress.start();

            Ajax.post(url, fd, saved);
            

            NProgress.done();
        });
    });

    function saved() {

        // $('input').val('');

        // $('textarea').val('');

        location.reload();
    }

</script>
@endsection
