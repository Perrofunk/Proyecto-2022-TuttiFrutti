@extends('layouts.app')

@section('content')
<div class="w-full flex justify-center">
    <form method="POST" action="{{ route('login') }}" class="w-1/2  bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
            {{ __('Email Address') }}
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') is-invalid @enderror" id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-mail">
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
            {{ __('Password') }}
        </label>
        <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('password') is-invalid @enderror" id="password" name="password" type="password" required autocomplete="current-password">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
      
      <div class="mb-6">
        
            <input class="mr-2 leading-tight" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

            <label class="mb-3 text-gray-500 font-bold" for="remember">
                {{ __('Remember Me') }}
            </label>
      </div>
        
      <div class="flex items-center justify-between">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            {{ __('Login') }}
        </button>
        {{-- @if (Route::has('password.request'))
        <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
          </a>
          @endif --}}
      </div>
    </form>
</div>
@endsection
