<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Models\Doctor;
use App\Models\Especialidade;
use App\Models\User;
use App\Models\Patient;

class DoctorController extends Controller
{
    public function index() {
//        $doctor = Doctor::all();

        $search    = request('search');

        if ($search) {
            $data   = DB::table('especialidades')
            ->join('doctors', 'especialidades.id', '=', 'doctors.especialidade_id')
            ->orWhere('doctors.name',  'like', '%'.$search.'%')
            ->orWhere('doctors.crm',  '=', ''.$search.'')
            ->orWhere('especialidades.name',  'like', '%'.$search.'%')
            ->select('doctors.*', 'especialidades.name as nome_especialidade')
            ->get();

        } else {
            $data   = DB::table('especialidades')
            ->join('doctors', 'especialidades.id', '=', 'doctors.especialidade_id')
            ->select('doctors.*', 'especialidades.name as nome_especialidade')
            ->get();

        }

        return view('doctor.list', ['doctors' => $data, 'search' => $search ]);        
    }

    public function create() {
        $isEdit = false;
        $doctor  = new Doctor();
        $especialidade  = Especialidade::all();

        return view('doctor.create', ['isEdit' => $isEdit, 'doctor' => $doctor, 'especialidades' => $especialidade]);
    }   
    
    public function store(Request $request) {
        $doctor = new Doctor;

        $doctor->name   = $request->name;
        $doctor->crm    = $request->crm;
        $doctor->especialidade_id   = $request->especialidade_id;

        $doctor->save();

        return redirect('/profissional')->with('msg', 'Profissional cadastrado com sucesso');
    }    

    public function edit($id){

        $doctor  = Doctor::findOrFail($id);
        $especialidade  = Especialidade::all();

        $isEdit = true;

        return view('doctor.create', ['doctor' => $doctor, 'isEdit' => $isEdit, 'especialidades' => $especialidade ]);
    }  
    
    public function update(Request $request) {

        $data   = $request->all();        

        Doctor::findOrFail($request->id)->update($data);

        return redirect('/profissional')->with('msg', 'Dados atualizados com sucesso!');

    }  
    
    public function getDoctorByAgePatient($patient_id) {
        //Dados do paciente
        $patient    = Patient::findOrFail($patient_id); 
        //Descobrindo a idade do paciente
        $dateOfBirth = $patient->dateBirth;
        $today  = date("Y-m-d");
        $diff   = date_diff(date_create($dateOfBirth), date_create($today));
        $age    = $diff->format('%y');   
        
        if ($age<=12) {
            //Pode consultar apenass com PEDIATRA
            $data['data']   = DB::table('especialidades')
            ->join('doctors', 'especialidades.id', '=', 'doctors.especialidade_id')
            ->orWhere('especialidades.isForChild',  '=', 1)
            ->select('doctors.*', 'especialidades.name as nome_especialidade')
            ->get();            
        } else {
            $data['data']   = DB::table('especialidades')
            ->join('doctors', 'especialidades.id', '=', 'doctors.especialidade_id')
            ->select('doctors.*', 'especialidades.name as nome_especialidade')
            ->get();          
        }

        return response()->json($data);
    }
}
