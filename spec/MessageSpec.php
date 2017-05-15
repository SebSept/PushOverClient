<?php

namespace spec\SebSept\PushOverClient;

use PhpSpec\ObjectBehavior;
use SebSept\PushOverClient\Message;

class MessageSpec extends ObjectBehavior
{
    const MESSAGE_CONTENT = "some message to send";

    function let()
    {
        $this->beConstructedWith(self::MESSAGE_CONTENT);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Message::class);
    }

    function it_has_a_message()
    {
        $this->getMessage()->shouldBe(self::MESSAGE_CONTENT);
    }
}
