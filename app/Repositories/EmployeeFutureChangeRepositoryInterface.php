<?php

namespace App\Repositories;

use App\Models\EmployeeFutureChange;
use App\Models\Employee;

interface EmployeeFutureChangeRepositoryInterface
{
    public function create(array $data): EmployeeFutureChange;

}
