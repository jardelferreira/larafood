@extends('adminlte::page')

@section('title', 'Detalhes do plano')

@section('content_header')
<h1>{{$plan->name}} <a href="{{route('plans.create')}}" class="btn btn-success">Adicionar detalhe - <i class="fas fa-plus-circle    "></i></a></h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('plans.index')}}">Planos</a></li>
    <li class="breadcrumb-item"><a href="{{route('plans.show',$plan->url)}}">{{$plan->name}}</a></li>
    <li class="breadcrumb-item active"><a href="{{route('details.plans.index',$plan->url)}}">Detalhe</a></li>
</ol>
@stop
@section('content')
    <table class="table table-striped table-responsive">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($details as $detail)
                <tr>
                    <td scope="row">{{$detail->name}}</td>
                    <td>
                        <a class="btn btn-primary" href="#" role="button"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-primary" href="#" role="button"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
    </table>
@endsection