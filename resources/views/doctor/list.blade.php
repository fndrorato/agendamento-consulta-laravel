@extends('layouts.main')

@section('title', 'Lista de Profissionais')

@section('content')
<div class="col-md-12 p-2">
    <a href="/profissional/create" class="btn btn-primary ">Adicionar Novo Profissional</a>
</div>

@if($search)
<p>Você pesquisou por: {{$search}}</p>
@endif


<div class="bg-light p-5 rounded">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Especialidade</th>
                <th scope="col">CRM</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach($doctors as $doctor)
                <tr>
                    <td scope="row">{{ $loop->index + 1 }}</td>
                    <td>{{ $doctor->name }}</td>
                    <td>{{ $doctor->nome_especialidade }}</td>
                    <td>{{ $doctor->crm }}</td>
                    <td>
                        <a href="/profissional/edit/{{$doctor->id}}"  class="btn btn-sm btn-info edit-btn"><ion-icon name="create-outline"></ion-icon>Editar</a>                         
                    </td>
                </tr>
            @endforeach 
        </tbody>
    </table>                
</div>
@endsection