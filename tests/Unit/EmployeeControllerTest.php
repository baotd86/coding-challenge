<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class EmployeeControllerTest extends TestCase
{
    use DatabaseMigrations;


    public function test_create_employee_api()
    {
        $user = User::create([
            'name' => 'Tester',
            'email' => 'test@example.com',
            'password' => Hash::make('123123')
        ]);
        $data = [
            'Pete'=> 'Nick',
            'Barbara' => 'Nick',
            'Nick' => 'Sophie',
            'Sophie'=> 'Jonas'
        ];
            $response = $this->actingAs($user)
            ->withoutMiddleware()
            ->post('/api/employees', $data);
        $response->assertResponseStatus(201);
    }

    public function test_get_all_employee_api()
    {
        $user = User::create([
            'name' => 'Tester',
            'email' => 'test@example.com',
            'password' => Hash::make('123123')
        ]);

        $response = $this->actingAs($user)
            ->withoutMiddleware()
            ->get('/api/employees');
        $response->assertResponseStatus(200);
    }

    public function test_get_detail_employee_api()
    {
        $user = User::create([
            'name' => 'Tester',
            'email' => 'test@example.com',
            'password' => Hash::make('123123')
        ]);

        $response = $this->actingAs($user)
            ->withoutMiddleware()
            ->get('/api/employees/nick');
        $response->assertResponseStatus(200);
    }
}
