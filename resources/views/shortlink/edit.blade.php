@extends('layouts.app')
@section('title', 'Редактирование ссылки # '.$shortLink->id)
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route( 'home') }}">Главная</a></li>
            <li class="breadcrumb-item"><a href="{{ route( 'shortlink.index') }}">Список ссылок</a></li>
            <li class="breadcrumb-item active">Редактирование ссылки</li>
        </ol>
    </nav>
        <div class="my-3">
            @if($errors->isNotEmpty())
                @foreach ($errors->all() as $message)
                <div class="alert alert-danger my-3">
                     {{ $message }}
                </div>
                @endforeach
            @endif
            <form method="POST" action="{{ route('shortlink.update', ['shortLink' => $shortLink->id]) }}">
                @csrf
                <input type="hidden" name="id" value="{{ $shortLink->id }}" />
                <div class="mb-3">
                    <label for="url" class="form-label">Полный url</label>
                    <input type="text" class="form-control"  placeholder="Введите url" name="url" value="{{ old('url', $shortLink->url) }}" />
                </div>
                <div class="mb-3">
                    <label for="shortId" class="form-label">Короткий url</label>
                    <input type="text" class="form-control"  placeholder="Введите url" name="short_id" value="{{ old('short_id', $shortLink->short_id) }}" />
                </div>
                <div class="mb-3 d-flex gap-2">
                    <input type="submit" class="btn btn-primary" value="Сохранить" />
                    <a class="btn btn-danger" href="{{ route('shortlink.destroy', ['shortLink' => $shortLink->id]) }}">Удалить</a>
                </div>
            </form>
        </div>

@endsection
