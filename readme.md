# Flysystem AWS S3 V3 Adapter

[![Packagist Version](https://img.shields.io/packagist/v/aclyte/flysystem-aws-s3-v3.svg)](https://packagist.org/packages/aclyte/flysystem-aws-s3-v3)
[![Packagist Downloads](https://img.shields.io/packagist/dt/aclyte/flysystem-aws-s3-v3.svg)](https://packagist.org/packages/aclyte/flysystem-aws-s3-v3)
[![License](https://img.shields.io/packagist/l/aclyte/flysystem-aws-s3-v3.svg)](LICENSE)

Fork of [league/flysystem-aws-s3-v3](https://github.com/thephpleague/flysystem-aws-s3-v3) with extended PHP compatibility.

- **PHP 7.4 – 8.4**
- **Flysystem 2.x** (PHP 7.4+)
- **Flysystem 3.x** (PHP 8.0+)

## Installation

```bash
composer require aclyte/flysystem-aws-s3-v3
```

### PHP version notes

| PHP version | Flysystem | AWS SDK |
|-------------|-----------|---------|
| 7.4         | 2.x       | 3.337.x (last release supporting PHP 7.4) |
| 8.0 – 8.3   | 2.x or 3.x | latest compatible |
| 8.4         | 3.x recommended | latest compatible |

On PHP 7.4, Composer may resolve an older `aws/aws-sdk-php` release. That is expected.

## Usage

Using `Aws\S3\S3Client`:

```php
<?php

use Aws\S3\S3Client;
use League\Flysystem\AwsS3V3\AwsS3V3Adapter;
use League\Flysystem\Filesystem;

require __DIR__ . '/vendor/autoload.php';

$client = new S3Client([
    'credentials' => [
        'key'    => 'your-key',
        'secret' => 'your-secret',
    ],
    'region' => 'your-region',
    'version' => 'latest',
]);

$adapter = new AwsS3V3Adapter($client, 'your-bucket-name');
$filesystem = new Filesystem($adapter);
```

Using `Aws\S3\S3MultiRegionClient` (no `region` required):

```php
<?php

use Aws\S3\S3MultiRegionClient;
use League\Flysystem\AwsS3V3\AwsS3V3Adapter;
use League\Flysystem\Filesystem;

require __DIR__ . '/vendor/autoload.php';

$client = new S3MultiRegionClient([
    'credentials' => [
        'key'    => 'your-key',
        'secret' => 'your-secret',
    ],
    'version' => 'latest',
]);

$adapter = new AwsS3V3Adapter($client, 'your-bucket-name');
$filesystem = new Filesystem($adapter);
```

## Publishing on Packagist

1. Push this repository to GitHub (public).
2. Create a release tag, for example `1.1.0`:
   ```bash
   git tag -a 1.1.0 -m "PHP 7.4–8.4 compatibility"
   git push origin 1.1.0
   ```
3. Register the package at [packagist.org](https://packagist.org/packages/submit):
   - Repository URL: `https://github.com/aclyte/flysystem-aws-s3-v3`
4. Enable the Packagist GitHub hook so new tags are picked up automatically.

> **Note:** This repository may contain legacy upstream git tags. Packagist imports all tags as versions. For a clean version history, publish only tags that match this fork (for example `1.1.x`).

## License

MIT. See [LICENSE](LICENSE).
