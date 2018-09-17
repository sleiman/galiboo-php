# Galiboo PHP client
A PHP client for the Galiboo API. Feedback or bug reports are appreciated.


## Get started

Get your API key from Galiboo 

---

### Installation

If you're using Composer, you can run the following command:
```
composer require sleiman/galiboo-php
```
You can also download them directly and extract them to your web directory.


### Add the wrapper to your project
If you're using Composer, run the autoloader
```php
require 'vendor/autoload.php';
```
Or include all the. files

```php
include('../src/Galiboo.php');
include('../src/Request.php');
```

### Initialize the class
```php
use TANIOS\Galiboo\Galiboo;
$galiboo = new Galiboo('API KEY');
```
### Prepare a request

### Metadata

#### Get metadata for tracks
```php
$request = $galiboo->getTrackMetadata("5a41aae78cc3d0d2d4259034");
```
#### Get metadata for artists
```php
$request = $galiboo->getArtistMetadata("5a43df43c3de0d10231633d3");
```
### Search

#### Search for artists
```php
$request = $galiboo->searchArtists("Nicolas Jaar");
```

#### Search for tracks
```php
$request = $galiboo->searchTracks("Mi Mujer","Nicolas Jaar");
```

### Discovery & A.I. search

#### A.I. search for tracks (alpha)
```php
$request = $galiboo->searchTracksAI("good vibes");
```

#### Find tracks by tags
```php
$query = array(
    "energy" => 0.25,
    "smart_tags" => array(
         "Emotion-Calming_/_Soothing" => 0.9
    )
);
$request = $galiboo->findTracksByTags($query);
```

#### findSimilarTracks
```php
$request = $galiboo->findSimilarTracks("5a43df43c3de0d10231633d3");
```

### Personalization

#### Add New User
```php
$request = $galiboo->addNewUser($unique_id_from_your_database);
```

#### Add User Event
```php
$request = $galiboo->addUserEvent($galibo_user_id,$timestamp,$type,$object);
```

#### Get a user
```php
$request = $galiboo->getUser($galibo_user_id);
```

#### Get a user's events
```php
$request = $galiboo->getUserEvents($galibo_user_id);
```

#### Get music recommendations
```php
$request = $galiboo->getUserMusicRecommendations($galibo_user_id,$seed_track="",$seed_artist="",$context="",$limit="");
```

### A.I. Music Analyzer

#### Analyze music from a URL
```php
$request = $galiboo->analyzeFromUrl("URL");
```

#### Analyze music from a YouTube URL
```php
$request = $galiboo->analyzeFromYoutube("https://www.youtube.com/watch?v=Bag1gUxuU0g");
```

### Batch Integration

#### Schedule a Music Analysis Job
```php
$request = $galiboo->analyzeFromUrlBatch("URL");
```

#### View a job's status
```php
$request = $galiboo->jobStatus($job_id);
```

#### View all jobs
```php
$request = $galiboo->jobAllStatus();
```

### Get the response
```php
$response = $request->getResponse();
print_r($response);
```

## Credits

Copyright (c) 2018 - Programmed by Sleiman Tanios
