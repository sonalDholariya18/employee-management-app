<?php
namespace App\Http\Repositories;

use App\Models\Role;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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
     * Get roles list
     * @return array
     */
    public function getAllRoles(): array
    {
        return $this->model->get()->toArray();
    }

    /**
     *
     * Get roles with paginate
     * @return LengthAwarePaginator
     */
    public function getRole(): LengthAwarePaginator
    {
        return $this->model->paginate(5);
    }

    /**
     * Insert a new Role
     * @param $role
     * @return Role
     */
    public function create($role): Role
    {
        return $this->model->create($role);
    }

    /**
     * Update a role
     * @param Role $role
     * @param array $params
     * @return RoleModel
     */
    public function update(Role $model, $params):? int
    {
        return $this->model
                    ->where('id', $model->id)
                    ->update(['guard_name' => $params['guard_name']]);
    }

    /**
     * Delete a role
     * @param $role
     * @return Role
     */
    public function delete($role): Role
    {
        return $this->model
                    ->where('id', $role->id)
                    ->delete();
    }
}
