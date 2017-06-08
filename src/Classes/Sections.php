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
            'CourseIndex' => $i,
            'Sections'    => $class['Sections']
          ]);
        }
      }
    } else {
      foreach ($this->class_info as $class) {
        array_push($this->sections_info, $class['Sections']);
      }
    }

    return $this;
  }

  /**
   * Return section(s) that has remaining space greater than given number.
   */
  public function spaceGreaterThan($space)
  {
    $sections = array();
    $newData = array();

    if ($this->countCourses() > 1) {
      foreach ($this->sections_info as $courseIndex) {
        foreach ($courseIndex['Sections'] as $section) {
          if ($section['RemainingSpace'] > $space) {
            array_push($sections, $section);
          }
        }
        array_push($newData, [
          'CourseIndex' => $courseIndex['CourseIndex'],
          'Sections'    => $sections
        ]);

        $sections = array(); // empty array
      }
    } else {
      foreach ($this->sections_info as $sections_info) {
        foreach ($sections_info as $section) {
          if ($section['RemainingSpace'] > $space) {
            array_push($sections, $section);
          }
        }
        array_push($newData, $sections);

        $sections = array();
      }
    }

    $this->sections_info = $newData;

    return $this;
  }

  /**
   * Return section(s) that has remaining space less than given number.
   */
  public function spaceLessThan($space)
  {
    $sections = array();
    $newData = array();

    if ($this->countCourses() > 1) {
      foreach ($this->sections_info as $courseIndex) {
        foreach ($courseIndex['Sections'] as $section) {
          if ($section['RemainingSpace'] < $space) {
            array_push($sections, $section);
          }
        }
        array_push($newData, [
          'CourseIndex' => $courseIndex['CourseIndex'],
          'Sections'    => $sections
        ]);

        $sections = array(); // empty array
      }
    } else {
      foreach ($this->sections_info as $sections_info) {
        foreach ($sections_info as $section) {
          if ($section['RemainingSpace'] < $space) {
            array_push($sections, $section);
          }
        }
        array_push($newData, $sections);

        $sections = array();
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
