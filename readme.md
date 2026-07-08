# League\Flysystem\AwsS3V3

AWS S3 filesystem adapter for Flysystem, compatible with **PHP 7.4** and **PHP 8.0–8.4**.

Works with Flysystem 2.x (PHP 7.4+) and Flysystem 3.x (PHP 8.0.2+).

# Installation

```bash
composer require league/flysystem-aws-s3-v3
```

# Bootstrap

Using standard `Aws\S3\S3Client`:

```php
<?php
use Aws\S3\S3Client;
use League\Flysystem\AwsS3V3\AwsS3V3Adapter;
use League\Flysystem\Filesystem;

include __DIR__ . '/vendor/autoload.php';

$client = new S3Client([
    'credentials' => [
        'key'    => 'your-key',
        'secret' => 'your-secret'
    ],
    'region' => 'your-region',
    'version' => 'latest|version',
]);

$adapter = new AwsS3V3Adapter($client, 'your-bucket-name');
$filesystem = new Filesystem($adapter);
```

or using `Aws\S3\S3MultiRegionClient` which does not require to specify the `region` parameter:

```php
<?php
use Aws\S3\S3MultiRegionClient;
use League\Flysystem\AwsS3V3\AwsS3V3Adapter;
use League\Flysystem\Filesystem;

include __DIR__ . '/vendor/autoload.php';

$client = new S3MultiRegionClient([
    'credentials' => [
        'key'    => 'your-key',
        'secret' => 'your-secret'
    ],
    'version' => 'latest|version',
]);

$adapter = new AwsS3V3Adapter($client, 'your-bucket-name');
$filesystem = new Filesystem($adapter);
```
