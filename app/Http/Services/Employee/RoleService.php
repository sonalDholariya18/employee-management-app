<?php
namespace App\Http\Services\Employee;

use App\Http\Repositories\RoleRepository;
use App\Http\Resources\RoleResource;
use App\Models\Role;

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
     * @return array
     *
     */
    public function getAllRoles(): array
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
     * @return void
     */
    public function createRole($role): void
    {
        $this->repository->create($role);
    }

    /**
     * update role
     * @param Role $role
     * @param array $params
     * @return void
     */
    public function updateRole($role, $params): void
    {
        $this->repository->update($role, $params);
    }

    /**
     * delete role
     * @param Role $role
     * @return void
     */
    public function deleteRole($role): void
    {
        $this->repository->delete($role);
    }
}
