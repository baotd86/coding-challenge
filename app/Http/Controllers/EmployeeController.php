<?php
namespace App\Http\Controllers;

use App\Services\EmployeeService;
use App\Traits\CustomValidation;
use App\Traits\HttpResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class EmployeeController extends Controller
{
    use HttpResponse;
    use CustomValidation;

    protected EmployeeService $service;

    public function __construct(EmployeeService $employeeService)
    {
        $this->service = $employeeService;
    }

    public function findEmployees()
    {
        try {
            $employees = $this->service->findEmployees();
            return $this->successResponse($employees, 'Get data success');
        } catch (HttpException $exception) {
            return $this->errorResponse($exception->getMessage(), $exception->getStatusCode());
        }
    }

    public function findSupervisors(string $name)
    {
        try {
            $employee = $this->service->findSupervisors($name);
            return $this->successResponse($employee, 'Get data success');
        } catch (HttpException $exception) {
            return $this->errorResponse($exception->getMessage(), $exception->getStatusCode());
        }

    }

    public function store(Request $request)
    {
        try {
            if (!$this->isSingleAssocArray($request->all())) {
                throw new HttpException( 400, 'Input invalid format, please check again');
            }
            $this->service->create($request->all());;
            return $this->successResponse([], 'Create employee success', 201);
        } catch (HttpException $exception) {
            return $this->errorResponse($exception->getMessage(), $exception->getStatusCode());
        }

    }
}
