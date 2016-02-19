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
                            <input value="{{ $property->period }}" type="text" name="lease_period" id="property-input-lease_period" required>
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
                                <option value="{{ $category->id }}" {{ $category->id == $property->category()->id ? 'selected' : '' }}>{{ $category->name }}</option>
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

                    <div class="m-input-group textarea fwidth flexbox flexbox-wrap">
                        <h3 class="input-group-title">Property Description</h3>
                        <div class="input-wrapper fwidth">
                            <textarea name="content" id="property-input-description" rows="10" style="padding-top: 0">{{ $property->localeEN()->content or '' }}</textarea>
                        </div>
                    </div>
                </m-caroussel-slide>

                @if($request->category != 'land')
                <m-caroussel-slide class="flexbox flexbox-wrap" id="caroussel-facilities" style="width: calc(100% / <?= $numberOfSlides ?>)">

                    <div class="m-input-group fwidth flexbox flexbox-wrap justify-between">

                        <div class="m-input-group fwidth flexbox flexbox-wrap justify-between" id="facility-wrapper">
                            <m-input w50-6>
                                <input type="text" value="bedroom" name="facility_name[]">
                                <label>name</label>
                            </m-input>
                            <m-input w50-6>
                                <input type="text" name="facility_value[]">
                                <label>value</label>
                            </m-input>

                            <m-input w50-6>
                                <input type="text" value="bathroom" name="facility_name[]">
                                <label>name</label>
                            </m-input>

                            <m-input w50-6>
                                <input type="text" name="facility_value[]">
                                <label>value</label>
                            </m-input>

                            <m-input w50-6>
                                <input type="text" value="sale in furnish" name="facility_name[]">
                                <label>name</label>
                            </m-input>
                            
                            <m-input w50-6>
                                <input type="text" name="facility_value[]">
                                <label>value</label>
                            </m-input>

                        </div>
                        <button class="add-facility">add more</button>

                        <div class="push-bottom"></div>
                        <div class="push-bottom"></div>
                    </div>

                </m-caroussel-slide>

                <m-caroussel-slide class="justify-between flexbox flexbox-wrap" id="caroussel-distance" style="width: calc(100% / <?= $numberOfSlides ?>)">

                    <div class="m-input-group fwidth flexbox flexbox-wrap justify-between">

                        <div class="m-input-group fwidth flexbox flexbox-wrap justify-between" id="distance-wrapper">
                            <m-input w50-6>
                                <input type="text" value="beach" name="distance_name[]">
                                <label>name</label>
                            </m-input>
                            <m-input w50-6>
                                <input type="text" name="distance_value[]">
                                <label>value</label>
                            </m-input>

                            <m-input w50-6>
                                <input type="text" value="airport" name="distance_name[]">
                                <label>name</label>
                            </m-input>

                            <m-input w50-6>
                                <input type="text" name="distance_value[]">
                                <label>value</label>
                            </m-input>

                            <m-input w50-6>
                                <input type="text" value="market" name="distance_name[]">
                                <label>name</label>
                            </m-input>
                            
                            <m-input w50-6>
                                <input type="text" name="distance_value[]">
                                <label>value</label>
                            </m-input>

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
<!--
                        <m-gallery-item style="background-image: url('http://loremflickr.com/320/240?t={{ microtime() }}')" data-id="23">
                            <m-gallery-item-menu>
                                <m-button class="make-thumbnail" data-function="makeThumbnail">
                                    <i class="material-icons">star_border</i>
                                </m-button>
                                <m-button delete data-url="propertyimage/destroy">
                                    <i class="material-icons">close</i>
                                </m-button>
                            </m-gallery-item-menu>
                        </m-gallery-item>
 -->
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

                        <m-checkbox data-label="Agent Agreement" w25-9>
                            <input type="checkbox" value="agent agreement" name="document_name[]" id="property-input-document_name[agent agreement]">
                            <lever></lever>
                        </m-checkbox>

                        <m-checkbox data-label="pondok wisata license" w25-9>
                            <input type="checkbox" value="pondok wisata license" name="document_name[]" id="property-input-document_name[pondok wisata license]">
                            <lever></lever>
                        </m-checkbox>

                        <m-checkbox data-label="tax construction" w25-9>
                            <input type="checkbox" value="tax construction" name="document_name[]" id="property-input-document_name[tax construction]">
                            <lever></lever>
                        </m-checkbox>

                        <m-checkbox data-label="photographs" w25-9>
                            <input type="checkbox" value="photographs" name="document_name[]" id="property-input-document_name[photographs]">
                            <lever></lever>
                        </m-checkbox>

                        <m-checkbox data-label="imb" w25-9>
                            <input type="checkbox" value="imb" name="document_name[]" id="property-input-document_name[imb]">
                            <lever></lever>
                        </m-checkbox>

                        <m-checkbox data-label="land certificate" w25-9>
                            <input type="checkbox" value="land certificate" name="document_name[]" id="property-input-document_name[land certificate]">
                            <lever></lever>
                        </m-checkbox>

                        <m-checkbox data-label="Notary Details" w25-9>
                            <input type="checkbox" value="Notary Details" name="document_name[]" id="property-input-document_name[Notary Details]">
                            <lever></lever>
                        </m-checkbox>

                        <m-checkbox data-label="owner idcard" w25-9>
                            <input type="checkbox" value="owner idcard" name="document_name[]" id="property-input-document_name[owner idcard]" checked>
                            <lever></lever>
                        </m-checkbox>
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
    <input type="hidden" name="author" id="property-input-admin" value="admin">
    <input type="hidden" name="property_type" id="property-input-type" value="property">
    <input type="hidden" name="edit" value="0" id="edit-flag">

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

            var url = "{{ route('api.property.store') }}";
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

    });

    function saved() {

        location.reload();
    }

</script>

@endsection
