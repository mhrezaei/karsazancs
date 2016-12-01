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
                        @include('auth.frame.input',[
                            'field' => 'name_first',
                            'class' => 'form-required form-persian',
                            'icon' => 'icon-user',

                        ])

                        @include('auth.frame.input',[
                            'field' => 'name_last',
                            'class' => 'form-required form-persian',
                            'icon' => 'icon-user',

                        ])

                        @include('auth.frame.input',[
                            'field' => 'email',
                            'class' => 'form-required form-email',
                            'icon' => 'icon-mail',

                        ])

                        @include('auth.frame.input',[
                            'field' => 'mobile',
                            'class' => 'form-required form-mobile',
                            'icon' => 'icon-earphone',

                        ])

                            <div class="field">
                                <div class="checkbox"> <input id="check-1" type="checkbox" name="field" value="check"> <label for="check-1"> <a style="color: #BBBBBB; font-size: 13px;" target="_blank" href="{{ url('/pages/term_of_service') }}">{{ trans('front.term_of_service') }}</a> </label> </div>
                            </div>
                            <div class="field mt25"> <button class="green block" type="submit"> ثبت‌نام </button> </div>
                        @include('forms.feed')
                            <div class="more-link"> <span> عضو سایت هستید؟ </span> <a href="#"> وارد شوید </a> </div>
                        {!! Form::close() !!}
                    </article>
                </section>
            </div>
        </div>
    </div>
@endsection