@extends('adminlte::page')

@section('title', 'Mesas')

@section('content_header')
<h1>Mesas <a href="{{route('tables.create')}}" class="btn btn-success">Adicionar - <i class="fas fa-plus-circle    "></i></a></h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{route('tables.index')}}">Mesas</a></li>
</ol>
@stop
@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{route('tables.search')}}" method="POST" class="form form-inline">
            @csrf
            @method('POST')
            <input type="text" name="filter" value="{{$filters['filter'] ?? ''}}" placeholder="Pesquisar...">
            <button type="submit" class="btn btn-secondary"><i class="fas fa-search    "></i></button>
        </form>
        @if (isset($filters))
            <a href="{{route('tables.index')}}" class="btn btn-success">Resetar</a>
        @endif
    </div>
    <div class="card-body">
    @include('Admin.Includes.alerts')
        <table class="table table-striped table-inverse table-responsive">
            <thead class="thead-inverse">
                <tr>
                    <th>Identificador</th>
                    <th>Description</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($tables as $table)
                        
                    <tr>
                    <td scope="row">{{$table->identify}}</td>
                    <td>{{$table->description}}</td>
                     <td>
                         <a href="{{route('tables.show',$table->id)}}" class="btn btn-warning"><i class="fas fa-eye"></i></a>
                         <a href="{{route('tables.edit',$table->id)}}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                    </tr>
                    @endforeach
                    
                </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if(isset($filters))
        {!! $tables->appends($filters)->links() !!}
        @else
        {!! $tables->links() !!}
        @endif
    </div>
</div>
@endsection