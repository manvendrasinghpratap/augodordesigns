<x-guest-layout>
    <!-- main-signin-wrapper -->
    <div class="my-auto page page-h">
        <div class="main-signin-wrapper error-wrapper">
            <div class="main-card-signin d-md-flex wd-100p">
                <!-- Left Side Image -->
               <div class="wd-md-50p login d-none d-md-block page-signin-style p-5 text-white">
                    <div class="my-auto authentication-pages">
                        <div>
                            <img src="{{ asset('assets/img/brand/logo.png') }}" class=" m-0 mb-4" alt="logo @lang('translation.webname')">
                            <p class="mb-1 text-center">Welcome to @lang('translation.webname')</p>
                            <p class="mb-2 text-center">
                                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Login Form Slot -->

                <div class="p-5 wd-md-50p">
                    <div class="main-signin-header">

                        <h2>Forgot your password?</h2>
                        {{-- <h4>Please sign in to continue</h4> --}}
                         <p class="mb-0 text-center">
                                {{ __('Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                            </p>
                        <x-auth-session-status class="mb-4" :status="session('status')" />
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <!-- Email Address -->
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button>
                                    {{ __('Email Password Reset Link') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                    <div class="main-signin-footer mt-3 mg-t-5">
                        <p>Already have an account?<x-href-input name="login" label="Sign In"  href="{{ route('login') }}" class="btn- btn-secondary- error changepassword" /></p>
                        <p>Don't have an account? <a href="{{ route('register') }}">@lang('translation.create_an_account')</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>


