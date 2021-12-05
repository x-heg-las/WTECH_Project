@extends('layout.app')
    @section('title')
    <title>Login</title>
    @endsection
    @section('content')

            <div class="offset-4 col-4 ">     
    
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
    
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
                <form method="POST" action="{{ route('login') }}">
                    @csrf
    
                    <div class="d-flex text-center flex-column">
                        <!-- Email Address -->
                        <div>
                            <x-label class="row" for="email" :value="__('Email')" />
        
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                        </div>
        
                        <!-- Password -->
                        <div class="mt-4">
                            <x-label class="row" for="password" :value="__('Password')" />
        
                            <x-input id="password" class="block mt-1 w-full"
                                            type="password"
                                            name="password"
                                            required autocomplete="current-password" />
                        </div>
                        @isset($checkout)
                            <input type="hidden" name="checkout" value="checkout"/>
                            <div class="alert alert-danger mt-2">If you login now, your saved shopping cart will be overwritten by current one.</div>
                        @endisset
                        <!-- Remember Me -->
                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>
        
                        <div class="flex items-center justify-end mt-4">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
        
                            <x-button class="ml-3">
                                {{ __('Log in') }}
                            </x-button>
                        </div>
                    </div>
                </form>
                @guest    
                    @isset($checkout)
                        <div class="row text-center mt-4">
                            <span>If you are not registered you can..</span>
                            <form method="GET" action="{{ route('register')}}">
                                <input type="hidden" name="checkout" value="continue"/>
                                <input type="submit" value="Register"  class="btn purple-btn"/>
                            </form>
                            <span>or</span>
                            <form method="GET" action="{{ route('shipping')}}">
                                <input type="hidden" name="checkout" value="continue"/>
                                <input type="submit" class="btn purple-btn" value="Continue without registration"/>
                            </form>
                        </div>
                    @endisset
                @endguest
            </div>
    @endsection
