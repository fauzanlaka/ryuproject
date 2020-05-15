<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PostRating;

class PostRatingController extends Controller
{
    public function giveStar(Request $request)
    {
        $user_id = auth('api')->user()->id;
        $post_id = $request->post_id;
        $star = $request->star;
        //ตรวจสอบว่าผู้ใช้เคยให้คะแนน post นี้หรือยัง
        //ถ้าเคยแล้วให้อัพเดทคะแนน
        if(PostRating::where('user_id',$user_id)->where('post_id',$post_id)->exists()){
            $status = 'exist';
            PostRating::where('user_id',$user_id)
                ->where('post_id',$post_id)
                ->update([
                // 'user_id' => $user_id,
                // 'post_id' => $post_id,
                'star_rate' => $star,
            ]);
        }else{ //ถ้ายังไม่เคยแล้วให้เพิ่มคะแนน
            $status = 'not exist';
            PostRating::create([
                'user_id' => $user_id,
                'post_id' => $post_id,
                'star_rate' => $star,
            ]);
        }

        return [
            'user_id' => $user_id,
            'status' => $status,
            'star' => $star,
        ];
    }
}
