<?php

namespace App\Data;

final readonly class RenderedEmail
{
    public function __construct(
        public string $subject,
        public string $preheader,
        public string $html,
        public string $text,
    ) {}
}
