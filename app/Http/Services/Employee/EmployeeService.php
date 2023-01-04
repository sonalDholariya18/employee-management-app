<?php
namespace App\Http\Services\Employee;

use App\Http\Repositories\EmployeeRepository;
use App\Http\Repositories\EmployeeRoleAssociationRepository;
use App\Http\Repositories\PermanentAddressRepository;
use App\Http\Repositories\RoleRepository;

/**
 * Class EmployeeService
 * @package App\Http\Services\Employee
 */
class EmployeeService
{
   /**
     * @var RoleRepository
     */
    protected $repository;
    protected $addressRepository;
    protected $employeeRoleAssociationRepository;
    // protected $rolesRepository;


    /**
     * RoleService constructor
     *
     * @param EmployeeRepository $employeeRepository
     * @return void
     */
    public function __construct(
        EmployeeRepository $employeeRepository,
        PermanentAddressRepository $permanentAddressRepository,
        EmployeeRoleAssociationRepository $employeeRoleAssociationRepository
        // RoleRepository $roleRepository
    ) {
        $this->repository = $employeeRepository;
        $this->addressRepository = $permanentAddressRepository;
        $this->employeeRoleAssociationRepository = $employeeRoleAssociationRepository;
        // $this->rolesRepository = $roleRepository;
    }

    /**
     * Get All Employee list
     *
     */
    public function getEmployees()
    {
        $empDetails = [];
        $empData = $this->repository->getEmployeeList();
        foreach ($empData as $emp) {
            if (isset($emp['is_same_address']) && $emp['is_same_address'] == 0) {
                $getAddress = $this->addressRepository->getEmpAddress($emp['id']);
                if (!empty($getAddress)) {
                    $emp['pAddress'] = $getAddress['address'];
                }
            }

            $roles = $this->employeeRoleAssociationRepository->getEmpRoles($emp['id']);

            if (!empty($roles)) {
                $emp['roles'] = $roles;
            }
            array_push($empDetails, $emp);
        }
        return $empDetails;
    }

     /**
     * @param array $data
     * @throws ModelCreateErrorException
     */
    public function create($request)
    {
        $imageName = time().'.'.$request->profile_image_name->extension();


        $request->profile_image_name->move(public_path('images/profile'), $imageName);
        $emp = $this->repository->create([
                                        'first_name' => $request->first_name,
                                        'last_name' => $request->last_name,
                                        'email' => $request->email,
                                        'date_of_birth' => $request->date_of_birth,
                                        'profile_image_name' => $imageName,
                                        'current_address' => $request->current_address,
                                        'is_same_address' => isset($request->is_same_add) ? 1 : 0,
        ]);

        if (!isset($request->is_same_add) && $request->p_address != "") {
            $insertAdd = $this->addressRepository->create(['emp_id' => $emp->id, 'address' => $request->p_address]);
        }

        if (!empty($request->roles)) {
            foreach ($request->roles as $role) {
                $insertRole = $this->employeeRoleAssociationRepository->create(['emp_id' => $emp->id, 'role_id' => $role]);
            }
        }
    }


     /**
     * @param array $data
     * @throws ModelCreateErrorException
     */
    public function update($request, $employee)
    {
        $imageName = $employee->profile_image_name;

        if ($request->profile_image_name) {
            if (isset($employee->profile_image_name)) {
                $image_path = public_path('/images/profile/'). $employee->profile_image_name;
                if (file_exists($image_path)) {
                    //  unlink($image_path);
                }
            }
            $imageName = time().'.'.$request->profile_image_name->extension();
            $request->profile_image_name->move(public_path('images/profile'), $imageName);
        }

        $emp = $this->repository->update($employee->id, [
                                        'first_name' => $request->first_name,
                                        'last_name' => $request->last_name,
                                        'email' => $request->email,
                                        'date_of_birth' => $request->date_of_birth,
                                        'profile_image_name' => $imageName,
                                        'current_address' => $request->current_address,
                                        'is_same_address' => isset($request->is_same_add) ? 1 : 0
        ]);

        if (!isset($request->is_same_add) && $request->p_address != "" && $employee->p_address == null) {
            $this->addressRepository->create(['emp_id' => $employee['id'], 'address' => $request->p_address]);
        } else if (!isset($request->is_same_add) && $request->p_address != "" && $employee->p_address != null) {
            $this->addressRepository->update($employee['id'], ['address' => $request->p_address]);
        } else if (!isset($employee->is_same_add) && isset($request->is_same_add)) {
            $this->addressRepository->delete($employee['id']);
        }

        $deleteRoles = $this->employeeRoleAssociationRepository->delete($employee['id']);
        if (!empty($request->roles)) {
            foreach ($request->roles as $role) {
                $insertRole = $this->employeeRoleAssociationRepository->create(['emp_id' => $employee['id'], 'role_id' => $role]);
            }
        }
    }

    /**
     * delete role
     *
     */
    public function deleteEmp($emp)
    {
        $this->repository->delete($emp);
    }


}
