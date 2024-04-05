<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Instrutor;
use App\Http\Requests\StoreInstrutorRequest;
use App\Http\Requests\UpdateInstrutorRequest;
use GuzzleHttp\Psr7\Request;

class InstrutorController extends Controller
{
    public $instrutor;

    public function __construct(Instrutor $instrutor)
    {
        $this->instrutor = $instrutor;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instrutores = $this->instrutor->all();

        return response()->json($instrutores, 200);
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
        $request->validate($this->instrutor->Regras(), $this->instrutor->Feedback());

        $imagem = $request->file('foto');
        $imagem_url = $imagem->store('imagem', 'public');

        $instrutor = $this->instrutor->create([
            'nome' => $request->nome,
            'foto' => $imagem_url
        ]);

        return response()->json($instrutor, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $instrutor = $this->instrutor->find($id);

        if ($instrutor == null) {
            return response()->json(['erro' => 'Não existe dados para esse instrutor.'], 404);
        }

        return response()->json($instrutor, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $instrutor = $this->instrutor->find($id);

        if ($instrutor === null) {
            return response()->json(['erro' => 'Impossivel realizar a atualização. O instrutor não existe!'], 404);
        }

        $request->validate($this->instrutor->Regras(), $this->instrutor->Feedback());

        if ($request->file('foto')) {
            Storage::disk('public')->delete($instrutor->foto);
        }

        $imagem = $request->file('foto');
        $imagem_url = $imagem->store('imagem', 'public');

        $instrutor->update([
            'nome' => $request->nome,
            'foto' => $imagem_url
        ]);

        return response()->json($instrutor, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $instrutor = $this->instrutor->find($id);

        if ($instrutor === null) {
            return response()->json(['erro' => 'Impossivel deletar o instrutor. O instrutor não existe!'], 404);
        }

        Storage::disk('public')->delete($instrutor->foto);

        $instrutor->delete();
        return response()->json(['msg' => 'O registro foi removido com sucesso!'], 200);
    }
}
