<?php

declare(strict_types=1);

namespace A3Naumov\CloudDriveDriverFilesystem\Infrastructure\Service;

use A3Naumov\CloudDriveContract\Resource\PathInterface;
use A3Naumov\CloudDriveDriverFilesystem\Domain\Contract\Service\FileStorageInterface;
use A3Naumov\CloudDriveDriverFilesystem\Infrastructure\Contract\Service\ConfigInterface;
use Symfony\Component\Filesystem\Filesystem;

class FileStorage implements FileStorageInterface
{
    public function __construct(
        private readonly Filesystem $fileSystem,
        private readonly ConfigInterface $config,
    ) {
    }

    public function store(string $fileName, PathInterface $path): void
    {
        $rootDirectory = $this->getRootDirectory();
        $resourcePath = $rootDirectory.DIRECTORY_SEPARATOR.$this->formatResourcePath($path);

        if ($this->fileSystem->exists($resourcePath) && !is_dir($resourcePath)) {
            throw new \RuntimeException(sprintf('Provided path "%s" is invalid. A file with the same name already exists.', $resourcePath));
        }

        $this->fileSystem->mkdir($resourcePath);
        $this->fileSystem->touch($resourcePath.DIRECTORY_SEPARATOR.$fileName);
    }

    private function getRootDirectory(): string
    {
        $rootPath = $this->config->getRootPath();

        if (!$this->fileSystem->exists($rootPath)) {
            $this->fileSystem->mkdir($rootPath);
        }

        return $rootPath;
    }

    private function formatResourcePath(PathInterface $path): string
    {
        if (!$path->getChildren()) {
            return $path->getName();
        }

        return $path->getName().DIRECTORY_SEPARATOR.$this->formatResourcePath($path->getChildren());
    }
}
