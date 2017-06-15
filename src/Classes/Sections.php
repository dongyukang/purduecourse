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
   * For example, a line
   * Purdue::course('cs 180')->classes()->sections()->type('Laboratory')->getSectionInfo();
   * gives arrays of sections that type is lab.
   *
   * @param  $condition
   */
  public function type($type)
  {
    $sections = array();
    $newData = array();

    if ($this->countCourses() > 1) {
      foreach ($this->sections_info as $courseIndex) {
        foreach ($courseIndex['Sections'] as $section) {
          if ($section['Type'] == $type) {
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
          if ($section['Type'] == $type) {
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
   * Get all sections that are not lecture.
   */
  public function excludeLecture()
  {
    $sections = array();
    $newData = array();

    if ($this->countCourses() > 1) {
      foreach ($this->sections_info as $courseIndex) {
        foreach ($courseIndex['Sections'] as $section) {
          if ($section['Type'] != 'Lecture') {
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
          if ($section['Type'] != 'Lecture') {
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
   * Get actual data of section.
   *
   * @return Array
   */
  public function getSections()
  {
    return $this->sections_info;
  }
}
