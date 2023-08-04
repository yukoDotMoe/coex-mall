<?php

namespace App\Http\Controllers;

use App\Models\BaiViet;
use App\Models\ReactLike;
use App\Models\ReactVote;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function homeView()
    {
        return view('news');
    }

    public static function findPost($catName)
    {
        $posts = BaiViet::where('danh_muc', $catName);
        return $posts;
    }

    public function viewPost($id)
    {
        $post = BaiViet::where('post_id', $id)->first();
        return view('post', ['post' => $post]);
    }

    public function react(Request $request, $id)
    {
        $request->validate([
            'react' => 'required|numeric|min:1|max:2',
            'post_id' => 'required|string',
        ]);

        $reactType = $request->react;
        $post_id =  $request->post_id;

        $post = BaiViet::where('post_id', $post_id)->first();

        if (empty($post)) return ApiController::response(404, [], 'Không tìm thấy bài viết');

        $userCurrentVote = ReactVote::where([
            ['user_id', Auth::user()->id],
            ['post_id', $post_id]
        ])->whereDay('created_at', now()->day)->count();

        $userCurrentLike = ReactLike::where([
            ['user_id', Auth::user()->id],
            ['post_id', $post_id]
        ])->whereDay('created_at', now()->day)->count();

        if ($reactType == 2 && $userCurrentLike >= $post->limit_like)
        {
            return ApiController::response(401, [], 'Đã thao tác');
        }

        if ($reactType == 1 && $userCurrentVote >= $post->limit_vote)
        {
            return ApiController::response(401, [], 'Đã thao tác');
        }

        $react = Auth::user()->getReact($reactType);

        if (($react - 1) < 0) return ApiController::response(501, [],  ($reactType == 1) ? 'Hết lượt đánh giá.' : 'Hết lượt yêu thích.');

        $wallet = Auth::user()->getWallet();

        $wallet->changeIneract($reactType, 1, 'Thao tác với bài viết');

        $post = BaiViet::where('post_id', $id)->first();
        $post->increment(($reactType == 1) ? 'vote' : 'like', 1);
        if (empty($post->order) && $reactType == 1  ) $post->update(['order' => rand(3, 5)]);
        if ($reactType == 1)
        {
            $vote = new ReactVote();
            $vote->post_id = $post_id;
            $vote->user_id = Auth::user()->id;
            $vote->vote = $request->rating;
            $vote->created_at = Carbon::now();
            $vote->updated_at = Carbon::now();
            $vote->save();
            $wallet->changeMoney(10 * ApiController::getSetting('vote_bonus'), 'Thưởng thao tác', 1);
        }else{
            $likes = new ReactLike();
            $likes->post_id = $post_id;
            $likes->user_id = Auth::user()->id;
            $likes->likes = 1;
            $likes->created_at = Carbon::now();
            $likes->updated_at = Carbon::now();
            $likes->save();
            $wallet->changeMoney(10 * ApiController::getSetting('like_bonus'), 'Thưởng thao tác', 1);
        }

        return ApiController::response(200, [], 'Thao tác thành công');
    }

    public function buyReact(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'type' => 'required|numeric|min:1|max:2',
        ]);
        $typeNum =  $request->type;
        $typeText = ($typeNum == 1) ? 'Vote' : 'Like';
        $amount = $request->amount;

        $amountInBal = $amount * ApiController::getSetting('interact_rate');
        if ($amountInBal > Auth::user()->balance()) return ApiController::response(501, [], 'Số dư của bạn không đủ.');
        $wallet = Auth::user()->getWallet();
        $wallet->changeMoney($amountInBal, 'Mua thao tác');
        $wallet->changeIneract($typeNum, $amount, 'Mua thao tác', 1);

        return ApiController::response(200, [], 'Mua ' . $amount . ' ' . $typeText . ' thành công.');
    }
}
