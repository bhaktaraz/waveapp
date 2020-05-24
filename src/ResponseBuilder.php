<?php
namespace Bhaktaraz\WaveApp;

class ResponseBuilder
{
    public function success($response)
    {
        return json_decode($response->getBody(), true);
    }

    public function errors($e)
    {
        if ($e->hasResponse()) {
            $response = json_decode($e->getResponse()->getBody(), true);
            return $response['errors'];
        }
        return $e->getMessage();
    }
}