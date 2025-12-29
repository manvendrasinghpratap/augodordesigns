<x-guest-layout>
    <!-- main-signin-wrapper -->
    <div class="my-auto page page-h">
        <div class="main-signin-wrapper error-wrapper">
            <div class="main-card-signin d-md-flex wd-100p">
                <!-- Left Side Image -->
               <div class="wd-md-50p login d-none d-md-block page-signin-style p-5 text-white per-40">
                    <div class="my-auto authentication-pages">
                        <div>
                            <img src="{{ asset('assets/img/brand/logo.png') }}" class=" m-0 mb-4" alt="logo @lang('translation.webname')">
                            <p class="mb-5 text-center">Welcome to @lang('translation.webname')</p>
                        </div>
                    </div>
                </div>
                <!-- Login Form Slot -->
                <div class="p-5 wd-md-50p per-60">
                    <div class="main-signin-header">
                        <h2>Welcome back!</h2>
                        <h4>Please sign in to continue</h4>
                        <form method="POST" action="{{ route('login') }}" autocomplete="off">
                            @csrf
                            <x-input-field id="email" label="Email" type="email" name="email" value="{{ old('email') }}" placeholder="{{ __('translation.enter_email') }}" autofocus class="form-control" autocomplete="new-email" />
                            <x-input-field id="password" label="Password" type="password" name="password" placeholder="{{ __('translation.enter_password') }}"  autocomplete="new-password"/>
                            <x-primary-button class="ms-3">@lang('translation.login')</x-primary-button>
                        </form>
                    </div>
                    <div class="main-signin-footer mt-3 mg-t-5">
                        <p><a href="{{ route('password.request') }}">Forgot password?</a></p>
                        <p>Don't have an account? <a href="{{ route('register') }}">Create an Account</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

