<?php

namespace TANIOS\Galiboo;

/**
 * Galiboo API Class
 *
 * @author Sleiman Tanios
 * @copyright Sleiman Tanios - TANIOS 2018
 * @version 1.0
 */


class Galiboo 
{
	const API_URL = "https://secure.galiboo.com/api";

	private $_key;

	
	public function __construct($api_key)
    {
        if (isset($api_key)) {
            $this->setKey($api_key);
        } else {
            echo 'Error: __construct() - Configuration data is missing.';
        }
    }

    public function setKey($api_key)
    {
        $this->_key = $api_key;
    }

    public function getKey()
    {
        return $this->_key;
    }


    public function getApiUrl($request){
	    $request = str_replace( ' ', '%20', $request );
    	$url = self::API_URL.'/'.$request;
    	return $url;
    }

    function getTrackMetadata($track_id,$params="")
    {
        $endpoint = "metadata/tracks/".$track_id;
        return new Request( $this, $endpoint , $params);
    }
    function getArtistMetadata($artist_id,$params="")
    {
        $endpoint = "metadata/artists/".$artist_id;
        return new Request( $this, $endpoint , $params);
    }

    function searchArtists($artist,$limit="",$page="")
    {
         $params = array(
            "artist" => $artist,
            "limit" => $limit ?: 10,
            "page" => $page ?: 1
        );
        $endpoint = "metadata/artists/search";
        return new Request( $this, $endpoint , $params);
	}

    function searchTracks($track,$artist,$limit="",$page="")
    {
        $params = array(
            "track" => $track,
            "artist" => $artist,
            "limit" => $limit ?: 10,
            "page" => $page ?: 1
        );
        $endpoint = "metadata/tracks/search";
        return new Request( $this, $endpoint , $params);
    }

    function searchTracksAI($query)
    {
        $params['q'] = $query;
        $endpoint = "discover/tracks/smart_search";
        return new Request( $this, $endpoint , $params);
    }

    function findTracksByTags($params="")
    {
        $endpoint = "discover/tracks/find";
        return new Request( $this, $endpoint , $params, true);
    }
    
    function findSimilarTracks($track_id,$count="")
    {
        $params['count'] = $count ?: 15;
        $endpoint = "discover/tracks/".$track_id."/similar";
        return new Request( $this, $endpoint , $params);
    }
    

    // A.I. Music Analyzer
    function analyzeFromUrl($url)
    {
        $endpoint = "analyzer/analyze_url";
        $params['url'] = $url;
        return new Request( $this, $endpoint , $params);
    }
    function analyzeFromYoutube($url)
    {
        $endpoint = "analyzer/analyze_youtube";
        $params['url'] = $url;
        return new Request( $this, $endpoint , $params);
    }

    // Personalization
    function addNewUser($id)
    {
        $params['_id'] = $id;
        $endpoint = "personalization/users/new";
        return new Request( $this, $endpoint , $params, true);
    }

    function addUserEvent($user_id,$timestamp,$type,$object,$meta="",$context="")
    {
        $params = array(
            "timestamp" => $timestamp,
            "type" => $type,
            "object" => $object,
            "meta" => $meta ?: "",
            "context" => $context ?: ""
        );

        $endpoint = "personalization/users/".$user_id."/events/new";
        return new Request( $this, $endpoint , $params, true);
    }

    function getUser($user_id)
    {
        $endpoint = "personalization/users/".$user_id;
        return new Request( $this, $endpoint);
    }

    function getUserEvents($user_id)
    {
        $endpoint = "personalization/users/".$user_id."/events";
        return new Request( $this, $endpoint);
    }

    function getUserMusicRecommendations($user_id,$seed_track="",$seed_artist="",$context="",$limit="")
    {
        $params = array(
            "seed_track" => $seed_track ?: "",
            "seed_artist" => $seed_artist ?: "",
            "limit" => $limit ?: 10,
            "context"=> $context ?: ""
        );

        $endpoint = "personalization/users/".$user_id."/recommend_tracks";
        return new Request( $this, $endpoint , $params, true);
    }

     // Batch Integration
    function analyzeFromUrlBatch($url)
    {
        $endpoint = "integration/tracks/analyze";
        $params['url'] = $url;
        return new Request( $this, $endpoint , $params);
    }

    function jobStatus($job_id)
    {
        $endpoint = "integration/jobs/".$job_id;
        return new Request( $this, $endpoint);
    }

     function jobAllStatus($show_progress="",$page="")
    {
        $endpoint = "integration/tracks/analyze";
        $params = array(
            "show_progress" => $show_progress ?: false,
            "page" => $page ?: 1
        );
        return new Request( $this, $endpoint , $params);
    }

}
