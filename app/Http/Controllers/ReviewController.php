<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $search = $request->input('search') ?? "";
        // if (!empty($search))
        // {
        //     $lstReview = Review::where('name', 'LIKE', "%$search%")->paginate(3);
        // }
        // else
        $lstReview = Review::paginate(3);
        $lstReview->appends($request->all());
        return view('Reviews.index', ['review' => $lstReview]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReviewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReviewRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReviewRequest  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return Redirect::route('reviews.index')->with('deleted', 'ok');
    }
    public function trash()
    {
        $lstReview = Review::onlyTrashed()->paginate(3);
        return view('Reviews.trash', ['review' => $lstReview]);
    }

    public function restore($id)
    {
        $lstReview = Review::withTrashed()->where('id', $id)->first();
        $lstReview->restore();
        return Redirect::route('reviews.trash')->with('restored', 'ok');
    }

    public function getReview($id)
    {
        $rv = Review::where('product_id', $id)->get();
        return response()->json($rv, 200);
    }
}
