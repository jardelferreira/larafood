@extends('adminlte::page')

@section('title', 'Perfis do plano')

@section('content_header')
<h1>Perfis do plano {{$plan->name}} <a href="{{route('plans.profiles.create',$plan->url)}}" class="btn btn-success">Adicionar - <i class="fas fa-plus-circle    "></i></a></h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{route('plans.show',$plan->url)}}">{{$plan->name}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('plans.profiles.create',$plan->url)}}">Perfis para plano</a></li>
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
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($profiles as $profile)
                        
                    <tr>
                    <td scope="row">{{$profile->name}}</td>
                    <td>{{$profile->description}}</td>
                     <td>
                         <a href="{{route('profiles.show',$profile->id)}}" class="btn btn-warning"><i class="fas fa-eye"></i></a>
                         <a href="{{route('profiles.edit',$profile->id)}}" class="btn btn-info"><i class="fas fa-edit    "></i></a>
                         <a href="{{route('profiles.permissions',$profile->id)}}" class="btn btn-primary"><i class="fas fa-lock"></i></a>
                         <a href="{{route('plans.profiles.destroy',[$plan->url,$profile->id])}}" class="btn btn-danger">Desvincular</a>
                    </td>  
                    </tr>
                    @endforeach
                    
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