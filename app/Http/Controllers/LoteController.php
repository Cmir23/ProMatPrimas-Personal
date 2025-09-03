<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class LoteController extends Controller
{
    /**
     * Mostrar lista de lotes
     */
    public function index(): View
    {
        $lotes = Lote::latest()->paginate(10);
        return view('lotes.index', compact('lotes'));
    }

    /**
     * Mostrar formulario para crear nuevo lote
     */
    public function create(): View
    {
        return view('lotes.create');
    }

    /**
     * Guardar nuevo lote
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'codigo_lote' => 'required|string|max:50|unique:lotes',
            'tipo_cultivo' => 'required|string|max:100',
            'variedad' => 'nullable|string|max:100',
            'fecha_cosecha' => 'required|date',
            'cantidad_kg' => 'required|numeric|min:0',
            'ubicacion_origen' => 'required|string|max:200',
            'estado' => 'required|in:cosechado,procesando,almacenado,entregado',
            'observaciones' => 'nullable|string',
            'responsable' => 'required|string|max:100',
            'precio_kg' => 'nullable|numeric|min:0'
        ]);

        Lote::create($request->all());

        return redirect()->route('lotes.index')
            ->with('success', 'Lote creado exitosamente.');
    }

    /**
     * Mostrar detalles del lote
     */
    public function show(Lote $lote): View
    {
        return view('lotes.show', compact('lote'));
    }

    /**
     * Mostrar formulario para editar lote
     */
    public function edit(Lote $lote): View
    {
        return view('lotes.edit', compact('lote'));
    }

    /**
     * Actualizar lote
     */
    public function update(Request $request, Lote $lote): RedirectResponse
    {
        $request->validate([
            'codigo_lote' => 'required|string|max:50|unique:lotes,codigo_lote,'.$lote->id,
            'tipo_cultivo' => 'required|string|max:100',
            'variedad' => 'nullable|string|max:100',
            'fecha_cosecha' => 'required|date',
            'cantidad_kg' => 'required|numeric|min:0',
            'ubicacion_origen' => 'required|string|max:200',
            'estado' => 'required|in:cosechado,procesando,almacenado,entregado',
            'observaciones' => 'nullable|string',
            'responsable' => 'required|string|max:100',
            'precio_kg' => 'nullable|numeric|min:0'
        ]);

        $lote->update($request->all());

        return redirect()->route('lotes.index')
            ->with('success', 'Lote actualizado exitosamente.');
    }

    /**
     * Eliminar lote
     */
    public function destroy(Lote $lote): RedirectResponse
    {
        $lote->delete();

        return redirect()->route('lotes.index')
            ->with('success', 'Lote eliminado exitosamente.');
    }

    /**
     * Buscar lotes
     */
    public function search(Request $request): View
    {
        $query = Lote::query();

        if ($request->filled('codigo_lote')) {
            $query->where('codigo_lote', 'like', '%' . $request->codigo_lote . '%');
        }

        if ($request->filled('tipo_cultivo')) {
            $query->byTipoCultivo($request->tipo_cultivo);
        }

        if ($request->filled('estado')) {
            $query->byEstado($request->estado);
        }

        $lotes = $query->latest()->paginate(10);
        
        return view('lotes.index', compact('lotes'));
    }
}