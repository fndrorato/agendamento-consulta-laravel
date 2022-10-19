@extends('layouts.main')

@section('title', 'Lista de Especialidades')

@section('content')
<div class="col-md-12 p-2">
    <a href="/especialidade/create" class="btn btn-primary ">Criar Nova Especialidade Médica</a>
</div>

<div class="bg-light p-5 rounded">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach($especialidades as $especialidade)
                <tr>
                    <td scope="row">{{ $loop->index + 1 }}</td>
                    <td>{{ $especialidade->name }}</td>
                    <td>
                        <a href="/especialidade/edit/{{$especialidade->id}}"  class="btn btn-sm btn-info edit-btn"><ion-icon name="create-outline"></ion-icon>Editar</a>                         
                    </td>
                </tr>
            @endforeach    
        </tbody>
    </table>                
</div>
@endsection