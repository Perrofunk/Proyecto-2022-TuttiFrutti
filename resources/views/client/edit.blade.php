@extends('layouts.app')

@section('content')

@if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @elseif (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
<div class="flex justify-center">
    <form class="w-full max-w-lg" method="POST" action="{{ route('client.profile.update', ['user'=>$user]) }}">
        @csrf
        <input type="hidden" name="user_type" value="3">
        <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label for="name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('Name') }}</label>

                <input id="name" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>

        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label for="surname" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('Surname') }}</label>

            <div class="col-md-6">
                <input id="surname" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('surname') is-invalid @enderror" name="surname" value="{{ $user->surname }}" required autocomplete="surname" autofocus>

                @error('surname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        

        <div class="w-full px-3">
            <label for="phone" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('phone') }}</label>

            <div class="col-md-6">
                <input id="phone" type="tel" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}" required autocomplete="phone">

                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label for="oldPasswordInput" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('Old Password') }}</label>

            <div class="col-md-6">
                <input name="old_password" type="password" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('old_password') is-invalid @enderror" id="oldPasswordInput"
                placeholder="{{__('Old Password')}}" required>

                @error('old_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label for="newPasswordInput" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{__('New Password')}}</label>

            <div class="col-md-6">
                <input name="new_password" type="password" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('new_password') is-invalid @enderror" id="newPasswordInput"
                placeholder="{{__('New Password')}}">
            </div>
            @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
        </div>
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label for="confirmNewPasswordInput" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{__('Confirm Password')}}</label>

            <div class="col-md-6">
                <input name="new_password_confirmation" type="password" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="confirmNewPasswordInput"
                placeholder="{{__('Confirm New Password')}}">
            </div>
        </div>
        
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label for="street" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{__('Street')}}</label>

            <div class="col-md-6">
                <input id="street" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('street') is-invalid @enderror" name="street" value="{{$user->client->address->street}}" autocomplete="new-street">

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
                <input id="address" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('address') is-invalid @enderror" name="address" value="{{$user->client->address->address}}" required autocomplete="new-address">

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
                <input id="department" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('department') is-invalid @enderror" name="department" value="{{$user->client->address->department}}" autocomplete="new-department">

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
                <input id="zone" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('zone') is-invalid @enderror" name="zone" value="{{$user->client->address->zone->postal_code}}" required autocomplete="new-zone">

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
                <input id="details" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('between_streets') is-invalid @enderror" value="{{$user->client->address->details}}" name="details" autocomplete="new-details">

                @error('details')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
            

        
            <div class="w-full px-3 mb-10">
                <button type="submit" class="w-full bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                    Aceptar
                </button>
            </div>
        
    </div>
    </form>
</div>

@endsection