@extends('layout')

@section('content')
<form action="{{ route('register') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="exampleInputName">{{ __('Name') }}</label>
        <input type="text" 
            name="name" 
            value="{{ old('name') }}" 
            class="form-control {{ $errors->has('name') ? ' is-invalid': '' }}" 
            id="exampleInputName" 
            placeholder="{{ __('Enter name') }}">
        @if ($errors->has('name'))
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
        @endif

    
    </div>
    <div class="form-group">
        <label for="exampleInputEmail">{{ __('E-mail') }}</label>
        <input type="text" 
            name="email" 
            value="{{ old('email') }}" 
            class="form-control {{ $errors->has('email') ? ' is-invalid': '' }}" 
            id="exampleInputEmail" 
            aria-describedby="emailHelp" 
            placeholder="{{ __('Enter email') }}">
        <small id="emailHelp" class="form-text text-muted">{{ __("We'll never share your email with anyone else.") }}</small>
        @if ($errors->has('email'))
            <div class="invalid-feedback">
                {{ $errors->first('email') }}
            </div>
        @endif
    </div>
    <div class="form-group">
        <label for="exampleInputPassword">{{ __('Password') }}</label>
        <input 
            type="password" 
            name="password" 
            class="form-control {{ $errors->has('password') ? ' is-invalid': '' }}" 
            id="exampleInputPassword" 
            placeholder="{{ __('Enter password') }}">
        @if ($errors->has('password'))
            <div class="invalid-feedback">
                {{ $errors->first('password') }}
            </div>
        @endif
    </div>

    <div class="form-group">
        <label for="exampleInputConfirmPassword">{{ __('Confirm password') }}</label>
        <input type="password" name="password_confirmation" class="form-control" id="exampleInputConfirmPassword" placeholder="{{ __('Confirm password') }}" required>
    </div>
    {{-- <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div> --}}
    <button type="submit" class="btn btn-success btn-block">{{ __('Join') }}</button>
</form>
@endsection