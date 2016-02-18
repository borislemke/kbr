@extends('admin.master')
@section('page', 'blog')

@section('content')
<h3>Edit Post</h3>
<br>

{!! Form::open(['url' => route('api.post.update', $post->id)]) !!}

{!! method_field('PUT') !!}

    <m-caroussel>

        <m-caroussel-header class="flexbox justify-end">
            <m-caroussel-switch-wrapper class="flexbox">
                <?php $numberOfSlides = 4 ?>
                <m-caroussel-switch class="active">english</m-caroussel-switch>
                <m-caroussel-switch>french</m-caroussel-switch>
                <m-caroussel-switch>russian</m-caroussel-switch>
                <m-caroussel-switch>bahasa</m-caroussel-switch>
            </m-caroussel-switch-wrapper>
        </m-caroussel-header>

        <m-caroussel-body>
            <m-caroussel-slider class="flexbox align-start" style="width: <?= $numberOfSlides ?>00%;">

                @foreach(Config::get('app.alt_langs') as $locale)
                <?php $postLocale = $post->postLocales()->where('locale', $locale)->first(); ?>

                <m-caroussel-slide class="flexbox flexbox-wrap" id="caroussel-general" style="width: calc(100% / <?= $numberOfSlides ?>)">

                    <div class="m-input-group fwidth flexbox justify-between">                    
                        <div class="m-input-wrapper w50-6">
                            <input value="{{ $postLocale->title or '' }}" url-format data-target="#post-input-slug-{{ $locale }}" type="text" name="title[{{ $locale }}]" id="post-input-title" required>
                            <label for="title">title</label>
                        </div>

                        <div class="m-input-wrapper w50-6">
                            <input value="{{ $postLocale->slug or '' }}" type="text" name="slug[{{ $locale }}]" id="post-input-slug-{{ $locale }}" required>
                            <label for="slug">url</label>
                        </div>
                    </div>

                    <div class="m-input-group fwidth flexbox justify-between">
                        <div class="m-input-wrapper w50-6">
                            <input value="{{ $postLocale->meta_keyword or '' }}" type="text" name="meta_keyword[{{ $locale }}]" required>
                            <label for="title">keyword</label>
                        </div>
                        <div class="m-input-wrapper w50-6">
                            <input value="{{ $postLocale->meta_description or '' }}" type="text" name="meta_description[{{ $locale }}]" required>
                            <label for="title">description</label>
                        </div>
                    </div>

                    <div class="m-input-group textarea fwidth flexbox flexbox-wrap">
                        <h3 class="input-group-title">content</h3>
                        <div class="input-wrapper fwidth">
                            <textarea id="editor{{ $locale }}" name="content[{{ $locale }}]" rows="20" style="padding-top: 0"></textarea>
                        </div>
                    </div>      

                    <script type="text/javascript">

                        CKEDITOR.replace('editor{{ $locale }}', {
                            height: 500,
                            filebrowserBrowseUrl : 'assets/plugins/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
                            filebrowserUploadUrl : 'assets/plugins/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
                            filebrowserImageBrowseUrl : 'assets/plugins/filemanager/dialog.php?type=1&editor=ckeditor&fldr='
                        });


                        CKEDITOR.instances.editor{{ $locale }}.setData(<?= $postLocale ? json_encode($postLocale->content) : '' ?>);

                    </script>          

                </m-caroussel-slide>
                @endforeach

            </m-caroussel-slider>
        </m-caroussel-body>

    </m-caroussel>

    <div class="m-input-group fwidth flexbox justify-between">
        <div class="m-input-wrapper w50-6">
            <select name="status">
                <option value="1" {{ $post->status == 1 ? 'selected' : '' }}>publish</option>
                <option value="0" {{ $post->status == 0 ? 'selected' : '' }}>draft</option>
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

            var url = "{{ route('api.post.update', $post->id) }}";
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
