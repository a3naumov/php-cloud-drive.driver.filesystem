<?php

declare(strict_types=1);

namespace A3Naumov\CloudDriveDriverFilesystem\Domain\Entity;

use A3Naumov\CloudDriveContract\Drive\DriverInterface;
use A3Naumov\CloudDriveContract\DriveInterface;
use A3Naumov\CloudDriveContract\ResourceInterface;
use A3Naumov\CloudDriveDriverFilesystem\Domain\Contract\Service\FileStorageInterface;
use A3Naumov\CloudDriveDriverFilesystem\Domain\ValueObject\ResourcePath;

class Driver implements DriverInterface
{
    public const string CODE = 'fs';

    public function __construct(
        private readonly FileStorageInterface $fileStorage,
    ) {
    }

    public function getCode(): string
    {
        return self::CODE;
    }

    public function addResource(DriveInterface $drive, ResourceInterface $resource): array
    {
        if (!$drive->getId()) {
            throw new \InvalidArgumentException('Drive ID cannot be null');
        }

        if (!$resource->getId()) {
            throw new \InvalidArgumentException('Resource ID cannot be null');
        }

        $path = new ResourcePath(
            name: $drive->getId(),
            children: new ResourcePath(
                name: $resource->getId(),
            ),
        );

        $this->fileStorage->store('content', $path);

        return [];
    }
}
