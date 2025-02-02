<?php

namespace App\Console\Commands;

use App\Models\EmployeeFutureChange;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ApplyFutureChanges extends Command
{
    // The name and signature of the console command.
    protected $signature = 'employee:apply-future-changes';

    // The console command description.
    protected $description = 'Apply future changes to employees based on the effective date';

    // Execute the console command.
    public function handle()
    {
        // Get current date
        $currentDate = Carbon::now();

        // Get future changes that have an effective date less than or equal to today and are still pending
        $futureChanges = EmployeeFutureChange::where('effective_date', '<=', $currentDate)
            ->where('status', 'pending') // Only get changes that are still pending
            ->get();

        // Loop through the future changes and apply them
        foreach ($futureChanges as $change) {
            // Fetch the related employee
            $employee = Employee::find($change->employee_id);

            if ($employee) {
                // Apply changes to employee fields
                $employee->update(json_decode($change->changes, true)); // Apply changes from JSON

                // Mark the future change as applied
                $change->status = 'applied'; // Update the status to applied
                $change->save();

                $this->info("Applied future changes to employee {$employee->id}.");
            }
        }

        $this->info('Future changes applied successfully.');
    }
}
