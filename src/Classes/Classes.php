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
   * Load All Classes
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
   * Get classes by course id, if there are more than one courses.
   */
  public function classesByCourseId($courseId)
  {
    $this->class_info = array();

    if ($this->countCourses() > 1) {
      foreach ($this->classes as $classes) {
        foreach ($classes as $class) {
          if ($class['CourseId'] == $courseId) {
            array_push($this->class_info, $class);
          }
        }
      }

      $this->count_courses = 1;
      
      return $this;
    }

    return $this->classes();
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
