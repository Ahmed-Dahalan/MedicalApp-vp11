<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Permission::class, 'permission');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $permissions = Permission::all();
        return response()->view('cms.permissions.index', ['permissions' => $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('cms.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $valedator = validator([
            'name' => 'required|string',
            'guard_name' => 'required|string|in:admin,patient'
        ]);
        if (!$valedator->fails()) {
            $permission = new Permission();
            $permission->name = $request->input('name');
            $permission->guard_name = $request->input('guard_name');
            $isSaved = $permission->save();
            return response()->json(["massege" => $isSaved ? "created successfully" : "created Faild"], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['messege' => $valedator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(permission $permission)
    {
        //
        return response()->view('cms.permissions.edit', ['permission' => $permission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, permission $permission)
    {
        //
        $valedator = validator([
            'name' => 'required|string',
            'guard_name' => 'required|string|in:admin,patient'
        ]);
        if (!$valedator->fails()) {
            $permission->name = $request->input('name');
            $permission->guard_name = $request->input('guard_name');
            $isSaved = $permission->save();
            return response()->json(["massege" => $isSaved ? "created successfully" : "created Faild"], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['messege' => $valedator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(permission $permission)
    {
        //
        $deleted = $permission->delete();
        return response()->json(["massege" => $deleted ? "deleted successfully" : "delete Faild"], $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
