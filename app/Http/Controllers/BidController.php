<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\User;

class BidController extends Controller
{
    /**
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function random($userId)
    {
        $rand = rand(0, 1000);
        $isWin = $rand % 2 == 0;
        $value = 0;

        $user = User::find($userId);

        if ($isWin) {
            if ($rand > 900) {
                $value = ($rand / 100) * 70;
            } elseif ($rand > 600) {
                $value = ($rand / 100) * 50;
            } elseif ($rand > 300) {
                $value = ($rand / 100) * 30;
            } else {
                $value = ($rand / 100) * 10;
            }
        }

        $user->history()->create([
            'user_id' => $userId,
            'value' => $value,
            'is_win' => $isWin,
        ]);

        return response()->json([
            'value' => $value,
            'isWin' => $isWin,
        ]);
    }

    /**
     * @param $userId
     * @return
     */
    public function history($userId)
    {
        $history = History::where('user_id', $userId)
            ->orderBy('id', 'DESC')
            ->take(3)
            ->get();

        $template = view('components.table', compact('history'))->render();

        return response()->json([
            'html' => $template
        ]);
    }
}
