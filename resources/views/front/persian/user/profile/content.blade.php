<div class="page-bg">
    <div class="user-dashboard mt50">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <section class="panel user-info">
                        <article>
                            <div class="avatar"><img src="{{ url('/assets/images/avatar.png') }}" width="96"></div>
                            <h1 class="user-name"> {{ $user->name_first . ' ' . $user->name_last}} </h1>
                            <hr>
                            <?php
                                $order_count = count($user->orders());
                            ?>
                            <h2 class="order-count"> @pd($order_count) <small>سفارش</small> </h2> </article>
                    </section>
                </div>
                <div class="col-sm-9">
                    <div class="row">
                        @if($user->status == 2)
                            <div class="alert compact alt icon-bell orange">
                                <p> {{ trans('front.alert_for_verify_email') }} </p>
                            </div>
                        @endif
                        @if(strlen($user->code_melli) != 10)
                            <div class="alert compact alt icon-bell red">
                                <p> {{ trans('front.profile_not_completed_one') }} <a href="{{ url('/user/edit') }}">{{ trans('front.profile_not_completed_two') }}</a> </p>
                            </div>
                        @endif
                        <div class="col-sm-3">
                            <section class="panel dashboard-item blue">
                                <a href="#"> <span class="icon-cart"></span>
                                    <div class="title"> سفارشات </div>
                                </a>
                            </section>
                        </div>
                        <div class="col-sm-3">
                            <section class="panel dashboard-item blue">
                                <a href="#"> <span class="icon-money"></span>
                                    <div class="title"> تراکنش‌ها </div>
                                </a>
                            </section>
                        </div>
                        <div class="col-sm-3">
                            <section class="panel dashboard-item blue">
                                <a href="#"> <span class="icon-add"></span>
                                    <div class="title"> افزودن تیکت </div>
                                </a>
                            </section>
                        </div>
                        <div class="col-sm-3">
                            <section class="panel dashboard-item blue">
                                <a href="#"> <span class="icon-setting"></span>
                                    <div class="title"> تنظیمات </div>
                                </a>
                            </section>
                        </div>
                    </div>
                    <section class="panel">
                        <header>
                            <div class="title"> تازه‌ترین تیکت‌ها </div>
                            <div class="functions"> <button class="blue xs"> همه‌ی تیکت‌ها </button> </div>
                        </header>
                        <article class="ticket-items">
                            <div class="ticket-item">
                                <div class="col-1"><a href="#">سوال در مورد کارت‌های ۵۰ دلاری</a> </div>
                                <div class="col-2">
                                    <div class="label green">بسته شده</div>
                                </div>
                            </div>
                            <div class="ticket-item">
                                <div class="col-1"><a href="#">سوال در مورد کارت‌های ۵۰ دلاری</a> </div>
                                <div class="col-2">
                                    <div class="label red">بسته شده</div>
                                </div>
                            </div>
                            <div class="ticket-item">
                                <div class="col-1"><a href="#">سوال در مورد کارت‌های ۵۰ دلاری</a> </div>
                                <div class="col-2">
                                    <div class="label orange">بسته شده</div>
                                </div>
                            </div>
                            <div class="ticket-item">
                                <div class="col-1"><a href="#">سوال در مورد کارت‌های ۵۰ دلاری</a> </div>
                                <div class="col-2">
                                    <div class="label gray">بسته شده</div>
                                </div>
                            </div>
                            <div class="ticket-item">
                                <div class="col-1"><a href="#">سوال در مورد کارت‌های ۵۰ دلاری</a> </div>
                                <div class="col-2">
                                    <div class="label teal">بسته شده</div>
                                </div>
                            </div>
                        </article>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>