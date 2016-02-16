@extends('admin.master')
@section('page', 'properties')

@section('content')
<h3>Add Enquiry</h3>
<br>

{!! Form::open(['url' => route('api.enquiry.store')]) !!}


    <div class="m-input-group fwidth flexbox justify-between">
        <div class="m-input-wrapper w50-6">
            <input type="text" name="property_id" required>
            <label for="title">Property ID</label>
        </div>
        <div class="m-input-wrapper w50-6">
            <input type="text" name="subject" required>
            <label for="title">subject</label>
        </div>
    </div>

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

    <div class="m-input-group textarea fwidth flexbox flexbox-wrap">
        <h3 class="input-group-title">Comment</h3>
        <div class="input-wrapper fwidth">
            <textarea name="content" id="property-input-description" rows="10" style="padding-top: 0"></textarea>
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

            var url = "{{ route('api.enquiry.store') }}";
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
