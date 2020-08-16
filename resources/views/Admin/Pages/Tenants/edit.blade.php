@extends('adminlte::page')

@section('title', 'Empresas')

@section('content_header')
<h1>Empresas <a href="{{route('tenants.create')}}" class="btn btn-success">Adicionar - <i class="fas fa-plus-circle"></i></a></h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item "><a href="{{route('tenants.index')}}">Empresas</a></li>
    <li class="breadcrumb-item active"><a href="{{route('tenants.edit',$tenant->id)}}">Editar</a></li>
</ol>
@stop
@section('content')
    @include('Admin.Includes.alerts')
    {{$tenant->id}}
    <form action="{{route('tenants.update',$tenant->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('Admin.Pages.Tenants._partials.form')
    <button type="submit" class="btn btn-info">Salvar Alterações</button>
    </form>
@endsection