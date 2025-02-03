<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EmployeeRepositoryInterface;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

/**
 * Class EmployeeController
 *
 * This controller handles CRUD operations for Employee entities using the 
 * EmployeeRepositoryInterface for data persistence.
 */
class EmployeeController extends Controller
{
    /**
     * The employee repository instance.
     *
     * @var EmployeeRepositoryInterface
     */
    private $employeeRepository;

    /**
     * EmployeeController constructor.
     *
     * @param EmployeeRepositoryInterface $employeeRepository
     */
    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * Display a paginated list of employees.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $employees = $this->employeeRepository->paginate(10); // Show 10 employees per page
        return view('employees', compact('employees'));
    }

    /**
     * Show the form for editing an existing employee.
     *
     * @param int $id Employee ID
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $employee = $this->employeeRepository->find($id);
        return view('employee-form', compact('employee'));
    }

    /**
     * Update an existing employee.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id Employee ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateEmployeeRequest $request, $id)
    {        
       // $request = $request->except(['_token', '_method']);
        $this->employeeRepository->update($id, $request->validated());

       // $employee =  $this->employeeRepository->update($id, $request);

        return redirect()->route('employees')->with('success', 'Employee updated');
    }

    /**
     * Show the form for creating a new employee.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('employee-form');
    }

    /**
     * Store a new employee in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreEmployeeRequest $request)
    {
        
        // $validated = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:employees,email',
        //     'telephone' => ['nullable', 'regex:/^(\+?\d{1,4})?\s?-?\d{10}$/'],         
        //     'address' => 'nullable|string',
        //     'title' => 'nullable|string',
        // ]);

        $this->employeeRepository->create($request->validated());

      //  $this->employeeRepository->create($validated);

        return redirect()->route('employees')->with('success', 'Employee added successfully.');
    }

    /**
     * Delete an employee.
     *
     * @param int $id Employee ID
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if($this->employeeRepository->delete($id)){
            return redirect()->route('employees')->with('success', 'Employee Delete successfully.');
        }
        return redirect()->route('employees')->with('success', 'Try again to Delete successfully.');
    }
}
