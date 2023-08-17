<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserData;

class AlterarValores extends Controller
{
    //

    public function alterarValor(Request $request)
    {
        $id_user = auth()->user()->id;
        
        $retorno = UserData::where('user_id', $id_user)->update($request->except('_method', '_token'));
        
        if ($retorno == 1){
            return redirect()->route('admindashboard')->with(['message' => 'Dados alterados com sucesso!']);
        }
        return redirect()->route('admindashboard')->with(['message' => 'Nenhum dado alterado!']);
    }
}
