<?php

namespace PinpeoSdk\Resources;

use PinpeoSdk\Helpers\ValidationHelper;

abstract class AbstractResource
{
    use ValidationHelper;


    function getPath($url) {
        $parsedUrl = parse_url($url);
        return isset($parsedUrl['path']) ? $parsedUrl['path'] : '';
    }
    
    function getQueryString($url) {
        $parsedUrl = parse_url($url);
        return isset($parsedUrl['query']) ? $parsedUrl['query'] : '';
    }
    
    function getAuthHeader($CLIENT_KEY, $hash, $httpMethod, $requestUrl, $_requestBody) {
        $SECRET_KEY = hash('sha512', $hash);
        $AUTH_TYPE = 'Pinpeo';
    
        $requestBody = '';
        $requestPath = getPath($requestUrl);
        global $_requestPath;
        $_requestPath = $requestPath;
    
        $queryString = getQueryString($requestUrl);
    
        if ($httpMethod == 'GET' || empty($_requestBody)) {
            $requestBody = '';
        } else {
            $requestBody = json_encode(json_decode($_requestBody));
        }
    
        $timestamp = round(microtime(true) * 1000);
        $requestData = trim($timestamp . $httpMethod . $requestPath . $queryString . $requestBody);
        global $_requestData;
        $_requestData = $requestData;
    
        $hmacDigest = hash_hmac('sha256', $requestData, $SECRET_KEY);
        $authHeader = $AUTH_TYPE . ' ' . $CLIENT_KEY . ':' . $timestamp . ':' . $hmacDigest;
    
        return $authHeader;
    }
    
    /*// Ejemplo de uso
    $httpMethod = 'POST';
    $requestUrl = 'https://sandbox.pinpeo.com/orders/payorder/manage/create_order/channel';
    $requestBody = '{
        "amount": 20,
        "properties": {
            "email": "email@yopmail.com",
            "fullname": "Jhon Doe",
            "phone": "+525544778899",
            "curp_rfc": "CCECEVWEW155",
            "concept": "Accesorios"
        },
        "channels": [
            "payment_link"
        ]
    }';
    
    $authHeader = getAuthHeader($httpMethod, $requestUrl, $requestBody);
    echo "Authorization Header: " . $authHeader; */
    
    

    /**
     * Authorization for the API requests
     *
     * @var array
     */
    protected $options = [];

    /**
     * Base API url for the endpoints
     *
     * @var string
     */
    protected $apiUrl = '';

    /**
     * Shared headers between resources
     *
     * @var array
     */
    protected $headers = [];

    /**
     * AbstractResource Construct
     */
    public function __construct()
    {
        $this->options = ['auth' => null];
        $this->headers = ['Content-Type' => 'application/json'];
    }

    /**
     * Set keys for the Pinpeo API
     *
     * @param string $public  Public key of Pinpeo panel
     * @param string $private Private key of Pinpeo panel
     *
     * @return AbstractResorce Self resource instance
     */
    public function withKeys($public, $private)
    {
        $this->options['auth'] = [$private, $public];
        return $this;
    }

    /**
     * Return an array with the auth information of the request
     *
     * @return array Auth array data
     */
    public function getAuth()
    {
        return $this->options['auth'];
    }
}
