<?php

namespace App\Http\Controllers;
use App\Models\Customer;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
class CustomerController extends Controller
{
    /**
     * Mostrar el listado de clientes.
     */
    public function index()
    {
        $customers = Customer::orderBy('id', 'desc')->get();

        return view('customer.index', compact('customers'));
    }

    /**
     * Mostrar el formulario para registrar un cliente.
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Guardar un nuevo cliente.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ruc' => [
                'required',
                'string',
                'max:11',
                'unique:customers,ruc',
            ],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'nullable',
                'email',
                'max:255',
                'unique:customers,email',
            ],
            'phone' => [
                'nullable',
                'string',
                'max:15',
            ],
            'address' => [
                'nullable',
                'string',
                'max:255',
            ],
            'photo' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048',
            ],
            'status' => [
                'required',
                Rule::in(['active', 'inactive']),
            ],
        ]);

        // Guardar la fotografía, si se proporcionó.
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')
                ->store('customers', 'public');
        }

        Customer::create($validated);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Cliente registrado correctamente.');
    }

    /**
     * Mostrar un cliente.
     */
    public function show(string $id)
    {
    
    }

    /**
     * Mostrar el formulario para editar un cliente.
     */
    public function edit(string $id)
    {
        $customer = Customer::findOrFail($id);

        return view('customer.edit', compact('customer'));
    }

    /**
     * Actualizar un cliente.
     */
    public function update(Request $request, string $id)
    {
        $customer = Customer::findOrFail($id);

        $validated = $request->validate([
            'ruc' => [
                'required',
                'string',
                'max:11',
                Rule::unique('customers', 'ruc')
                    ->ignore($customer->id),
            ],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('customers', 'email')
                    ->ignore($customer->id),
            ],
            'phone' => [
                'nullable',
                'string',
                'max:15',
            ],
            'address' => [
                'nullable',
                'string',
                'max:255',
            ],
            'photo' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048',
            ],
            'status' => [
                'required',
                Rule::in(['active', 'inactive']),
            ],
        ]);

        $fotoAnterior = $customer->photo;

        // Guardar la nueva fotografía si se proporcionó.
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')
                ->store('customers', 'public');
        }

        $customer->update($validated);

        // Borrar la foto anterior después de actualizar el registro.
        if (
            $request->hasFile('photo') &&
            $fotoAnterior &&
            $fotoAnterior !== $customer->photo
        ) {
            Storage::disk('public')->delete($fotoAnterior);
        }

        return redirect()
            ->route('customers.index')
            ->with('success', 'Cliente actualizado correctamente.');
    }

    /**
     * Eliminar un cliente.
     */
    public function destroy(string $id)
    {
        $customer = Customer::findOrFail($id);
        $foto = $customer->photo;

        $customer->delete();

        if ($foto) {
            Storage::disk('public')->delete($foto);
        }

        return redirect()
            ->route('customers.index')
            ->with('success', 'Cliente eliminado correctamente.');
    }
}