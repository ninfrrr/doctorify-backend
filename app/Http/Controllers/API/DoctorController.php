<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;

class DoctorController extends Controller
{
    public function fetch()
    {
        try {
            $doctor = Doctor::get();

            if ($doctor->count() < 1) {
                throw new Exception('Doctor not found!');
            }

            return ResponseFormatter::success($doctor, 'Doctor found!');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function create(CreateDoctorRequest $request)
    {
        try {
            // Upload photo
            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('public/photos');
            }

            $doctor = Doctor::create([
                'name' => $request->name,
                'photo' => isset($path) ? $path : '',
                'location' => $request->location,
                'price' => $request->price,
                'specialist_id' => $request->specialist_id,
            ]);

            if (!$doctor) {
                throw new Exception('Doctor not created');
            }

            return ResponseFormatter::success($doctor, 'Doctor successfully created!');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function update(UpdateDoctorRequest $request, $id)
    {
        try {
            $doctor = Doctor::find($id);

            if (!$doctor) {
                throw new Exception('Doctor not found');
            }

            // Upload photo
            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('public/photos');
            }

            $doctor->update([
                'name' => $request->name,
                'photo' => isset($path) ? $path : $doctor->photo,
                'location' => $request->location,
                'price' => $request->price,
                'specialist_id' => $request->specialist_id,
                'review' => $request->review,
                'star' => $request->star,
                'total_review' => $request->total_review,
            ]);

            return ResponseFormatter::success($doctor, 'Doctor successfully edited');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function delete($id)
    {
        try {
            $doctor = Doctor::find($id);

            if (!$doctor) {
                throw new Exception('Doctor not found');
            }

            $doctor->delete();

            return ResponseFormatter::success($doctor, 'Doctor successfully deleted');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }
}
