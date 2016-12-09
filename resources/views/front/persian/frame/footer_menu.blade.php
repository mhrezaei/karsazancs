<a href="{{ url('/') }}" id="foot-logo"><img src="{{ url('/' . Setting::get('site_logo_bw')) }}" width="150"></a>
<div class="simple-links">
    <a href="{{ url('/contact') }}"> {{ trans('front.contact_us') }}</a>
    <a href="{{ url('/pages/about_page') }}"> {{ trans('front.about') }}</a>
    <a href="{{ url('/pages/privacy') }}">{{ trans('front.privacy') }}</a>
    <a href="{{ url('/faq') }}"> {{ trans('front.faq') }} </a>
</div>