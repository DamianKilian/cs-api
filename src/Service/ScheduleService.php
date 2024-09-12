<?php

namespace App\Service;

class ScheduleService
{

    protected $bcscale = 10;

    public function __construct() {}

    public function calculateSchedule($scheduleInquiry, $yearInstallmentsNum): array
    {
        bcscale($this->bcscale);
        $schedule = [];
        $n = $scheduleInquiry->installmentsNum;
        $nr = 0;
        $r = $scheduleInquiry->interestRate;
        $k = $yearInstallmentsNum;
        $subResult1 = $r / $k;
        $subResult2 = pow(1 + $subResult1, $n);
        $subResult3 = ($subResult1 * $subResult2) / ($subResult2 - 1);
        $installmentAmount = bcmul($scheduleInquiry->amount, $subResult3, 2);
        do {
            $nr++;
            $schedule[$nr] = [
                'nr' => $nr,
                'installmentAmount' => $installmentAmount,
            ];
        } while ($nr < $n);
        return $schedule;
    }
}
