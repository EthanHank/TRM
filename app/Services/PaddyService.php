<?php

namespace App\Services;

use Carbon\Carbon;

class PaddyService
{
    public function getStorageData(int $moisture_content)
    {

        $rules = $this->getStorageRules();

        foreach ($rules as $rule) {
            if ($moisture_content <= $rule['max']) {
                $startDate = Carbon::now();
                $endDate = isset($rule['add']['months'])
                    ? $startDate->copy()->addMonths($rule['add']['months'])
                    : $startDate->copy()->addDays($rule['add']['days']);

                return [
                    'maximum_storage_duration' => $rule['label'],
                    'storage_start_date' => $startDate->toDateString(),
                    'storage_end_date' => $endDate->toDateString(),
                ];
            }
        }

        // Fallback case if no rules match
        return [
            'maximum_storage_duration' => 'Too wet to store safely.',
            'storage_start_date' => Carbon::now(),
            'storage_end_date' => null,
        ];
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
