<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function store(Request $request) {
        try {
            $employee = new Employee();
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->address = $request->address;
            $employee->gender = $request->gender;
            $employee->save();

            return response()->json([
                'status' => 'success',
                'message' => 'employee created successfully',
                'data' => $employee
            ]);
        }
        catch (\Exception $e) {
            throw $e;
        }
    }
}
