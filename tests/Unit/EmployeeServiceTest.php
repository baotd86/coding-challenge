<?php

namespace Tests\Unit;

use App\Models\Employee;
use App\Services\EmployeeService;
use Tests\TestCase;
use Laravel\Lumen\Testing\DatabaseMigrations;

class EmployeeServiceTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test create employee success
     * @return void
     */
    public function test_create_employee_success()
    {
        $model = new Employee();
        $service = new EmployeeService($model);
        $response = $service->create([
            'Pete'=> 'Nick',
            'Barbara' => 'Nick',
            'Nick' => 'Sophie',
            'Sophie'=> 'Jonas'
        ]);
        $this->assertEquals(true, $response, 'test create employee success');
    }

    public function test_find_employee_success()
    {
        $model = new Employee();
        $service = new EmployeeService($model);
        $response = $service->findEmployees();
        $this->assertIsObject($response, 'test query all employee');
    }

    public function test_find_employee_with_supervisor()
    {
        $model = new Employee();
        $service = new EmployeeService($model);
        $response = $service->findSupervisors('nick');
        $this->assertIsObject($response, 'test query all employee');
    }


}
