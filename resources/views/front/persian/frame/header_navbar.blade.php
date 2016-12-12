<nav id="top-bar">
    <div class="container">
        <div class="socials">
            <a href="{{ Setting::get('facebook_account') }}" class="icon-facebook-official"></a>
            <a href="{{ Setting::get('twitter_account') }}" class="icon-twitter"></a>
            <a href="{{ Setting::get('gplus_account') }}" class="icon-google-plus"></a>
            <a href="{{ Setting::get('telegram_account') }}" class="icon-telegram"></a>
            <a href="{{ Setting::get('instagram_account') }}" class="icon-instagram"></a>
        </div>

        <div class="langs">
            <a href="#" class="active simptip-position-bottom simptip-fade" data-tooltip="{{ trans('front.persian') }}">
                <img src="{{ url('/assets/images/images/lang-fa.png') }}" width="21">
            </a>
            <a href="#" class="simptip-position-bottom simptip-fade" data-tooltip="{{ trans('front.english') }}">
                <img src="{{ url('/assets/images/images/images/lang-en.png') }}" width="21">
            </a>
            <a href="#" class="simptip-position-bottom simptip-fade" data-tooltip="{{ trans('front.arabic') }}">
                <img src="{{ url('/assets/images/images/images/lang-ar.png') }}" width="21">
            </a>
        </div>

    </div>
</nav>