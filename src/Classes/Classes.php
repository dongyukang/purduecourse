<?php

namespace DongyuKang\PurdueCourse\Classes;

use DongyuKang\PurdueCourse\Classes\Course;

class Classes extends Course
{

  /**
   * Get Classes
   */
  public function classes()
  {
    return $this->classes;
  }

  /**
   * Conditional clause
   *
   *  @param $condition Either numeric or array
   */
  public function class($condition)
  {
    if (is_array($condition)) {
      return $this->getClassByCondition($condition);
    }
    return null;
  }

  protected function getClassByCondition($condition)
  {
  }

}
