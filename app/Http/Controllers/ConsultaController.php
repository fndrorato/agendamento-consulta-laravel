<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Especialidade;
use App\Models\Patient;
use App\Models\Consulta;

class ConsultaController extends Controller
{
    public function index() {

        $data   = DB::table('consultas')
        ->join('doctors', 'doctors.id', '=', 'consultas.doctor_id')
        ->join('patients', 'patients.id', '=', 'consultas.patient_id')
        ->join('especialidades', 'especialidades.id', '=', 'doctors.especialidade_id')
        ->select('doctors.name', 'especialidades.name as nome_especialidade', 'patients.*', 'consultas.*')
        ->get();

        return view('welcome', ['consultas' => $data]);
    }

    public function create() {
        $isEdit     = false;
        $doctor     = Doctor::all();
        $patient    = Patient::all();

        return view('consulta.create', ['isEdit' => $isEdit, 'doctors' => $doctor, 'patients' => $patient]);
    }  

    public function store(Request $request) {
        $consulta = new Consulta;

        $consulta->patient_id   = $request->patient_id;
        $consulta->doctor_id    = $request->doctor_id;
        $consulta->appointment   = $request->appointment;

        $consulta->save();

        return redirect('/')->with('msg', 'Consulta cadastrado com sucesso');
    }     
}
