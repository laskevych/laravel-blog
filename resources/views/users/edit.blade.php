@extends('layout')

@section('content')
    <form action="{{ route('users.update', ['user' => $user->id]) }}" 
        enctype="multipart/form-data" method="POST"
        class="form-horizontal">

        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-4">
                <img class="img-thumbnail avatar" src="{{ $user->image ? $user->image->url() : asset('images/no-image-user.jpg') }}" alt="">
                <div class="card mt-4">
                    <div class="card-body">
                        <h6>{{ __('Upload a different photo') }}</h6>
                        <small class="text-muted">{{ __('Image size') }}</small>
                        <input type="file" class="form-control-file" name="avatar">
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="form-group">
                    <label for="name">{{ __('Name') }}</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}"/>
                </div>

                <div class="form-group">
                    <label for="language">{{ __('Site Language') }}</label>
                    <select id="language" class="form-control" name="locale">
                        @foreach (App\User::LOCALES as $locale => $label)
                            <option value="{{ $locale }}" {{ $user->locale != $locale ?: 'selected'}}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="api_token">{{ __('API Token') }}</label>
                    <textarea readonly class="form-control" id="api_token" rows="2">{{ $user->api_token }}</textarea>
                </div>

                @errors @enderrors

                <div class="form-group">
                    <input type="submit" class="btn btn-success btn-block" value="{{ __('Save Сhanges') }}"/>
                </div>
            </div>
        </div>

    </form>
@endsection