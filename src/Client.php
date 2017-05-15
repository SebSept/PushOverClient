<?php
/**
 * Pushover API Client
 *
 * @author Sébastien Monterisi <contact@seb7.fr>
 */

namespace SebSept\PushOverClient;


use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\TransferException;

class Client
{
    const API_BASE_URI = "https://api.pushover.net/1/messages.json";

    /**
     * @var \GuzzleHttp\Client
     */
    private $guzzle_client;
    /**
     * @var AppToken
     */
    private $app_token;
    /**
     * @var UserToken
     */
    private $user_token;

    public function __construct(\GuzzleHttp\Client $guzzle_client, AppToken $app_token, UserToken $user_token)
    {
        $this->guzzle_client = $guzzle_client;
        $this->app_token = $app_token;
        $this->user_token = $user_token;
    }


    public function push(Message $message)
    {
        try {
            $response = $this->guzzle_client->post(self::API_BASE_URI, ["form_params" => [
                "token" => $this->app_token->getToken(),
                "user" => $this->user_token->getToken(),
                "message" => $message->getMessage(),
            ]]);

            $response_object = \GuzzleHttp\json_decode($response->getBody());
            return $response_object->request;
        } // client exception : 400 response code, problem with this code (or api changed).
        catch (ClientException $client_exception) {
            throw new Exception("Unexpected bad API call : " . $client_exception->getMessage());
        } // all Guzzle Exceptions
        catch (TransferException $exception) {
            throw new Exception("Transfert exception : " . $exception->getMessage());
        } // failed to json_decode
        catch (\InvalidArgumentException $exception) {
            throw new Exception("Response Exception : " . $exception->getMessage());
        }
    }

}