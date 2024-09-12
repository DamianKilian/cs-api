<?php

namespace App\Controller;

use App\DTO\ScheduleInquiry;
use App\Service\ScheduleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

class InstallmentController extends AbstractController
{
    #[Route('/calculations', name: 'calculations', methods: 'POST')]
    public function calculations(Request $request, #[MapRequestPayload] ScheduleInquiry $scheduleInquiry, ScheduleService $scheduleService): JsonResponse
    {
        $schedule = $scheduleService->calculateSchedule($scheduleInquiry, 12);
        return $this->json([
            'calculationTime' => time(),
            'installmentsNum' => $scheduleInquiry->installmentsNum,
            'amount' => $scheduleInquiry->amount,
            'interestRate' => $scheduleInquiry->interestRate,
            'schedule' => $schedule
        ]);
    }
}
