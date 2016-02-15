@extends('index_old')
@section('content')

<!-- JUMBO VIDEO -->
<section id="jumbotron">

    <!-- VIDEO -->
    <div id="video-container">
        <video id="video" autoplay="autoplay" loop="loop" muted="muted">
            <source src="{{ asset('assets/video/Alban48s.m4v') }}" type="video/mp4">
            <source src="{{ asset('assets/video/Alban48s.webm') }}" type="video/webm">
        </video>
    </div>

    <div class="wrapper">
        <h2>Your dreams come to live</h2>
        <a class="btn md-button catergorie-btn" data-target="#villa"><i class="material-icons">home</i>Search Villa</a>
        <a class="btn md-button catergorie-btn" data-target="#land"><i class="material-icons">pin_drop</i>Search Land</a>
    </div>

    <a class="pause-btn play" href>
        <i class="show material-icons">pause_circle_outline</i>
        <i class="hide material-icons">play_circle_outline</i>
    </a>

    <!-- CATERGORIES -->
    <div class="categories">

        <div class="wrapper flexbox flexbox-wrap justify-between" id="villa">
            <a href="{{ route('search', ['search' => Lang::get('url')['search'], 'find' => 'investment-under-500000-1-villas']) }}">
                <div class="text-wrapper">
                    <h3>Investment <br> <span>under $500.000</span></h3>
                    <h4>First investment <br><span>8% - 12% NET R.O.I.</span></h4>
                </div>
            </a>
            <a href="{{ route('search', ['search' => Lang::get('url')['search'], 'find' => 'investment-over-500000-2-villas']) }}">
                <div class="text-wrapper">
                    <h3>Investment <br><span>over $500.000</span></h3>
                    <h4>Luxurious <br><span>8% - 12% NET R.O.I. Capital gain</span></h4>
                </div>
            </a>
            <a href="{{ route('search', ['search' => Lang::get('url')['search'], 'find' => 'home-&-retirement-3-villas']) }}">
                <div class="text-wrapper">
                    <h3>Home &amp; <br><span>Retirement</span></h3>
                    <h4>Find here more than 1000 real estate for sale</h4>
                </div>
            </a>
            <a href="{{ route('search', ['search' => Lang::get('url')['search'], 'find' => 'beachfront-properties--4-villas']) }}">
                <div class="text-wrapper">
                    <h3>Beachfront <br><span>Properties</span></h3>
                    <h4>Your tropical Dolce Vita</h4>
                </div>
            </a>
        </div>

        <div class="wrapper flexbox flexbox-wrap justify-between" id="land">
            <a href="{{ route('search', ['search' => Lang::get('url')['search'], 'find' => 'investment-under-500000-1-lands']) }}">
                <div class="text-wrapper">
                    <h3>Investment <br> <span>under $500.000</span></h3>
                    <h4>First investment <br><span>8% - 12% NET R.O.I.</span></h4>
                </div>
            </a>
            <a href="{{ route('search', ['search' => Lang::get('url')['search'], 'find' => 'investment-over-500000-2-lands']) }}">
                <div class="text-wrapper">
                    <h3>Investment <br><span>over $500.000</span></h3>
                    <h4>Luxurious Villas <br><span>8% - 12% NET R.O.I. Capital gain</span></h4>
                </div>
            </a>
            <a href="{{ route('search', ['search' => Lang::get('url')['search'], 'find' => 'home-&-retirement-3-lands']) }}">
                <div class="text-wrapper">
                    <h3>Home &amp; <br><span>Retirement</span></h3>
                    <h4>Find here more than 1000 real estate for sale</h4>
                </div>
            </a>
            <a href="{{ route('search', ['search' => Lang::get('url')['search'], 'find' => 'beachfront-properties--4-lands']) }}">
                <div class="text-wrapper">
                    <h3>Beachfront <br><span>Properties</span></h3>
                    <h4>Your tropical Dolce Vita</h4>
                </div>
            </a>
        </div>

    </div>

</section>

<!-- MAIN CONTAINER -->
<section id="main">

    <!-- LOCATIONS TITLE -->
    <section class="section-title">
        <h3 class="section-title">Locations <br><span>Find your property in the different area of Bali</span></h3>
    </section>

    <!-- LOCATION BOXES -->
    <section class="locations flexbox flexbox-wrap justify-between">
        <div class="double" style="background-image: url('{{ asset('assets/img/seminyak.jpg') }}');">
            <h2>Seminyak</h2>
            <div class="desc flexbox flexbox-wrap justify-center">
                <div>
                    <h4><i class="material-icons">home</i>Villa</h4>
                    <p>
                        <a href="">Investment &lt; $500.000</a>
                        <a href="">Investment &gt; $500.000</a>
                        <a href="">Home &amp; Retirement</a>
                        <a href="">Beach front properties</a>
                        <a href="">Villa for rent</a>
                    </p>
                </div>
                <div>
                    <h4><i class="material-icons">pin_drop</i>Land</h4>
                    <p>
                        <a href="">Investment &lt; $500.000</a>
                        <a href="">Investment &gt; $500.000</a>
                        <a href="">Beach front</a>
                    </p>
                </div>
            </div>
        </div>
        <div style="background-image: url('{{ asset('assets/img/sanur.jpg') }}');">
            <h2>Sanur</h2>
            <div class="desc flexbox flexbox-wrap justify-center">
                <div>
                    <h4><i class="material-icons">home</i>Villa</h4>
                    <p>
                        <a href="">Investment &lt; $500.000</a>
                        <a href="">Investment &gt; $500.000</a>
                        <a href="">Home &amp; Retirement</a>
                        <a href="">Beach front properties</a>
                        <a href="">Villa for rent</a>
                    </p>
                </div>
                <div>
                    <h4><i class="material-icons">pin_drop</i>Land</h4>
                    <p>
                        <a href="">Investment &lt; $500.000</a>
                        <a href="">Investment &gt; $500.000</a>
                        <a href="">Beach front</a>
                    </p>
                </div>
            </div>
        </div>
        <div style="background-image: url('{{ asset('assets/img/canggu.jpg') }}');">
            <h2>Cangu</h2>
            <div class="desc flexbox flexbox-wrap justify-center">
                <div>
                    <h4><i class="material-icons">home</i>Villa</h4>
                    <p>
                        <a href="">Investment &lt; $500.000</a>
                        <a href="">Investment &gt; $500.000</a>
                        <a href="">Home &amp; Retirement</a>
                        <a href="">Beach front properties</a>
                        <a href="">Villa for rent</a>
                    </p>
                </div>
                <div>
                    <h4><i class="material-icons">pin_drop</i>Land</h4>
                    <p>
                        <a href="">Investment &lt; $500.000</a>
                        <a href="">Investment &gt; $500.000</a>
                        <a href="">Beach front</a>
                    </p>
                </div>
            </div>
        </div>
        <div style="background-image: url('{{ asset('assets/img/ubud.jpg') }}');">
            <h2>Ubud</h2>
            <div class="desc flexbox flexbox-wrap justify-center">
                <div>
                    <h4><i class="material-icons">home</i>Villa</h4>
                    <p>
                        <a href="">Investment &lt; $500.000</a>
                        <a href="">Investment &gt; $500.000</a>
                        <a href="">Home &amp; Retirement</a>
                        <a href="">Beach front properties</a>
                        <a href="">Villa for rent</a>
                    </p>
                </div>
                <div>
                    <h4><i class="material-icons">pin_drop</i>Land</h4>
                    <p>
                        <a href="">Investment &lt; $500.000</a>
                        <a href="">Investment &gt; $500.000</a>
                        <a href="">Beach front</a>
                    </p>
                </div>
            </div>
        </div>
        <div style="background-image: url('{{ asset('assets/img/jimbaran.jpg') }}');">
            <h2>Jimbaran</h2>
            <div class="desc flexbox flexbox-wrap justify-center">
                <div>
                    <h4><i class="material-icons">home</i>Villa</h4>
                    <p>
                        <a href="">Investment &lt; $500.000</a>
                        <a href="">Investment &gt; $500.000</a>
                        <a href="">Home &amp; Retirement</a>
                        <a href="">Beach front properties</a>
                        <a href="">Villa for rent</a>
                    </p>
                </div>
                <div>
                    <h4><i class="material-icons">pin_drop</i>Land</h4>
                    <p>
                        <a href="">Investment &lt; $500.000</a>
                        <a href="">Investment &gt; $500.000</a>
                        <a href="">Beach front</a>
                    </p>
                </div>
            </div>
        </div>
        <div style="background-image: url('{{ asset('assets/img/lovina.jpg') }}');">
            <h2>Lovina</h2>
            <div class="desc flexbox flexbox-wrap justify-center">
                <div>
                    <h4><i class="material-icons">home</i>Villa</h4>
                    <p>
                        <a href="">Investment &lt; $500.000</a>
                        <a href="">Investment &gt; $500.000</a>
                        <a href="">Home &amp; Retirement</a>
                        <a href="">Beach front properties</a>
                        <a href="">Villa for rent</a>
                    </p>
                </div>
                <div>
                    <h4><i class="material-icons">pin_drop</i>Land</h4>
                    <p>
                        <a href="">Investment &lt; $500.000</a>
                        <a href="">Investment &gt; $500.000</a>
                        <a href="">Beach front</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="double" style="background-image: url('{{ asset('assets/img/tanahlot.jpg') }}');">
            <h2>Tanah Lot</h2>
            <div class="desc flexbox flexbox-wrap justify-center">
                <div>
                    <h4><i class="material-icons">home</i>Villa</h4>
                    <p>
                        <a href="">Investment &lt; $500.000</a>
                        <a href="">Investment &gt; $500.000</a>
                        <a href="">Home &amp; Retirement</a>
                        <a href="">Beach front properties</a>
                        <a href="">Villa for rent</a>
                    </p>
                </div>
                <div>
                    <h4><i class="material-icons">pin_drop</i>Land</h4>
                    <p>
                        <a href="">Investment &lt; $500.000</a>
                        <a href="">Investment &gt; $500.000</a>
                        <a href="">Beach front</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- BLOG & TESTIMONIALS -->
    <section class="bottom-section flexbox flexbox-wrap justify-between">
        <section class="w66">
            <h3 class="section-title left">Testimonials<br><span>Find your property in the different area of Bali</span></h3>
            <div class="testimonials flexbox flexbox-wrap justify-between">
                <a href="" class="flexbox flexbox-wrap justify-between" style="background-image:url('{{ asset('assets/img/testimonial1.png') }}');">
                    <div class="desc">
                        <h4>More than 10% ROI already</h4>
                        Marilyn S
                        <div class="md-button md-button-outline">Read more</div>
                    </div>
                </a>
                <a href="" class="flexbox flexbox-wrap justify-between" style="background-image:url('{{ asset('assets/img/testimonial2.jpg') }}');">
                    <div class="desc">
                        <h4>More than 10% ROI already</h4>
                        Marilyn S
                        <div class="md-button md-button-outline">Read more</div>
                    </div>
                </a>
                <a href="" class="flexbox flexbox-wrap justify-between"  style="background-image:url('{{ asset('assets/img/testimonial3.jpg') }}');">
                    <div class="desc">
                        <h4>More than 10% ROI already</h4>
                        Marilyn S
                        <div class="md-button md-button-outline">Read more</div>
                    </div>
                </a>
                <a href="" class="flexbox flexbox-wrap justify-between" style="background-image:url('{{ asset('assets/img/testimonial4.png') }}');">
                    <div class="desc">
                        <h4>More than 10% ROI already</h4>
                        Marilyn S
                        <div class="md-button md-button-outline">Read more</div>
                    </div>
                </a>
                <a href="" class="flexbox flexbox-wrap justify-between" style="background-image:url('{{ asset('assets/img/testimonial5.png') }}');">
                    <div class="desc">
                        <h4>More than 10% ROI already</h4>
                        Marilyn S
                        <div class="md-button md-button-outline">Read more</div>
                    </div>
                </a>
                <a href="" class="flexbox flexbox-wrap justify-between" style="background-image:url('{{ asset('assets/img/testimonial6.jpeg') }}');">
                    <div class="desc">
                        <h4>More than 10% ROI already</h4>
                        Marilyn S
                        <div class="md-button md-button-outline">Read more</div>
                    </div>
                </a>
            </div>
        </section>

        <section class="w33">
            <h3 class="section-title left">Blog<br><span>Find your property in the different area of Bali</span></h3>
            <div class="blog flexbox flexbox-wrap justify-between">
                <a href="" style="background-image: url('{{ asset('assets/img/blog1.jpg') }}');">
                    <div class="desc">
                        <h3>Money of Indonesia <br>
                            <span class="date">22 Jan 2016</span>
                        </h3>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eros velit</p>
                        <div class="md-button md-button-outline">Read more</div>
                    </div>
                </a>
                <a href="" style="background-image: url('{{ asset('assets/img/blog2.jpg') }}');">
                    <div class="desc">
                        <h3>Ngurah Rai Airport On High Alert <br>
                            <span class="date">22 Jan 2016</span>
                        </h3>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eros velit</p>
                        <div class="md-button md-button-outline">Read more</div>
                    </div>
                </a>
                <a href="" style="background-image: url('{{ asset('assets/img/blog1.jpg') }}');">
                    <div class="desc">
                        <h3>Amazing Places To Watch The Sunrise In Indonesia <br>
                            <span class="date">22 Jan 2016</span>
                        </h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eros velit</p>
                        <div class="md-button md-button-outline">Read more</div>
                    </div>
                </a>
            </div>
        </section>
    </section>
</section>

@endsection

@section('scripts')
<script>
    Kibarer.home();
</script>
@endsection
