<?php

namespace DongyuKang\PurdueCourse\Classes;

use DongyuKang\PurdueCourse\Classes\Course;

class Classes extends Course
{

  /**
   * Get All Classes
   */
  public function classes()
  {
    return $this->classes;
  }

  /**
   * Return class info by index in case there are more than one class information.
   *
   * @param  [type] $index [description]
   * @return [type]        [description]
   */
  public function classByIndex($index)
  {
    if ($this->countCourses() > 1) {
      return $this->classes[$index];
    }

    return $this->classes;
  }

}
