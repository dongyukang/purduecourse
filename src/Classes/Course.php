<?php

namespace DongyuKang\PurdueCourse\Classes;

use DongyuKang\PurdueCourse\Classes\Term;

class Course extends Term
{

  protected $course;

  protected $subject;

  protected $course_number;

  /**
   *
   *
   * @param   $course
   */
  public function course($course)
  {


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

  public function only()
  {
    return 'only';
  }

  public function except()
  {
    return 'except';
  }
}
