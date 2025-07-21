<?php

namespace App\Services;

class MillingPredictor
{
    protected int $bagCount;
    protected float $bagWeight;
    protected float $moistureIn;
    protected float $moistureOut;
    protected array $outputRatios;

    /**
     * @param int $bagCount
     * @param float $bagWeight
     * @param float $moistureIn
     * @param float $moistureOut
     * @param array $outputRatios (e.g. ['white_rice' => 0.65, 'broken_rice' => 0.07, ...])
     */
    public function __construct(
        int $bagCount,
        float $bagWeight = 50,
        float $moistureIn = 18,
        float $moistureOut = 14,
        array $outputRatios = [
            'white_rice' => 0.65,
            'broken_rice' => 0.07,
            'bran' => 0.08,
            'husk' => 0.20,
        ]
    ) {
        $this->bagCount = $bagCount;
        $this->bagWeight = $bagWeight;
        $this->moistureIn = $moistureIn;
        $this->moistureOut = $moistureOut;
        $this->outputRatios = $outputRatios;
    }

    public function calculateAdjustedWeight(): float
    {
        $totalWeight = $this->bagCount * $this->bagWeight;
        // If moistureIn is 13 or 14, no adjustment needed
        if (in_array((int) $this->moistureIn, [13, 14])) {
            return $totalWeight;
        }
        return round($totalWeight * ((100 - $this->moistureIn) / (100 - $this->moistureOut)), 2);
    }

    public function predict(string $type): int
    {
        if (!isset($this->outputRatios[$type])) {
            throw new \InvalidArgumentException("Unknown output type: $type");
        }
        $weight = $this->calculateAdjustedWeight() * $this->outputRatios[$type];
        return (int) round($weight / $this->bagWeight);
    }

    public function summary(): array
    {
        $adjusted = $this->calculateAdjustedWeight();
        $result = [
            'adjusted_weight' => $adjusted,
        ];
        foreach ($this->outputRatios as $type => $ratio) {
            $bags = (int) round(($adjusted * $ratio) / $this->bagWeight);
            $result[$type . '_bags'] = $bags;
        }
        return $result;
    }

    public function getOutputRatios(): array
    {
        return $this->outputRatios;
    }
} 