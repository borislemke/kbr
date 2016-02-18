@extends('admin.master')
@section('page', 'pages')

@section('content')
<h3>Add Page</h3>
<br>

{!! Form::open(['url' => route('api.page.update', $page->id)]) !!}

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
                <?php $pageLocale = $page->pageLocales()->where('locale', $locale)->first(); ?>

                <m-caroussel-slide class="flexbox flexbox-wrap" id="caroussel-general" style="width: calc(100% / <?= $numberOfSlides ?>)">

                    <div class="m-input-group fwidth flexbox justify-between">                    
                        <div class="m-input-wrapper w50-6">
                            <input value="{{ $pageLocale->title or '' }}" url-format data-target="#page-input-slug-{{ $locale }}" type="text" name="title[{{ $locale }}]" id="page-input-title" required>
                            <label for="title">title</label>
                        </div>

                        <div class="m-input-wrapper w50-6">
                            <input value="{{ $pageLocale->slug or '' }}" type="text" name="slug[{{ $locale }}]" id="page-input-slug-{{ $locale }}" required>
                            <label for="slug">url</label>
                        </div>
                    </div>

                    <div class="m-input-group fwidth flexbox justify-between">
                        <div class="m-input-wrapper w50-6">
                            <input value="{{ $pageLocale->meta_keyword or '' }}" type="text" name="meta_keyword[{{ $locale }}]" required>
                            <label for="title">keyword</label>
                        </div>
                        <div class="m-input-wrapper w50-6">
                            <input value="{{ $pageLocale->meta_description or '' }}" type="text" name="meta_description[{{ $locale }}]" required>
                            <label for="title">description</label>
                        </div>
                    </div>

                    <div class="m-input-group textarea fwidth flexbox flexbox-wrap">
                        <h3 class="input-group-title">content</h3>
                        <div class="input-wrapper fwidth">
                            <textarea name="content[{{ $locale }}]" rows="10" style="padding-top: 0">{{ $pageLocale->content or '' }}</textarea>
                        </div>
                    </div>                

                </m-caroussel-slide>
                @endforeach

            </m-caroussel-slider>
        </m-caroussel-body>

    </m-caroussel>

    <div class="m-input-group fwidth flexbox justify-between">
        <div class="m-input-wrapper w50-6">
            <select name="status">
                <option value="1" {{ $page->status == 1 ? 'selected' : '' }}>publish</option>
                <option value="0" {{ $page->status == 0 ? 'selected' : '' }}>draft</option>
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

            var url = "{{ route('api.page.update', $page->id) }}";
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
