<?php

namespace DongyuKang\PurdueCourse\Classes;

use DongyuKang\PurdueCourse\Classes\Course;

class Classes extends Course
{
  protected $class_info;

  /**
   * Get All Classes
   */
  public function class()
  {
    if ($this->countCourses() > 1) {
      dd('This course `' . $this->subject . ' ' . $this->course_number . '` has more than one course. Use `classByIndex` method to choose one class.');
    }

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
