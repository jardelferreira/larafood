@extends('adminlte::page')

@section('title', 'Perfis do plano')

@section('content_header')
<h1>Perfis do plano {{$plan->name}} <a href="{{route('plans.profiles.create',$plan->url)}}" class="btn btn-success">Adicionar - <i class="fas fa-plus-circle    "></i></a></h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{route('profiles.index')}}">Perfis</a></li>
    <li class="breadcrumb-item"><a href="{{route('plans.profiles',$plan->url)}}">Perfis do {{$plan->name}}</a></li>
</ol>
@stop
@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{route('plans.profiles.create',$plan->url)}}" method="POST" class="form form-inline">
            @csrf
            @method('POST')
            <input type="text" name="filter" value="{{$filters['filter'] ?? ''}}" placeholder="Pesquisar...">
            <button type="submit" class="btn btn-secondary"><i class="fas fa-search    "></i></button>
        </form>
    </div>
    <div class="card-body">
        @include('Admin.Includes.alerts')
            <table class="table table-striped table-inverse table-responsive">
                <thead class="thead-inverse">
                    <form action="{{route('plans.profiles.store',$plan->id)}}" method="post">
                        @csrf
                        @method('POST')
                    <tr>
                        <th><button type="submit" class="btn btn-success">Salvar</button></th>
                        <th>Nome</th>
                        <th>Descrição</th>
                    </tr>
                    </thead>
                    <tbody>
                            @foreach ($profiles as $profile)     
                        <tr>
                            <td class="input-group"><div class="input-group-prepend">
                                <label class=" input-group-text">
                                    <input class="ml-3" type="checkbox" name="profiles[]" value="{{$profile->id}}">
                                </label>
                            </div></td>
                            <td scope="row">{{$profile->name}}</td>
                            <td>{{$profile->description}}</td>
                        </tr>
                        @endforeach
                        </form>
                        
                    </tbody>
            </table>
        </div>
    <div class="card-footer">
        @if(isset($filters))
        {!! $profiles->appends($filters)->links() !!}
        @else
        {!! $profiles->links() !!}
        @endif
    </div>
</div>
@endsection