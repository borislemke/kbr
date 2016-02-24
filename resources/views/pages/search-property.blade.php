@extends('index')
@section('content')

<div class="line-top"><h3><small>{{ trans('url.search') }}</small></h3></div>

<div class="flexbox flexbox-wrap search-container">
    <div class="searchbox-left">

        <div class="search-filter-container">

            <form id="search-form">
                <div class="search-filter-main">
                    <div class="search-filter-row flexbox" id="search-filter-types">
                        <p>Type</p>
                        <div class="search-filter-group flexbox">
                            <label for="search-type-gt500">
                                &lt; $500,000
                                <input type="radio" id="search-type-gt500" name="type" value="lt500k" <?= isset($_GET['type']) ? ($_GET['type'] == 'lt500k' ? 'checked' : 'checked') : 'checked' ?>>
                            </label>

                            <label for="search-type-lt500">
                                &gt; $500,000
                                <input type="radio" id="search-type-lt500" name="type" value="gt500k" <?= isset($_GET['type']) && $_GET['type'] == 'gt500k' ? 'checked' : '' ?>>
                            </label>

                            <label for="search-type-retirement">
                                Home &amp; Retir.
                                <input type="radio" id="search-type-retirement" name="type" value="retirement" <?= isset($_GET['type']) && $_GET['type'] == 'retirement' ? 'checked' : '' ?>>
                            </label>

                            <label for="search-type-beachfront">
                                Beachfront
                                <input type="radio" id="search-type-beachfront" name="type" value="beachfront" <?= isset($_GET['type']) && $_GET['type'] == 'beachfront' ? 'checked' : '' ?>>
                            </label>
                        </div>
                    </div>
                    <div class="search-filter-row flexbox" id="search-filter-location">
                        <p>Location</p>
                        <div class="search-filter-group flexbox">
                            <i class="material-icons">place</i>
                            <input type="text" id="search-location" class="m-input relative" placeholder="All Bali">
                        </div>
                    </div>
                    <div class="search-filter-row flexbox" id="search-filter-price">
                        <p>Price Range</p>
                        <div class="search-filter-group flexbox">
                            <input id="priceSlider">
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="search-additional-buttons flexbox">
            <button class="more-filter-buttons" id="search-more-filter">More filters</button>
            <button class="more-filter-buttons" id="search-more-filter">Prices</button>
            <p class="search-additional-count"><strong>{{ count($properties) }}</strong> properties found</p>
        </div>

        <div class="search-listing-container flexbox flexbox-wrap justify-between">
            <?php $i = 0 ?>
            @foreach($properties as $property)

            <div class="search-result-box" style="background-image: url(http://loremflickr.com/320/240/architecture/?{{ $i }})">

                <button class="search-result-box-close" onclick="closeActiveBoxes()"><i class="material-icons">close</i></button>

                <div class="search-result-price-box">
                    <p class="search-result-currency">{{ \Session::get('currency') }}</p>
                    <p class="search-result-price">{{ convertCurrency($property->price, $property->currency, \Session::get('currency')) }}</p>
                </div>

                <div class="search-result-bottom">
                    <div class="search-result-title">
                        <p>{{ $property->lang()->title }}</p>
                    </div>

                    <div class="search-result-short-info flexbox flexbox-wrap">
                        <div class="search-result-short-bed"><i class="material-icons">hotel</i>2</div>
                        <div class="search-result-short-location"><i class="material-icons">place</i>Balangan</div>
                        <div class="search-result-short-more">Details</div>

                        <div class="search-result-action-buttons flexbox">
                            <div class="search-result-action-button"><i class="material-icons">mail_outline</i>Enquire</div>
                            <div class="search-result-action-button"><i class="material-icons">star_border</i>Favorite</div>

                            <a href="{{ route('property', ['property' => trans('url.property'), 'term' => implode('/', category_slug($property->categories[0]) ) . '/' . $property->lang()->slug] ) }}" class="search-result-action-button"><i class="material-icons">add</i>Details</a>
                        </div>
                    </div>
                </div>

                <div class="search-result-gallery-buttons" id="result-gallery-prev">
                    <i class="material-icons">chevron_left</i>
                </div>

                <div class="search-result-gallery-buttons" id="result-gallery-next">
                    <i class="material-icons">chevron_right</i>
                </div>
            </div>
            <?php $i++ ?>
            @endforeach
        </div>



    </div>
    <div id="map" class="searchbox-right">

    </div>
    <!--    @include('fragments.pagination', ['paginator' => $properties])-->
</div>

<style>
    footer{
        display: none;
    }

    .zopim{
        display: none;
    }
</style>
@endsection

@section('scripts')

<script>

    $("#priceSlider").ionRangeSlider({
        type: "double",
        min: 0,
        max: 100,
        from: 30,
        to: 70,
        max_interval: 50
    });

    //var url = search?type=gt500k&location=-8.523412,115.2377871&price=200000,2000000&bed=1&bath=3&facilities=gazebo,pool,garden,garage,wifi&build_size=400&land_size=650
    //var type = type = [‘gt500k’, ‘lt500k’, ‘beachfront’, ‘homeretirement’];

    function initMap() {

        var myLatLng = { lat: -8.6898657, lng: 115.1567108 };
        <?php if(isset($_GET['nw_lat'])): ?>
        myLatLng = { lat: (<?= $_GET['nw_lat'] . ' + ' . $_GET['se_lat'] ?>) / 2, lng: (<?= $_GET['nw_lng'] . ' + ' . $_GET['se_lng'] ?>) / 2};
        <?php endif ?>

        // Create a map object and specify the DOM element for display.
        var map = new google.maps.Map(document.getElementById('map'), {
            mapTypeControl: false,
            center: myLatLng,
            scrollwheel: false,
            zoom: 13,
            maxZoom: 15,
            minZoom: 8,
            streetViewControl: false
        });

        @foreach($properties as $property)
        // Create a marker and set its position.
        var marker = new google.maps.Marker({
            map: map,
            position: { lat: {{ $property->map_latitude }}, lng: {{ $property->map_longitude }} },
            title: 'Hello World!'
        });
        @endforeach

        google.maps.event.addListener(map, 'bounds_changed', function() {
            //console.log(map.getBounds());
            //window.location = 'http://kibarer.app/search/villa?lat=' + map.getCenter().lat() + '&lng=' + map.getCenter().lng();
        });

        google.maps.event.addListener(map, 'dragend', function() {

            var newNwLng = map.getBounds().j.R,
                newNwLat = map.getBounds().R.R,
                newSeLng = map.getBounds().j.j,
                newSeLat = map.getBounds().R.j,
                type   = $('input[name="type"]:checked').val();

            //console.log(map.getBounds()); return false;

            history.pushState({}, '', 'http://kibarer.app/search/villa?nw_lat=' + newNwLat + '&nw_lng=' + newNwLng + '&se_lat=' + newSeLat + '&se_lng=' + newSeLng + '&type=' + type);

            newLat = (newNwLat + newSeLat) / 2;
            newLng = (newNwLng + newSeLng) / 2;

            console.log(newLat);
            console.log(newLng);

            /*
            var marker = new google.maps.Marker({
                map: map,
                position: {lat: newLat, lng: newLng},
                title: 'Hello World!'
            });
            */
        });

        $(document).on('change', 'input[name="type"]', function() {

            var newNwLng = map.getBounds().j.R,
                newNwLat = map.getBounds().R.R,
                newSeLng = map.getBounds().j.j,
                newSeLat = map.getBounds().R.j,
                type   = $('input[name="type"]:checked').val();

            history.pushState({}, '', 'http://kibarer.app/search/villa?nw_lat=' + newNwLat + '&nw_lng=' + newNwLng + '&se_lat=' + newSeLat + '&se_lng=' + newSeLng + '&type=' + type);
        });
    }

    $(document).on('click', '.search-result-short-more', function() {

        closeActiveBoxes();

        $(this).closest('.search-result-box').addClass('active');
    });

    function closeActiveBoxes() {

        $('.search-result-box').removeClass('active');
    }
</script>
@endsection
