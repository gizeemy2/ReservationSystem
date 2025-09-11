<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Customer;

class ReservationsController extends Controller
{
    public function index(Request $r)
    {
        $q = trim($r->get('q', ''));
        $reservations = Reservation::with('customer')
            ->when($q, fn ($qr) => $qr->where('code', 'like', "%$q%"))
            ->latest('id')->paginate(10)->withQueryString();

        return view('admin.reservations.index', compact('reservations', 'q'));
    }

    public function create()
    {
        $customers = Customer::orderBy('first_name')->get();
        return view('admin.reservations.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['code'] = uniqid('RSV-');

        Reservation::create($data);

        return redirect()->route('admin.reservations.index')->with('success', 'Rezervasyon oluşturuldu.');
    }

    public function edit(Reservation $reservation)
    {
        $customers = Customer::orderBy('first_name')->get(['id', 'first_name', 'last_name']);
        return view('admin.reservations.edit', compact('reservation', 'customers'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $data = $this->validateData($request);
        $reservation->update($data);

        return redirect()->route('admin.reservations.index')->with('status', 'Rezervasyon güncellendi.');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return back()->with('status', 'Rezervasyon silindi.');
    }

    /**
     * Ortak doğrulama metodu
     */
    protected function validateData(Request $request): array
    {
        return $request->validate([
            // Müşteri
            'customer_id'      => ['required', 'exists:customers,id'],
            'person_count'     => ['nullable', 'integer', 'min:1'],
            'segment'          => ['nullable', 'string'],
            'identity_number'  => ['nullable', 'string'],
            'passport_no'      => ['nullable', 'string'],
            'country'          => ['nullable', 'string'],

            // Otel
            'hotel_name'       => ['nullable', 'string'],
            'start_date'       => ['nullable', 'date'],
            'end_date'         => ['nullable', 'date', 'after_or_equal:start_date'],
            'night_count'      => ['nullable', 'integer'],
            'room_type'        => ['nullable', 'string'],
            'hotel_price'      => ['nullable', 'numeric'],
            'hotel_supplier'   => ['nullable', 'string'],
            'hotel_note'       => ['nullable', 'string'],

            // Uçak
            'flight_departure' => ['nullable', 'date'],
            'flight_return'    => ['nullable', 'date', 'after_or_equal:flight_departure'],
            'airline'          => ['nullable', 'string'],
            'pnr'              => ['nullable', 'string'],
            'baggage'          => ['nullable', 'string'],
            'flight_price'     => ['nullable', 'numeric'],
            'flight_supplier'  => ['nullable', 'string'],

            // Transfer
            'transfer_date'     => ['nullable', 'date'],
            'transfer_direction'=> ['nullable', 'string'],
            'transfer_price'    => ['nullable', 'numeric'],
            'transfer_supplier' => ['nullable', 'string'],

            // Sigorta
            'insurance_type'     => ['nullable', 'string'],
            'insurance_price'    => ['nullable', 'numeric'],
            'insurance_supplier' => ['nullable', 'string'],

            // eSIM
            'esim_package'     => ['nullable', 'string'],
            'esim_price'       => ['nullable', 'numeric'],
            'esim_supplier'    => ['nullable', 'string'],

            // Ödeme
            'service_fee_usd'  => ['nullable', 'numeric'],
            'total_usd'        => ['nullable', 'numeric'],
            'usd_to_try_rate'  => ['nullable', 'numeric'],
            'payment_type'     => ['nullable', 'string'],
            'payment_status'   => ['nullable', 'string'],

            // Genel
            'status'           => ['required', 'in:pending,confirmed,cancelled'],
            'note'             => ['nullable', 'string'],
        ]);
    }
}
