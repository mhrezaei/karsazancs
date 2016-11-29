@extends('auth.frame.frame')

@section('page_title')
    {{ trans('front.site_title') }} | {{ trans('front.register') }}
@endsection
@section('content')
    <div class="page-bg">
        <div class="container">
            <div class="col-sm-4 col-center">
                <section class="panel auth-content">
                    <article>
                        <h1 class="auth-title"> {{ trans('front.register') }} </h1>
                        {!! Form::open([
                            'url'	=> '/register' ,
                            'method'=> 'post',
                            'class' => 'js',
                            'name' => 'registerForm',
                            'id' => 'registerForm',
                        ]) !!}
                            <div class="field icon right">
                                <input type="text" placeholder="نام" class="">
                                <div class="icon-user"></div>
                            </div>
                            <div class="field icon right"> <input type="text" placeholder="ایمیل">
                                <div class="icon-mail"></div>
                            </div>
                            <div class="field icon right"> <input type="password" placeholder="پسورد">
                                <div class="icon-lock"></div>
                            </div>
                            <div class="field">
                                <div class="checkbox"> <input id="check-1" type="checkbox" name="field" value="check"> <label for="check-1"> شرایط و قوانین سایت را می‌پذیرم </label> </div>
                            </div>
                            <div class="field mt25"> <button class="green block" type="button"> ثبت‌نام </button> </div>
                        @include('forms.feed')
                            <div class="more-link"> <span> عضو سایت هستید؟ </span> <a href="#"> وارد شوید </a> </div>
                        {!! Form::close() !!}
                    </article>
                </section>
            </div>
        </div>
    </div>
@endsection