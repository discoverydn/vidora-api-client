<?php namespace Discoverydn\VidoraApiClient\Requests\Behavioral;

use DiscoveryDN\VidoraApiClient\Requests\Request;
use DiscoveryDN\VidoraApiClient\Client;

use Carbon\Carbon;

class BehavioralRequest extends Request
{
    const types = [
        'play',
        'playhead_update',
        'share',
        'like',
        'purchase',
        'click',
        'shown',
        'sent',
    ];

    public function __construct(Client $client, $userId, $itemId, $type, Array $params = [])
    {
        $this->setClient($client);
        //$this->setPath('/v1/users/' . $userId . '/items/' . $itemId . '/similars');
        //$this->setMethod('GET');

        if (! in_array($type, self::types)) {
            throw new \Exception('Invalid type selected. It must be one of: ' . implode(', ', self::types));
        }

        // Add a default params
        $this->addParams([
            'api_key' => $client->getApiKey(),
            'expires' => (new Carbon(null, 'UTC'))->addHours(1)->format('Y-m-d\TH:i'),
        ]);

        // Params added here will override the defaults
        $this->addParams($params);
    }
}