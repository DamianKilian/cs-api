<?php

namespace App\Service;

class ScheduleService
{
    public function __construct() {}

    public function calculateSchedule($scheduleInquiry, $yearInstallmentsNum): array
    {
        $schedule = [];
        $n = $scheduleInquiry->installmentsNum;
        $nr = 0;
        $r = $scheduleInquiry->interestRate;
        $k = $yearInstallmentsNum;
        $subResult1 = $r / $k;
        $subResult2 = pow(1 + $subResult1, $n);
        $subResult3 = ($subResult1 * $subResult2) / ($subResult2 - 1);
        $installmentAmount = round($scheduleInquiry->amount * $subResult3 * 100) / 100;
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
