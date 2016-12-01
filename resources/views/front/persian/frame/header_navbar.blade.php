<nav id="top-bar">
    <div class="container">
        <div class="socials">
            <a href="{{ App\Providers\SettingServiceProvider::get('facebook_account') }}" class="icon-fb"></a>
            <a href="{{ App\Providers\SettingServiceProvider::get('twitter_account') }}" class="icon-tw"></a>
            <a href="{{ App\Providers\SettingServiceProvider::get('gplus_account') }}" class="icon-gp"></a>
            <a href="{{ App\Providers\SettingServiceProvider::get('telegram_account') }}" class="icon-tl"></a>
            <a href="{{ App\Providers\SettingServiceProvider::get('instagram_account') }}" class="icon-in"></a>
        </div>
    </div>
</nav>