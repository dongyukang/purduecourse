<?php

namespace DongyuKang\PurdueCourse\Classes;

use DongyuKang\PurdueCourse\Classes\Term;
use DongyuKang\PurdueCourse\Traits\CourseDataManager;

class Course extends Term
{
  use CourseDataManager;

  protected $subject;

  protected $course_number;

  public function course($course)
  {
    $courseData = $this->splitCourseData($course);
    $this->subject = $courseData['subject'];
    $this->course_number = $courseData['course_number'];

    if (!$this->checkCourseAvailability($this->termId, $this->subject, $this->course_number)) {
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

  public function all()
  {
    return $this->termId;
  }

  /**
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
