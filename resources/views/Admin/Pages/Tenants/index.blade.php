@extends('adminlte::page')

@section('title', 'Empresas')

@section('content_header')
<h1>Empresas <a href="{{route('tenants.create')}}" class="btn btn-success">Adicionar - <i class="fas fa-plus-circle    "></i></a></h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{route('tenants.index')}}">Empresas</a></li>
</ol>
@stop
@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{route('tenants.search')}}" method="POST" class="form form-inline">
            @csrf
            @method('POST')
            <input type="text" name="filter" value="{{$filters['filter'] ?? ''}}" placeholder="Pesquisar...">
            <button type="submit" class="btn btn-secondary"><i class="fas fa-search    "></i></button>
        </form>
        @if (isset($filters))
            <a href="{{route('tenants.index')}}" class="btn btn-success">Resetar</a>
        @endif
    </div>
    <div class="card-body">
    @include('Admin.Includes.alerts')
        <table class="table table-striped table-inverse table-responsive">
            <thead class="thead-inverse">
                <tr>
                    <th>Imagem</th>
                    <th>Título</th>
                    <th>CNPJ</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($tenants as $tenant)
                        
                    <tr>
                    <td scope="row"><img style="width: 70px; height: 50px;" src="{{asset("storage/$tenant->logo")}}" alt="{{$tenant->name}}" ></td>
                    <td>{{$tenant->cnpj}}</td>
                    <td>{{$tenant->name}}</td>
                     <td>
                         <a href="{{route('tenants.show',$tenant->id)}}" class="btn btn-warning"><i class="fas fa-eye"></i></a>
                         <a href="{{route('tenants.edit',$tenant->id)}}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                    </tr>
                    @endforeach
                    
                </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if(isset($filters))
        {!! $tenants->appends($filters)->links() !!}
        @else
        {!! $tenants->links() !!}
        @endif
    </div>
</div>
@endsection