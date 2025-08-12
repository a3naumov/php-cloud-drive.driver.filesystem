<?php

declare(strict_types=1);

namespace A3Naumov\CloudDriveDriverFilesystem\Domain\ValueObject;

use A3Naumov\CloudDriveContract\Resource\PathInterface;

class ResourcePath implements PathInterface
{
    public function __construct(
        private readonly string $name,
        private readonly ?PathInterface $children = null,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getChildren(): ?PathInterface
    {
        return $this->children;
    }
}
