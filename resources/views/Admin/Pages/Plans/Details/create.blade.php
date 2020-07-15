@extends('adminlte::page')

@section('title', 'Adicionar detalhes ao plano')

@section('content_header')
<h1>Cadastro de detalhe para - {{$plan->name}} </h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('plans.index')}}">Planos</a></li>
    <li class="breadcrumb-item"><a href="{{route('plans.show',$plan->url)}}">{{$plan->name}}</a></li>
    <li class="breadcrumb-item "><a href="{{route('details.plans.index',$plan->url)}}">Detalhe</a></li>
    <li class="breadcrumb-item active"><a href="{{route('details.plans.create',$plan->url)}}">Cadastrar</a></li>
</ol>
@stop
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('details.plans.store',$plan->url)}}" method="post">
                @csrf
                @method('POST')
                @include('Admin.Pages.Plans.Details._Partials.form')
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </form>
        </div>
    </div>
@endsection