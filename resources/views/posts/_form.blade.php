<div class="form-group">
    <p>
        <label for="title">{{ __('Title') }}</label>
        <input class="form-control" type="text" id="title" name="title" value="{{ old('title', $post->title ?? null) }}"/>
    </p>
</div>

<div class="form-group">
    <p>
        <label for="content">{{ __('Content') }}</label>
        <textarea rows="30" class="form-control fn_post_editor" type="text" id="content" name="content">{{ old('content', $post->content ?? null) }}</textarea>
    </p>
</div>

<div class="form-group">
    <p>
        <label for="thumbnail">{{ __('Thumbnail') }}</label>
        <input class="form-control-file" type="file" id="thumbnail" name="thumbnail" value=""/>
    </p>
</div>


@errors @enderrors