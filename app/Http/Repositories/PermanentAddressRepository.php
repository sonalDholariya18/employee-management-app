<?php
namespace App\Http\Repositories;

use App\Models\PermanentAddress;

/**
 * Class PermanentAddressRepository
 * @package App\Http\Repositories
 */
class PermanentAddressRepository
{
    /**
     * @var Model|Builder
     */
    protected $model;

    /**
     * PermanentAddressRepository constructor.
     * @param PermanentAddress|Model|Builder $model
     */
    public function __construct(PermanentAddress $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $id
     *
     */
    public function getEmpAddress(
        int $id
    ) {
        $address = $this
            ->model
            ->where('emp_id', $id)
            ->first();
        if ($address !== null) {
            return $address->toArray();
        }
        return [];
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
     * @throws ModelCreateErrorException
     */
    public function update($id, $data)
    {
        $this->model
        ->where('emp_id', $id)
        ->update($data);
    }

    /**
     * @param array $data
     * @throws ModelCreateErrorException
     */
    public function delete($id)
    {
        $this->model
        ->where('emp_id', $id)
        ->delete();
    }
}
