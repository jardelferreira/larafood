@extends('adminlte::page')

@section('title', 'Cadastro de Planos')

@section('content_header')
<h1>Cadastro de planos</h1>
@stop
@section('content')
    
<div class="card">
    <div class="card-body">
    <form action="{{route('plans.store')}}" method="post">
        @csrf
        @method('POST')
       @include('Admin.Pages.Plans._Partials.form')
        <button type="submit" class="btn btn-primary">cadastrar</button>
    </form>
    </div>
</div>
@endsection