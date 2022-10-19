@extends('layouts.main')

@section('title', 'Adicionar Novo Profissional')

@section('content')
<div class="col-md-6 offset-md-3 mt-2">
    @if($isEdit)
        @php
            $textButton = "Atualizar Dados";
        @endphp
        
        <h3>Editando: {{ $doctor->name }}</h3>
        <form action="/profissional/update/{{ $doctor->id }}" method="POST">    
        @csrf
        @method('PUT')
    @else
        @php
            $textButton = "Registrar Profissional";
        @endphp    
        <h3>Cadastro de Novo Profissional</h3>
        <form action="/profissional" method="POST">    
        @csrf
    @endif


        <div class="form-group">
            <label for="name">Nome da Profissional:</label>
            <input type="text" value="{{ $doctor->name }}" class="form-control" id="name" name="name" placeholder="Nome do Profissional">
        </div>  

        <div class="form-group">
            <label for="crm">Número do CRM:</label>
            <input type="number" value="{{ $doctor->crm }}" class="form-control" id="crm" name="crm" placeholder="Digite o CRM">
        </div> 

        <div class="form-group">
            <label for="especialidade">Especialidade</label>
            <select name="especialidade_id" id="especialidade_id" class="form-control">
                @foreach($especialidades as $especialidade)
                    @if($doctor->especialidade_id == $especialidade->id)
                        <option value="{{ $especialidade->id }}" selected> {{ $especialidade->name }} </option>
                    @else
                        <option value="{{ $especialidade->id }}"> {{ $especialidade->name }} </option>
                    @endif

                @endforeach
            </select>
        </div>  
        
        
        <input type="submit" class="btn btn-primary mt-2" value="{{ $textButton }}">
    </form>
</div>


@endsection