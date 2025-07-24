<?php

namespace App\Services;

use App\Exceptions\AppointmentSlotNotAvailableException;
use App\Models\Appointment;
use Carbon\Carbon;

class AppointmentService
{
    /**
     * Calculate appointment end date and duration based on start date and bag quantity.
     *
     * @param  string  $startDate  (Y-m-d)
     */
    public function calculateEndDate(string $startDate, int $bagQuantity): array
    {
        $start = Carbon::parse($startDate);
        $workingDaysNeeded = (int) ceil($bagQuantity / 1000);

        $daysCounted = 0;
        $currentDate = $start->copy();

        while ($daysCounted < $workingDaysNeeded) {
            // If it's not Saturday (6) or Sunday (0)
            if (! in_array($currentDate->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY])) {
                $daysCounted++;
            }

            // Don't move forward if this is the final day
            if ($daysCounted < $workingDaysNeeded) {
                $currentDate->addDay();
            }
        }

        return [
            'end_date' => $currentDate->toDateString(),
            'duration' => $workingDaysNeeded,
        ];
    }

    public function checkAvailability(array $data): Appointment
    {
        $result = $this->calculateEndDate($data['appointment_start_date'], $data['bag_quantity']);
        $appointment_end_date = $result['end_date'];
        $duration = $result['duration'];

        $existingAppointment = Appointment::where('appointment_type_id', $data['appointment_type_id'])
            ->where(function ($query) use ($data, $appointment_end_date) {
                $query->where('appointment_start_date', '<=', $appointment_end_date)
                    ->where('appointment_end_date', '>=', $data['appointment_start_date']);
            })
            ->first();

        if ($existingAppointment) {
            throw new AppointmentSlotNotAvailableException('This appointment date is already booked. Please choose another date.');
        }

        $appointment = new Appointment;
        $appointment->paddy_id = $data['paddy_id'];
        $appointment->appointment_type_id = $data['appointment_type_id'];
        $appointment->appointment_start_date = $data['appointment_start_date'];
        $appointment->appointment_end_date = $appointment_end_date;
        $appointment->duration = $duration;
        $appointment->bag_quantity = $data['bag_quantity'];
        $appointment->load('appointment_type');

        return $appointment;
    }
}
