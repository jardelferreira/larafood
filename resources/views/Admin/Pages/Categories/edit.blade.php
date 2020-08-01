@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
<h1>Categorias <a href="{{route('categories.create')}}" class="btn btn-success">Adicionar - <i class="fas fa-plus-circle    "></i></a></h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item "><a href="{{route('categories.index')}}">Categorias</a></li>
    <li class="breadcrumb-item active"><a href="{{route('categories.edit',$category->id)}}">Editar</a></li>
</ol>
@stop
@section('content')
    @include('Admin.Includes.alerts')
    <form action="{{route('categories.update',$category->id)}}" method="post">
    @csrf
    @method('PUT')
    @include('Admin.Pages.Categories._partials.form')
    <button type="submit" class="btn btn-info">Salvar Alterações</button>
    </form>
@endsection