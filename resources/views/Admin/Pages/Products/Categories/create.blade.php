@extends('adminlte::page')

@section('title', 'Categorias do produto')

@section('content_header')
<h1>Categorias do produto {{$product->title}} <a href="{{route('products.categories.create',$product->id)}}" class="btn btn-success">Adicionar - <i class="fas fa-plus-circle    "></i></a></h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{route('categories.index')}}">Categorias</a></li>
    <li class="breadcrumb-item"><a href="{{route('products.categories',$product->id)}}">Categorias do {{$product->title}}</a></li>
</ol>
@stop
@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{route('products.categories.create',$product->id)}}" method="POST" class="form form-inline">
            @csrf
            @method('POST')
            <input type="text" title="filter" value="{{$filters['filter'] ?? ''}}" placeholder="Pesquisar...">
            <button type="submit" class="btn btn-secondary"><i class="fas fa-search    "></i></button>
        </form>
    </div>
    <div class="card-body">
        @include('Admin.Includes.alerts')
            <table class="table table-striped table-inverse table-responsive">
                <thead class="thead-inverse">
                    <form action="{{route('products.categories.store',$product->id)}}" method="post">
                        @csrf
                        @method('POST')
                    <tr>
                        <th><button type="submit" class="btn btn-success">Salvar</button></th>
                        <th>Nome</th>
                        <th>Descrição</th>
                    </tr>
                    </thead>
                    <tbody>
                            @foreach ($categories as $category)     
                        <tr>
                            <td class="input-group"><div class="input-group-prepend">
                                <label class=" input-group-text">
                                    <input class="ml-3" type="checkbox" name="categories[]" value="{{$category->id}}">
                                </label>
                            </div></td>
                            <td scope="row">{{$category->name}}</td>
                            <td>{{$category->description}}</td>
                        </tr>
                        @endforeach
                        </form>
                        
                    </tbody>
            </table>
        </div>
    <div class="card-footer">
        @if(isset($filters))
        {!! $categories->appends($filters)->links() !!}
        @else
        {!! $categories->links() !!}
        @endif
    </div>
</div>
@endsection