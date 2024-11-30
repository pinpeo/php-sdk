<?php

namespace PinpeoSdk\Resources\Payments;

use PinpeoSdk\Resources\AbstractResource;
use Requests;

class Card extends AbstractResource
{
    /**
     * Card Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->apiUrl = 'https://api.pinpeo.com/';
        
    }


    /**
     * Create Payment Order
     *
     * @param array $data Order information like customer data, price currency an product
     *
     * @return array Structure with order details
     *
     * @throws \Exception Request error or exception
     */
    public function createOrder($data)
    {
        $endpoint = "{$this->apiUrl}/orders/payorder/manage/create_order/channel";

        $res = Requests::post(
            $endpoint,
            $this->headers,
            json_encode($data),
            $this->options
        );
        $this->validateResponse($res);

        return json_decode($res->body, true);
    }

    /**
     * Verify order status by id
     *
     * @param string $orderId Order id
     *
     * @return array Structure with order details
     *
     * @throws \Exception Request error or exception
     */
    public function verifyOrder($orderId)
    {
        $endpoint = "{$this->apiUrl}/orders/payorder/manage/order?id={$orderId}";

        $res = Requests::get(
            $endpoint,
            $this->headers,
            array(),
            $this->options
        );
        $this->validateResponse($res);

        return json_decode($res->body, true);
    }
}
