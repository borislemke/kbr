@extends('admin.master')
@section('page', 'branches')

@section('content')
<h3>Add Category</h3>
<br>

{!! Form::open(['url' => route('api.term.store')]) !!}

    <div class="m-input-group fwidth flexbox justify-between">                    
        <div class="m-input-wrapper w50-6">
            <input url-format data-target="#category-input-slug" type="text" name="name" id="category-input-title" required>
            <label for="title">name</label>
        </div>

        <div class="m-input-wrapper w50-6">
            <input type="text" name="slug" id="category-input-slug" required>
            <label for="slug">slug</label>
        </div>
    </div>

    <div class="m-input-group fwidth flexbox justify-between">

        <div class="m-input-wrapper w50-6">
            <select name="parent_id">
                <option value="0">none</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <label for="title">parent</label>
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

            var url = "{{ route('api.term.store', ['type' => 'post_category']) }}";
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
