@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
<h1>Usuários <a href="{{route('users.create')}}" class="btn btn-success">Adicionar - <i class="fas fa-plus-circle    "></i></a></h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item "><a href="{{route('users.index')}}">Usuários</a></li>
    <li class="breadcrumb-item active"><a href="{{route('users.create')}}">Criar</a></li>
</ol>
@stop
@section('content')
    @include('Admin.Includes.alerts')
    <form action="{{route('users.store')}}" method="post">
    @csrf
    @method('POST')
    <div class="form-group">
        <label for="name">Perfil</label>
        <input type="text" value="{{$user->name ?? old('name')}}" class="form-control" name="name" id="name" aria-describedby="nameHelp" placeholder="nome do perfil">
        <small id="nameHelp" class="form-text text-muted">informe o nome do perfil</small>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" value="{{$user->email ?? old('email')}}" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="seuemail@mail">
        <small id="emailHelp" class="form-text text-muted">Email</small>
      </div>
      <div class="form-group">
        <label for="password">Senha</label>
        <input type="text" value="{{$user->password ?? old('password')}}" class="form-control" name="password" id="password" aria-describedby="passwordHelp" placeholder="seupassword@mail">
        <small id="passwordHelp" class="form-text text-muted">Senha</small>
      </div>
      <div class="form-group">
        <label for="_password">confirmação de senha</label>
        <input type="text" value="{{$user->_password ?? old('_password')}}" class="form-control" name="_password" id="_password" aria-describedby="_passwordHelp" placeholder="seu_password@mail">
        <small id="_passwordHelp" class="form-text text-muted">confirmação de senha</small>
      </div>
    <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>
@endsection