@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
<h1>Usuários <a href="{{route('users.create')}}" class="btn btn-success">Adicionar - <i class="fas fa-plus-circle    "></i></a></h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item "><a href="{{route('users.index')}}">Usuários</a></li>
    <li class="breadcrumb-item active"><a href="{{route('users.edit',$user->id)}}">Editar</a></li>
</ol>
@stop
@section('content')
    @include('Admin.Includes.alerts')
    <form action="{{route('users.update',$user->id)}}" method="post">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Usuário</label>
        <input type="text" value="{{$user->name ?? old('name')}}" class="form-control" name="name" id="name" aria-describedby="nameHelp" placeholder="nome do Usuário">
        <small id="nameHelp" class="form-text text-muted">informe o nome do Usuário</small>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" value="{{$user->email ?? old('email')}}" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="seuemail@mail">
        <small id="emailHelp" class="form-text text-muted">Email</small>
      </div>
    <button type="submit" class="btn btn-info">Salvar Alterações</button>
    </form>
@endsection