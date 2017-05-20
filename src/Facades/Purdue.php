<?php

namespace DongyuKang\PurdueCourse\Facades;

use Illuminate\Support\Facades\Facade;

class Purdue extends Facade
{
  protected static function getFacadeAccessor()
  {
    return 'purdue';
  }
}
