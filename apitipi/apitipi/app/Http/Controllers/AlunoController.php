<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Aluno;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage as FacadesStorage;

class AlunoController extends Controller
{
    public $aluno;

    public function __construct(Aluno $aluno)
    {
        $this->aluno = $aluno;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $aluno = Aluno::all();

        $alunos = $this->aluno->all();

        return response()->json($alunos, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate($this->aluno->Regras(), $this->aluno->Feedback());

        $imagem = $request->file('foto');

        $imagem_url = $imagem->store('imagem', 'public');

        // dd($imagem_url);

        $alunos = $this->aluno->create([
            'nome' => $request->nome,
            'foto' => $imagem_url
        ]);


        return response()->json($alunos, 200);
        // permite criar dados no meu banco apartir daqui e do site, apenas preenchendo as lacunas
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        // return 'Cheguei aqui - SHOW';

        $alunos = $this->aluno->find($id);

        if ($alunos == null) {
            return response()->json(['erro' => 'Não existe dados para esse aluno.'], 404);
        }

        return response()->json($alunos, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */


    // public function edit(Aluno $aluno)
    // {

    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return 'Cheguei aqui - UPDATE';

        // print_r($request->all()); //NOVOS DATOS
        // echo 'hr';
        // print_r($aluno->getAttributes()); //ANTIGOS DADOS


        $alunos = $this->aluno->find($id);

        // dd($request->nome);
        // dd($request->file('foto'));

        if ($alunos === null) {
            return response()->json(['erro' => 'Impossivel realizar a atualização. O aluno não existe!'], 404);
        }

        if ($request->method() === 'PATCH') {

            $dadosDinamico = [];

            foreach ($alunos->Regras() as $input => $regra) {
                if (array_key_exists($input, $request->all())) {
                    $dadosDinamico[$input] = $regra;
                }
            }

            // dd($dadosDinamico);

            $request->validate($dadosDinamico, $this->aluno->Feedback());
        } else {

            $request->validate($this->aluno->Regras(), $this->aluno->Feedback());
        }

        if ($request->file('foto')) {
            Storage::disk('public')->delete($alunos->foto);
        }




        $imagem = $request->file('foto');
        $imagem_url = $imagem->store('imagem', 'public');

        // dd($imagem_url);

        $alunos->update([
            'nome' => $request->nome,
            'foto' => $imagem_url
        ]);

        return response()->json($alunos, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alunos = $this->aluno->find($id);

        if ($alunos === null) {
            return response()->json(['erro' => 'Impossivel deletar o aluno. O aluno não existe!'], 404);
        }

        Storage::disk('public')->delete($alunos->foto);

        $alunos->delete();
        return response()->json(['msg' => 'O registro foi removido com sucesso!'], 200);
    }
}
