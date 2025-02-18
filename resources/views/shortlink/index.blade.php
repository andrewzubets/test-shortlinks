<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    @else
        <style></style>
    @endif
</head>
<body>
<div class="container my-5">
    <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
        <div class="col-lg-12 p-3 p-lg-5 pt-lg-3">
            <h1 class="display-4 fw-bold lh-1 text-body-emphasis">Получить короткую ссылку</h1>

            <form class="d-grid gap-md-2 d-flex justify-content-between flex-md-max-column mb-md-8" method="POST" action="{{ route('shortlink.create') }}">
                @csrf
                <div class="my-3 flex-fill">
                    <input type="text" name="url_input" class="form-control form-control-lg @if($errors->has('url_input')) is-invalid @endif" id="urlInput" placeholder="Введите ссылку" value="{{ old('url_input', $urlInput) }}" />
                    @if($errors->has('url_input'))
                    <div class="invalid-feedback">
                        @foreach ($errors->get('url_input') as $message)
                            {{ $message }}
                        @endforeach
                    </div>
                    @endif
                </div>
                <div class="my-3">
                    <button type="submit" class="btn btn-primary btn-lg w100-md-max">Получить ссылку</button>
                </div>
            </form>
            @if(!empty($urlShortLink))
            <div class="d-grid gap-md-2 d-flex justify-content-between flex-md-max-column mb-md-8" >
                <div class="my-3 flex-fill">
                    <input type="text" class="form-control form-control-lg" disabled id="urlOutput" value="{{$urlShortLink}}" >
                </div>
                <div class="my-3">
                    <button type="button" id="copyUrlOutputBtn" class="btn btn-success btn-lg fw-bold w100-md-max">Скопировать</button>
                </div>
            </div>

            <div class="alert alert-success d-none" id="copyInfoAlert" role="alert">
                Скопировано в буфер обмена!
            </div>
            @endif
        </div>
    </div>
</div>
</body>
</html>
