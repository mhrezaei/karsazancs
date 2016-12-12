<div class="page-bg">
    <div class="part-title"> {{ trans('front.contact_us') }} </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-center">
                <div class="page-content">
                    <div class="page-content contact">
                        <section class="panel">
                            <article>
                                <p>
                                    <span class="icon-map-marker"></span>
                                    {{ trans('front.address') }}: {{ Setting::get(Setting::getLocale() . '-address') }}
                                </p>
                                <p>
                                    <span class="icon-phone"></span>
                                    {{ trans('front.phone') }}: {{ Setting::get(Setting::getLocale() . '-phone') }}
                                </p>
                                <p>
                                    <span class="icon-fax"></span>
                                    {{ trans('front.fax') }}: {{ Setting::get(Setting::getLocale() . '-fax') }}
                                </p>
                                <p>
                                    <span class="icon-envelope-open"></span>
                                    {{ trans('front.email') }}: {{ Setting::get(Setting::getLocale() . '-email') }}
                                </p>
                            </article>
                        </section>
                        <section class="panel">
                            <article>
                                <form action="#">
                                    <div class="row mb20">
                                        <div class="col-sm-4">
                                            <div class="field"> <label> {{ trans('front.name') }} </label> <input type="text"> </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="field"> <label> {{ trans('front.email') }} </label> <input type="text"> </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="field"> <label> {{ trans('front.mobile') }} </label> <input type="text"> </div>
                                        </div>
                                    </div>
                                    <div class="field"> <label> {{ trans('front.your_message') }} </label> <textarea name="" id="" cols="30" rows="3"></textarea> </div>
                                    <div class="tal"> <button class="blue ticket-submit"> {{ trans('front.send') }} </button> </div>
                                </form>
                            </article>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>