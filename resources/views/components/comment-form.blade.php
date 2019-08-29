@auth
    <form action="{{ $route }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="comment_content"></label>
            <textarea class="form-control fn_comment_editor" name="content" id="comment_content" rows="5">{{ old('content') }}</textarea>
        </div>
        
        <button class="btn btn-success btn-block btn-sm" type="submit">{{ __('Add comment') }}</button>    
    </form>
@else
    <a class="card-link weight-bold" href="{{ route('login') }}">{{ __('Sign in') }}</a> {{ __('to post comment') }}
@endauth

@errors @enderrors