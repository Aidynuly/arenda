<?php

declare(strict_types=1);

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class FirebaseNotification
 * @package App\Services
 */
class FirebaseNotification
{
    /** @var string  */
    protected $endpoint;

    public function __construct()
    {
        $this->endpoint = "https://fcm.googleapis.com/fcm/send";
    }

    /**
     * @param String $token
     * @param String $title
     * @param String $body
     * @throws GuzzleException
     */
    public function send(String $token, String $title, String $body): void
    {
        $server_key = env("FCM_SERVER_KEY");

        $headers = [
            'Authorization' => 'key='.$server_key,
            'Content-Type'  => 'application/json',
            'Accept'        => 'application/json',
        ];

        $fields = json_encode([
            'to'                => '/topics/token_'.$token,
            'content-available' => true,
            'priority'          => 'high',
            'notification'      => [
                'title' => $title,
                'body'  => $body,
            ],
        ]);

        $client = new Client();

        try{
            $client->post($this->endpoint, [
                'headers' => $headers,
                'body'    => $fields,
            ]);
        } catch (GuzzleException $e) {
            throw $e;
        }
    }
}
