@extends('admin.master')
@section('page', 'properties')

@section('content')
<h3>Edit Testimony</h3>
<br>

{!! Form::open(['url' => route('api.testimony.update', $testimony->id)]) !!}

    {{ method_field('PUT') }}
    <div class="m-input-group fwidth flexbox justify-between">
        <div class="m-input-wrapper w50-6">
            <input value="{{ $testimony->customer_id }}" type="text" name="customer_id" required>
            <label for="title">customer id</label>
        </div>
        <div class="m-input-wrapper w50-6">
            <input value="{{ $testimony->title }}" type="text" name="title" required>
            <label for="title">title</label>
        </div>
    </div>

    <div class="m-input-group textarea fwidth flexbox flexbox-wrap">
        <h3 class="input-group-title">content</h3>
        <div class="input-wrapper fwidth">
            <textarea name="content" rows="10" style="padding-top: 0">{{ $testimony->content }}</textarea>
        </div>
    </div>

    <div class="m-input-group fwidth flexbox justify-between">
        <div class="m-input-wrapper w50-6">
            <select name="status">
                <option value="1" {{ $testimony->status == 1 ? 'selected' : '' }}>publish</option>
                <option value="0" {{ $testimony->status == 0 ? 'selected' : '' }}>hidden</option>
            </select>
            <label for="title">status</label>
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

            var url = "{{ route('api.testimony.update', $testimony->id) }}";
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
