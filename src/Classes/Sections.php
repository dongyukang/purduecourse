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
    $this->sections_info = $this->class_info['Sections'];

    return $this;
  }

  /**
   * Return section(s) that has capacity greater than given number.
   */
  public function spaceGreaterThan($capacity)
  {
    $newData = array();

    foreach ($this->sections_info as $section) {
      if ($section['RemainingSpace'] > $capacity) {
        array_push($newData, $section);
      }
    }

    $this->sections_info = $newData;

    return $this;

  }

  /**
   * Return section(s) that has capacity less than given number.
   */
  public function spaceLessThan($capacity)
  {
    $newData = array();

    foreach ($this->sections_info as $section) {
      if ($section['RemainingSpace'] < $capacity) {
        array_push($newData, $section);
      }
    }

    $this->sections_info = $newData;

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
