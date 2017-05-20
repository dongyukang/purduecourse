<?php

namespace DongyuKang\PurdueCourse\Traits;

trait CourseDataManager
{

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
}
