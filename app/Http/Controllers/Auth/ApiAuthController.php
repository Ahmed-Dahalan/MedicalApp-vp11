<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\patient;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthController extends Controller
{
    public function Login(Request $request)
    {
        $validator = validator($request->all(), [
            'email' => 'required|email|exists:patients,email',
            'password' => 'required|string|min:3'
        ]);
        if (!$validator->fails()) {
            $patient = patient::where('email', '=', $request->input('email'))->first();
            if (Hash::check($request->input('password'), $patient->password)) {
                $token =  $patient->createToken('patient-Api');
                $patient->setAttribute('token', $token->accessToken);
                $patient->load('city');
                return response()->json([
                    'message' => "Logged in successfully",
                    'data' => $patient,
                ]);
            } else {
                return response()->json(["messege" => 'Login faild , error password'], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json(["messege" => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }
    public function LoginPGCT(Request $request)
    {
        $validator = validator($request->all(), [
            'email' => 'required|email|exists:patients,email',
            'password' => 'required|string|min:3'
        ]);
        if (!$validator->fails()) {
            return $this->generatePGCT($request);
        } else {
            return response()->json(["messege" => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }
    private function generatePGCT(Request $request)
    {
        try {
            $response = Http::asForm()->post('http://medical.ad-dev.xyz/oauth/token', [
                'grant_type' => 'password',
                'client_id' => '2',
                'client_secret' => 'pbWwLhUWAkxTL2gvF869FlZRGAB1V9O8Y6q3I1I0',
                'username' => $request->input('email'),
                'password' => $request->input('password'),
                'scope' => '*'
            ]);
            $decodedResponse = json_decode($response);
            $patient = patient::where('email', '=', $request->input('email'))->first();
            $patient->setAttribute('token', $decodedResponse->access_token);
            return response()->json([
                'status' => true,
                'message' => 'Logged in successfully',
                'data' => $patient,
            ], Response::HTTP_OK);
        } catch (Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $decodedResponse->message,
            ], Response::HTTP_BAD_REQUEST);
        }
    }
    public function Logout(Request $request)
    {
        $guard = auth('patient-api')->check()?'patient':'admin';
        $token =  $request->user($guard)->token();
        $revoked = $token->revoke();
        return response()->json([
            'message' => $revoked ? 'Logged out successfully' : 'Logged out faild'
        ], $revoked ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
