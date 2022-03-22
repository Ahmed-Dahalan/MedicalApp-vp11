<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    //
    public function showLoginVeiw(Request $request)
    {
        $request->merge(['guard' => $request->guard]);
        $validator = validator($request->all(), [
            'guard' => 'string|in:admin,patient',
        ]);

        session()->put('guard', $request->input('guard'));
        if (!$validator->fails()) {
            return response()->view('cms.auth.login');
        } else {
            abort(Response::HTTP_NOT_FOUND, 'the page not found');
        }
    }


    public function login(Request $request)
    {
        $validator = validator($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:3',
            'remember' => 'required|boolean'
        ]);
        $guard = session()->get('guard');
        if (!$validator->fails()) {
            $crednetials = ['email' => $request->input('email'), 'password' => $request->input('password')];
            if (Auth::guard($guard)->attempt($crednetials, $request->input('remember'))) {
                return response()->json(['massege' => 'login succsess'], Response::HTTP_OK);
            } else {
                return response()->json(
                    ['massege' => 'login faild'],
                    Response::HTTP_BAD_REQUEST
                );
            }
        } else {
            return response()->json(
                ['massege' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }
    public function logout(Request $request)
    {
        $guard = session()->get('guard');
        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        return redirect()->route('auth.login', $guard);
    }
}
