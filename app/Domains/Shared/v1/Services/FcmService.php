<?php

namespace App\Domains\Shared\v1\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;

class FcmService 
{
    /**
     * The password.
     *
     * @var string
     */
    private string $server_key;

    /**
     * The http client instance.
     *
     * @var \Illuminate\Support\Facades\Http
     */
    protected Http $httpClient;

    /**
     * The class constructor.
     *
     * @param \Illuminate\Support\Facades\Http the http client.
     */
    public function __construct(Http $httpClient)
    {
        $this->server_key = config('fcm.server_key');
        $this->httpClient = $httpClient;
    }

    /**
     * Send the message.
     *
     * @param string|array The recipients mobile number.
     * @param string The message.
     *
     * @return void
     */
    public function send(array $data)
    {
        $response = $this->httpClient::withHeaders([
            'Authorization' => 'key='.$this->server_key,
            'Content-Type' => 'application/json' 
       ])->post("https://fcm.googleapis.com/fcm/send", $this->prepareAndGetNotificationPayload($data));
        
        return $response;
    }

    /**
     * Prepare and get Payload for the sending process.
     *
     * @param string|array Recipients mobile number.
     * @param string The message.
     *
     * @return array The payload.
     */
    protected function prepareAndGetNotificationPayload($data): array
    {
        return [
            'registration_ids'    => $data['device_tokens'],
            "notification"     => [
                "title" => $data['title'],
                "body" => $data['body'],
                "icon" => asset('admin-panel-assets/v1/images/logo-dark.png'),
            ],
        ];
    }
}
// asset('admin-panel-assets/v1/images/logo-dark.png')