@extends('layouts.app')

@section('content')

<div class="flex justify-center">
                    <form class="w-full max-w-lg" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label for="name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('Name') }}</label>

                                <input id="name" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label for="surname" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('Surname') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>

                                @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="w-full px-3">
                            <label for="email" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label for="password" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label for="password-confirm" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label for="street" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{__('Street')}}</label>

                            <div class="col-md-6">
                                <input id="street" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('street') is-invalid @enderror" name="street" autocomplete="new-street">

                                @error('street')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label for="address" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('address') is-invalid @enderror" name="address" required autocomplete="new-address">

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label for="department" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('Department') }}</label>

                            <div class="col-md-6">
                                <input id="department" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('department') is-invalid @enderror" name="department" autocomplete="new-department">

                                @error('department')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label for="zone" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{__('Zone')}}</label>

                            <div class="col-md-6">
                                <input id="zone" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('zone') is-invalid @enderror" name="zone" required autocomplete="new-zone">

                                @error('zone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label for="details" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{__('Details')}}</label>
                            
                            <div class="col-md-6">
                                <input id="details" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('between_streets') is-invalid @enderror" name="details" autocomplete="new-details">

                                @error('details')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label for="between_streets" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{__('Between Streets')}}</label>
    
                                <div class="col-md-6">
                                    <input id="between_streets" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('between_streets') is-invalid @enderror" name="between_streets" autocomplete="new-between_streets">
    
                                    @error('between_streets')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        
                            <div class="w-full px-3 mb-10">
                                <button type="submit" class="w-full bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        
                    </div>
                    </form>
                </div>

@endsection
