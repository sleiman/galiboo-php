<?php

namespace TANIOS\Galiboo;

class Request
{

    /**
     * @var Galiboo Instance of Galiboo
     */
    private $galiboo;
    /**
     * @var resource Instance of CURL
     */
    private $curl;
    /**
     * @var string Content type
     */
    private $request;
    /**
     * @var array Request data
     */
    private $data = [];
    /**
     * @var bool Is it a POST request?
     */
    private $is_post = false;

    /**
     * @var array|boolean Relations to lazy load
     */
    private $relations;

    /**
     * Create a Request to Galiboo API
     * @param Galiboo $galiboo Instance of Galiboo
     * @param string $content_type Content type
     * @param array $data Request data
     * @param bool|string $is_post Is it a POST request?
     */
    public function __construct( $galiboo, $request, $data = [], $is_post = false )
    {

        $this->galiboo = $galiboo;
        $this->request = $request;
        $this->data = $data;
        $this->is_post = $is_post;
        

    }

    private function init()
    {

        $headers = array(
            'Content-Type: application/json',
        );

        $request = $this->request;
        $request .= "/?token=" . $this->galiboo->getKey();

        if( ! $this->is_post )
        {
            if (!empty($this->data)){
                $data = http_build_query($this->data);
                $request .= "&" . $data;
            }
        }

        $curl = curl_init($this->galiboo->getApiUrl($request));

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        if( $this->is_post )
        {
            if( strtolower( $this->is_post ) == 'patch' )
            {
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');
            }
            else if( strtolower( $this->is_post ) == 'delete' )
            {
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
            }
            curl_setopt($curl,CURLOPT_POST, count($this->data));
            curl_setopt($curl,CURLOPT_POSTFIELDS, json_encode($this->data));
        }


        $this->curl = $curl;

    }

    /**
     * @return Response Get response from API
     */
    public function getResponse()
    {

        $this->init();

        $response_string = curl_exec( $this->curl);

        return json_decode($response_string);

    }


}