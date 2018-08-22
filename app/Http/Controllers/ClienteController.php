<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;

class ClienteController extends Controller
{
	 /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

	
     public function index() {
        $clientes = Cliente::all();
        $total = Cliente::all()->count();
        return view('list-clientes', compact('clientes', 'total'));
    }

    public function create() {
        return view('include-cliente');
    }

    public function store(Request $request) {
        $client = new Cliente;
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->description = $request->description;
        $client->save();
        return redirect()->route('client.index')->with('message', 'Cliente criado com sucesso!');
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $client = Cliente::findOrFail($id);
        return view('alter-cliente', compact('client'));
    }

    public function update(Request $request, $id) {
        $client = Cliente::findOrFail($id); 
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->description = $request->description;
        $client->save();
        return redirect()->route('client.index')->with('message', 'Cliente alterado com sucesso!');
    }

    public function destroy($id) {
        $client = Cliente::findOrFail($id);
        $client->delete();
        return redirect()->route('client.index')->with('message', 'Cliente excluído com sucesso!');
    }
}
