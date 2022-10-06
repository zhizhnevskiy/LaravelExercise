<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>Laravel Exercise</title>

    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body>

<main>
    <div class="container mt-4">
        <h3>Laravel Exercise</h3>
        <form method="post" action="{{ route('format') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="avatar">Choose your file for validation:</label>
                <input type="file"
                       class="mt-2 form-control @error('file') is-invalid @enderror"
                       id="file"
                       name="file"
                >
                @error('file')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-4">Get result</button>
        </form>
    </div>
</main>

<script src="{{ asset('js/main.js') }}"></script>

</body>
</html>
