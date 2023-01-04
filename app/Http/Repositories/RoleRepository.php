<?php
namespace App\Http\Repositories;

use App\Models\Role;

/**
 * Class RoleRepository
 * @package App\Http\Repositories
 */
class RoleRepository
{
    /**
     * @var Model|Builder
     */
    protected $model;

    /**
     * RoleRepository constructor.
     * @param Role|Model|Builder $model
     */
    public function __construct(Role $model)
    {
        $this->model = $model;
    }
     /**
     *
     * Get roles
     */
    public function getAllRoles()
    {
        return $this->model->get()->toArray();
    }

    /**
     *
     * Get roles
     */
    public function getRole()
    {
        return $this->model->paginate(5);
    }

    /**
     * Insert a role
     * @param $role
     */
    public function create($role)
    {
        return $this->model->create($role);
    }

    /**
     * Update a role
     * @param $role
     * @param $params
     */
    public function update(Role $model, $params)
    {
        return $this->model
                    ->where('id', $model->id)
                    ->update(['guard_name' => $params['guard_name']]);
    }

    /**
     * Delete a role
     * @param $role
     */
    public function delete($role)
    {
        return $this->model
                    ->where('id', $role->id)
                    ->delete();
    }
}
