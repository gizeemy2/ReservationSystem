<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation; 
use App\Models\Customer; 

class ReservationsController extends Controller
{
    
    public function index(Request $r){
        $q = trim($r->get('q',''));
        $reservations = Reservation::with('customer')
            ->when($q, fn($qr)=>$qr->where('code','like',"%$q%"))
            ->latest('id')->paginate(10)->withQueryString();
        return view('admin.reservations.index', compact('reservations','q'));
    }
    public function create()
{
    $customers = Customer::orderBy('first_name')->get();

    return view('admin.reservations.create', compact('customers'));
}
    public function store(Request $r){
        $data = $r->validate([
            'customer_id'=>['required','exists:customers,id'],
            'start_date' =>['nullable','date'],
            'end_date'   =>['nullable','date','after_or_equal:start_date'],
            'status'     =>['required','in:draft,pending,confirmed,cancelled'],
            'code'       =>['nullable','string','max:255'],
            'notes'      =>['nullable','string'],
        ]);
        Reservation::create($data);
        return redirect()->route('admin.reservations.index')->with('status','Rezervasyon oluşturuldu.');
    }
    public function edit(Reservation $reservation){
        $customers = Customer::orderBy('first_name')->get(['id','first_name','last_name']);
        return view('admin.reservations.edit', compact('reservation','customers'));
    }
    public function update(Request $r, Reservation $reservation){
        $data = $r->validate([
            'customer_id'=>['required','exists:customers,id'],
            'start_date' =>['nullable','date'],
            'end_date'   =>['nullable','date','after_or_equal:start_date'],
            'status'     =>['required','in:draft,pending,confirmed,cancelled'],
            'code'       =>['nullable','string','max:255'],
            'notes'      =>['nullable','string'],
        ]);
        $reservation->update($data);
        return redirect()->route('admin.reservations.index')->with('status','Rezervasyon güncellendi.');
    }
    public function destroy(Reservation $reservation){
        $reservation->delete();
        return back()->with('status','Rezervasyon silindi.');
    }
}
