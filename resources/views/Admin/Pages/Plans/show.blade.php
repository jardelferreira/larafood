@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>{{$plan->name}}</h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('plans.index')}}">Planos</a></li>
    <li class="breadcrumb-item active"><a href="{{route('plans.show',$plan->url)}}">{{$plan->name}}</a></li>
</ol>
@stop

@section('content')
@include('Admin.Includes.alerts')

    <div class="list-group">
        <a href="{{route('details.plans.index',$plan->url)}}" class=" my-1 mx-1 btn btn-warning">clique para ver detalhes</a>
        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{$plan->name}} </h5>
                <small>R$ {{number_format($plan->price,2,",",".")}}</small>
            </div>
            <p class="mb-1">Descrição</p>
            <small>{{$plan->description}}</small>
        </a>
    </div>
    <form action="{{route('plans.destroy',$plan->url)}}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger mx-2 my-2">Deletar - <i class="fas fa-trash-alt"></i></button>
    </form>
@endsection