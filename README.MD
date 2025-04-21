# Laravel Response Helper Package

A simple Laravel package to provide consistent and easy-to-use JSON responses.

## Installation

You can install this package via Composer:

```bash
composer require milutinvelisic/response-helper

## Usage

Once installed, you can use the `ResponseHelper` class statically in your controllers or other parts of your Laravel application to generate consistent JSON responses.

**Generating a Successful Response:**


<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use MilutinVelisic\ResponseHelper\ResponseHelper;

class ExampleController extends Controller
{
    public function __construct(protected readonly ResponseHelper $responseHelper) {}
    
    public function index()
    {
        $data = ['message' => 'Data retrieved successfully', 'items' => [1, 2, 3]];
        return $this->responseHelper->success($data, 'Successfully fetched data');
    }

    public function noDataSuccess()
    {
        return $this->responseHelper->success(null, 'Operation completed successfully');
    }

    public function customStatusCodeSuccess()
    {
        return $this->responseHelper->success(['id' => 1], 'Resource created', 201);
    }
}

**Generating Error Response:**

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use MilutinVelisic\ResponseHelper\ResponseHelper;
use Exception;

class ErrorController extends Controller
{
    public function __construct(protected readonly ResponseHelper $responseHelper) {}

    public function exampleError()
    {
        try {
            // Some code that might throw an exception
            throw new Exception('Something went wrong during processing.');
        } catch (Exception $e) {
            return $this->responseHelper->error($e, 'Failed to process request', 500);
        }
    }

    public function validationError()
    {
        $exception = new \Illuminate\Validation\ValidationException(\Illuminate\Support\Facades\Validator::make([], [
            'name' => 'required',
            'email' => 'email',
        ]));
        return $this->responseHelper->error($exception, 'Validation failed', 422);
    }
}

**Generating a Custom JSON Response:**

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use MilutinVelisic\ResponseHelper\ResponseHelper;

class CustomResponseController extends Controller
{
    public function __construct(protected readonly ResponseHelper $responseHelper) {}

    public function customJsonResponse()
    {
        $responseData = [
            'status' => 'error',
            'code' => 'INVALID_INPUT',
            'message' => 'The provided input is not valid.',
            'details' => ['field' => 'name', 'reason' => 'required'],
        ];
        return $this->responseHelper->json($responseData, 400);
    }
}