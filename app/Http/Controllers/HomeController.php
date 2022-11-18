<?php

namespace App\Http\Controllers;

use App\Models\GeneratedUrl;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param $uri
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($uri)
    {
        $dateNow = Carbon::now();
        $generated = GeneratedUrl::where('uri', $uri)->first();

        if (!$generated) {
            abort(404);
        }
        if ($generated->is_expired || $dateNow->gt($generated->expiry_date)) {
            $generated->update(['is_expired' => true]);
            abort(419);
        }

        return view('home', compact('generated'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function register()
    {
        return view('register');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deactivate($id)
    {
        GeneratedUrl::find($id)->update([
            'is_expired' => 1
        ]);

        return redirect('/');
    }

    /**
     * @param $userId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function generateNewLink($userId)
    {
        $generatedUrl = GeneratedUrl::generateNewLinkForByUser(User::find($userId));

        return back()->with([
            'uri' => $generatedUrl->uri,
            'expiry_date' => $generatedUrl->expiry_date
        ]);
    }
}
