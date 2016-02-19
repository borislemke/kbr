@extends('admin.master')
@section('page', 'translations')

@section('content')
<h3>Add Page</h3>
<br>

{!! Form::open(['url' => route('api.property_locale.store')]) !!}

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

                <input value="{{ $property->id }}" type="hidden" name="property_id">

                @foreach(Config::get('app.alt_langs') as $locale)
                <?php $propertyLocale = $property->propertyLocales()->where('locale', $locale)->first(); ?>

                <m-caroussel-slide class="flexbox flexbox-wrap" id="caroussel-general" style="width: calc(100% / <?= $numberOfSlides ?>)">

                    <input value="{{ $propertyLocale->id or 0 }}" type="hidden" name="id[{{ $locale }}]">
                    <div class="m-input-group fwidth flexbox justify-between">                    
                        <div class="m-input-wrapper w50-6">
                            <input value="{{ $propertyLocale->title or '' }}" url-format data-target="#property-input-slug-{{ $locale }}" type="text" name="title[{{ $locale }}]" id="property-input-title" required>
                            <label for="title">title</label>
                        </div>

                        <div class="m-input-wrapper w50-6">
                            <input value="{{ $propertyLocale->slug or '' }}" type="text" name="slug[{{ $locale }}]" id="property-input-slug-{{ $locale }}" required>
                            <label for="slug">url</label>
                        </div>
                    </div>

                    <div class="m-input-group fwidth flexbox justify-between">
                        <div class="m-input-wrapper w50-6">
                            <input value="{{ $propertyLocale->meta_keyword or '' }}" type="text" name="meta_keyword[{{ $locale }}]" required>
                            <label for="title">keyword</label>
                        </div>
                        <div class="m-input-wrapper w50-6">
                            <input value="{{ $propertyLocale->meta_description or '' }}" type="text" name="meta_description[{{ $locale }}]" required>
                            <label for="title">description</label>
                        </div>
                    </div>

                    <div class="m-input-group textarea fwidth flexbox flexbox-wrap">
                        <h3 class="input-group-title">content</h3><button class="translate" data-locale="{{ $locale }}">translate by google</button>
                        <div class="input-wrapper fwidth">
                            <textarea id="editor{{ $locale }}" name="content[{{ $locale }}]" rows="20" style="padding-top: 0">{{ $propertyLocale->content or '' }}</textarea>
                        </div>
                    </div>              

                </m-caroussel-slide>
                @endforeach


            </m-caroussel-slider>
        </m-caroussel-body>

    </m-caroussel>

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

            var url = "{{ route('api.property_locale.store') }}";
            var fd = new FormData($('form')[0]);

            NProgress.start();

            Ajax.post(url, fd, saved);
            

            NProgress.done();
        });

        $(document).on('click', '.translate', function(event) {
            event.preventDefault();
            
            var locale = $(this).attr('data-locale');

            alert(locale + ': You must connect google translate API');
        });
    });

    function saved() {

        $('input').val('');

        $('textarea').val('');

        location.reload();
    }

</script>
@endsection
