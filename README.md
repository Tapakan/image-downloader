# image-downloader
[![Build Status](https://travis-ci.org/Tapakan/image-downloader.svg?branch=master)](https://travis-ci.org/Tapakan/image-downloader)
[![Code Climate](https://codeclimate.com/github/Tapakan/image-downloader/badges/gpa.svg)](https://codeclimate.com/github/Tapakan/image-downloader)
## USE

Add to require section
```
  "require" : {
    "tapakan/image-downloader" : "0.0.1"
  }
```
## DEMO

```
require('vendor/autoload.php');
use Tapakan\ImageDownloader\Manager;

$manager = new Manager();
$manager->getDownloader()->load('http://example.com/path_to_img');
```
