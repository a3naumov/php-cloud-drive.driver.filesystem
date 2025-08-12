<?php

declare(strict_types=1);

namespace A3Naumov\CloudDriveDriverFilesystem\Domain\Contract\Service;

use A3Naumov\CloudDriveContract\Resource\PathInterface;

interface FileStorageInterface
{
    public function store(string $fileName, PathInterface $path): void;
}
