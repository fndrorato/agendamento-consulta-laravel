@extends('layouts.main')

@section('title', 'Agenda Clínica')

@section('content')
<div class="bg-light p-5 rounded">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Data Consulta</th>
                <th scope="col">Médico(a)</th>
                <th scope="col">Telefone</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
        @foreach($consultas as $consulta)
            <tr>
                <td scope="row">{{ $loop->index + 1 }}</td>
                <td>{{ $consulta->patient_name }}</td>
                <td>{{ date('d/m/Y H:i', strtotime($consulta->appointment)) }}</td>
                <td>{{ $consulta->name }} ({{ $consulta->nome_especialidade }})</td>
                <td>{{ $consulta->phone }}</td>
                <td>
                    <a href="/consulta/edit/{{$consulta->id}}"  class="btn btn-sm btn-info edit-btn"><ion-icon name="create-outline"></ion-icon>Editar</a>                         
                </td>                

            </tr>
        @endforeach             
        </tbody>
    </table>                
</div>
@endsection