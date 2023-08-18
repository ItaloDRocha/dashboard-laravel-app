<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserData;

class AlterarValores extends Controller
{
    //

    public function alterarValor(Request $request)
    {
        if (auth()->check()) {

            // Caso usuario estiver logado, faz as alterações direto no banco de dados conectado

            $id_user = auth()->user()->id;

            $retorno = UserData::where('user_id', $id_user)->update($request->except('_method', '_token'));

            if ($retorno == 1) {
                return redirect()->route('admindashboard')->with(['message' => 'Dados alterados com sucesso!']);
            }
            return redirect()->route('admindashboard')->with(['message' => 'Nenhum dado alterado!']);
        }

        // Caso for um usuario teste, faz as alterações no arquivo json

        $json_data =  json_encode($request->except('_method', '_token'), JSON_PRETTY_PRINT);
        $json_return = file_put_contents('..\resources\json\guestData.json', $json_data);

        if($json_return != false){
            return redirect()->route('guestdashboard')->with(['message' => 'Dados alterados com sucesso!']);
        }
        return redirect()->route('guestdashboard')->with(['message' => 'Nenhum dado alterado!']);
        
    }
}
