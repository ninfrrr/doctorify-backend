<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateAppointmentRequest;

class AppointmentController extends Controller
{
    public function fetch()
    {
        try {
            $appointment = Appointment::get();

            if ($appointment->count() < 1) {
                throw new Exception('Appointment not found!');
            }

            return ResponseFormatter::success($appointment, 'Appointment found!');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function fetchById()
    {
        try {
            $user = Auth::user();
            $appointment = Appointment::where('user_id', $user->id)->get();

            if (!$appointment) {
                throw new Exception('Appointment not found!');
            }

            return ResponseFormatter::success($appointment, 'Appointment found!');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function create(CreateAppointmentRequest $request)
    {
        try {
            $appointment = Appointment::create([
                'user_id' => Auth::user()->id,
                'doctor_id' => $request->doctor_id,
                'subject' => $request->subject,
                'explanation' => $request->explanation,
                'date' => $request->date,
                'time' => $request->time,
                'location' => $request->location,
                'total_price' => $request->total_price,
            ]);

            if (!$appointment) {
                throw new Exception('Appointment not created');
            }

            return ResponseFormatter::success($appointment, 'Appointment successfully created!');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function accept($id)
    {
        try {
            $appointment = Appointment::find($id);

            if (!$appointment) {
                throw new Exception('Appointment not found');
            }

            $appointment->update([
                'status' => 'accept',
            ]);

            return ResponseFormatter::success($appointment, 'Appointment accepted!');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function reject($id)
    {
        try {
            $appointment = Appointment::find($id);

            if (!$appointment) {
                throw new Exception('Appointment not found');
            }

            $appointment->update([
                'status' => 'reject',
            ]);

            return ResponseFormatter::success($appointment, 'Appointment rejected!');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $appointment = Appointment::find($id);

            if (!$appointment) {
                throw new Exception('Appointment not found');
            }

            $appointment->delete();

            return ResponseFormatter::success($appointment, 'Appointment successfully deleted');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }
}
