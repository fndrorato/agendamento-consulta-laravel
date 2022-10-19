<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Especialidade;
use App\Models\User;

class EspecialidadeController extends Controller
{
    public function index() {

        $especialidade = Especialidade::all();

        return view('especialidade.list', ['especialidades' => $especialidade]);
    }

    public function create() {
        $isEdit = false;
        $especialidade  = new Especialidade();
        return view('especialidade.create', ['isEdit' => $isEdit, 'especialidade' => $especialidade]);
    }    

    public function store(Request $request) {
        $especialidade = new Especialidade;

        $especialidade->name    = $request->name;
        $especialidade->isForChild  = $request->isForChild;

        $especialidade->save();

        return redirect('/especialidade')->with('msg', 'Especialidade criada com sucesso');
    }

    public function edit($id){

        $especialidade  = Especialidade::findOrFail($id);

        $isEdit = true;

        return view('especialidade.create', ['especialidade' => $especialidade, 'isEdit' => $isEdit]);
    }  
    

    public function update(Request $request) {

        $data   = $request->all();

        Especialidade::findOrFail($request->id)->update($data);

        return redirect('/especialidade')->with('msg', 'Dados atualizados com sucesso!');

    }    
}
