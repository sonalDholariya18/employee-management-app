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
     * @var EmployeeRepository
     */
    protected $repository;

    protected $addressRepository;
    protected $employeeRoleAssociationRepository;


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
    ) {
        $this->repository = $employeeRepository;
        $this->addressRepository = $permanentAddressRepository;
        $this->employeeRoleAssociationRepository = $employeeRoleAssociationRepository;
    }

    /**
     * Get All Employee list
     * @return array
     */
    public function getEmployees():? array
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
     * Create a new employee
     * @param Request $request
     * @return void
    */
    public function create($request): void
    {
        $imageName = time().'.'.$request->profile_image_name->extension();
        $request->profile_image_name->move(public_path('images/profile'), $imageName);

        $emp = $this->repository
                    ->create([
                            'first_name' => $request->first_name,
                            'last_name' => $request->last_name,
                            'email' => $request->email,
                            'date_of_birth' => $request->date_of_birth,
                            'profile_image_name' => $imageName,
                            'current_address' => $request->current_address,
                            'is_same_address' => isset($request->is_same_add) ? 1 : 0,
                    ]);

        if (!isset($request->is_same_add) && $request->p_address != "") {
            $this->addressRepository->create(['emp_id' => $emp->id, 'address' => $request->p_address]);
        }

        if (!empty($request->roles)) {
            foreach ($request->roles as $role) {
                $this->employeeRoleAssociationRepository->create(['emp_id' => $emp->id, 'role_id' => $role]);
            }
        }
    }

     /**
     * @param Request $request
     * @param array @employee
     * @return void
     */
    public function update($request, $employee): void
    {
        $imageName = $employee->profile_image_name;

        if ($request->profile_image_name) {
            if (isset($employee->profile_image_name) && $employee->profile_image_name != "") {
                $image_path = public_path('/images/profile/'). $employee->profile_image_name;
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            $imageName = time().'.'.$request->profile_image_name->extension();
            $request->profile_image_name->move(public_path('images/profile'), $imageName);
        }

        $this->repository->update($employee->id, [
                                        'first_name' => $request->first_name,
                                        'last_name' => $request->last_name,
                                        'email' => $request->email,
                                        'date_of_birth' => $request->date_of_birth,
                                        'profile_image_name' => $imageName,
                                        'current_address' => $request->current_address,
                                        'is_same_address' => isset($request->is_same_add) ? 1 : 0
        ]);

        //Check the permanent address and update
        if (!isset($request->is_same_add) && $request->p_address != "" && $employee->p_address == null) {
            $this->addressRepository->create(['emp_id' => $employee['id'], 'address' => $request->p_address]);
        } elseif (!isset($request->is_same_add) &&
                    $request->p_address != "" &&
                    $employee->p_address != null
                ) {
            $this->addressRepository->update($employee['id'], ['address' => $request->p_address]);
        } elseif (!isset($employee->is_same_add) && isset($request->is_same_add)) {
            $this->addressRepository->delete($employee['id']);
        }

        //update employee role
        $this->employeeRoleAssociationRepository->delete($employee['id']);
        if (!empty($request->roles)) {
            foreach ($request->roles as $role) {
                $this->employeeRoleAssociationRepository->create(['emp_id' => $employee['id'], 'role_id' => $role]);
            }
        }
    }

    /**
     * delete employee
     * @param array $employee
     * @return void
     */
    public function deleteEmp($employee): void
    {
        $this->repository->delete($employee);
    }

    /**
     * Get employee image path
     * @param array $emp_id
     * @return array
     */
    public function getImageByEmpId($emp_id): array
    {
        return $this->repository->getImageByEmpId($emp_id);
    }
}
