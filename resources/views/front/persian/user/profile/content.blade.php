<div class="page-bg">
    <div class="user-dashboard mt50">
        <div class="container">
            <div class="row">
                @include('front.persian.user.frame.user_right_side_panel')
                <div class="col-sm-9">
                    <div class="row">
                        @if($user->status == 2)
                            <div class="alert compact alt icon-bell orange">
                                <p> {{ trans('front.alert_for_verify_email') }} </p>
                            </div>
                        @endif
                        @if(strlen($user->code_melli) != 10)
                            <div class="alert alt icon-bell red">
                                <p> {{ trans('front.profile_not_completed_one') }} <a href="{{ url('/user/edit') }}">{{ trans('front.profile_not_completed_two') }}</a> </p>
                            </div>
                        @endif

                        @include('front.persian.user.profile.middle_menu')
                    </div>
                        @include('front.persian.user.profile.quick_ticket')
                </div>
            </div>
        </div>
    </div>
</div>