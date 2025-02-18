@extends('layouts.app')
@section('title', 'Список коротких ссылок')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route( 'home') }}">Главная</a></li>
            <li class="breadcrumb-item active"><a href="{{ route( 'shortlink.index') }}">Список ссылок</a></li>
        </ol>
    </nav>
    @if(empty($shortLinks))
        <div class="my-3">Нет ссылок</div>
    @else
        <div class="my-3">
            @if(!empty($message))
                <div class="my-3 alert alert-{{$message['type']}}">{{$message['message']}}</div>
            @endif
            @foreach($shortLinks as $shortLink)
                <div class="card my-3" >
                    <div class="card-body">
                        <h5 class="card-title">Ссылка: {{$shortLink->url}}</h5>
                        <ul>
                            <li>
                                Короткая: <a href="{{ route('index.follow_shortlink', ['shortId' => $shortLink->short_id] ) }}" target="_blank">
                                    {{ route('index.follow_shortlink', ['shortId' => $shortLink->short_id] ) }}
                                </a>
                            </li>
                            <li>
                                Количество переходов: {{$shortLink->call_count}}
                            </li>
                        </ul>
                        <a href="{{ route('shortlink.edit', ['shortLink' => $shortLink->id]) }}" class="btn btn-primary">Редактировать</a>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $shortLinks->links() }}
    @endif
@endsection
