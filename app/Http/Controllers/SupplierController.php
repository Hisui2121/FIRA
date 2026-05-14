<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Supplier;
use App\Helpers\AuditHelper;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'logo' => 'nullable|image|max:2048'
        ]);
    
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('suppliers', 'public');
        }
        
        Supplier::create($data);
       
        AuditHelper::log(
            'CREATE',
            'Suppliers',
            'Added supplier: ' . $supplier->name
        );
   
        return redirect()->route('suppliers.index');
    }

    public function show(Supplier $supplier)
    {
        return view('suppliers.show', compact('supplier'));

    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));

    }

    public function update(Request $request, Supplier $supplier)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'logo' => 'nullable|image|max:2048'
        ]);
    
        // If new logo uploaded
        if ($request->hasFile('logo')) {
    
            // delete old logo if exists
            if ($supplier->logo) {
                Storage::disk('public')->delete($supplier->logo);
            }
    
            $data['logo'] = $request->file('logo')->store('suppliers', 'public');
        }
    
        $supplier->update($data);


        AuditHelper::log(
            'UPDATE',
            'Suppliers',
            'Edited supplier: ' . $supplier->name
        );
    
        return redirect()->route('suppliers.show', $supplier)
            ->with('success', 'Supplier updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // delete logo file
    if ($supplier->logo) {
        Storage::disk('public')->delete($supplier->logo);
    }

    $supplier->delete();

    return redirect()->route('suppliers.index')
        ->with('success', 'Supplier deleted successfully.');
    }
}
