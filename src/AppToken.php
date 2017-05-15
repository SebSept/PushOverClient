<?php
/**
 * pushoverclient
 *
 * @author Sébastien Monterisi <contact@seb7.fr>
 */

namespace SebSept\PushOverClient;


class AppToken
{
    /**
     * @var string
     */
    private $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }


}