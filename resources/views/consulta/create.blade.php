@extends('layouts.main')

@section('title', 'Adicionar Novo Profissional')

@section('content')
<div class="col-md-6 offset-md-3 mt-2">
        @php
            $textButton = "Registrar Consulta";
        @endphp    
        <h3>Registrar Nova Consulta</h3>
        <form action="/consulta" method="POST">    
        @csrf


        <div class="form-group">
            <label for="name">Paciente:</label>
            <select name="patient_id" id="patient_id" class="form-control">
                    <option value="" selected>Selecione um paciente</option>
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}"> {{ $patient->patient_name }} </option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label for="name">Profissional:</label>
            <select name="doctor_id" id="doctor_id" class="form-control">
            </select>
        </div>        

        <div class="form-group">
            <label for="appointment">Data e Hora da Consulta:</label>
            <input type="datetime-local" value="" class="form-control" id="appointment" name="appointment">
        </div> 

  
        
        
        <input type="submit" class="btn btn-primary mt-2" value="{{ $textButton }}">
    </form>
</div>

<!-- Script -->
<script type='text/javascript'>

$(document).ready(function(){

  // Department Change
  $('#patient_id').change(function(){

     // Department id
     var id = $(this).val();

     // Empty the dropdown
     //$('#doctor_id').find('option').not(':first').remove();
     $('#doctor_id').find('option').remove();

     // AJAX request 
     $.ajax({
       url: '/profissional/'+id,
       type: 'get',
       dataType: 'json',
       success: function(response){

         var len = 0;
        
         if(response['data'] != null){
           len = response['data'].length;
         }
        
         if(len > 0){
           // Read data and create <option >
           for(var i=0; i<len; i++){

             var id = response['data'][i].id;
             var name = response['data'][i].name + " (" + response['data'][i].nome_especialidade + ")";

             var option = "<option value='"+id+"'>"+name+"</option>"; 

             $("#doctor_id").append(option); 
           }
         }

       }
    });
  });

});

</script>

@endsection