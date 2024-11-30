<?php
/**
 * @author Support DynamiCore <support@dynamicore.io>
 */

namespace Tests;

use PHPUnit\Framework\TestCase;
use PinpeoSdk\Client;
use PinpeoSdk\Resources\Payments\Card;
use PinpeoSdk\Resources\Webhook;


class TestClient extends TestCase
{
    const PUBLIC_KEY = '14112423a086';
    const PRIVATE_KEY = '614142822f';


    /**
     * Test Client instanciation
     *
     * @coversNothing
     *
     * @return Client
     */
    public function testCreateObject()
    {
        try {
            $obj = new Client(self::PUBLIC_KEY, self::PRIVATE_KEY);

            $this->assertTrue($obj instanceof Client);

            return $obj;
        } catch (\Exception $e) {
            echo "{$e->getMessage()}\n";
            $this->assertTrue(false);
            $this->assertTrue(false);

            return null;
        }
    }


    /**
     * Test to obtaine Card
     *
     * @depends testCreateObject
     *
     * @covers Card::getAuth
     *
     * @param Client $obj Client object instance
     */
    public function testGetCardResource(Client $obj)
    {
        try {
            $resoruce = $obj->getResource(Card::class);

            $this->assertTrue($resoruce instanceof Card);
            $this->assertEquals(
                [self::PRIVATE_KEY, self::PUBLIC_KEY],
                $resoruce->getAuth()
            );
        } catch (\Exception $e) {
            echo "{$e->getMessage()}\n";
            $this->assertTrue(false);
            $this->assertTrue(false);
        }
    }


    /**
     * Test to obtaine Spei
     *
     * @depends testCreateObject
     *
     * @covers Webhook::getAuth
     *
     * @param Client $obj Client object instance
     */
    /*public function testGetWebhooksResource(Client $obj)
    {
        try {
            $resoruce = $obj->getResource(Webhook::class);

            $this->assertTrue($resoruce instanceof Webhook);
            $this->assertEquals(
                [self::PRIVATE_KEY, self::PUBLIC_KEY],
                $resoruce->getAuth()
            );
        } catch (\Exception $e) {
            echo "{$e->getMessage()}\n";
            $this->assertTrue(false);
            $this->assertTrue(false);
        }
    }*/

    /**
     * Validate get public key function
     *
     * @depends testCreateObject
     *
     * @covers Client::getPublicKey
     *
     * @param Client $obj Instance of Client object
     */
    public function testGetPublicKey(Client $obj)
    {
        $this->assertEquals(
            self::PUBLIC_KEY,
            $obj->getPublicKey()
        );
    }

    /**
     * Validate get private key
     *
     * @depends testCreateObject
     *
     * @covers Client::getPrivateKey
     *
     * @param Client $obj Instance of Client object
     */
    public function testGetPrivateKey(Client $obj)
    {
        $this->assertEquals(
            self::PRIVATE_KEY,
            $obj->getPrivateKey()
        );
    }
}
