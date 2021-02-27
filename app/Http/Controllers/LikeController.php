<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function actionLike(Request $request)
    {
        $restaurant_id = $request->id;
        $like = Like::where([['user_id', Auth::id()],['restaurant_id', $restaurant_id]])->first();


        if ($like)
        {
            $like->likeRestaurant();
        }
        else
        {
            $like = new Like([
                'user_id' => Auth::id(),
                'restaurant_id' => $restaurant_id,
                'like' => 1
            ]);
            $like->save();
        }

        return response()->json(['count_likes' => Like::where([['like', 1],['restaurant_id', $restaurant_id]])->count()]);
    }
}
