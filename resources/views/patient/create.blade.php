@extends('layouts.main')

@section('title', 'Pacientes')

@section('content')
<div class="col-md-6 offset-md-3 mt-2">
    @if($isEdit)
        @php
            $textButton = "Atualizar Dados";
        @endphp
        
        <h3>Editando: {{ $patient->patient_name }}</h3>
        <form action="/pacientes/update/{{ $patient->id }}" method="POST">    
        @csrf
        @method('PUT')
    @else
        @php
            $textButton = "Cadastrar Paciente";
        @endphp    
        <h3>Cadastro de Novo Paciente</h3>
        <form action="/pacientes" method="POST">    
        @csrf
    @endif    


        <div class="form-group">
            <label for="patient_name">Nome:</label>
            <input type="text" value="{{ $patient->patient_name }}" class="form-control" id="patient_name" name="patient_name" placeholder="Nome do Paciente">
        </div>  

        <div class="form-group">
            <label for="cpf">CPF:</label>
            <input type="text" value="{{ $patient->cpf }}" class="form-control" id="cpf" name="cpf" placeholder="CPF do Paciente">
        </div> 
        
        <div class="form-group">
            <label for="dateBirth">Data de Nascimento:</label>
            <input type="date" value="{{$patient->dateBirth->format('Y-m-d')}}" class="form-control" id="dateBirth" name="dateBirth" placeholder="dd/mm/aaaa">
            <!-- <input type="hidden" value="" class="form-control" id="idade" name="idade" > -->
        </div> 
        
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="text" value="{{ $patient->email }}" class="form-control" id="email" name="email" placeholder="E-mail">
        </div> 
        
        <div class="form-group">
            <label for="cep">CEP:</label>
            <input type="text" value="{{ $patient->cep }}"  class="form-control" id="cep" name="cep" onblur="pesquisacep(this.value);" placeholder="Digite o CEP da residência">
        </div> 
        
        <div class="form-group">
            <label for="address">Endereço:</label>
            <input type="text" value="{{ $patient->address }}" class="form-control" id="address" name="address" placeholder="Endereço">
        </div> 

        <div class="form-group">
            <label for="number">Número:</label>
            <input type="text" value="{{ $patient->number }}" class="form-control" id="number" name="number" placeholder="Endereço Número">
        </div>         
        
        <div class="form-group">
            <label for="name_responsable">Nome Responsável:</label>
            <input type="text" value="{{ $patient->name_responsable }}" class="form-control" id="name_responsable" name="name_responsable" placeholder="Nome do Responsável" disabled>
        </div>  
        
        <div class="form-group">
            <label for="cpf_responsable">CPF Responsável:</label>
            <input type="text" value="{{ $patient->cpf_responsable }}" class="form-control" id="cpf_responsable" name="cpf_responsable" placeholder="CPF do Responsável" disabled>
        </div>    
        
        <div class="form-group field_wrapper">
            <label for="phone">Telefone:</label>
            <input type="text" value="{{ $patient->phone }}" class="form-control" id="phone" name="phone" placeholder="(00) 99999-9999">
            <a href="javascript:void(0);" class="add_button" title="Add field"><img src="/img/add-icon.png"/></a>
        </div>        
        @foreach ($patient->otherPhones as $otherPhones)
        <div class="form-group field_wrapper">
            <input type="text" name="otherPhones[]" id="otherPhones[]" class="form-control" value="{{ $otherPhones }}" placeholder="(00) 99999-9999"/>
            <a href="javascript:void(0);" class="remove_button">
                <img src="/img/remove-icon.png"/>
            </a>
        </div>
            
        @endforeach 
  
        
        
        <input type="submit" class="btn btn-primary mt-2" value="{{ $textButton }}">
    </form>
</div>



<script>
    $(document).ready(function(){
        
        var addButton = $('.add_button');   //Add button selector
        var wrapper = $('.field_wrapper');  //Input field wrapper
        var fieldHTML = '<div class="form-group field_wrapper"><input type="text" name="otherPhones[]" id="otherPhones[]" class="form-control" value="" placeholder="(00) 99999-9999"/><a href="javascript:void(0);" class="remove_button"><img src="/img/remove-icon.png"/></a></div>'; 
        var x = 1; //Initial field counter is 1
        
        //Once add button is clicked
        $(addButton).click(function(){
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        });
        
        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });

    document.getElementById("dateBirth").addEventListener('change', function() {
        var data = new Date(this.value);
        if(isDate_(this.value) && data.getFullYear() > 1900) {
            //document.getElementById("idade").value = calculateAge(this.value);
            
            if (calculateAge(this.value) < 18) {
                document.getElementById('name_responsable').disabled = false;
                document.getElementById('cpf_responsable').disabled = false;
            } else {
                document.getElementById('name_responsable').disabled = true;
                document.getElementById('cpf_responsable').disabled = true;            
            }            
        }
            
    });

    function calculateAge(dobString) {
        var dob = new Date(dobString);
        var currentDate = new Date();
        var currentYear = currentDate.getFullYear();
        var birthdayThisYear = new Date(currentYear, dob.getMonth(), dob.getDate());
        var age = currentYear - dob.getFullYear();
        if(birthdayThisYear > currentDate) {
            age--;
        }
        return age;
    }

    function calcular(data) {
        var data = document.form.dateBirth.value;
        
        var partes = data.split("/");
        var junta = partes[2]+"-"+partes[1]+"-"+partes[0];
        document.form.idade.value = (calculateAge(junta));
        console.log(calculateAge(junta))
    }

    var isDate_ = function(input) {
            var status = false;
            if (!input || input.length <= 0) {
            status = false;
            } else {
            var result = new Date(input);
            if (result == 'Invalid Date') {
                status = false;
            } else {
                status = true;
            }
            }
            return status;
    }    

    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('address').value=("");
            document.getElementById('number').value=("");

    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('address').value=(conteudo.logradouro);

        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('address').value="...";
                document.getElementById('number').value="...";


                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };

    </script>

@endsection