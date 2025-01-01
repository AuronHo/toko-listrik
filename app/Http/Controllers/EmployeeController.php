<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // Load the initial Blade view
    public function index()
    {
        return view('dashboard.employees', [
            'title' => 'Employees'
        ]);
    }

    // Fetch data from the external API
    public function fetchEmployees() {
        try {
            $employees = Employee::all();  // Fetch all employees
            return response()->json($employees);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
