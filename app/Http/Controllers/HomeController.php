<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function changeMode(Request $request)
    {
        DB::beginTransaction();
        try {
            $setting = Setting::find(1);
            $setting->dark_mode = $request->dark_mode;
            $setting->save();
            DB::commit();
            return response()->json([
                'status' => 200,
                'data' => 'Mode berhasil diubah'
            ]);
        } catch (Exception $err) {
            DB::rollback();
            return response()->json([
                'status' => '500',
                'error' => $err->getMessage()
            ], 500);
        }
    }

    public function changeAvatar(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'avatar' => 'required|image',
            ]);

            $user = User::find(Auth::user()->id);
            if ($request->file('avatar')) {
                $user->photo = $this->getPathFile($request->file('avatar'), 'avatar');
            }
            $user->save();
            DB::commit();
            return response()->json([
                'status' => 200,
                'data' => 'Avatar berhasil diubah'
            ]);
        } catch (Exception $err) {
            DB::rollback();
            return response()->json([
                'status' => '500',
                'error' => $err->getMessage()
            ], 500);
        }
    }
}
