<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Patient;

class PatientController extends Controller
{
    public function index() {

        $patient = Patient::all();

        return view('patient.list', ['patients' => $patient]);
    }

    public function create() {
        $isEdit = false;
        $paciente  = new Patient();
        return view('patient.create', ['isEdit' => $isEdit, 'paciente' => $paciente]);
    }  
    
    public function store(Request $request) {
        $patient = new Patient;

        $patient->patient_name  = $request->patient_name;
        $patient->cpf           = $request->cpf;
        $patient->dateBirth     = $request->dateBirth;
        $patient->email         = $request->email;
        $patient->cep           = $request->cep;
        $patient->address       = $request->address;
        $patient->number        = $request->number;
        $patient->name_responsable    = $request->name_responsable;
        $patient->cpf_responsable     = $request->cpf_responsable;
        $patient->phone         = $request->phone;
        $patient->otherPhones   = $request->otherPhones;

        $patient->save();

        return redirect('/pacientes')->with('msg', 'Paciente cadastrado com sucesso');
    } 
    
    public function edit($id){

        $patient  = Patient::findOrFail($id);

        $isEdit = true;

        return view('patient.create', ['patient' => $patient, 'isEdit' => $isEdit ]);
    }   
    
    public function update(Request $request) { 

        $data   = $request->all();   

        // $data = new Patient;

        // $data->patient_name  = $request->patient_name;
        // $data->cpf           = $request->cpf;
        // $data->dateBirth     = $request->dateBirth;
        // $data->email         = $request->email;
        // $data->cep           = $request->cep;
        // $data->address       = $request->address;
        // $data->number        = $request->number;
        // $data->name_responsable    = $request->name_responsable;
        // $data->cpf_responsable     = $request->cpf_responsable;
        // $data->phone         = $request->phone;
        // $data->otherPhones   = $request->otherPhones;              

        Patient::findOrFail($request->id)->update($data);

        return redirect('/pacientes')->with('msg', 'Dados atualizados com sucesso!');

    }     
}
