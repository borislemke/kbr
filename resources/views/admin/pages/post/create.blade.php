@extends('admin.master')
@section('page', 'blog')

@section('content')
<h3>Add Post</h3>
<br>

{!! Form::open(['url' => route('api.post.store')]) !!}

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

                <m-caroussel-slide class="flexbox flexbox-wrap" id="caroussel-general" style="width: calc(100% / <?= $numberOfSlides ?>)">

                    <div class="m-input-group fwidth flexbox justify-between">                    
                        <div class="m-input-wrapper w50-6">
                            <input url-format data-target="#post-input-slug" type="text" name="title[en]" id="post-input-title" required>
                            <label for="title">title</label>
                        </div>

                        <div class="m-input-wrapper w50-6">
                            <input type="text" name="slug[en]" id="post-input-slug" required>
                            <label for="slug">url</label>
                        </div>
                    </div>

                    <div class="m-input-group fwidth flexbox justify-between">
                        <div class="m-input-wrapper w50-6">
                            <input type="text" name="meta_keyword[en]" required>
                            <label for="title">keyword</label>
                        </div>
                        <div class="m-input-wrapper w50-6">
                            <input type="text" name="meta_description[en]" required>
                            <label for="title">description</label>
                        </div>
                    </div>

                    <div class="m-input-group textarea fwidth flexbox flexbox-wrap">
                        <h3 class="input-group-title">content</h3>
                        <div class="input-wrapper fwidth">
                            <textarea name="content[en]" rows="10" style="padding-top: 0"></textarea>
                        </div>
                    </div>                

                </m-caroussel-slide>

                <m-caroussel-slide class="flexbox flexbox-wrap" id="caroussel-general" style="width: calc(100% / <?= $numberOfSlides ?>)">

                    <div class="m-input-group fwidth flexbox justify-between">                    
                        <div class="m-input-wrapper w50-6">
                            <input url-format data-target="#post-input-slug2" type="text" name="title[fr]" id="post-input-title" required>
                            <label for="title">title</label>
                        </div>

                        <div class="m-input-wrapper w50-6">
                            <input type="text" name="slug[fr]" id="post-input-slug2" required>
                            <label for="slug">url</label>
                        </div>
                    </div>

                    <div class="m-input-group fwidth flexbox justify-between">
                        <div class="m-input-wrapper w50-6">
                            <input type="text" name="meta_keyword[fr]" required>
                            <label for="title">keyword</label>
                        </div>
                        <div class="m-input-wrapper w50-6">
                            <input type="text" name="meta_description[fr]" required>
                            <label for="title">description</label>
                        </div>
                    </div>

                    <div class="m-input-group textarea fwidth flexbox flexbox-wrap">
                        <h3 class="input-group-title">content</h3>
                        <div class="input-wrapper fwidth">
                            <textarea name="content[fr]" rows="10" style="padding-top: 0"></textarea>
                        </div>
                    </div>

                </m-caroussel-slide>

                <m-caroussel-slide class="flexbox flexbox-wrap" id="caroussel-general" style="width: calc(100% / <?= $numberOfSlides ?>)">

                    <div class="m-input-group fwidth flexbox justify-between">                    
                        <div class="m-input-wrapper w50-6">
                            <input url-format data-target="#post-input-slug3" type="text" name="title[ru]" id="post-input-title" required>
                            <label for="title">title</label>
                        </div>

                        <div class="m-input-wrapper w50-6">
                            <input type="text" name="slug[ru]" id="post-input-slug3" required>
                            <label for="slug">url</label>
                        </div>
                    </div>

                    <div class="m-input-group fwidth flexbox justify-between">
                        <div class="m-input-wrapper w50-6">
                            <input type="text" name="meta_keyword[ru]" required>
                            <label for="title">keyword</label>
                        </div>
                        <div class="m-input-wrapper w50-6">
                            <input type="text" name="meta_description[ru]" required>
                            <label for="title">description</label>
                        </div>
                    </div>

                    <div class="m-input-group textarea fwidth flexbox flexbox-wrap">
                        <h3 class="input-group-title">content</h3>
                        <div class="input-wrapper fwidth">
                            <textarea name="content[ru]" rows="10" style="padding-top: 0"></textarea>
                        </div>
                    </div>

                </m-caroussel-slide>

                <m-caroussel-slide class="flexbox flexbox-wrap" id="caroussel-general" style="width: calc(100% / <?= $numberOfSlides ?>)">

                    <div class="m-input-group fwidth flexbox justify-between">                    
                        <div class="m-input-wrapper w50-6">
                            <input url-format data-target="#post-input-slug4" type="text" name="title[id]" id="post-input-title" required>
                            <label for="title">title</label>
                        </div>

                        <div class="m-input-wrapper w50-6">
                            <input type="text" name="slug[id]" id="post-input-slug4" required>
                            <label for="slug">url</label>
                        </div>
                    </div>

                    <div class="m-input-group fwidth flexbox justify-between">
                        <div class="m-input-wrapper w50-6">
                            <input type="text" name="meta_keyword[id]" required>
                            <label for="title">keyword</label>
                        </div>
                        <div class="m-input-wrapper w50-6">
                            <input type="text" name="meta_description[id]" required>
                            <label for="title">description</label>
                        </div>
                    </div>

                    <div class="m-input-group textarea fwidth flexbox flexbox-wrap">
                        <h3 class="input-group-title">content</h3>
                        <div class="input-wrapper fwidth">
                            <textarea name="content[id]" rows="10" style="padding-top: 0"></textarea>
                        </div>
                    </div>

                </m-caroussel-slide>

            </m-caroussel-slider>
        </m-caroussel-body>

    </m-caroussel>

    <div class="m-input-group fwidth flexbox justify-between">
        <div class="m-input-wrapper w50-6">
            <select name="status">
                <option value="1">publish</option>
                <option value="0">draft</option>
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

            var url = "{{ route('api.post.store') }}";
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
