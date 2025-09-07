<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer; // Model adı Customer olsun
use Illuminate\Http\Request;


class CustomersController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->get('q', ''));
        $customers = Customer::query()
            ->when($q, fn($qr) =>
                $qr->where('first_name','like',"%$q%")
                   ->orWhere('last_name','like',"%$q%")
                   ->orWhere('email','like',"%$q%")
                   ->orWhere('phone','like',"%$q%")
            )
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.customers.index', compact('customers','q'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name'  => ['required','string','max:255'],
            'last_name'   => ['required','string','max:255'],
            'email'       => ['nullable','email','max:255'],
            'phone'       => ['nullable','string','max:255'],
            'passport_no' => ['nullable','string','max:255'],
            'country'     => ['nullable','string','max:255'],
            'tc_no'       => ['nullable','string','max:255'],
            'gender'      => ['nullable','in:male,female,other'],
            'dob'         => ['nullable','date'],
            'segment'     => ['required','in:res_premium,res_standard,heb_standard'], // enum’unla uyumlu tut
        ]);

        Customer::create($data);
        return redirect()->route('admin.customers.index')->with('status','Müşteri oluşturuldu.');
    }

    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'first_name'  => ['required','string','max:255'],
            'last_name'   => ['required','string','max:255'],
            'email'       => ['nullable','email','max:255'],
            'phone'       => ['nullable','string','max:255'],
            'passport_no' => ['nullable','string','max:255'],
            'country'     => ['nullable','string','max:255'],
            'tc_no'       => ['nullable','string','max:255'],
            'gender'      => ['nullable','in:male,female,other'],
            'dob'         => ['nullable','date'],
            'segment'     => ['required','in:res_premium,res_standard,heb_standard'],
        ]);

        $customer->update($data);
        return redirect()->route('admin.customers.index')->with('status','Müşteri güncellendi.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return back()->with('status','Müşteri silindi.');
    }
}
