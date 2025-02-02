<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Repositories\EmployeeFutureChangeRepositoryInterface;

class EmployeeFutureChangeController extends Controller
{
    protected $employeeFutureChangeRepository;

    public function __construct(EmployeeFutureChangeRepositoryInterface $employeeFutureChangeRepository)
    {
        $this->employeeFutureChangeRepository = $employeeFutureChangeRepository;
    }

    public function create($id)
    {
        $employee = Employee::find($id);

        return view('future-change-form', compact('employee'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $id,
            'telephone' => ['nullable'],         
            'address' => 'nullable|string',
            'title' => 'nullable|string',
        ]);

        // Fetch the existing employee data
        $employee = Employee::findOrFail($id);

        // Check if at least one field is changing
        $data = array_filter([
            'name' => $request->name !== $employee->name ? $request->name : null,
            'email' => $request->email !== $employee->email ? $request->email : null,
            'telephone' => $request->telephone !== $employee->telephone ? $request->telephone : null,
            'address' => $request->address !== $employee->address ? $request->address : null,
            'title' => $request->title !== $employee->title ? $request->title : null,
            'effective_date' => $request->effective_date
        ]);
    
        // Check if any field other than 'effective_date' is changed
        if (count($data) <= 1 && isset($data['effective_date'])) {
            return redirect()->back()->with('error', 'No changes detected. Please modify at least one field.');
        }
    
        // Set the 'changes' field to the modified data in JSON format
        $data['changes'] = json_encode(array_filter([
            'name' => $request->name !== $employee->name ? $request->name : $employee->name,
            'email' => $request->email !== $employee->email ? $request->email : $employee->email,
            'telephone' => $request->telephone !== $employee->telephone ? $request->telephone : $employee->telephone,
            'address' => $request->address !== $employee->address ? $request->address : $employee->address,
            'title' => $request->title !== $employee->title ? $request->title : $employee->title,
        ]));
    
        // Store the future change with status set to 'pending'
        $this->employeeFutureChangeRepository->create(array_merge(['employee_id' => $id, 'status' => 'pending'], $data));

        return redirect()->route('employees')->with('success', 'Future change scheduled successfully.');
    }

}
