<?php
namespace Bhaktaraz\WaveApp;

use Exception;
use GuzzleHttp\Client;
use Bhaktaraz\WaveApp\GraphQL\Query;
use Bhaktaraz\WaveApp\GraphQL\Mutation;

class WaveApp
{
    /**
     * @var Client
     */
    private $client;
    private $headers;
    private $url = 'https://gql.waveapps.com/graphql/public';
    private $accessToken;
    private $businessId;
    /**
     * @var ResponseBuilder
     */
    private $responseBuilder;

    public function __construct($accessToken, $businessId)
    {
        if (empty($accessToken)) {
            throw new Exception("Please set wave app's access token.", 400);
        }

        $this->accessToken = $accessToken;
        $this->businessId = $businessId;

        $this->client = new Client();
        $this->headers = [
            'Authorization' => 'Bearer ' . $this->accessToken,
        ];
        $this->responseBuilder = new ResponseBuilder();
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed|string
     * @throws Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function __call($name, $arguments)
    {
        $query = null;
        $variables = null;
        $operationName = null;

        if (count($arguments) == 2) {
            if (!is_string($arguments[1])) {
                throw new Exception("Operation name is expected to be a string.", 422);
            }
            if (!$this->is_assoc($arguments[0])) {
                throw new Exception("Variables are expected to be an associative array.", 422);
            }
            $query = Mutation::$name();
            $variables = $arguments[0];
            $operationName = $arguments[1];
        } elseif (count($arguments) > 2) {
            throw new Exception('Too many arguments', 422);
        } else {
            $query = Query::$name();
            $variables = count($arguments) > 0 ? $arguments[0] : null;
        }

        $options = [
            'json' => [
                'query' => $query,
                'variables' => $variables,
                'operationName' => $operationName,

            ],
            'headers' => $this->headers
        ];

        try {
            $res = $this->client->request('POST', $this->url, $options);
            return $this->responseBuilder->success($res);
        } catch (Exception $e) {
            return $this->responseBuilder->errors($e);
        }
    }

    /**
     * @param $arr
     * @return bool
     */
    private function is_assoc($arr)
    {
        if (!is_array($arr)) {
            return false;
        }
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
}