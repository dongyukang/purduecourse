<?php

namespace DongyuKang\PurdueCourse\Classes;

use DongyuKang\PurdueCourse\Classes\Course;

class Sections extends Classes
{
  protected $sections_info;

  /**
   * Get all sections from certain class.
   */
  public function sections()
  {
    if ($this->countCourses() > 1) {
      $this->sections_info = array();
      foreach ($this->classes as $class) {
        array_push($this->sections_info, $class['Sections']);
      }
    } else {
      $this->sections_info = $this->class_info['Sections'];
    }

    return $this;
  }

  /**
   * Get certain sections by filtering through condition.
   *
   * @param  $condition
   */
  public function sectionByCondition($condition)
  {

  }

  /**
   * Get actual data of section.
   *
   * @return Array
   */
  public function getSectionInfo()
  {
    return $this->sections_info;
  }
}
