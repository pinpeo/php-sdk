<?php

namespace pinpeoSdk\Resources;

use pinpeoSdk\Resources\AbstractResource;
use Requests;

class Webhook extends AbstractResource
{
    /**
     * Webhook Construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->apiUrl = 'https://api.pinpeo.com/';
    }

    /**
     * Returns a list of all registed webhooks
     *
     * @return array Webhook structure
     *
     * @throws \Exception Request error or exception
     */
    public function getAll()
    {
        $endpoint = "{$this->apiUrl}/webhooks";

        $res = Requests::get(
            $endpoint,
            array(),
            $this->options
        );
        $this->validateResponse($res);

        return json_decode($res->body, true);
    }

    /**
     * Register a new webhook
     *
     * @param string $url Webhook URL to register
     *
     * @return array Webhook structure
     *
     * @throws \Exception Request error or exception
     */
    public function create($url)
    {
        $enpoint = "{$this->apiUrl}/webhooks";
        $data = [
            "url" => $url
        ];

        $res = Requests::post(
            $enpoint,
            $this->headers,
            json_encode($data),
            $this->options
        );
        $this->validateResponse($res);

        return json_decode($res->body, true);
    }

    /**
     * Register a new webhook
     *
     * @param string $webhookId Webhook ID to update
     * @param string $url       Webhook URL to register
     *
     * @return array Webhook structure
     *
     * @throws \Exception Request error or exception
     */
    public function update($webhookId, $url)
    {
        $enpoint = "{$this->apiUrl}/webhooks/{$webhookId}";
        $data = [
            "url" => $url
        ];

        $res = Requests::put(
            $enpoint,
            $this->headers,
            json_encode($data),
            $this->options
        );
        $this->validateResponse($res);

        return json_decode($res->body, true);
    }

    /**
     * Register a new webhook
     *
     * @param string $webhookId Webhook ID to delete
     *
     * @return array Webhook structure
     *
     * @throws \Exception Request error or exception
     */
    public function delete($webhookId)
    {
        $enpoint = "{$this->apiUrl}/webhooks/{$webhookId}";

        $res = Requests::delete(
            $enpoint,
            array(),
            $this->options
        );
        $this->validateResponse($res);

        return json_decode($res->body, true);
    }
}
