<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{

    public function __construct()
    {
        $this->returnUrl = "/hesabim";
    }

    public function index(): View
    {
        return view("frontend.account.index")->with("user", Auth::user());
    }

    public function updatePassword(CategoryRequest $request)
    {
        # Validation
        $request->validate([
            'password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->password, auth()->user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }

        User::where('user_id',auth()->user()->user_id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
    }
}
