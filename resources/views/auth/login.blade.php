@extends('auth.layout')

@section('page_title' , trans('people.commands.login'))

@section('content')

    <div class="page-bg">
        <div class="container">
            <div class="col-sm-4 col-center">
                <section class="panel auth-content">
                    <article>
                        <h1 class="auth-title">{{ trans('people.commands.login') }}</h1>

                        @if($errors->all())
                            <div class="authform-error">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif

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
                                </div>
                                <div class="col-sm-6 tal"> <a href="#" class="simple-link">{{ trans('people.commands.forget_password') }}</a> </div>
                            </div>
                            <div class="field mt25"> <button class="green block">{{ trans('people.commands.login_into_site') }}</button> </div>

                        <div class="more-link"> <span>{{ trans('people.commands.not_a_member') }}</span> <a href="#">{{ trans('people.commands.register_now') }}</a> </div>
                        </form>
                    </article>
                </section>
            </div>
        </div>
    </div>


@endsection