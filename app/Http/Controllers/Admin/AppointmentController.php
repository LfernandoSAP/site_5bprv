<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AppointmentController extends Controller
{
    public function index(): View
    {
        return view('admin.appointments.index', [
            'appointments' => Appointment::query()->latest()->paginate(15),
            'stats' => [
                'total' => Appointment::count(),
                'pending' => Appointment::where('status', 'pending')->count(),
                'confirmed' => Appointment::where('status', 'confirmed')->count(),
            ]
        ]);
    }

    public function updateStatus(Request $request, Appointment $appointment): RedirectResponse
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        $appointment->update([
            'status' => $request->status,
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('status', 'Status do agendamento atualizado com sucesso.');
    }

    public function destroy(Appointment $appointment): RedirectResponse
    {
        $appointment->delete();
        return redirect()->route('admin.appointments.index')->with('status', 'Agendamento removido com sucesso.');
    }
}
