<?php

declare(strict_types=1);

namespace League\Flysystem {
    if ( ! interface_exists(ChecksumProvider::class)) {
        interface ChecksumProvider
        {
            public function checksum(string $path, Config $config): string;
        }
    }

    if ( ! class_exists(ChecksumAlgoIsNotSupported::class)) {
        class ChecksumAlgoIsNotSupported extends \InvalidArgumentException
        {
        }
    }

    if ( ! class_exists(UnableToProvideChecksum::class)) {
        class UnableToProvideChecksum extends \RuntimeException implements FilesystemException
        {
            public function __construct(string $reason, string $path, ?\Throwable $previous = null)
            {
                parent::__construct("Unable to get checksum for $path: $reason", 0, $previous);
            }
        }
    }

    if ( ! class_exists(UnableToGeneratePublicUrl::class)) {
        class UnableToGeneratePublicUrl extends \RuntimeException implements FilesystemException
        {
            public function __construct(string $reason, string $path, ?\Throwable $previous = null)
            {
                parent::__construct("Unable to generate public url for $path: $reason", 0, $previous);
            }

            public static function dueToError(string $path, \Throwable $exception): self
            {
                return new self($exception->getMessage(), $path, $exception);
            }
        }
    }

    if ( ! class_exists(UnableToGenerateTemporaryUrl::class)) {
        class UnableToGenerateTemporaryUrl extends \RuntimeException implements FilesystemException
        {
            public function __construct(string $reason, string $path, ?\Throwable $previous = null)
            {
                parent::__construct("Unable to generate temporary url for $path: $reason", 0, $previous);
            }

            public static function dueToError(string $path, \Throwable $exception): self
            {
                return new self($exception->getMessage(), $path, $exception);
            }
        }
    }

    if ( ! class_exists(UnableToCheckDirectoryExistence::class)) {
        class UnableToCheckDirectoryExistence extends \RuntimeException implements FilesystemOperationFailed
        {
            public static function forLocation(string $path, ?\Throwable $exception = null): self
            {
                return new self("Unable to check directory existence for: {$path}", 0, $exception);
            }

            public function operation(): string
            {
                return FilesystemOperationFailed::OPERATION_FILE_EXISTS;
            }
        }
    }
}

namespace League\Flysystem\UrlGeneration {
    if ( ! interface_exists(PublicUrlGenerator::class)) {
        interface PublicUrlGenerator
        {
            public function publicUrl(string $path, \League\Flysystem\Config $config): string;
        }
    }

    if ( ! interface_exists(TemporaryUrlGenerator::class)) {
        interface TemporaryUrlGenerator
        {
            public function temporaryUrl(
                string $path,
                \DateTimeInterface $expiresAt,
                \League\Flysystem\Config $config
            ): string;
        }
    }
}
