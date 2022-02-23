<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WalletFollowing;

class WalletFollowingController extends Controller
{
    public function index()
    {
        $wallet_following = WalletFollowing::all();
        if ($wallet_following)
            return response()->json(['success' => true, 'wallet_following' => $wallet_following]);
        else
            return response()->json(['success' => false]);
    }

    public function create(Request $request)
    {

        $wallet_following = WalletFollowing::create([
            'name' => $request->name,
            'user_id' => $request->user_id,
            'wallet' => $request->wallet,
            'notification_type' => $request->notification_type,
            'priority' => $request->priority
        ]);
        if ($wallet_following)
            return response()->json(['success' => true]);
        else
            return response()->json(['success' => false]);
    }

    public function read($id)
    {
        $wallet_following = WalletFollowing::where('id', $id)->whereNull('deleted_at')->get();

        if ($wallet_following)
            return response()->json(['success' => true, 'wallet_following' => $wallet_following]);
        else
            return response()->json(['success' => false]);
    }

    public function update(Request $request, $id)
    {

        $result = WalletFollowing::where('id', $id)->whereNull('deleted_at')->update([
            'name' => $request->name,
            'user_id' => $request->user_id,
            'wallet' => $request->wallet,
            'notification_type' => $request->notification_type,
            'priority' => $request->priority
        ]);

        if ($result)
            return response()->json(['success' => true]);
        else
            return response()->json(['success' => false]);
    }

    public function delete($id)
    {

        $result = WalletFollowing::find($id)->delete();

        if ($result)
            return response()->json(['success' => true]);
        else
            return response()->json(['success' => false]);
    }
}
