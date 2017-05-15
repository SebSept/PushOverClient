<?php
/**
 * Pushover Message
 *
 * @author Sébastien Monterisi <contact@seb7.fr>
 */

namespace SebSept\PushOverClient;


class Message
{
    /**
     * @var string
     */
    private $message;


    /**
     * Message constructor.
     * @param string $message
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }


}