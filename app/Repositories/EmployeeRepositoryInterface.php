<?php

namespace App\Repositories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Collection;

interface EmployeeRepositoryInterface
{
    public function all(): Collection;
    public function find(int $id): ?Employee;
    public function create(array $data): Employee;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
    public function paginate($perPage);
}