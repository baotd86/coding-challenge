<?php

namespace App\Services;

use App\Helpers\GenerateTreeObject;
use App\Models\Employee;


class EmployeeService
{
    protected Employee $model;
    protected array $employees;

    public function __construct(Employee $employeeModel)
    {
        $this->model = $employeeModel;
        $this->employees = $this->loadEmployee();
    }


    /**
     * Insert data based on pair key and value of json
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data): bool
    {
        $rows = [];
        foreach ($data as $key => $val) {
            $rows[]= ['employee' => $key, 'supervisor' => $val];
        }
        return $this->model->insert($rows);
    }

    /**
     * Get all employee and convert data into nested object
     *
     * @return \stdClass
     */
    public function findEmployees(): \stdClass
    {
        return GenerateTreeObject::generateParentChildTreeObject($this->employees,
            'supervisor',
            'employee');
    }

    /**
     * Find an employee with his/her supervisor and his/her supervisor's supervisor
     *
     * @param string $name
     * @return \stdClass
     */
    public function findSupervisors(string $name): \stdClass
    {
        return GenerateTreeObject::generateChildParentTreeObject($this->employees,
            $name,
            'employee',
            'supervisor');
    }

    /**
     * Get all employee from database
     * mark supervisor that has no supervisor as an employee
     * @return array
     */
    private function loadEmployee(): array
    {
        $staffs = $this->model->select('employee', 'supervisor')->get();
        $employees = array_filter($staffs->pluck('employee')->toArray());
        $supervisors = array_filter($staffs->pluck('supervisor')->toArray());
        $staffsNoSupervisor = array_diff($supervisors, $employees);

        foreach ($staffsNoSupervisor as $staff) {
            $staffs[] = ['employee' => $staff, 'supervisor' => null];
        }
        return $staffs->toArray();
    }

}
