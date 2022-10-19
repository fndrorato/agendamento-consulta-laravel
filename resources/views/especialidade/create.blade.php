@extends('layouts.main')

@section('title', 'Criar Nova Especialidade')

@section('content')
<div class="col-md-6 offset-md-3 mt-2">
    @if($isEdit)
        @php
            $textButton = "Salvar Especialidade";
        @endphp
        
        <h3>Editando: {{ $especialidade->name }}</h3>
        <form action="/especialidade/update/{{ $especialidade->id }}" method="POST">    
        @csrf
        @method('PUT')
    @else
        @php
            $textButton = "Criar Especialidade";
        @endphp    
        <h3>Criando Nova Especialidade Médica</h3>
        <form action="/especialidade" method="POST">    
        @csrf
    @endif

        <div class="form-group">
            <label for="name">Nome da Especialidade:</label>
            <input type="text" value="{{ $especialidade->name }}" class="form-control" id="name" name="name" placeholder="Nome da Especialidade">
        </div>  
        <div class="form-group">
            <label for="isForChild">É Pediatria?</label>
            <select name="isForChild" id="isForChild" class="form-control">
                <option value="0">Não</option>
                <option value="1"  {{ $especialidade->isForChild == 1 ? "selected='selected'" : "" }}>Sim</option>
            </select>
        </div>  
        
        
        <input type="submit" class="btn btn-primary mt-2" value="{{ $textButton }}">
    </form>
</div>


@endsection