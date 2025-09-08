<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\Payment;


class DashboardController extends Controller
{
   
    public function index()
    {
        $totalCustomers = Customer::count();
        $activeReservations = Reservation::where('status', 'confirmed')->count();
        $monthlyRevenue = Payment::whereMonth('created_at', now()->month)->sum('amount_paid');

        $recentReservations = Reservation::with('customer')
            ->latest()
            ->take(5)
            ->get();
        
        // Yeni: dönüşüm oranı hesaplama
        $totalReservations = Reservation::count();
        $confirmedReservations = $activeReservations;

        $conversionRate = $totalReservations > 0
        ? round(($confirmedReservations / $totalReservations) * 100, 1)
        : 0;

        return view('admin.dashboard', compact(
            'totalCustomers',
            'activeReservations',
            'monthlyRevenue',
            'recentReservations',
            'conversionRate'
        ));
    }
}
