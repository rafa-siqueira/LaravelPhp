<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\jogo;

class jogosController extends Controller
{
    public function index()
    {
        $jogos = jogo::all();
        return view('jogos.index', compact('jogos'));
    }   
    
    public function create(){
        return view('jogos.create');
    }

    public function store(Request $request)
    {
        Jogo::create($request->all());
        return redirect()->route('jogos-index');
    }

    public function edit($id)
    {
        $jogos = Jogo::where('id',$id)->first();
        if(!empty($jogos))
        {
            return view('jogos.edit', ['jogos'=>$jogos]);
        }
        else
        {
            return redirect()->route('jogos-index');   
        }
    }

    public function update(Request $request, $id)
    {
        $data = [
            'nome' => $request->nome,
            'categoria' => $request->categoria,
            'ano_criacao' => $request->ano_criacao,
            'valor' => $request->valor
        ];
        Jogo::where('id',$id)->update($data);
        return redirect()->route('jogos-index');
    }

    public function destroy($id)
    {
        Jogo::where('id',$id)->delete();
        return redirect()->route('jogos-index');
    }
}
