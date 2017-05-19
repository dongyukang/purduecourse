<?php

namespace DongyuKang\PurdueCourse\Classes;

use DongyuKang\PurdueCourse\Classes\Term;

class Course extends Term
{

  public function course()
  {

    /**
     * If user tries to access to course() directly without filtering through term,
     * then the default term will be current term.
     */
    if ($this->termId == NULL) {
      $this->termId = $this->currentTerm();
    }

    return $this->termId;
  }
}
