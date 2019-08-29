@if (session()->has('status'))
    <div class="mb-2 mt-2">
        <div class="alert alert-success" role="alert">
            {{ session()->get('status' )}}
        </div>
    </div>
@endif