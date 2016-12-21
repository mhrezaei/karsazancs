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
            @if(Setting::getLocale() == 'fa')
                <a href="{{ Setting::getUrl('fa') }}" class="active simptip-position-bottom simptip-fade" data-tooltip="{{ trans('front.persian') }}"><img src="{{ url('/assets/images/lang-fa.png') }}" width="21"></a>
                <a href="{{ Setting::getUrl('en') }}" class="simptip-position-bottom simptip-fade" data-tooltip="{{ trans('front.english') }}"><img src="{{ url('/assets/images/lang-en.png') }}" width="21"></a>
{{--                <a href="{{ Setting::getUrl('ar') }}" class="simptip-position-bottom simptip-fade" data-tooltip="{{ trans('front.arabic') }}"><img src="{{ url('/assets/images/lang-ar.png') }}" width="21"></a>--}}
            @elseif(Setting::getLocale() == 'en')
                <a href="{{ Setting::getUrl('fa') }}" class="simptip-position-bottom simptip-fade" data-tooltip="{{ trans('front.persian') }}"><img src="{{ url('/assets/images/lang-fa.png') }}" width="21"></a>
                <a href="{{ Setting::getUrl('en') }}" class="active simptip-position-bottom simptip-fade" data-tooltip="{{ trans('front.english') }}"><img src="{{ url('/assets/images/lang-en.png') }}" width="21"></a>
{{--                <a href="{{ Setting::getUrl('ar') }}" class="simptip-position-bottom simptip-fade" data-tooltip="{{ trans('front.arabic') }}"><img src="{{ url('/assets/images/lang-ar.png') }}" width="21"></a>--}}
            @elseif(Setting::getLocale() == 'ar')
                <a href="{{ Setting::getUrl('fa') }}" class="simptip-position-bottom simptip-fade" data-tooltip="{{ trans('front.persian') }}"><img src="{{ url('/assets/images/lang-fa.png') }}" width="21"></a>
                <a href="{{ Setting::getUrl('en') }}" class="simptip-position-bottom simptip-fade" data-tooltip="{{ trans('front.english') }}"><img src="{{ url('/assets/images/lang-en.png') }}" width="21"></a>
                <a href="{{ Setting::getUrl('ar') }}" class="active simptip-position-bottom simptip-fade" data-tooltip="{{ trans('front.arabic') }}"><img src="{{ url('/assets/images/lang-ar.png') }}" width="21"></a>
            @endif
        </div>
    </div>
</nav>