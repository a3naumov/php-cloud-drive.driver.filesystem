<?php

declare(strict_types=1);

namespace A3Naumov\CloudDriveDriverFilesystem\Domain\Entity;

use A3Naumov\CloudDriveContract\Drive\DriverInterface;

class Driver implements DriverInterface
{
    public const string CODE = 'fs';

    public function getCode(): string
    {
        return self::CODE;
    }
}
