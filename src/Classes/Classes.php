<?php

namespace DongyuKang\PurdueCourse\Classes;

use DongyuKang\PurdueCourse\Classes\Course;

class Classes extends Course
{
  /**
   * Class info
   *
   * @var Array
   */
  protected $class_info;

  /**
   * Get All Classes
   */
  public function classes()
  {
    $this->class_info = array();

    foreach ($this->classes as $class) {
      array_push($this->class_info, $class);
    }

    return $this;
  }

  /**
   * Count classes
   *
   * @return Integer $count_courses
   */
  public function countClasses()
  {
    return count($this->class_info);
  }

  /**
   * Return class in array form
   *
   * @return Array
   */
  public function getClasses()
  {
    return $this->class_info;
  }

}
