<?php

namespace DongyuKang\PurdueCourse\Classes;

use DongyuKang\PurdueCourse\Classes\Course;

class Classes extends Course
{
  protected $class_info;

  /**
   * Get All Classes
   */
  public function classes()
  {
    $this->class_info = $this->classes;

    return $this;
  }

  /**
   * Return class info by index in case there are more than one class information.
   */
  public function classByIndex($index)
  {
    if ($this->countCourses() > 1) {
      $this->class_info = $this->classes[$index];
    } else {
      $this->class_info = $this->classes;
    }

    return $this;
  }

  /**
   * Return class in array form
   *
   * @return Array
   */
  public function getClassInfo()
  {
    return $this->class_info;
  }

}
