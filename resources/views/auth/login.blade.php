@extends('dashboard._layouts._app')

@section('content')
    {{-- Background container --}}
    <section class="material-half-bg">
        <div class="cover"></div>
    </section>
    {{-- Login container --}}
    <section class="login-content">
        {{-- Logo container --}}
        <div class="logo">
            <h1>{{ config('app.name') }}</h1>
        </div>
        <div class="login-box">
            {{-- Login form --}}
            <form method="post" class="login-form" action="{{ route('login') }}">
                @csrf
                <h3 class="login-head">{!! icon('user-alt', trans('auth.login')) !!}</h3>

                <div class="form-group">
                    <label class="control-label">@lang('auth.email')</label>
                    <input name="email" class="form-control" type="text" autofocus required="required">
                </div>
                <div class="form-group">
                    <label class="control-label">@lang('auth.password')</label>
                    <input name="password" class="form-control" type="password" required="required">
                </div>
                <div class="form-group btn-container">
                    <button class="btn btn-primary btn-block">{!! icon('login', trans('buttons.access')) !!}</button>
                </div>
                <div class="form-group my-3 text-center">
                    <p class="semibold-text mb-2"><a href="#" data-toggle="flip">@lang('auth.forgot')</a></p>
                </div>
            </form>
            {{-- Recovering form --}}
            <form method="post" class="forget-form" action="{{ route('password.email') }}">
                @csrf
                <h3 class="login-head">{!! icon('alert', trans('auth.forgot')) !!}</h3>
                <div class="form-group">
                    <label class="control-label">@lang('auth.email')</label>
                    <input name="email" class="form-control" type="text" required="required">
                </div>
                <div class="form-group btn-container">
                    <button class="btn btn-primary btn-block">{!! icon('password', trans('buttons.reset')) !!}</button>
                </div>
                <div class="form-group text-center">
                    <p class="semibold-text mb-0"><a href="#" data-toggle="flip">{!! trans('buttons.back') !!}</a></p>
                </div>
            </form>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm text-center">
                    <div>Agroepso es un proyecto para el impulso tecnológico del sector agrícola, desarrollado por la <a href="https://www.umh.es" target="_black">UMH</a></div>
                    <div>El proyecto se encuentra en beta privada (y en una primara etapa de desarrollo)</div>
                    <div>El acceso a la aplicación y su utilización, está solo permitido a los desarrolladores y programadores del mismo</div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('javascript')
    <script type="text/javascript">
        // Login Page Flipbox control
        $('.login-content [data-toggle="flip"]').click(function() {
            $('.login-box').toggleClass('flipped');
            return false;
        });
    </script>
@endsection

@section('modal')
    {{-- Messages --}}
    <div class="my5">@include(component_path('messages'))</div>
@endsection
