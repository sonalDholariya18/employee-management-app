<?php
namespace App\Http\Repositories;

use App\Models\Employee;

/**
 * Class EmployeeRepository
 * @package App\Http\Repositories
 */
class EmployeeRepository
{
    /**
     * @var Model|Builder
     */
    protected $model;

    /**
     * EmployeeRepository constructor.
     * @param Employee|Model|Builder $model
     */
    public function __construct(Employee $model)
    {
        $this->model = $model;
    }

    /**
     *
     * Get list of employees
     */
    public function getEmployeeList()
    {
        return $this->model->get()->toArray();
    }

    /**
     *
     *create
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

     /**
     * Update a employee
     * @param $emp
     */
    public function update($emp_id, $data)
    {
        return $this->model
                    ->where('id', $emp_id)
                    ->update($data);
    }

    /**
     * Delete a employee
     * @param $emp
     */
    public function delete($emp)
    {

        return $this->model
                    ->where('id', $emp)
                    ->delete();
    }
}
