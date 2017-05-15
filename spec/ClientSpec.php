<?php

namespace spec\SebSept\PushOverClient;

use PhpSpec\ObjectBehavior;
use SebSept\PushOverClient\Client;

class ClientSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Client::class);
    }
}
