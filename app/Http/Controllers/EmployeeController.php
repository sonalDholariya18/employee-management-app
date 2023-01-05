<?php

namespace App\Http\Controllers;

use App\Http\Repositories\PermanentAddressRepository;
use App\Http\Requests\EmployeeStoreRequest;
use App\Models\Employee;
use App\Http\Services\Employee\EmployeeService;
use App\Http\Services\Employee\RoleService;
use App\Http\Services\Employee\EmployeeRoleAssociationService;

class EmployeeController extends Controller
{
    /** @var RoleService */
    private $service;
    private $roleService;
    private $employeeRoleAssociationService;
    private $permanentAddressRepository;

    public function __construct(
        EmployeeService $service,
        RoleService $roleService,
        EmployeeRoleAssociationService $employeeRoleAssociationService,
        PermanentAddressRepository $permanentAddressRepository
    ) {
        $this->service = $service;
        $this->roleService = $roleService;
        $this->employeeRoleAssociationService = $employeeRoleAssociationService;
        $this->permanentAddressRepository = $permanentAddressRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = $this->service->getEmployees();

        return view('Employee.index', compact('employees'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = [];
        $roles = $this->roleService->getAllRoles();

        return view('Employee.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeStoreRequest $request)
    {
        if (!isset($request->is_same_add) && $request->p_address == null) {
            $this->validate($request, [
                'p_address'=>'required|string',
            ], [
                'p_address.required' => 'Permanent Address required',
            ]);
        }

        $this->service->create($request);
        return $this->redirectToPage('employee.index', 'Employee created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $roles = $permanentAddress =  $empRolesArrKey = [];
        if ($employee->is_same_add == 0) {
            $permanentAddress = $this->permanentAddressRepository->getEmpAddress($employee->id);
        } else {
            $permanentAddress = ['address'=>''];
        }

        $roles = $this->roleService->getAllRoles();

        $empRoles = $this->employeeRoleAssociationService->getRolesForSelectedEmployee($employee->id);
        foreach ($empRoles as $empRole) {
            array_push($empRolesArrKey, $empRole['id']);
        }

        return view('Employee.edit', compact('employee', 'roles', 'empRolesArrKey', 'permanentAddress'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeStoreRequest $request, Employee $employee)
    {
        if (!isset($request->is_same_add) && $request->p_address == null) {
            $this->validate($request, [
                'p_address'=>'required|string',
            ], [
                'p_address.required' => 'Permanent Address required',
            ]);
        }

        $this->service->update($request, $employee);
        return $this->redirectToPage('employee.index', 'Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $empImage = $this->service->getImageByEmpId($employee->id);

        if (isset($empImage['profile_image_name']) && $empImage['profile_image_name'] !== "") {
            $image_path = public_path('/images/profile/'). $empImage['profile_image_name'];
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }

        $this->service->deleteEmp($employee->id);
        return $this->redirectToPage('employee.index', 'Employee deleted successfully');
    }

    public function redirectToPage($page, $message)
    {
        return redirect()->route($page)
                        ->with('success', $message);
    }
}
