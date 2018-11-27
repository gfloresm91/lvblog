@extends('layouts.master')


@section('content')

<div class="row">
    <div class="col-md-12 mt-2">
        <div class="jumbotron">
            <div class="container">
                <h1 class="display-4">Bienvenido a {{ env('APP_NAME') }}</h1>
                <p class="lead">Este sitio tiene fines educativos para el aprendizaje personal del desarrollo en
                    Laravel framework.
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <h1>Lista de noticias</h1>
        </div>
    </div>
</div>
<hr>

<div class="row">
    <div class="offset-md-8 col-md-4">
        <form class="form-inline" action="{{ route('noticia.buscar') }}">
            <div class="form-group">
                <input type="text" name="query" id="query" class="form-control" placeholder="Ingrese el texto a buscar" aria-describedby="helpId" value="{{ old('query') }}">
                <button type="submit" class="btn btn-outline-primary">Buscar</button>
            </div>
        </form>
    </div>
</div>

<div class="row mt-2">
    @include('noticia.noticia')
</div>

@endsection
