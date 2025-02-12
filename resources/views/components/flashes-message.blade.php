@if (session('error'))
    <div class="col-sm-12">
        <div class="error" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    </div>
@endif

@if (session('success'))
    <div class="col-sm-12">
        <div class="success" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    </div>
@endif