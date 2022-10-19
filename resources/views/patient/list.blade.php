@extends('layouts.main')

@section('title', 'Lista de Pacientes')

@section('content')
<div class="col-md-12 p-2">
    <a href="/pacientes/create" class="btn btn-primary ">Adicionar Paciente</a>
</div>

<div class="bg-light p-5 rounded">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Telefone</th>
                <th scope="col">Data Nascimento</th>
                <th scope="col">Idade</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
        @foreach($patients as $patient)
            @php
                $dateOfBirth = $patient->dateBirth;
                $today = date("Y-m-d");
                $diff = date_diff(date_create($dateOfBirth), date_create($today));
                $age = $diff->format('%y');
            @endphp
                <tr>
                    <td scope="row">{{ $loop->index + 1 }}</td>
                    <td>{{ $patient->patient_name }}</td>
                    <td>{{ $patient->phone }}</td>
                    <td>{{ date('d/m/Y', strtotime($patient->dateBirth)) }}</td>
                    <td>{{ $age }}</td>
                    <td>
                        <a href="/pacientes/edit/{{$patient->id}}"  class="btn btn-sm btn-info edit-btn"><ion-icon name="create-outline"></ion-icon>Editar</a>                         
                    </td>
                </tr>
            @endforeach    
        </tbody>
    </table>                
</div>
@endsection