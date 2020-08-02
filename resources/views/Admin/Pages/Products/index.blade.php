@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')
<h1>Produtos <a href="{{route('products.create')}}" class="btn btn-success">Adicionar - <i class="fas fa-plus-circle    "></i></a></h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{route('products.index')}}">Produtos</a></li>
</ol>
@stop
@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{route('products.search')}}" method="POST" class="form form-inline">
            @csrf
            @method('POST')
            <input type="text" name="filter" value="{{$filters['filter'] ?? ''}}" placeholder="Pesquisar...">
            <button type="submit" class="btn btn-secondary"><i class="fas fa-search    "></i></button>
        </form>
        @if (isset($filters))
            <a href="{{route('products.index')}}" class="btn btn-success">Resetar</a>
        @endif
    </div>
    <div class="card-body">
    @include('Admin.Includes.alerts')
        <table class="table table-striped table-inverse table-responsive">
            <thead class="thead-inverse">
                <tr>
                    <th>Imagem</th>
                    <th>Título</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        
                    <tr>
                    <td scope="row"><img style="width: 70px;" src="{{asset("storage/$product->image")}}" alt="{{$product->title}}" ></td>
                    <td>{{$product->title}}</td>
                     <td>
                         <a href="{{route('products.show',$product->id)}}" class="btn btn-warning"><i class="fas fa-eye"></i></a>
                         <a href="{{route('products.edit',$product->id)}}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                    </tr>
                    @endforeach
                    
                </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if(isset($filters))
        {!! $products->appends($filters)->links() !!}
        @else
        {!! $products->links() !!}
        @endif
    </div>
</div>
@endsection