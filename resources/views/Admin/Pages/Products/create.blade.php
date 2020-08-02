@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')
<h1>Produtos <a href="{{route('products.create')}}" class="btn btn-success">Adicionar - <i class="fas fa-plus-circle    "></i></a></h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item "><a href="{{route('products.index')}}">Produtos</a></li>
    <li class="breadcrumb-item active"><a href="{{route('products.create')}}">Criar</a></li>
</ol>
@stop
@section('content')
    @include('Admin.Includes.alerts')
    <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('POST')
      @include('Admin.Pages.Products._partials.form')
    <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>
@endsection