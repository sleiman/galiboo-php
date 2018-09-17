<?php

// If using Composer
require 'vendor/autoload.php';

 // If not using composer, uncomment this
// include('src/Galiboo.php');
// include('src/Request.php');

use TANIOS\Galiboo\Galiboo;

$galiboo = new Galiboo('API KEY');

// Metadata

// Get metadata for tracks
// $request = $galiboo->getTrackMetadata("5a41aae78cc3d0d2d4259034");

// Get metadata for artists
// $request = $galiboo->getArtistMetadata("5a43df43c3de0d10231633d3");

// Search

// Search for artists
// $request = $galiboo->searchArtists("Nicolas Jaar");

// Search for tracks
// $request = $galiboo->searchTracks("Mi Mujer","Nicolas Jaar");

// Discovery & A.I. search

// A.I. search for tracks (alpha)
// $request = $galiboo->searchTracksAI("good vibes");

// Find tracks by tags
// $query = array(
//     "energy" => 0.25,
//     "smart_tags" => array(
//          "Emotion-Calming_/_Soothing" => 0.9
//     )
// );
// $request = $galiboo->findTracksByTags($query);

// findSimilarTracks
// $request = $galiboo->findSimilarTracks("5a43df43c3de0d10231633d3");

// Personalization

// addNewUser
// $request = $galiboo->addNewUser($unique_id_from_your_database);

// addUserEvent
// $request = $galiboo->addUserEvent($galibo_user_id,$timestamp,$type,$object);

// Get a user
// $request = $galiboo->getUser($galibo_user_id);

// Get a user's events
// $request = $galiboo->getUserEvents($galibo_user_id);

// Get music recommendations
// $request = $galiboo->getUserMusicRecommendations($galibo_user_id,$seed_track="",$seed_artist="",$context="",$limit="");

// A.I. Music Analyzer

// Analyze music from a URL
// $request = $galiboo->analyzeFromUrl("URL");

// Analyze music from a YouTube URL
// $request = $galiboo->analyzeFromYoutube("https://www.youtube.com/watch?v=Bag1gUxuU0g");

// Batch Integration

// Schedule a Music Analysis Job
// $request = $galiboo->analyzeFromUrlBatch("URL");

// View a job's status
// $request = $galiboo->jobStatus($job_id);

// View all jobs
// $request = $galiboo->jobAllStatus();

$response = $request->getResponse();
header('Content-Type: application/json');
echo json_encode($response);


   
