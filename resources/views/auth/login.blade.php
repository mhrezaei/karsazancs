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
                        <h1 class="auth-title">{{ trans('people.commands.login') }}</h1>

                        {!! Form::open(['url' => url('/login')]) !!}
                            <div class="field icon right"> <input type="text" name="email" placeholder="{{ trans('validation.attributes.email') }}">
                                <div class="icon-mail"></div>
                            </div>
                            <div class="field icon right"> <input type="password" name="password" placeholder="{{ trans('validation.attributes.password') }}">
                                <div class="icon-lock"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 tar">
                                    {{--<div class="checkbox"> <input id="check-1" type="checkbox" name="remember" value="check"> <label for="check-1">{{ trans('people.commands.remember_me') }}</label> </div>--}}
                                    {!! app('captcha')->display($attributes = [], $lang = 'fa') !!}
                                </div>
                            </div>

                        @if($errors->all())
                            <div class="alert alert-danger" style="margin-top: 10px;">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </div>
                        @endif

                            <div class="field mt25"> <button class="green block">{{ trans('people.commands.login_into_site') }}</button> </div>
                        <div class="row">
                            <div class="col-sm-12" style="text-align: center;"> <a href="#" class="simple-link">{{ trans('people.commands.forget_password') }}</a> </div>
                        </div>

                        <div class="more-link"> <span>{{ trans('people.commands.not_a_member') }}</span> <a href="{{ url('/register') }}">{{ trans('people.commands.register_now') }}</a> </div>
                        </form>
                    </article>
                </section>
            </div>
        </div>
    </div>


@endsection