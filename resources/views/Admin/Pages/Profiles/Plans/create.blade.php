@extends('adminlte::page')

@section('title', 'Vincular Planos')

@section('content_header')
<h1>Planos disponíveis para {{$profile->name}}</h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('profiles.index')}}">Perfis</a></li>
    <li class="breadcrumb-item active"><a href="{{route('profiles.plans.create',$profile->id)}}">Este perfil</a></li>
</ol>
@stop
@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{route('profiles.plans.create',$profile->id)}}" method="POST" class="form form-inline">
            @csrf
            @method('POST')
            <input type="text" name="filter" value="{{$filters['filter'] ?? ''}}" placeholder="Pesquisar...">
            <button type="submit" class="btn btn-secondary"><i class="fas fa-search    "></i></button>
        </form>
        @if (isset($filters))
            <a href="{{route('plans.index')}}" class="btn btn-success">Resetar</a>
        @endif
    </div>
    <div class="card-body">
    @include('Admin.Includes.alerts')
        <table class="table table-striped table-inverse table-responsive">
            <thead class="thead-inverse">
                <form action="{{route('profiles.plans.store',$profile->id)}}" method="post">
                    @csrf
                    @method('POST')
                <tr>
                    <th><button type="submit" class="btn btn-success">Salvar</button></th>
                    <th>Nome</th>
                    <th>Descrição</th>
                </tr>
                </thead>
                <tbody>
                        @foreach ($plans as $plan)     
                    <tr>
                        <td class="input-group"><div class="input-group-prepend">
                            <label class=" input-group-text">
                                <input class="ml-3" type="checkbox" name="plans[]" value="{{$plan->id}}">
                            </label>
                        </div></td>
                        <td scope="row">{{$plan->name}}</td>
                        <td>{{$plan->description}}</td>
                    </tr>
                    @endforeach
                    </form>
                    
                </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if(isset($filters))
        {!! $plans->appends($filters)->links() !!}
        @else
        {!! $plans->links() !!}
        @endif
    </div>
</div>
@endsection