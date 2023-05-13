<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSpecialistRequest;
use App\Http\Requests\UpdateSpecialistRequest;
use App\Models\Specialist;
use Exception;
use Illuminate\Http\Request;

class SpecialistController extends Controller
{
    public function fetch()
    {
        try {
            $specialist = Specialist::get();

            if ($specialist->count() < 1) {
                throw new Exception('Specialist not found!');
            }

            return ResponseFormatter::success($specialist, 'Specialist found!');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function create(CreateSpecialistRequest $request)
    {
        try {
            $specialist = Specialist::create([
                'name' => $request->name,
                'fee' => $request->fee,
            ]);

            if (!$specialist) {
                throw new Exception('Specialist not created');
            }

            return ResponseFormatter::success($specialist, 'Specialist successfully created!');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function update(UpdateSpecialistRequest $request, $id)
    {
        try {
            $specialist = Specialist::find($id);

            if (!$specialist) {
                throw new Exception('Specialist not found');
            }

            $specialist->update([
                'name' => $request->name,
                'fee' => $request->fee,
            ]);

            return ResponseFormatter::success($specialist, 'Specialist successfully edited');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function delete($id)
    {
        try {
            $specialist = Specialist::find($id);

            if (!$specialist) {
                throw new Exception('Specialist not found');
            }

            $specialist->delete();

            return ResponseFormatter::success($specialist, 'Specialist successfully deleted');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }
}
