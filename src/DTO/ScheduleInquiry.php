<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class ScheduleInquiry
{

    public function __construct(
        #[Assert\NotBlank]
        #[Assert\GreaterThanOrEqual(1000)]
        #[Assert\LessThanOrEqual(12000)]
        public readonly int $amount,

        #[Assert\NotBlank]
        #[Assert\GreaterThanOrEqual(3)]
        #[Assert\LessThanOrEqual(18)]
        public readonly int $installmentsNum,

        #[Assert\NotBlank]
        public readonly string $interestRate,
    ) {}

    #[Assert\Callback]
    public function amountDivisibility(ExecutionContextInterface $context, mixed $payload): void
    {
        $divisor = 500;
        if ($this->amount % $divisor) {
            $context->buildViolation('The amount is not divisible by ' . $divisor)
                ->atPath('amount')
                ->addViolation();
        }
    }

    #[Assert\Callback]
    public function installmentsNumDivisibility(ExecutionContextInterface $context, mixed $payload): void
    {
        $divisor = 3;
        if ($this->installmentsNum % $divisor) {
            $context->buildViolation('The installmentsNum is not divisible by ' . $divisor)
                ->atPath('installmentsNum')
                ->addViolation();
        }
    }
}
