<?php

namespace DongyuKang\PurdueCourse\Classes;

use DongyuKang\PurdueCourse\Traits\CourseDataManager;

class SimpleQueryBuilder
{
  use CourseDataManager;

  protected $subabbeq = 'Subject/Abbreviation eq ';

  protected $endpoint = null;

  protected $filter = null;

  protected $expand = null;

  public function endpoint($endpoint)
  {
    $this->endpoint = $endpoint . '?';

    return $this;
  }

  public function expand($endpoints)
  {
    $this->expand .= $endpoints;

    return $this;
  }

  public function filter($filterations)
  {
    if (!is_array($filterations)) return null;

    if ($filterations['course'] != null) {

      /* At this point, only 'course' is available to filter, but more will be added. */
      $course_data = $this->splitCourseData($filterations['course']);

      $subnumquery = "'" . $course_data['subject'] . "'" . ' and Number eq ' . "'" . $course_data['course_number'] . "'";
    }

    $this->filter = '$filter=' . $this->subabbeq . $subnumquery;

    return $this;
  }

  public function build()
  {
    return $this->endpoint . $this->expand . '&' . $this->filter;
  }
}
