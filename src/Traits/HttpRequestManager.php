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

  public function requester()
  {
    $this->init();

    return $this->client;
  }
}
