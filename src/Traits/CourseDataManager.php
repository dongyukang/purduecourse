<?php

namespace DongyuKang\PurdueCourse\Traits;

use DongyuKang\PurdueCourse\Traits\HttpRequestManager;

trait CourseDataManager
{
  use HttpRequestManager;

  /**
   * Splits course data.
   * ex) Given 'CS 180', it splits into 'CS' and '180'
   * 'CS' will be saved into $subject and '180' will be saved into $course_number with
   * converted '18000'.
   *
   * @param $course
   * @return array $data
   */
  public function splitCourseData($course)
  {
    $courseData = explode(' ', $course);

    $course_number = '00';

    if (strlen($courseData[1]) == 3) {
      $course_number = $courseData[1] . $course_number;
    } else {
      $course_number = $courseData[1];
    }

    $data = [
      'subject' => strtoupper($courseData[0]),
      'course_number'  => $course_number
    ];

    return $data;
  }

  /**
   * Check if course is available during specific semester
   *
   * @return Boolean return 'true' if available
   */
  public function checkCourseAvailability($termId, $subject, $course_number)
  {
    $query = 'Courses?$expand=Classes&$filter=Subject/Abbreviation eq ' . "'" . $subject . "'" .' and Number eq ' . "'" . $course_number . "'";

    $classes = $this->requestAsGet($query);

    foreach ($classes[0]['Classes'] as $class) {
      if ($class['TermId'] == $termId) return true;
    }

    return false;
  }
}
