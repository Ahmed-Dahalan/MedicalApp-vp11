<?php

namespace App\Http\Controllers;

use App\Models\city;
use App\Models\patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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


    public function showRegisterVeiw(Request $request)
    {
        $request->merge(['guard' => $request->guard]);
        $validator = validator($request->all(), [
            // 'guard' => 'string|in:admin,patient',
        ]);

        session()->put('guard', $request->input('guard'));
        $cities = city::where('active','=',true)->get();
        if (!$validator->fails()) {
            return response()->view('cms.auth.register',['cities' => $cities]);
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


    public function Register(Request $request)
    {
        $validator = validator($request->all(), [
            'f_name' => 'required|string|min:3|max:50',
            'l_name' => 'required|string|min:3|max:50',
            'ensurance_num' => 'required|min:11|max:12',
            'national_num' => 'required|min:8|max:9',
            'mobile' => 'min:9|max:10',
            'email' => 'required|email|unique:patients',
            'active' => 'nullable|string|in:on',
            'city_id' => 'required|numeric|exists:cities,id',
            'gender' => 'required|string|in:M,F'

        ]);
        if (!$validator->fails()) {
            $patient = new patient();
            $patient = new patient();
            $patient->f_name = $request->input('f_name');
            $patient->l_name = $request->input('l_name');
            $patient->ensurance_num = $request->input('ensurance_num');
            $patient->national_num = $request->input('national_num');
            $patient->mobile = $request->input('mobile');
            $patient->birth_date = $request->input('birth_date');
            $patient->email = $request->input('email');
            $patient->gender = $request->input('gender');
            $patient->city_id = $request->input('city_id');
            $patient->active = $request->has('active');
            $patient->password = Hash::make(12345);
            $isSaved = $patient->save();
            return response()->json(["massege" => $isSaved ? "created successfully" : "created Faild"], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
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
