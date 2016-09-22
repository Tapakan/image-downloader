# image-downloader
[![Build Status](https://travis-ci.org/Tapakan/image-downloader.svg?branch=master)](https://travis-ci.org/Tapakan/image-downloader)
[![Code Climate](https://codeclimate.com/github/Tapakan/image-downloader/badges/gpa.svg)](https://codeclimate.com/github/Tapakan/image-downloader)
[![Coverage Status](https://coveralls.io/repos/github/Tapakan/image-downloader/badge.svg?branch=master)](https://coveralls.io/github/Tapakan/image-downloader?branch=master)

## INSTALL
Add to require section
```php
  "require" : {
    "tapakan/image-downloader" : "0.0.1"
  }
```

## EXAMPLES

```php
require('vendor/autoload.php');
use Tapakan\ImageDownloader\Manager;

$manager = new Manager();
$manager->getDownloader()->load('http://example.com/path_to_img');
$manager->getDownloader()->load([
    'http://example.com/path_to_img',
    'http://example.com/path_to_img'
]);

// Change destination folder
$manager = new Manager([
    'dir' => __DIR__
]);
$manager->getDownloader()->load('http://example.com/path_to_img');
```
