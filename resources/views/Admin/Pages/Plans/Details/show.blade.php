@extends('adminlte::page')

@section('title', 'Detalhe')

@section('content_header')
<h1>Cadastro de detalhe para - {{$plan->name}} </h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('plans.index')}}">Planos</a></li>
    <li class="breadcrumb-item"><a href="{{route('plans.show',$plan->url)}}">{{$plan->name}}</a></li>
    <li class="breadcrumb-item "><a href="{{route('details.plans.index',$plan->url)}}">Detalhes</a></li>
    <li class="breadcrumb-item active"><a href="{{route('details.plans.show',[$plan->url,$detail->id])}}">Detalhe</a></li>
</ol>
@stop
@section('content')
    {{$detail->name}}
    <form action="{{route('details.plans.destroy',[$plan->url,$detail->id])}}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Deletar - <i class="fas fa-trash    "></i></button>
    </form>
@endsection