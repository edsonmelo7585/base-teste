@extends('layouts.app', ["current_page" => "Inicio"])
@section('body')
<div class="card-deck mb-3 text-center">
    <div class="card mb-4 shadow-sm">
    <div class="card-header">
        <h4 class="my-0 font-weight-normal">Cadastro de Imóvel</h4>
    </div>
    <div class="card-body">
        <ul class="list-unstyled mt-3 mb-4">
        <li>Aqui você cadastra seus Imóvel.</li>
        <li>Só não se esqueça de cadastrar</li>
        <li>previamente as proprietários.</li>        
        </ul>        
        <a href="{{route('imoveis.create')}}" class="btn btn-lg btn-block btn-primary" role="button">Imóveis</a>
    </div>
    </div>
    <div class="card mb-4 shadow-sm">
    <div class="card-header">
        <h4 class="my-0 font-weight-normal">Cadastro de proprietários</h4>
    </div>
    <div class="card-body">
        <ul class="list-unstyled mt-3 mb-4"> 
        <li><br></li>
        <li>Cadastre os proprietários dos seus Imóveis</li>
        <li><br></li>
        </ul>
        <a href="{{route('proprietarios.create')}}" class="btn btn-lg btn-block btn-primary" role="button">Proprietários</a>
    </div>
    </div>
</div>
@endsection