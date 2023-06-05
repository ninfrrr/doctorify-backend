<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateReviewRequest;
use Illuminate\Support\Facades\Auth;
use NaturalLanguage;

class ReviewController extends Controller
{
    public function fetch()
    {
        try {
            $review = Review::get();

            if ($review->count() < 1) {
                throw new Exception('Review not found!');
            }

            return ResponseFormatter::success($review, 'Review found!');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function fetchById()
    {
        try {
            $user = Auth::user();
            $review = Review::where('reviewer', $user->name)->get();

            if (!$review) {
                throw new Exception('Review not found!');
            }

            return ResponseFormatter::success($review, 'Review found!');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function fetchByDoctorId($id)
    {

        // TODO:
        try {
            $review = Review::where('doctor_id', $id)->get();

            if (!$review) {
                throw new Exception('Review not found!');
            }

            return ResponseFormatter::success($review, 'Review found!');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function create(CreateReviewRequest $request)
    {
        try {
            $naturalLanguage = NaturalLanguage::sentiment($request->text);

            if ($naturalLanguage['verdict'] == 'The sentiment of the given text is mostly negative') {
                $naturalLanguage['verdict'] = 'negative';
            } else if ($naturalLanguage['verdict'] == 'The sentiment of the given text is mostly positive') {
                $naturalLanguage['verdict'] = 'positive';
            } else {
                $naturalLanguage['verdict'] = 'neutral';
            }

            $review = Review::create([
                'doctor_id' => $request->doctor_id,
                'reviewer' => Auth::user()->name,
                'text' => $naturalLanguage['text'],
                'verdict' => $naturalLanguage['verdict'],
                'score' => $naturalLanguage['score'],
                'magnitude' => $naturalLanguage['magnitude'],
            ]);

            if (!$review) {
                throw new Exception('Review not created');
            }

            return ResponseFormatter::success($review, 'Review successfully created!');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }
}
