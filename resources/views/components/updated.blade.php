<small class="text-muted">
    @if (empty(trim($slot)))
        @lang('Added')
    @else
        @lang("$slot")
    @endif

    {{ $date }} 

    @if (isset($name))
        @if (isset($userId))
            {{ __('by') }} <a class="font-weight-bold" style="text-decoration: none" href="{{ route('users.show', ['user' => $userId]) }}">{{ $name }}</a>
        @else
            {{ __('by') }} {{ $name }}
        @endif
    @endif
</small>