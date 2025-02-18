@extends('layouts.app')
@section('title', 'Получить короткую ссылку')
@section('content')

<form class="d-grid gap-md-2 d-flex justify-content-between flex-md-max-column mb-md-8" method="POST" action="{{ route('index.create_shortlink') }}">
    @csrf
    <div class="my-3 flex-fill">
        <input type="text" name="url"
               class="form-control form-control-lg @if($errors->has('url')) is-invalid @endif"
               id="urlInput"
               placeholder="Введите ссылку"
               value="{{ old('url', $urlInput) }}" />
        @if($errors->has('url'))
        <div class="invalid-feedback">
            @foreach ($errors->get('url') as $message)
                {{ $message }}
            @endforeach
        </div>
        @endif
    </div>
    <div class="my-3">
        <button type="submit" class="btn btn-primary btn-lg w100-md-max">Получить ссылку</button>
    </div>
</form>
@if(!empty($shortUrlId))
<div class="d-grid gap-md-2 d-flex justify-content-between flex-md-max-column mb-md-8" >
    <div class="my-3 flex-fill">
        <input type="text" class="form-control form-control-lg" disabled id="urlOutput" value="{{ route('index.follow_shortlink', [ 'shortId' => $shortUrlId]) }}" >
    </div>
    <div class="my-3">
        <button type="button" id="copyUrlOutputBtn" class="btn btn-success btn-lg fw-bold w100-md-max">Скопировать</button>
    </div>
</div>

<div class="alert alert-success d-none" id="copyInfoAlert" role="alert">
    Скопировано в буфер обмена!
</div>
@endif
<div class="my-3">
    <a href="{{ route('shortlink.index') }}">Все ссылки</a>
</div>
@endsection
