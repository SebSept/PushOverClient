<?php

namespace spec\SebSept\PushOverClient;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SebSept\PushOverClient\AppToken;
use SebSept\PushOverClient\Client;
use SebSept\PushOverClient\Exception;
use SebSept\PushOverClient\Message;
use SebSept\PushOverClient\UserToken;

class ClientSpec extends ObjectBehavior
{
    /**
     * @param \PhpSpec\Wrapper\Collaborator|Message $message
     * @param \GuzzleHttp\Client|\PhpSpec\Wrapper\Collaborator $guzzle_client
     */
    function let(Message $message, \GuzzleHttp\Client $guzzle_client)
    {
        $pushover_app_token = new AppToken("this_is_supposed_to_be_a_valid_app_token");
        $pushover_user_token = new UserToken("this_is_supposed_to_be_a_valid_user_token");
        $this->beConstructedWith($guzzle_client, $pushover_app_token, $pushover_user_token);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Client::class);
    }

    function it_throw_an_exception_if_it_fails_to_push_a_message($message, $guzzle_client)
    {
        $guzzle_client->post(Argument::any(), Argument::any())->willThrow(
            new ClientException("Request Failed", new Request("post", "http://notarealurl.zzzy"))
        );
        $message->getMessage()->willReturn("the message content");

        $this->shouldThrow(Exception::class)->during("push", [$message]);
    }

    function it_returns_a_request_id_on_success($message, $guzzle_client)
    {
        $request_id = "3a76d6a8-6cf8-40f5-b294-12fc8eb00bb6";
        $response = new Response(200, [], json_encode(["status" => "1", "request" => "$request_id"]));
        $guzzle_client->post(Argument::any(), Argument::any())->willReturn($response);
        $message->getMessage()->shouldBeCalled()->willReturn("A message to push");

        $this->push($message)->shouldReturn($request_id);
    }
}
