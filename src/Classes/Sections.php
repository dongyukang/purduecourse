<?php

namespace DongyuKang\PurdueCourse\Classes;

use DongyuKang\PurdueCourse\Classes\Classes;

class Sections extends Classes
{
  protected $sections_info;

  /**
   * Get all sections from certain class.
   */
  public function sections()
  {
    $this->sections_info = array();

    // If there are more than one same course in single term, such as 'PHYS 172000',
    // then additional array for each course is wrapped.
    if ($this->countCourses() > 1) {
      for ($i = 0; $i < $this->countCourses(); $i++) {
        foreach ($this->class_info[$i] as $class) {
          array_push($this->sections_info, [
            'ClassIndex'  => $i,
            'Sections'    => $class['Sections']
          ]);
        }
      }
    } else {

    }

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
