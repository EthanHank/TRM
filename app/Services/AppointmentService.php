<?php

namespace App\Services;

use Carbon\Carbon;

class AppointmentService
{
    /**
     * Calculate appointment end date based on start date and bag quantity.
     *
     * @param string $startDate (Y-m-d)
     * @param int $bagQuantity
     * @return string (Y-m-d)
     */
    public function calculateEndDate(string $startDate, int $bagQuantity): string
    {
        $start = Carbon::parse($startDate);
        $workingDaysNeeded = (int) ceil($bagQuantity / 1000);

        $daysCounted = 0;
        $currentDate = $start->copy();

        while ($daysCounted < $workingDaysNeeded) {
            // If it's not Saturday (6) or Sunday (0)
            if (!in_array($currentDate->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY])) {
                $daysCounted++;
            }

            // Don't move forward if this is the final day
            if ($daysCounted < $workingDaysNeeded) {
                $currentDate->addDay();
            }
        }

        return $currentDate->toDateString(); // Y-m-d
    }
}
