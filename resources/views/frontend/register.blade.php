@extends('frontend.layout')


@section('content')


    <!--   hero area start    -->
    <div class="login-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="login-content">
                        @if (Session::has('sendmail'))
                            <div class="alert alert-success mb-4">
                                <p style="line-height: 24px;">{{ Session::get('sendmail') }}</p>
                            </div>
                        @endif
                        <div class="login-title text-center">
                            <h3 class="title text-uppercase">{{ __('Register') }}</h3>
                        </div>

                        <form action="{{ route('user-register-submit') }}" method="POST">@csrf
                            <div class="input-box">
                                <span class="text-uppercase">{{ __('Username') }}  <span class="text-danger">*</span></span>
                                <input type="text" name="username" value="{{ Request::old('username') }}">
                                @if ($errors->has('username'))
                                    <p class="text-danger mb-0 mt-2">{{ $errors->first('username') }}</p>
                                @endif
                            </div>
                            <div class="input-box">
                                <span class="text-uppercase">{{ __('Email address') }}  <span class="text-danger">*</span></span>
                                <input type="email" name="email" value="{{ Request::old('email') }}">
                                @if ($errors->has('email'))
                                    <p class="text-danger mb-0 mt-2">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                            <div class="input-box">
                                <span class="text-uppercase">{{ __('Password') }}  <span class="text-danger">*</span></span>
                                <input type="password" name="password" value="{{ Request::old('password') }}">
                                @if ($errors->has('password'))
                                    <p class="text-danger mb-0 mt-2">{{ $errors->first('password') }}</p>
                                @endif
                            </div>
                            <div class="input-box mb-4">
                                <span class="text-uppercase">{{ __('Confirmation Password') }}  <span class="text-danger">*</span></span>
                                <input type="password" name="password_confirmation"
                                    value="{{ Request::old('password_confirmation') }}">
                                @if ($errors->has('password_confirmation'))
                                    <p class="text-danger mb-0 mt-2">{{ $errors->first('password_confirmation') }}</p>
                                @endif
                            </div>

                            <div class="input-btn">
                                <button type="submit" class="get-ticket-btn class="text-uppercase"">{{ __('Register') }}</button>
                                <p>{{ __('Already have an account ?') }} <a class="mr-3"
                                        href="{{ route('user.login') }}">{{ __('Click Here') }}</a> {{ __('to login') }}.
                                </p>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--   hero area end    -->
@endsection
