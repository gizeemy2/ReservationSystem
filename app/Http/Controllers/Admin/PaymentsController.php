<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment; 
use App\Models\Reservation;
use App\Models\Customer;

class PaymentsController extends Controller
{
    public function index(Request $r){
        $q = trim($r->get('q',''));
        $payments = Payment::with('reservation')
            ->when($q, fn($qr)=>$qr->where('reference','like',"%$q%"))
            ->latest('id')->paginate(10)->withQueryString();
        return view('admin.payments.index', compact('payments','q'));
    }
    public function create()
    {
        $reservations = Reservation::orderBy('id', 'desc')->get();
        $customers = Customer::orderBy('first_name')->get();

        return view('admin.payments.create', compact('reservations', 'customers'));
    }
    public function store(Request $r){
        $data = $r->validate([
            'reservation_id'=>['required','exists:reservations,id'],
            'amount_usd'    =>['required','numeric','min:0'],
            'method'        =>['required','in:cash,card,wire,other'],
            'paid_at'       =>['required','date'],
            'reference'     =>['nullable','string','max:255'],
            'notes'         =>['nullable','string'],
        ]);
        Payment::create($data);
        return redirect()->route('admin.payments.index')->with('status','Ödeme eklendi.');
    }
    public function edit(Payment $payment){
        $reservations = Reservation::latest('id')->get(['id','code']);
        return view('admin.payments.edit', compact('payment','reservations'));
    }
    public function update(Request $r, Payment $payment){
        $data = $r->validate([
            'reservation_id'=>['required','exists:reservations,id'],
            'amount_usd'    =>['required','numeric','min:0'],
            'method'        =>['required','in:cash,card,wire,other'],
            'paid_at'       =>['required','date'],
            'reference'     =>['nullable','string','max:255'],
            'notes'         =>['nullable','string'],
        ]);
        $payment->update($data);
        return redirect()->route('admin.payments.index')->with('status','Ödeme güncellendi.');
    }
    public function destroy(Payment $payment){
        $payment->delete();
        return back()->with('status','Ödeme silindi.');
    }
}
