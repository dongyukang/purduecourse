<?php

namespace DongyuKang\PurdueCourse\Traits;

use GuzzleHttp\Client;

trait HttpRequestManager
{
  protected $client;


  /**
   * Initialize base uri.
   */
  protected function init()
  {
    $this->client = new Client([
      'base_uri' => 'http://api.purdue.io/odata/'
    ]);
  }

  protected function requester()
  {
    $this->init();

    return $this->client;
  }

  /**
   * Request as get
   *
   * @param  $query
   * @return array
   */
  public function requestAsGet($query)
  {
    $response = $this->requester()->request('GET', $query);
    $data = json_decode($response->getBody(), true);
    return $data['value'];
  }
}
