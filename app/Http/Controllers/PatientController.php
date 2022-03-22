<?php

namespace App\Http\Controllers;

use App\Models\city;
use App\Models\patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

use function GuzzleHttp\Promise\all;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $patients = patient::withcount('permissions')->with('city')->get();
        return view('cms.patients.index', ['patients' => $patients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cities = city::where('active', '=', true)->get();
        return response()->view('cms.patients.create', ['cities' => $cities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([ طريقة form submit
        //     'f_name' => 'required|string|min:3|max:50',
        //     'l_name' => 'required|string|min:3|max:50',
        //     'national_num' => 'required|min:8|max:9',
        //     'ensurance_num' => 'required|min:11|max:12',
        //     'mobile' => 'min:9|max:10',
        //     'active' => 'nullable|string|in:on',
        //     'email' => 'required|email'


        // ]);
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
        //
        // $patient = new patient(); طريقة form submit
        // $patient->f_name = $request->input('f_name');
        // $patient->l_name = $request->input('l_name');
        // $patient->ensurance_num = $request->input('ensurance_num');
        // $patient->national_num = $request->input('national_num');
        // $patient->mobile = $request->input('mobile');
        // $patient->birth_date = $request->input('birth_date');
        // $patient->email = $request->input('email');
        // $patient->gender = $request->input('gender');
        // $patient->city_id = $request->input('city');
        // $patient->active = $request->has('active');
        // $isSaved = $patient->save();
        // if ($isSaved) {
        //     session()->flash('massege', __('massege/cms.create success'));
        //     return redirect()->back();
        // } else
        //     return redirect()->back();
        if (!$validator->fails()) {
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
            return response()->json(["massege" => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(patient $patient)
    {
        //
        $cities = city::where('active', '=', true)->get();
        return view('cms.patients.edit', ['patient' => $patient, 'cities' => $cities]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, patient $patient)
    {
        //
        $validator = validator($request->all(), [
            'f_name' => 'required|string|min:3|max:50',
            'l_name' => 'required|string|min:3|max:50',
            'ensurance_num' => 'required|min:11|max:12',
            'national_num' => 'required|min:8|max:9',
            'mobile' => 'min:9|max:10',
            'email' => 'required|email|unique:patients,email,' . $patient->id,
            'active' => 'nullable|string|in:on',
            'city_id' => 'required|numeric|exists:cities,id',
            'gender' => 'required|string|in:M,F'

        ]);
        if (!$validator->fails()) {
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
            $isSaved = $patient->save();
            return response()->json(["massege" => $isSaved ? "Updated successfully" : "update Faild"], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(["massege" => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(patient $patient)
    {
        //
        $deleted = $patient->delete();
        return response()->json(['massege' => $deleted ? "deleted successfully" : "delete faild"], $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
    public function editPatientPermission(Request $request, patient $patient)
    {
        $permissions = Permission::where('guard_name', '=', 'patient')->get();
        $patientPermissions = $patient->permissions;
        foreach ($permissions as $permission) {
            $permission->setAttribute('assignd', false);
            foreach ($patientPermissions as $patientPermission) {
                if ($patientPermission->id == $permission->id) {
                    $permission->setAttribute('assignd', true);
                }
            }
        }
        return response()->view('cms.patients.patient-permission', ['patient' => $patient, 'permissions' => $permissions]);
    }
    public function updatePatientPermission(Request $request, patient $patient)
    {
        $validator = validator($request->all(), [
            'permission_id' => 'required|numeric|exists:permissions,id',
        ]);
        if (!$validator->failed()) {
            $permissions = Permission::findOrFail($request->input('permission_id'));
            if ($patient->hasPermissionTo($permissions)) {
                $patient->revokePermissionTo($permissions);
            } else {
                $patient->givePermissionTo($permissions);
            }
            return response()->json(["massege" => "created permission"], Response::HTTP_OK);
        } else {
            return response()->json(["massege" => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }
}
