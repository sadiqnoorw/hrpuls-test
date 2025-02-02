<?php

namespace App\Http\Controllers;

use App\Repositories\EmployeeRepositoryInterface;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    private $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function index()
    {
        $employees = $this->employeeRepository->paginate(10); // Show 10 employees per page
        
        return view('employees', compact('employees'));
    }

    public function edit($id)
    {
        $employee = $this->employeeRepository->find($id);
        return view('employee-form', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $id,
            'telephone' => ['nullable'],         
            'address' => 'nullable|string',
            'title' => 'nullable|string',
        ]);
        
        $request = $request->except(['_token', '_method']);
        $employee =  $this->employeeRepository->update($id, $request);

        return redirect()->route('employees')->with('success', 'Employee updated');
    }

    public function create()
    {
        return view('employee-form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'telephone' => ['nullable', 'regex:/^(\+?\d{1,4})?\s?-?\d{10}$/'],         
            'address' => 'nullable|string',
            'title' => 'nullable|string',
        ]);

        $this->employeeRepository->create($validated);

        return redirect()->route('employees')->with('success', 'Employee added successfully.');
    }

    // public function update(Request $request, $id)
    // {
    //     $validated = $request->validate([
    //         'name' => 'string|max:255',
    //         'telephone' => 'string',
    //         'email' => 'email|unique:employees,email,' . $id,
    //         'address' => 'string',
    //         'title' => 'string',
    //     ]);

    //     return response()->json(['success' => $this->employeeRepository->update($id, $validated)]);
    // }

    public function destroy($id)
    {
        return response()->json(['success' => $this->employeeRepository->delete($id)]);
    }
}

