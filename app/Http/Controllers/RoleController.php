<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Services\Employee\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    /** @var RoleService */
    private $service;

    public function __construct(RoleService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $roles = $this->service->getRolesForEmployee();

        return view('Role.index', compact('roles'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleStoreRequest $request
     */
    public function store(RoleStoreRequest $request)
    {
        $this->service->createRole($request->all());

        return $this->redirectToPage('role.index', 'Role created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('Role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleStoreRequest $request, Role $role)
    {
        $this->service->updateRole($role, $request->all());

        return $this->redirectToPage('role.index', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // $getRole = $this->service->getEmployeesByRoleId($role); //Check if employee having this role

        $this->service->deleteRole($request);

        return $this->redirectToPage('role.index', 'Role deleted successfully');
    }

    public function redirectToPage($page, $message)
    {
        return redirect()->route($page)
                        ->with('success', $message);
    }
}
