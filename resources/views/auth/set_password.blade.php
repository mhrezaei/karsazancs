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
                        <h1 class="auth-title">{{ trans('people.commands.set_password') }}</h1>

                        {!! Form::open([
                            'url'	=> '/user/password' ,
                            'method'=> 'post',
                            'class' => 'js',
                            'name' => 'setPasswordForm',
                            'id' => 'setPasswordForm',
                        ]) !!}
                            <div class="field icon right">
                                <input type="password" name="password" id="password" placeholder="{{ trans('validation.attributes.password') }}" class="form-password form-required" error-value="{{ trans('validation.javascript_validation.password') }}" minlength="8" maxlength="32">
                                <div class="icon-lock"></div>
                            </div>
                            <div class="field icon right"> <input type="password" name="password2" id="password2" placeholder="{{ trans('validation.attributes.password2') }}" class="form-required" error-value="{{ trans('validation.javascript_validation.password2') }}" minlength="8" maxlength="32">
                                <div class="icon-lock"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 tar">
                                    {{--<div class="checkbox"> <input id="check-1" type="checkbox" name="remember" value="check"> <label for="check-1">{{ trans('people.commands.remember_me') }}</label> </div>--}}
                                </div>
                            </div>

                            <div class="field mt25"> <button type="submit" class="green block">{{ trans('people.commands.set_password') }}</button> </div>
                        @include('forms.feed')

                        {!! Form::close() !!}
                    </article>
                </section>
            </div>
        </div>
    </div>


@endsection