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
     * @return array
     */
    public function getEmployeeList():? array
    {
        return $this->model->get()->toArray();
    }

    /**
     *
     * Create a new employee
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

     /**
     * Update an employee
     * @param $emp
     * @return int
     */
    public function update($emp_id, $data):? int
    {
        return $this->model
                    ->where('id', $emp_id)
                    ->update($data);
    }

    /**
     * Delete a employee
     * @param $emp
     * @return int
     */
    public function delete($emp):? int
    {
        return $this->model
                    ->where('id', $emp)
                    ->delete();
    }

    /**
     * get image path
     * @param $emp_id
     * @return array
     */
    public function getImageByEmpId($emp_id): array
    {
        return $this->model
                    ->select('profile_image_name')
                    ->where('id', $emp_id)
                    ->first()->toArray();
    }
}
