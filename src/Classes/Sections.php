<?php

namespace DongyuKang\PurdueCourse\Classes;

use DongyuKang\PurdueCourse\Classes\Course;

class Sections extends Classes
{
  protected $sections_info;

  public function sections()
  {
    $this->sections_info = $this->class_info['Sections'];

    return $this;
  }

  public function sectionByCondition($condition)
  {

  }

  public function getSectionInfo()
  {
    return $this->sections_info;
  }
}
