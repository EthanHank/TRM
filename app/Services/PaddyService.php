<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Paddy;
use Illuminate\Support\Facades\Log;

class PaddyService
{
    /**
     * Calculates and applies storage values to a Paddy model.
     *
     * @param Paddy|null $paddy (pass null when creating)
     * @param int $moisture
     * @return array [storage_period, start_date, end_date]
     */
    public function getStorageData(?Paddy $paddy, int $moisture_content)
    {
        try {

            $rules = $this->getStorageRules();

            // Use existing start date for update, or now for create
            $startDate = isset($paddy) && $paddy->storage_start_date
                ? Carbon::parse($paddy->storage_start_date)
                : Carbon::now();

            foreach ($rules as $rule) {
                if ($moisture_content <= $rule['max']) {
                    $endDate = isset($rule['add']['months'])
                        ? $startDate->copy()->addMonths($rule['add']['months'])
                        : $startDate->copy()->addDays($rule['add']['days']);

                    return [
                        'maximum_storage_duration' => $rule['label'],
                        'storage_start_date' => $startDate,
                        'storage_end_date' => $endDate,
                    ];
                }
            }

            // Fallback case if no rules match
            return [
                'maximum_storage_duration' => 'Too wet to store safely.',
                'storage_start_date' => $startDate,
                'storage_end_date' => null,
            ];
        } catch (\Exception $e) {
            // Handle the exception (log it, rethrow, return a default value, etc.)
            // Example: log and return a default error response
            Log::error('Error in getStorageData: ' . $e->getMessage());
            return [
                'maximum_storage_duration' => 'Error calculating storage.',
                'storage_start_date' => null,
                'storage_end_date' => null,
            ];
        }
    }

    public function getStorageRules()
    {
        return [
            ['max' => 13, 'label' => '24 months',     'add' => ['months' => 24]],
            ['max' => 14, 'label' => '12 months',     'add' => ['months' => 12]],
            ['max' => 15, 'label' => '6 months',      'add' => ['months' => 6]],
            ['max' => 16, 'label' => '3 months',      'add' => ['months' => 3]],
            ['max' => 17, 'label' => '45 days',       'add' => ['days' => 45]],
            ['max' => 18, 'label' => '25 to 30 days',    'add' => ['days' => 30]],
            ['max' => 19, 'label' => '15 to 20 days',    'add' => ['days' => 20]],
            ['max' => 20, 'label' => '7 to 15 days',     'add' => ['days' => 15]],
            ['max' => 21, 'label' => '3 to 5 days',      'add' => ['days' => 5]],
            ['max' => 22, 'label' => '2 days',        'add' => ['days' => 2]],
            ['max' => 23, 'label' => '1 day',         'add' => ['days' => 1]],
        ];
    }
}
