<?php
namespace App\Http\Services\Employee;

use App\Http\Repositories\RoleRepository;
use App\Http\Resources\RoleResource;

/**
 * Class RoleService
 * @package App\Http\Services\Employee
 */
class RoleService
{
   /**
     * @var RoleRepository
     */
    protected $repository;

    /**
     * RoleService constructor
     *
     * @param RoleRepository $roleRepository
     * @return void
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->repository = $roleRepository;
    }

    /**
     * Get All role for employeee
     *
     */
    public function getAllRoles()
    {
        return $this->repository->getAllRoles();
    }

    /**
     * Get All role for employeee
     *
     */
    public function getRolesForEmployee()
    {
        return RoleResource::collection(
            $this->repository->getRole()
        );
    }

    /**
     * Create a new role
     *
     */
    public function createRole($role)
    {
        $this->repository->create($role);
    }

    /**
     * update role
     *
     */
    public function updateRole($role, $params)
    {
        $this->repository->update($role, $params);
    }

    /**
     * delete role
     *
     */
    public function deleteRole($role)
    {
        $this->repository->delete($role);
    }
}
