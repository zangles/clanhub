<?php

declare(strict_types=1);

namespace App\DTOs\layout\menu\sidebarAlerts;

/**
 * @property-read string $title
 * @property-read string $footerText
 * @property-read float $percentage
 * @property-read string $progressBarClass background class from bootstrap (bg-danger, bg-primary)
 */
final class AlertDTO
{
    /**
     * @param  string  $title
     * @param  string  $footerText
     * @param  float  $percentage
     * @param  string  $progressBarClass
     */
    public function __construct(
        public readonly string $title,
        public readonly string $footerText = '',
        public readonly float $percentage = 0,
        public readonly string $progressBarClass = '',
    ) {}

    public static function make(
        string $title,
        string $footerText = '',
        float $percentage = 0,
        string $progressBarClass = ''
    ) {
        return new self(
            title: $title,
            footerText: $footerText,
            percentage: $percentage,
            progressBarClass: $progressBarClass
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'footerText' => $this->footerText,
            'percentage' => $this->percentage,
            'progressBarClass' => $this->progressBarClass,
        ];
    }
}
