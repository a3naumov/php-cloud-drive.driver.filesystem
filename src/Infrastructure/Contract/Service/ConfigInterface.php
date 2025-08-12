<?php

declare(strict_types=1);

namespace A3Naumov\CloudDriveDriverFilesystem\Infrastructure\Contract\Service;

interface ConfigInterface
{
    public function getRootPath(): string;
}
