
<header>
    <section id="main" class=" flexbox justify-between">

        <h1 class="logo"><a href="{{ url('/') }}"><img src="{{ asset('assets/img/logo.png') }}" alt="Kibarer Property"></a>Kibarer Property</h1>

        <div class="fullscreen-nav flexbox flex-wrap justify-between">
            <section class="bottom-nav">
                <div class="navbottom">
                    <ul>
                        <li><a href="{{ route('search', ['search' => Lang::get('url')['search'], 'category' => 'villa']) }}">Villas</a></li>
                        <li><a href="{{ route('search', ['search' => Lang::get('url')['search'], 'category' => 'land']) }}">Lands</a></li>
                        <li><a href="{{ route('lawyer_notary', Lang::get('url')['lawyer_notary']) }}">Lawyer &amp; Notary</a></li>
                        <li><a href="{{ route('testimony', Lang::get('url')['testimony']) }}">Testimonials</a></li>
                        <li><a href="{{ route('contact', Lang::get('url')['contact']) }}">Contact</a></li>
                        <li><a href="{{ route('search', ['search' => Lang::get('url')['search']]) }}"><i class="fa fa-search"></i></a></li>
                    </ul>
                </div>

                <span class="title-border"></span>

                <section class="top-nav">
                    <ul>
                        <li><a href="{{ route('sell_property', Lang::get('url')['sell_property']) }}"><i class="material-icons">business</i> Sell my Property</a></li>
                        <li><a href="{{ route('blog', Lang::get('url')['blog']) }}"><i class="material-icons">chat</i> Blog</a></li>
                        <li><a href="{{ route('account', Lang::get('url')['account']) }}"><i class="material-icons">person</i> Account</a></li>
                    </ul>
                </section>

                <span class="title-border"></span>
            </section>

            <section class="lang-cur">
                <div class="flexbox justify-between">
                    <p>Language<br><span>EN</span></p>
                    <div>
                        <i class="material-icons">flag</i>
                        <i class="material-icons">keyboard_arrow_down</i>
                    </div>
                    <ul>
                        <li><a href="{{ url() }}">English</a></li>
                        <li><a href="{{ url('fr') }}">French</a></li>
                        <li><a href="{{ url('id') }}">Indonesian</a></li>
                        <li><a href="{{ url('ru') }}">Russian</a></li>
                    </ul>
                </div>

                <div class="flexbox justify-between">
                    <p>Currency<br><span>USD</span></p>
                    <div>
                        <i class="material-icons">attach_money</i>
                        <i class="material-icons">keyboard_arrow_down</i>
                    </div>
                    <ul>
                        <li><a href="">USD</a></li>
                        <li><a href="">EUR</a></li>
                        <li><a href="">IDR</a></li>
                        <li><a href="">RUB</a></li>
                    </ul>
                </div>
            </section>
        </div>

        <section id="burger-nav">
            <a id="burger" href>
                <span></span>
                <span></span>
            </a>
        </section>
    </section>
</header>
