@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')
<h1>{{$product->title}}</h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('products.index')}}">Produtos</a></li>
    <li class="breadcrumb-item active"><a href="{{route('products.show',$product->id)}}">{{$product->title}}</a></li>
</ol>
@stop

@section('content')
@include('Admin.Includes.alerts')

    <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <img src="{{asset("storage/{$product->image}")}}" alt="{{$product->title}}">
                <h5 class="mb-1">{{$product->title}} </h5>
            </div>
            <p class="mb-1">Descrição:</p>
            <small>{{$product->flag}}</small>
        </a>
    </div>
    <form action="{{route('products.destroy',$product->id)}}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger mx-2 my-2">Deletar - <i class="fas fa-trash-alt"></i></button>
    </form>
@endsection