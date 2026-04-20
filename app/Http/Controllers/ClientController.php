<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Client::query();

        $search = $request->get('search');
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama_client', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('nama_pic', 'like', '%' . $search . '%');
            });
        }

        $filterField = $request->get('filter_field');
        $filterValue = $request->get('filter_value');
        if ($filterField && $filterValue) {
            $query->where($filterField, 'like', '%' . $filterValue . '%');
        }

        $clients = $query->get();

        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_client' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:clients',
            'nama_pic' => 'required|string|max:255',
            'nomor_hp' => 'required|regex:/^08[0-9]{8,10}$/',
        ]);

        $validated['id_pkf'] = Client::generatePkfId();

        Client::create($validated);

        return redirect()->route('clients.index')->with('success', 'Client berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'nama_client' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:clients,email,' . $client->id,
            'nama_pic' => 'required|string|max:255',
            'nomor_hp' => 'required|regex:/^08[0-9]{8,10}$/',
        ]);

        $client->update($validated);

        return redirect()->route('clients.index')->with('success', 'Client berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Client berhasil dihapus');
    }
}
