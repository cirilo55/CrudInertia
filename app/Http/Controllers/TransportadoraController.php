<?php
namespace App\Http\Controllers;

use App\Models\Transportadora;
use App\Http\Requests\StoretransportadoraRequest;
use App\Http\Requests\UpdatetransportadoraRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TransportadoraController extends Controller
{
    public function index()
    {
        $transportadoras = Transportadora::all();
        return Inertia::render('Transportadora',['transportadoras' => $transportadoras]);
    }

    public function store(Request $request)
    {
        Transportadora::create($request->validate([
            'nome' => ['required', 'max:50'],
            'endereco' => ['required', 'max:50'],
            'bairro' => ['required', 'max:50'],
            'cidade' => ['required', 'max:50'],
            'uf' => ['required', 'max:50'],
            'limite_creditos' => ['max:50'],
            'data_analise_credito' => ['max:50']

        ]));

        return redirect()->route('transportadora')->with('success', 'Criado com sucesso.');
    }


    public function show($id)
    {
        $transportadora = Transportadora::find($id);

        if (!$transportadora) {
            return response()->json(['message' => 'Transportadora não encontrada'], 404);
        }

        return response()->json($transportadora);
    }

    public function update(Request $request,int $id)
    {
        $request->validate([
            'nome' => ['required', 'max:50'],
            'endereco' => ['required', 'max:50'],
            'bairro' => ['required', 'max:50'],
            'cidade' => ['required', 'max:50'],
            'uf' => ['required', 'max:50'],
            'limite_creditos' => ['max:50'],
            'data_analise_credito' => ['max:50']

        ]);

        $transportadora = Transportadora::find($id);
        $transportadora->update($request->all());
        return redirect()->route('transportadora')->with('success', 'Criado com sucesso.');
    }


    public function destroy($id)
    {
        $transportadora = Transportadora::find($id);

        if ($transportadora) {
            $transportadora->delete();
            return response()->json(['message' => 'Transportadora excluída com sucesso']);
        } else {
            return response()->json(['message' => 'Transportadora não encontrada'], 404);
        }
    }

}
