<?php

namespace Tests\Resources\Payments;

use PHPUnit\Framework\TestCase;
use PinpeoSdk\Resources\Payments\Card;

class TestCard extends TestCase
{
    const PUBLIC_KEY = '428e17d48';
    const PRIVATE_KEY = '7e7c0138694785';

    /**
     * Test creation of object Card
     *
     * @covers Card::withKeys
     *
     * @return Spei Instance of Spei object
     */
    public function testCreateObject()
    {
        try {
            $obj = (new Spei)->withKeys(self::PUBLIC_KEY, self::PRIVATE_KEY);
            $this->assertTrue($obj instanceof Spei);

            return $obj;
        } catch (\Exception $e) {
            echo "{$e->getMessage()}\n";
            $this->assertTrue(false);

            return null;
        }
    }

    /**
     * Test Card order creation
     *
     * @depends testCreateObject
     *
     * @covers Card::createOrder
     *
     * @param Card $obj Instance of Card object
     *
     * @return array New Card order
     */
    public function testCreateOrder(Card $obj)
    {
        try {
            $data = [
                "amount"=> 2,
                "properties"=> [
                    "email"=> "devenv+" . rand(0, 100) . "@dynamicore.io",
                    "fullname"=> "Jhon Doe",
                    "phone"=> "+525544778899",
                    "curp_rfc"=> "CCECEVWEW155",
                    "concept"=> "Accesorios"
                ],
                "channels"=> [
                    "payment_link"
                ]];


            $order = $obj->createOrder($data);
            $this->assertTrue(is_array($order) && isset($order['data']['id']));
            return $order;
        } catch (\Exception $e) {
            echo "{$e->getMessage()}\n";
            $this->assertTrue(false);

            return null;
        }
    }

    /**
     * Test Card order verification
     *
     * @depends testCreateObject
     * @depends testCreateOrder
     *
     * @covers Card::verifyOrder
     *
     * @param Card $obj
     *
     * @param array $order
     */
    public function testVerifyOrder(Card $obj, $order)
    {
        try {
            $verified = $obj->verifyOrder($order['data']['id']);
            $this->assertTrue($order['data']['id'] === $verified['data']['id']);
        } catch (\Exception $e) {
            echo "{$e->getMessage()}\n";
            $this->assertTrue(false);
        }
    }
}
