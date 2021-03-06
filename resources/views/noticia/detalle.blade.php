@extends('layouts.master')


@section('content')
<div class="row mt-2">
    <div class="col-md-12">
        <div class="page-header">
            <h1>{{ $noticia->titulo }}</h1>
        </div>
    </div>
</div>

<hr>


<div class="row">
    <div class="col-md-12">
        <strong>@lang('app.Posted')</strong> <a href="#"> {{ $noticia->user->username }}</a> |
        @lang('app.Date_post') {{ $noticia->created_at }}
    </div>
</div>


<div class="row container mt-2">
    <div class="col-md-12 text-center">
        <p>
            <img src="{{ $noticia->imagen }}" class="img-thumbnail" alt="">

        </p>
        <p>
            {{ $noticia->cuerpo }}
        </p>
    </div>
</div>

<comentarios-component :noticia_id="{{ $noticia->id }}"></comentarios-component>

@endsection
