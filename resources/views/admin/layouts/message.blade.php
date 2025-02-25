@if (count($errors->all()) > 0)
    <div class="text-center alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

@if (session()->has('error') && !empty(session('error')))
    <div class="text-center alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if (session()->has('success') && !empty(session('success')))
    <div class="text-center alert alert-success">
        {{ session('success') }}
    </div>
@endif