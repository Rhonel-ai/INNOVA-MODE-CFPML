@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ $email ?? old('email') }}" required autocomplete="email"
                                    autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('ResPassword') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection



<!DOCTYPE html>
<html lang="en" data-theme="light" data-sidebar-behaviour="fixed" data-navigation-color="inverted" data-is-fluid="true">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="Webinning" name="author">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/theme.bundle.css') }}" id="stylesheetLTR">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/theme.rtl.bundle.css') }}" id="stylesheetRTL">

    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link rel="preload" as="style"
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&amp;display=swap">
    <link rel="stylesheet" media="print" onload="this.onload=null;this.removeAttribute('media');"
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&amp;display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- no-JS fallback -->
    <noscript>
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&amp;display=swap">
    </noscript>

    <script>
    // Theme switcher

    let themeSwitcher = document.getElementById('themeSwitcher');

    const getPreferredTheme = () => {
        if (localStorage.getItem('theme') != null) {
            return localStorage.getItem('theme');
        }

        return document.documentElement.dataset.theme;
    };

    const setTheme = function(theme) {
        if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.dataset.theme = window.matchMedia('(prefers-color-scheme: dark)').matches ?
                'dark' : 'light';
        } else {
            document.documentElement.dataset.theme = theme;
        }

        localStorage.setItem('theme', theme);
    };

    const showActiveTheme = theme => {
        const activeBtn = document.querySelector(`[data-theme-value="${theme}"]`);

        document.querySelectorAll('[data-theme-value]').forEach(element => {
            element.classList.remove('active');
        });

        activeBtn && activeBtn.classList.add('active');

        // Set button if demo mode is enabled
        document.querySelectorAll('[data-theme-control="theme"]').forEach(element => {
            if (element.value == theme) {
                element.checked = true;
            }
        });
    };

    function reloadPage() {
        window.location = window.location.pathname;
    }


    setTheme(getPreferredTheme());

    if (typeof themeSwitcher != 'undefined') {
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
            if (localStorage.getItem('theme') != null) {
                if (localStorage.getItem('theme') == 'auto') {
                    reloadPage();
                }
            }
        });

        window.addEventListener('load', () => {
            showActiveTheme(getPreferredTheme());

            document.querySelectorAll('[data-theme-value]').forEach(element => {
                element.addEventListener('click', () => {
                    const theme = element.getAttribute('data-theme-value');

                    localStorage.setItem('theme', theme);
                    reloadPage();
                })
            })
        });
    }
    </script>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('admin/assets/favicon/favicon.ico') }}" sizes="any">

    <!-- Demo script -->
    <script>
    var themeConfig = {
        theme: JSON.parse('"light"'),
        isRTL: JSON.parse('false'),
        isFluid: JSON.parse('true'),
        sidebarBehaviour: JSON.parse('"fixed"'),
        navigationColor: JSON.parse('"inverted"')
    };

    var isRTL = localStorage.getItem('isRTL') === 'true',
        isFluid = localStorage.getItem('isFluid') === 'true',
        theme = localStorage.getItem('theme'),
        sidebarSizing = localStorage.getItem('sidebarSizing'),
        linkLTR = document.getElementById('stylesheetLTR'),
        linkRTL = document.getElementById('stylesheetRTL'),
        html = document.documentElement;

    if (isRTL) {
        linkLTR.setAttribute('disabled', '');
        linkRTL.removeAttribute('disabled');
        html.setAttribute('dir', 'rtl');
    } else {
        linkRTL.setAttribute('disabled', '');
        linkLTR.removeAttribute('disabled');
        html.removeAttribute('dir');
    }
    </script>

    <!-- Page Title -->
</head>

<body>

    <!-- THEME CONFIGURATION -->
    <script>
    let themeAttrs = document.documentElement.dataset;

    for (let attr in themeAttrs) {
        if (localStorage.getItem(attr) != null) {
            document.documentElement.dataset[attr] = localStorage.getItem(attr);

            if (theme === 'auto') {
                document.documentElement.dataset.theme = window.matchMedia('(prefers-color-scheme: dark)').matches ?
                    'dark' : 'light';

                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
                    e.matches ? document.documentElement.dataset.theme = 'dark' : document.documentElement
                        .dataset.theme = 'light';
                });
            }
        }
    }
    </script>

    <main class="container-fluid">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-7 col-lg-6 px-lg-4 px-xl-8 d-flex flex-column vh-100 py-6">

                <!-- Brand -->
                <a class="navbar-brand mb-auto" href="index-1.html">
                    <img src="{{ asset('admin/assets/images/logo-1.svg') }}"
                        class="navbar-brand-img logo-light logo-large" alt="..." width="125" height="25">
                    <img src="{{ asset('admin/assets/images/logo-dark-1.svg') }}"
                        class="navbar-brand-img logo-dark logo-large" alt="..." width="125" height="25">
                </a>

                <div>
                    <!-- Title -->
                    <h1 class="mb-2">
                        Reset password
                    </h1>
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ $email ?? old('email') }}" required autocomplete="email"
                                    autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('ResPassword') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>

                <div class="mt-auto">

                    <!-- Link -->
                    <small class="mb-0 text-body-secondary">
                        <!-- Don't have an account yet? <a href="{{ route('register') }}" class="fw-semibold"> Sign up </a> -->

                        You have an account yet? <a href="{{ route('login') }}" class="fw-semibold"> login </a>
                    </small>

                </div>

            </div>

            <div class="col-md-5 col-lg-6 d-none d-lg-block">

                <!-- Image -->
                <div class="bg-size-cover bg-position-center bg-repeat-no-repeat overlay overlay-dark overlay-50 vh-100 me-n4"
                    style="background-image: url({{asset('admin/assets/images/covers/reset-password-cover-1.jpeg')}})">
                </div>
            </div>
        </div> <!-- / .row -->
    </main> <!-- / main -->
    <script src="{{ asset('admin/assets/js/theme.bundle-1.js') }}">
    </script>

</body>

</html>