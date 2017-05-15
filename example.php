<?php

use GuzzleHttp\Client as GuzzleClient;
use SebSept\PushOverClient\{
    AppToken, Client, Exception, Message, UserToken
};

require_once("vendor/autoload.php");

try {
    $pushover_client = new Client(new GuzzleClient(), new AppToken("a_real_app_token_is_needed"), new UserToken("user_token"));
    $request_id = $pushover_client->push(new Message("Yep, envoyé par mon client."));
    echo "Push message sent. Request id : " . $request_id;
} catch (Exception $client_exception) {
    echo "Exception client : " . $client_exception->getMessage();
} catch (\Exception $exception) {
    echo "Exception baes : " . $client_exception->getMessage();
}