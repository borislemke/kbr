@extends('admin.master')
@section('page', 'properties')

@section('content')


    {!! Form::open(array('class' => 'modal-window', 'id' => 'property-form', 'data-function' => 'modalClose', 'data-url' => 'property/store')) !!}

    <h3>Edit Property</h3>
    <m-caroussel>

        <m-caroussel-header class="flexbox justify-end">
            <m-caroussel-switch-wrapper class="flexbox">
                <?php $numberOfSlides = 5 ?>
                <m-caroussel-switch class="active">detail</m-caroussel-switch>

                @if($request->category != 'land')
                <m-caroussel-switch>facilities</m-caroussel-switch>
                <m-caroussel-switch>distance</m-caroussel-switch>
                @endif

                <m-caroussel-switch>gallery</m-caroussel-switch>
                <m-caroussel-switch>owner</m-caroussel-switch>
            </m-caroussel-switch-wrapper>
        </m-caroussel-header>

        <m-caroussel-body>
            <m-caroussel-slider class="flexbox align-start" style="width: <?= $numberOfSlides ?>00%;">

                <m-caroussel-slide class="flexbox flexbox-wrap" id="caroussel-general" style="width: calc(100% / <?= $numberOfSlides ?>)">

                    <div class="m-input-group fwidth flexbox justify-between">
                        <div class="m-input-wrapper w50-6">
                            <input value="{{ $property->localeEN()->title or '' }}" url-format data-target="#property-input-slug" type="text" name="title" id="property-input-title" required>
                            <label for="title">title</label>
                        </div>

                        <div class="m-input-wrapper w50-6">
                            <input value="{{ $property->localeEN()->slug }}" type="text" name="slug" id="property-input-slug" required>
                            <label for="slug">url</label>
                        </div>
                    </div>

                    <div class="m-input-group fwidth flexbox flexbox-wrap justify-between">

                        <h3 class="input-group-title">General Information</h3>

                        <m-input w25-9>
                            <input value="{{ $property->code }}" type="text" name="code" id="property-input-code" required>
                            <label for="code">property code</label>
                        </m-input>

                        <m-input w25-9>
                            <input value="{{ $property->price }}" type="text" name="price" id="property-input-price" required>
                            <label for="property-input-price">price</label>
                        </m-input>

                        <m-input select w25-9>
                            <select name="price_label">
                                <option value="none" {{ $property->price_label == 'none' ? 'selected' : '' }}>none</option>
                                <option value="annually" {{ $property->price_label == 'annually' ? 'selected' : '' }}>annually</option>
                                <option value="monthly" {{ $property->price_label == 'monthly' ? 'selected' : '' }}>monthly</option>
                                <option value="weekly" {{ $property->price_label == 'weekly' ? 'selected' : '' }}>weekly</option>
                                <option value="daily" {{ $property->price_label == 'daily' ? 'selected' : '' }}>daily</option>
                            </select>
                            <label for="title">label</label>
                        </m-input>

                        <m-input select class="m-input-wrapper w25-9">
                            <select name="currency">
                                <option value="IDR" {{ $property->currency == 'IDR' ? 'selected' : '' }}>idr</option>
                                <option value="EUR" {{ $property->currency == 'EUR' ? 'selected' : '' }}>eur</option>
                                <option value="USD" {{ $property->currency == 'USD' ? 'selected' : '' }}>usd</option>
                            </select>
                            <label for="title">currency</label>
                        </m-input>
                    </div>

                    <div class="m-input-group fwidth flexbox justify-between">
                        <m-input w25-9>
                            <input value="{{ $property->lease_period }}" type="text" name="lease_period" id="property-input-lease_period" required>
                            <label for="lease_period">period</label>
                        </m-input>

                        <m-input w25-9>
                            <input value="{{ $property->lease_year }}" type="text" name="lease_year" id="property-input-lease_year" required>
                            <label for="lease_year">end year</label>
                        </m-input>

                        <m-input w25-9>
                            <input value="{{ $property->building_size }}" type="text" name="building_size" id="property-input-building_size" required>
                            <label for="building_size">building size(sqm)</label>
                        </m-input>

                        <m-input w25-9>
                            <input value="{{ $property->land_size }}" type="text" name="land_size" id="property-input-land_size" required>
                            <label for="land_size">land size(are)</label>
                        </m-input>
                    </div>

                    <div class="m-input-group fwidth flexbox flexbox-wrap justify-between">
                        <h3 class="input-group-title">Views</h3>
                        <m-input w25-9>
                            <input value="{{ $property->view_north }}" type="text" name="view_north" id="property-input-view_north" required>
                            <label for="view_north">north</label>
                        </m-input>

                        <m-input w25-9>
                            <input value="{{ $property->view_east }}" type="text" name="view_east" id="property-input-view_east" required>
                            <label for="view_east">east</label>
                        </m-input>

                        <m-input w25-9>
                            <input value="{{ $property->view_west }}" type="text" name="view_west" id="property-input-view_west" required>
                            <label for="view_west">west</label>
                        </m-input>

                        <m-input w25-9>
                            <input value="{{ $property->view_south }}" type="text" name="view_south" id="property-input-view_south" required>
                            <label for="view_south">south</label>
                        </m-input>
                    </div>

                    <div class="m-input-group fwidth flexbox justify-between">
                        <!-- <h3 class="input-group-title">Position</h3> -->
                        <m-input class="m-input-wrapper w50-6">
                            <input value="{{ $property->map_latitude }}" type="text" name="map_latitude" required>
                            <label for="map_latitude">latitude</label>
                        </m-input>

                        <m-input class="m-input-wrapper w50-6">
                            <input value="{{ $property->map_longitude }}" type="text" name="map_longitude" required>
                            <label for="map_longitude">longitude</label>
                        </m-input>
                    </div>

                    <div class="m-input-group fwidth flexbox justify-between">
                        <m-input select class="m-input-wrapper w50-6">
                            <select name="type">
                                <option value="free hold" {{ $property->type == 'free hold' ? 'selected' : '' }}>free hold</option>
                                <option value="lease hold" {{ $property->type == 'lease hold' ? 'selected' : '' }}>lease hold</option>
                            </select>
                            <label for="title">type</label>
                        </m-input>

                        <m-input select class="m-input-wrapper w50-6">
                            <select name="category">

                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $property->categories[0]->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach

                            </select>
                            <label for="title">category</label>
                        </m-input>

                    </div>                   

                    <div class="m-input-group fwidth flexbox justify-between">
                        <m-input select class="m-input-wrapper w50-6">
                            <select name="is_price_request">
                                <option value="1" {{ $property->is_price_request == 1 ? 'selected' : '' }}>yes</option>
                                <option value="0" {{ $property->is_price_request == 0 ? 'selected' : '' }}>no</option>
                            </select>
                            <label for="title">is price request</label>
                        </m-input>
                        <m-input select class="m-input-wrapper w50-6">
                            <select name="is_exclusive">
                                <option value="1" {{ $property->is_exclusive == 1 ? 'selected' : '' }}>yes</option>
                                <option value="0" {{ $property->is_exclusive == 0 ? 'selected' : '' }}>no</option>
                            </select>
                            <label for="title">is Exclusive</label>
                        </m-input>
                    </div>

                    <div class="m-input-group fwidth flexbox justify-between">
                        <m-input select class="m-input-wrapper w50-6">
                            <select name="city">

                                @foreach(\App\City::orderBy('city_name', 'asc')->get() as $city)
                                <option value="{{ $city->city_name }}" {{ $city->city_name == $property->city ? 'selected' : '' }}>{{ $city->city_name }}</option>
                                @endforeach

                            </select>
                            <label for="title">city</label>
                        </m-input>                        

                        <m-input select class="m-input-wrapper w50-6">
                            <select name="status">
                                <option value="1" {{ $property->status == 1 ? 'selected' : '' }}>available</option>
                                <option value="0" {{ $property->status == 0 ? 'selected' : '' }}>unavailable</option>
                                <option value="-1" {{ $property->status == -1 ? 'selected' : '' }}>hidden</option>
                            </select>
                            <label for="title">status</label>
                        </m-input>
                    </div>

                    <div class="m-input-group fwidth flexbox flexbox-wrap">

                        <?php $exist_tags = $property->tags->lists('id')->toArray(); ?>
                        <?php $tags = \App\Term::where('type', 'property_tag')->get(); ?>
                        @foreach($tags as $tag)
                        <m-checkbox data-label="{{ $tag->name }}" w25-9>
                            <input type="checkbox" value="{{ $tag->id }}" name="tag[]" {{ in_array($tag->id, $exist_tags) ? 'checked' : '' }}>
                            <lever></lever>
                        </m-checkbox>
                        @endforeach

                    </div>

                    <div class="m-input-group textarea fwidth flexbox flexbox-wrap">
                        <h3 class="input-group-title">Property Description</h3>
                        <div class="input-wrapper fwidth">
                            <textarea name="content" id="property-input-description" rows="10" style="padding-top: 0">{{ $property->localeEN()->content or '' }}</textarea>
                        </div>
                    </div>
                </m-caroussel-slide>

                @if($request->category != 'land')
                <m-caroussel-slide class="flexbox flexbox-wrap" id="caroussel-facilities" style="width: calc(100% / <?= $numberOfSlides ?>)">

                    <div class="m-input-group fwidth flexbox justify-between">
                        <!-- <h3 class="input-group-title">Position</h3> -->
                        <m-input class="m-input-wrapper w50-6">
                            <input value="{{ $property->bathroom }}" min="0" type="number" name="bathroom" required>
                            <label for="bathroom">bath room</label>
                        </m-input>

                        <m-input class="m-input-wrapper w50-6">
                            <input value="{{ $property->bedroom }}" min="0" type="number" name="bedroom" required>
                            <label for="bedroom">bed room</label>
                        </m-input>
                    </div>

                    <div class="m-input-group fwidth flexbox justify-between">
                        <!-- <h3 class="input-group-title">Position</h3> -->
                        <m-input class="m-input-wrapper w50-6">
                            <input value="{{ $property->bed }}" min="0" type="number" name="bed" required>
                            <label for="bed">bed</label>
                        </m-input>

                        <m-input class="m-input-wrapper w50-6">
                            <input value="{{ $property->sell_in_furnish }}" type="text" name="sell_in_furnish" required>
                            <label for="sell_in_furnish">sell in furnish</label>
                        </m-input>
                    </div>


                    <div class="m-input-group textarea fwidth flexbox flexbox-wrap" id="documents-received">

                        <?php 
                            $arr_facilities = Config::get('facility');
                        ?>

                        @foreach($arr_facilities as $key => $facility)
                        <m-checkbox data-label="{{ $facility }}" w25-9>
                            <input type="checkbox" value="{{ $facility }}" name="facility_name[]" {{ in_array($facility, $exist_facility) ? 'checked' : '' }}>
                            <lever></lever>
                        </m-checkbox>
                        @endforeach
                    </div>

                </m-caroussel-slide>

                <m-caroussel-slide class="justify-between flexbox flexbox-wrap" id="caroussel-distance" style="width: calc(100% / <?= $numberOfSlides ?>)">

                    <div class="m-input-group fwidth flexbox flexbox-wrap justify-between">

                        <div class="m-input-group fwidth flexbox flexbox-wrap justify-between" id="distance-wrapper">

                            @foreach($property->distances as $distance)
                            <m-input w50-6>
                                <input type="text" value="{{ $distance->name }}" name="distance_name[]">
                                <label>name</label>
                            </m-input>
                            <m-input w50-6>
                                <input type="text" value="{{ $distance->value }}" name="distance_value[]">
                                <label>value</label>
                            </m-input>
                            @endforeach

                        </div>
                        <button class="add-distance">add more</button>

                        <div class="push-bottom"></div>
                        <div class="push-bottom"></div>
                    </div>

                </m-caroussel-slide>
                @endif

                <m-caroussel-slide class="flexbox flexbox-wrap" id="caroussel-gallery" style="width: calc(100% / <?= $numberOfSlides ?>)">

                    <m-input picture>
                        <div class="drop-field">
                            <p class="drop-hint">drop files here</p>
                        </div>
                        <input class="m-image-input" type="file" name="files[]" id="property-input-image" multiple>
                    </m-input>

                    <div id="gallery-wrapper" flexwrap style="width: 100%">

                        @foreach($property->galleries as $gallery)
                        <m-gallery-item class="gallery-item" style="background-image: url({{ asset('uploads/images/property/' . $gallery->file) }})" data-id="{{ $gallery->id }}" id="gallery-item-{{ $gallery->id }}" data-file="{{ $gallery->file }}">
                            <m-gallery-item-menu>
                                <m-button class="make-thumbnail" data-function="makeThumbnail">
                                    <i class="material-icons {{ $gallery->file == $thumbnail ? 'yellow' : '' }}">{{ $gallery->file == $thumbnail ? 'star' : 'star_border' }}</i>
                                </m-button>
                                <m-button delete data-id="{{ $gallery->id }}" class="delete-gallery-item">
                                    <i class="material-icons">close</i>
                                </m-button>
                            </m-gallery-item-menu>
                        </m-gallery-item>
                        @endforeach

                    </div>

                </m-caroussel-slide>

                <m-caroussel-slide class="flexbox flexbox-wrap" id="caroussel-owner" style="width: calc(100% / <?= $numberOfSlides ?>)">

                    <div class="m-input-group fwidth flexbox flexbox-wrap justify-between">
                        <h3 class="input-group-title">Owner Information</h3>
                        <m-input w33-8>
                            <input value="{{ $property->owner_name }}" type="text" name="owner_name" id="property-input-owner_name" required>
                            <label for="owner_name">name</label>
                        </m-input>

                        <m-input w33-8>
                            <input value="{{ $property->owner_phone }}" type="text" name="owner_phone" id="property-input-owner_phone" required>
                            <label for="owner_phone">phone</label>
                        </m-input>

                        <m-input w33-8>
                            <input value="{{ $property->owner_email }}" type="text" name="owner_email" id="property-input-owner_email" required>
                            <label for="owner_email">email</label>
                        </m-input>
                    </div>

                    <div class="m-input-group fwidth flexbox flexbox-wrap justify-between">
                        <h3 class="input-group-title">Agency Information</h3>
                        <m-input w33-8>
                            <input value="{{ $property->agent_commission }}" type="text" name="agent_commission" id="property-input-agent_commission" required>
                            <label for="agent_commission">Commission</label>
                        </m-input>

                        <m-input w33-8>
                            <input value="{{ $property->agent_contact }}" type="text" name="agent_contact" id="property-input-agent_contact" required>
                            <label for="agent_contact">contact for viewing</label>
                        </m-input>

                        <m-input w33-8>
                            <input value="{{ $property->agent_inspector }}" type="text" name="agent_inspector" id="property-input-agent_inspector" required>
                            <label for="agent_inspector">inspected by</label>
                        </m-input>
                    </div>

                    <div class="m-input-group textarea fwidth flexbox flexbox-wrap" id="documents-received">
                        <h3 class="input-group-title">Documents Received</h3>

                        <?php 
                            $arr_documents = Config::get('document');
                        ?>

                        @foreach($arr_documents as $key => $document)
                        <m-checkbox data-label="{{ $document }}" w25-9>
                            <input type="checkbox" value="{{ $document }}" name="document_name[]" {{ in_array($document, $exist_document) ? 'checked' : '' }}>
                            <lever></lever>
                        </m-checkbox>
                        @endforeach

                    </div>

                    <div class="m-input-group textarea fwidth flexbox flexbox-wrap">
                        <h3 class="input-group-title">Reason for Selling</h3>
                        <m-input fwidth>
                            <textarea name="sell_reason" id="property-input-sell_reason" rows="3" style="padding-top: 0">{{ $property->sell_reason }}</textarea>
                        </m-input>
                    </div>

                    <div class="m-input-group textarea fwidth flexbox flexbox-wrap">
                        <h3 class="input-group-title">Other Listing Agents</h3>
                        <m-input fwidth>
                            <textarea name="other_agent" id="property-input-other_agent" rows="3" style="padding-top: 0">{{ $property->other_agent }}</textarea>
                        </m-input>
                    </div>

                    <div class="m-input-group textarea fwidth flexbox flexbox-wrap">
                        <h3 class="input-group-title">Notes</h3>
                        <m-input fwidth>
                            <textarea name="sell_note" id="property-input-sell_note" rows="5" style="padding-top: 0">{{ $property->sell_note }}</textarea>
                        </m-input>
                    </div>
                </m-caroussel-slide>

            </m-caroussel-slider>
        </m-caroussel-body>
    </m-caroussel>
    <input type="hidden" name="edit" value="{{ $property->id }}" id="edit-flag">

    <m-buttons flexbox justify-end>
        <m-button plain onclick="window.history.back()" id="close-properties-form">cancel</m-button>
        <m-button save-form plain>save</m-button>
    </m-buttons>
    {!! Form::close() !!}

@endsection

@section('scripts')

<script>
    // Matter.admin.properties();

    $(document).ready(function() {
    
        $(document).on('click', '[save-form]', function(event) {
            event.preventDefault();
            
            console.log('save clicked!');

            var url = "{{ route('api.properties.store') }}";
            var fd = new FormData($('form')[0]);

            NProgress.start();

            Ajax.post(url, fd, saved);
            

            NProgress.done();
        });

        $(document).on('click', '.add-facility', function(event) {
            event.preventDefault();
            
            var html = ''
                + '<m-input w50-6>'
                    + '<input type="text" value="" name="facility_name[]">'
                    + '<label>name</label>'
                + '</m-input>'
                
                + '<m-input w50-6>'
                    + '<input type="text" value="" name="facility_value[]">'
                    + '<label>value</label>'
                + '</m-input>';

            $('#facility-wrapper').append(html);

        });

        $(document).on('click', '.add-distance', function(event) {
            event.preventDefault();
            
            var html = ''
                + '<m-input w50-6>'
                    + '<input type="text" value="" name="distance_name[]">'
                    + '<label>name</label>'
                + '</m-input>'
                
                + '<m-input w50-6>'
                    + '<input type="text" value="" name="distance_value[]">'
                    + '<label>value</label>'
                + '</m-input>';

            $('#distance-wrapper').append(html);

        });

        $(document).on('click', '.delete-gallery-item', function(event) {
            event.preventDefault();

            var id = $(this).attr('data-id');
            var url = "{{ route('api.attachment.destroy', $id = null) }}/" + id + "?name=property";
            var method = 'delete';
            var token = "{{ csrf_token() }}";

            Monolog.confirm('delete item', 'are you sure to delete this item? this cannot be undone', function() {
                NProgress.start();
                $.post(url, {_method: method, _token: token}, function(data, textStatus, xhr) {
                    
                    switch(data.status) {

                        case 200:

                            Monolog.notify(data.monolog.title, data.monolog.message);

                            removeItem(data);

                            break;

                        default:

                            Monolog.notify(data.monolog.title, data.monolog.message);

                            consoleLog(data);
                    }
                });
            });

        });

        $(document).on('click', '.make-thumbnail', function(event) {
            event.preventDefault();

            var $this = $(this);

            var url = "{{ route('api.thumb.store') }}";
            var token = "{{ csrf_token() }}";
            var property_id = {{ $property->id }};
            var value = $(this).closest('.gallery-item').attr('data-file');

            $.post(url, {property_id: property_id, value: value, _token: token}, function(data, textStatus, xhr) {
                
                $('.make-thumbnail').find('.material-icons').html('star_border');

                $this.find('.material-icons').html('star').addClass('yellow');
            });            

        });

    });

    function saved() {

        location.reload();
    }

    function removeItem(data) {

        var id = data.id;

        $('#gallery-item-' + id).remove();

        NProgress.done();
    }

</script>

@endsection
