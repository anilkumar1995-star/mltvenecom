{{--  @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection  --}}
{{--  @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection  --}}

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin | Botble Technologies</title>
    <meta name="csrf-token" content="GFkR5VbE4gqD2PeBVLUMg1U78EuvAiPyzmyKxBlc">

    <link href="https://shofy-grocery.botble.com/storage/main/general/favicon.png" rel="icon shortcut"
        type="image/x-icon">
    <meta property="og:image" content="https://shofy-grocery.botble.com/storage/main/general/favicon.png">

    <meta name="description" content="Copyright 2026 © Botble Technologies. Version 1.4.4">
    <meta property="og:description" content="Copyright 2026 © Botble Technologies. Version 1.4.4">



    <style>
        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 300;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma2jl7w0q5n-wu.woff2) format('woff2');
            unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 300;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma0zl7w0q5n-wu.woff2) format('woff2');
            unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 300;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma2zl7w0q5n-wu.woff2) format('woff2');
            unicode-range: U+1F00-1FFF;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 300;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma1pl7w0q5n-wu.woff2) format('woff2');
            unicode-range: U+0370-0377, U+037A-037F, U+0384-038A, U+038C, U+038E-03A1, U+03A3-03FF;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 300;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma2pl7w0q5n-wu.woff2) format('woff2');
            unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+0300-0301, U+0303-0304, U+0308-0309, U+0323, U+0329, U+1EA0-1EF9, U+20AB;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 300;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma25l7w0q5n-wu.woff2) format('woff2');
            unicode-range: U+0100-02AF, U+0304, U+0308, U+0329, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 300;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma1zl7w0q5nw.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma2jl7w0q5n-wu.woff2) format('woff2');
            unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma0zl7w0q5n-wu.woff2) format('woff2');
            unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma2zl7w0q5n-wu.woff2) format('woff2');
            unicode-range: U+1F00-1FFF;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma1pl7w0q5n-wu.woff2) format('woff2');
            unicode-range: U+0370-0377, U+037A-037F, U+0384-038A, U+038C, U+038E-03A1, U+03A3-03FF;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma2pl7w0q5n-wu.woff2) format('woff2');
            unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+0300-0301, U+0303-0304, U+0308-0309, U+0323, U+0329, U+1EA0-1EF9, U+20AB;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma25l7w0q5n-wu.woff2) format('woff2');
            unicode-range: U+0100-02AF, U+0304, U+0308, U+0329, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma1zl7w0q5nw.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 500;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma2jl7w0q5n-wu.woff2) format('woff2');
            unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 500;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma0zl7w0q5n-wu.woff2) format('woff2');
            unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 500;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma2zl7w0q5n-wu.woff2) format('woff2');
            unicode-range: U+1F00-1FFF;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 500;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma1pl7w0q5n-wu.woff2) format('woff2');
            unicode-range: U+0370-0377, U+037A-037F, U+0384-038A, U+038C, U+038E-03A1, U+03A3-03FF;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 500;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma2pl7w0q5n-wu.woff2) format('woff2');
            unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+0300-0301, U+0303-0304, U+0308-0309, U+0323, U+0329, U+1EA0-1EF9, U+20AB;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 500;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma25l7w0q5n-wu.woff2) format('woff2');
            unicode-range: U+0100-02AF, U+0304, U+0308, U+0329, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 500;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma1zl7w0q5nw.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 600;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma2jl7w0q5n-wu.woff2) format('woff2');
            unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 600;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma0zl7w0q5n-wu.woff2) format('woff2');
            unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 600;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma2zl7w0q5n-wu.woff2) format('woff2');
            unicode-range: U+1F00-1FFF;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 600;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma1pl7w0q5n-wu.woff2) format('woff2');
            unicode-range: U+0370-0377, U+037A-037F, U+0384-038A, U+038C, U+038E-03A1, U+03A3-03FF;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 600;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma2pl7w0q5n-wu.woff2) format('woff2');
            unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+0300-0301, U+0303-0304, U+0308-0309, U+0323, U+0329, U+1EA0-1EF9, U+20AB;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 600;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma25l7w0q5n-wu.woff2) format('woff2');
            unicode-range: U+0100-02AF, U+0304, U+0308, U+0329, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 600;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma1zl7w0q5nw.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma2jl7w0q5n-wu.woff2) format('woff2');
            unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma0zl7w0q5n-wu.woff2) format('woff2');
            unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma2zl7w0q5n-wu.woff2) format('woff2');
            unicode-range: U+1F00-1FFF;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma1pl7w0q5n-wu.woff2) format('woff2');
            unicode-range: U+0370-0377, U+037A-037F, U+0384-038A, U+038C, U+038E-03A1, U+03A3-03FF;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma2pl7w0q5n-wu.woff2) format('woff2');
            unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+0300-0301, U+0303-0304, U+0308-0309, U+0323, U+0329, U+1EA0-1EF9, U+20AB;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma25l7w0q5n-wu.woff2) format('woff2');
            unicode-range: U+0100-02AF, U+0304, U+0308, U+0329, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url(https://shofy-grocery.botble.com/storage/fonts/2832c0ff63/sinterv13ucc73fwrk3iltehus-fvqtmwcp50knma1zl7w0q5nw.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }
    </style>
    <style>
        :root {
            --primary-font: "Inter";
            --primary-color: #206bc4;
            --primary-color-rgb: 32, 107, 196;
            --secondary-color: #6c7a91;
            --secondary-color-rgb: 108, 122, 145;
            --heading-color: inherit;
            --text-color: #182433;
            --text-color-rgb: 24, 36, 51;
            --link-color: #206bc4;
            --link-color-rgb: 32, 107, 196;
            --link-hover-color: #206bc4;
            --link-hover-color-rgb: 32, 107, 196;
        }
    </style>

    <link media="all" type="text/css" rel="stylesheet"
        href="https://shofy-grocery.botble.com/vendor/core/core/base/css/core.css?v=1.4.4">
    <link media="all" type="text/css" rel="stylesheet"
        href="https://shofy-grocery.botble.com/vendor/core/plugins/language/css/language.css?v=1.4.4">

    <script src="https://shofy-grocery.botble.com/vendor/core/core/base/libraries/jquery.min.js?v=1.4.4"></script>
    <script src="https://shofy-grocery.botble.com/vendor/core/core/base/libraries/jquery-compat/jquery4-compat.js?v=1.4.4">
    </script>
    <script src="https://shofy-grocery.botble.com/vendor/core/core/base/js/app.js?v=1.4.4"></script>
    <script>
        window.siteUrl = "https://shofy-grocery.botble.com";
    </script>
</head>

<body class="page-sidebar-closed-hide-logo page-content-white page-container-bg-solid " style=""
    data-bs-theme="dark">
    <div id="app">
        <main class="row g-0 flex-fill vh-100">
            <div
                class="col-12 col-lg-6 col-xl-4 border-top-wide border-primary d-flex flex-column justify-content-center">
                <div class="container container-tight my-5 px-lg-5">
                    <div class="text-center mb-4">
                        <a href="https://shofy-grocery.botble.com/admin">
                            <img src="https://shofy-grocery.botble.com/storage/main/general/logo-white.png"
                                style="max-height: 50px; height: auto;" alt="Botble Technologies"
                                class="navbar-brand-image">
                        </a>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-body">
                            <h2 class="h3 text-center mb-3">Sign In Below</h2>
                            <div class="mb-3 position-relative">
                                <label class="form-label form-label required" for="username">
                                    Email/Username
                                </label>
                                <input class="form-control" tabindex="1"
                                    placeholder="Enter your username or email address" required="required"
                                    name="email" type="text" value="admin" id="username">
                            </div>
                            <div class="mb-3 position-relative">
                                <label class="form-label form-label required" for="password">
                                    Password
                                    <span class="form-label-description">
                                        <a href="{{ route('password.request') }}" tabindex="5"
                                            title="Forgot Password">Lost your password?</a>
                                    </span>
                                </label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password" class="form-control"
                                        tabindex="2" placeholder="Enter your password" required="required"
                                        data-bb-password>
                                    <span class="input-password-toggle" data-bb-toggle-password>
                                        <svg class="icon svg-icon-ti-ti-eye" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path
                                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                        </svg>
                                    </span>
                                </div>
                            </div>

                            <style>
                                .input-password-toggle {
                                    position: absolute;
                                    right: 0;
                                    top: 0;
                                    cursor: pointer;
                                    padding: 10px 15px;
                                    z-index: 9;
                                    height: 100%;
                                    display: inline-flex;
                                    align-items: center;
                                }

                                input[data-bb-password]:valid,
                                input[data-bb-password].is-valid {
                                    background-image: unset;
                                }

                                body[dir="rtl"] .input-password-toggle {
                                    right: unset;
                                    left: 0;
                                }
                            </style>

                            <script>
                                (function() {
                                    if (window.bbPasswordToggleInitialized) {
                                        return;
                                    }

                                    window.bbPasswordToggleInitialized = true;

                                    function initPasswordToggles() {
                                        document.querySelectorAll('[data-bb-toggle-password]').forEach(function(button) {
                                            if (button.dataset.initialized === 'true') {
                                                return;
                                            }

                                            button.dataset.initialized = 'true';

                                            button.addEventListener('click', function(e) {
                                                e.preventDefault();
                                                e.stopPropagation();

                                                const inputGroup = this.closest('.input-group');
                                                const passwordField = inputGroup ? inputGroup.querySelector(
                                                    '[data-bb-password]') : null;

                                                if (!passwordField) {
                                                    console.warn('Password field not found for toggle button');
                                                    return;
                                                }

                                                if (passwordField.getAttribute('type') === 'password') {
                                                    passwordField.setAttribute('type', 'text');
                                                    this.innerHTML = `<svg class="icon svg-icon-ti-ti-eye-off"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="24"
                                                        height="24"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        >
                                                        <path d="M10.585 10.587a2 2 0 0 0 2.829 2.828" />
                                                        <path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87" />
                                                        <path d="M3 3l18 18" />
                                                        </svg>`;
                                                } else {
                                                    passwordField.setAttribute('type', 'password');
                                                    this.innerHTML = `<svg class="icon svg-icon-ti-ti-eye"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="24"
                                                        height="24"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        >
                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                        <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                        </svg>`;
                                                }
                                            });
                                        });
                                    }

                                    if (document.readyState === 'loading') {
                                        document.addEventListener('DOMContentLoaded', initPasswordToggles);
                                    } else {
                                        initPasswordToggles();
                                    }
                                })();
                            </script>
                            <label class="form-check">
                                <input type="checkbox" id="remember" name="remember" class="form-check-input"
                                    tabindex="3" value="1" checked>
                                <span class="form-check-label">
                                    Remember me?
                                </span>
                            </label>
                            <div class="form-footer">
                                <button class="btn btn-primary  w-full" type="submit">
                                    <svg class="icon icon-left svg-icon-ti-ti-login-2"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path
                                            d="M9 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
                                        <path d="M3 12h13l-3 -3" />
                                        <path d="M13 15l3 -3" />
                                    </svg>
                                    Sign in
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="position-relative col-12 col-lg-6 col-xl-8 d-none d-lg-block">
                <div class="bg-cover bg-white h-100 min-vh-100"
                    style="background-image: url(https://shofy-grocery.botble.com/vendor/core/core/acl/images/backgrounds/10.jpg)">
                </div>
                <div class="end-0 bottom-0 position-absolute">
                    <div class="text-white me-5 mb-4">
                        <h1 class="mb-1">Botble Technologies</h1>
                        <p>Copyright 2026 © Botble Technologies. Version <span class="fw-medium">1.4.4</span>
                        </p>
                    </div>
                </div>
            </div>
        </main>
    </div>


    <script src="https://shofy-grocery.botble.com/vendor/core/core/base/js/core-ui.js?v=1.4.4"></script>
    <script src="https://shofy-grocery.botble.com/vendor/core/core/base/libraries/flatpickr/flatpickr.min.js?v=1.4.4">
    </script>
    <script src="https://shofy-grocery.botble.com/vendor/core/core/base/js/core.js?v=1.4.4"></script>
    <script
        src="https://shofy-grocery.botble.com/vendor/core/core/base/libraries/mcustom-scrollbar/jquery.mCustomScrollbar.js?v=1.4.4">
    </script>
    <script src="https://shofy-grocery.botble.com/vendor/core/core/base/libraries/fslightbox.js?v=1.4.4"></script>
    <script src="https://shofy-grocery.botble.com/vendor/core/core/js-validation/js/js-validation.js?v=1.4.4"></script>
    <script
        src="https://shofy-grocery.botble.com/vendor/core/core/base/libraries/jquery.are-you-sure/jquery.are-you-sure.js?v=1.4.4">
    </script>
    <script src="https://shofy-grocery.botble.com/vendor/core/plugins/language/js/language-global.js?v=1.4.4"></script>

</body>

</html>
