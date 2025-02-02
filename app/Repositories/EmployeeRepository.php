<?php

namespace App\Repositories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Collection;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function all(): Collection
    {
        return Employee::all();
    }
    public function paginate($perPage)
    {
        return Employee::paginate($perPage);
    }

    public function find(int $id): ?Employee
    {
        return Employee::find($id);
    }

    public function create(array $data): Employee
    {
        return Employee::create($data);
    }

    public function update(int $id, array $data): bool
    {
        return Employee::where('id', $id)->update($data);
    }

    public function delete(int $id): bool
    {
        return Employee::destroy($id);
    }
}