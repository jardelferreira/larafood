@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')
<h1>{{$tenant->name}}</h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('tenants.index')}}">Produtos</a></li>
    <li class="breadcrumb-item active"><a href="{{route('tenants.show',$tenant->id)}}">{{$tenant->name}}</a></li>
</ol>
@stop

@section('content')
@include('Admin.Includes.alerts')
{{$tenant}}
    <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <img style="width: 100px; height:100px" src="{{asset("storage/{$tenant->logo}")}}" alt="{{$tenant->logo}}">
                <h5 class="mb-1">{{$tenant->name}} </h5>
            </div>
            <p class="mb-1"><strong>Plano: </strong><small>{{$tenant->plan->name}}</small></p>
            <p class="mb-1"><strong>Nome: </strong><small>{{$tenant->name}}</small></p>
            <p class="mb-1"><strong>Email: </strong><small>{{$tenant->email}}</small></p>
            <p class="mb-1"><strong>URL: </strong><small>{{$tenant->url}}</small></p>
            <p class="mb-1"><strong>CNPJ: </strong><small>{{$tenant->cnpj}}</small></p>
            <p class="mb-1"><strong>Ativo: </strong><small>{{$tenant->active == "Y" ? "SIM":"Não"}}</small></p>
            <hr>
            <h3>Assinatura</h3>
            <p class="mb-1"><strong>Identificador: </strong><small>{{$tenant->subscription_id}}</small></p>
            <p class="mb-1"><strong>Assinado em: </strong><small>{{$tenant->subscription}}</small></p>
            <p class="mb-1"><strong>Expira em: </strong><small>{{$tenant->expires_at}}</small></p>

        </a>
    </div>
    <form action="{{route('tenants.destroy',$tenant->id)}}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger mx-2 my-2">Deletar - <i class="fas fa-trash-alt"></i></button>
    </form>
@endsection