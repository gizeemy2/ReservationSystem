<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier; 

class SuppliersController extends Controller
{
    public function index(Request $r)
    {
        $q = trim($r->get('q',''));
        $suppliers = Supplier::query()
            ->when($q, fn($qr)=>$qr->where('name','like',"%$q%")->orWhere('email','like',"%$q%"))
            ->latest('id')->paginate(10)->withQueryString();

        return view('admin.suppliers.index', compact('suppliers','q'));
    }

    public function create()
    {
        // create view'a $supplier GÖNDERME!
        return view('admin.suppliers.create');
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'name'  => ['required','string','max:255'],
            'email' => ['nullable','email','max:255'],
            'phone' => ['nullable','string','max:255'],
        ]);

        Supplier::create($data);
        return redirect()->route('admin.suppliers.index')->with('status','Tedarikçi oluşturuldu.');
    }

    public function edit(Supplier $supplier) // <-- route model binding
    {
        // BURASI KRİTİK: edit view'a $supplier gönder
        return view('admin.suppliers.edit', compact('supplier'));
    }

    public function update(Request $r, Supplier $supplier)
    {
        $data = $r->validate([
            'name'  => ['required','string','max:255'],
            'email' => ['nullable','email','max:255'],
            'phone' => ['nullable','string','max:255'],
        ]);

        $supplier->update($data);
        return redirect()->route('admin.suppliers.index')->with('status','Tedarikçi güncellendi.');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return back()->with('status','Tedarikçi silindi.');
    }
}
