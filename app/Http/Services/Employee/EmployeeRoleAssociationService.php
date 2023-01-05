<?php

namespace App\Http\Services\Employee;

use App\Http\Repositories\EmployeeRoleAssociationRepository;

/**
 * Class EmployeeRoleAssociationService
 * @package App\Http\Services
 */
class EmployeeRoleAssociationService
{
    /** @var EmployeeRoleAssociationRepository $repository */
    protected $repository;

    public function __construct(
        EmployeeRoleAssociationRepository $employeeRoleAssociationRepository
    ) {
        $this->repository = $employeeRoleAssociationRepository;
    }

    /**
     * Get All role for employeee
     *
     */
    public function getRolesForSelectedEmployee($id)
    {
        return $this->repository->getEmpRoles($id);
    }


}
