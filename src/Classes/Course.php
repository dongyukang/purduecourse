<?php

namespace DongyuKang\PurdueCourse\Classes;

use DongyuKang\PurdueCourse\Classes\Term;
use DongyuKang\PurdueCourse\Traits\CourseDataManager;
use DongyuKang\PurdueCourse\Classes\SimpleQueryBuilder as Builder;

class Course extends Term
{
  use CourseDataManager;

  protected $subject = null;

  protected $course_number = null;

  protected $courses = null;

  public function course($course)
  {
    $courseData = $this->splitCourseData($course);
    $this->subject = $courseData['subject'];
    $this->course_number = $courseData['course_number'];

    if (!$this->checkCourseAvailability($this->termId, $this->subject, $this->course_number)) {
      echo 'Course may not offer during the term you have selected.';
      return null;
    }

    /**
     * If user tries to access to course() directly without filtering through term,
     * then the default term will be current term.
     */
    if ($this->termId == NULL) {
      $this->termId = $this->currentTerm();
    }

    return $this;
  }

  public function queryTest()
  {
    $builder = new Builder();
    $query = $builder->endpoint('Courses')->expand('$expand=Classes($expand=Sections)')->filter(['course' => 'cs 180'])->build();

    return $query;
  }

  public function all()
  {
    $course = $this->subject . ' ' . $this->course_number;
    $builder = new Builder();
    $query = $builder->endpoint('Courses')->expand('$expand=Classes($expand=Sections($expand=Meetings))')->filter(['course' => $course])->build();
    $this->courses = $this->requestAsGet($query);

    $course_data = [
    ];

    return $course_data;
  }

  /**
   * Can select which properties to pull
   *
   *
   * @param  [type] $property [description]
   * @return [type]           [description]
   */
  public function only($property)
  {
    return 'only';
  }

  public function except($property)
  {
    return 'except';
  }
}
