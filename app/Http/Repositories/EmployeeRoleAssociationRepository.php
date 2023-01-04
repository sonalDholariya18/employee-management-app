<?php

namespace App\Http\Repositories;

use App\Models\EmployeeRoleAssociation;

/**
 * Class EmployeeRoleAssociationRepository
 * @package App\Http\Repositories
 */
class EmployeeRoleAssociationRepository
{
    /**
     * @var Model|Builder
     */
    protected $model;

    /**
     * Class constructor
     *
     * @param EmployeeRoleAssociation $employeeRoleAssociation
     */
    public function __construct(EmployeeRoleAssociation $employeeRoleAssociation)
    {
        $this->model = $employeeRoleAssociation;
    }

     /**
     * @param int $id
     *
     */
    public function getEmpRoles(
        int $id
    ) {
        return $this->model->newQuery()
            ->select(['roles.id', 'roles.guard_name'])
            ->join('roles', 'employee_role_associations.role_id', '=', 'roles.id')
            ->where('emp_id', $id)
            ->get()
            ->toArray()
        ;
    }

     /**
     * @param array $data
     * @throws ModelCreateErrorException
     */
    public function create($data)
    {
        $this->model->create($data);
    }

     /**
     * @param array $data
     */
    public function delete($id)
    {
        $this->model
        ->where('emp_id', $id)
        ->delete();
    }
}
