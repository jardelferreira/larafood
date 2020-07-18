@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Planos do {{$profile->name}}<a href="{{route('profiles.plans.create',$profile->id)}}" class="btn btn-success">Adicionar - <i class="fas fa-plus-circle    "></i></a></h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{route('profiles.index')}}">Perfis</a></li>
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
        </div>
        <div class="card-body">
        @include('Admin.Includes.alerts')
            <table class="table table-striped table-inverse table-responsive">
                <thead class="thead-inverse">
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Preço</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($plans as $plan)
                            
                        <tr>
                        <td scope="row">{{$plan->name}}</td>
                        <td>{{$plan->description}}</td>
                        <td>{{$plan->price}}</td>
                         <td>
                             <a href="{{route('plans.show',$plan->url)}}" class="btn btn-warning"><i class="fas fa-eye"></i></a>
                             <a href="{{route('plans.edit',$plan->url)}}" class="btn btn-info"><i class="fas fa-edit    "></i></a>
                             <a href="{{route('details.plans.index',$plan->url)}}" class="btn btn-primary"><i class="fas fa-info-circle"></i></a>
                             <a href="{{route('plans.profiles',$plan->url)}}" class="btn btn-success"><i class="fas fa-address-book"></i></a>
                             <a href="{{route('profiles.plans.destroy',[$profile->id,$plan->url])}}" class="btn btn-danger">Desvincular</a>
                        </td>  
                        </tr>
                        @endforeach
                        
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
@stop
