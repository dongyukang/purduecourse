<?php

namespace DongyuKang\PurdueCourse\Classes;

use DongyuKang\PurdueCourse\Classes\Term;
use DongyuKang\PurdueCourse\Traits\CourseDataManager;
use DongyuKang\PurdueCourse\Classes\SimpleQueryBuilder as Builder;

class Course extends Term
{
  use CourseDataManager;

  /**
   *
   * @var Array
   */
  protected $courses;

  /**
   *
   *
   * @var Array
   */
  protected $classes;

  /**
   * Number of courses.
   * Default is 1.
   *
   * @var integer
   */
  protected $count_courses = 1;

  /**
   * Subject entity.
   *
   * @var String
   */
  public $subject;

  /**
   * Course number in a 5 digit string.
   *
   * @var String
   */
  public $course_number;

  /**
   * Numeric value of credits for the course.
   *
   * @var Double
   */
  public $creditHours;

  /**
   * Title of the course, ex) 'Multivariate Calculus'.
   *
   * @var String
   */
  public $title;

  /**
   * A unique identifier for a specific course.
   *
   * @var String
   */
  public $courseId;

  /**
   * Course description and/or notes ex) 'Evening Exams Required'.
   *
   * @var [type]
   */
  public $description;

  public function course($course)
  {
    $courseData = $this->splitCourseData($course);
    $this->subject = $courseData['subject'];
    $this->course_number = $courseData['course_number'];

    if (!$this->checkCourseAvailability($this->termId, $this->subject, $this->course_number)) {
      abort(404, 'Course not offer during this term');
    }

    $course = $this->subject . ' ' . $this->course_number;

    $builder = new Builder();
    $query = $builder->endpoint('Courses')
    ->expand('$expand=Classes($expand=Sections($expand=Meetings($expand=Instructors)))')
    ->filter(['course' => $course])->build();

    $this->courses = $this->requestAsGet($query);

    if (count($this->courses) > 1) {
      $this->count_courses = count($this->courses);
      $this->classes = $this->courseId = $this->title = $this->creditHours = $this->description = array();

      foreach($this->courses as $course) {
        array_push($this->courseId, $course['CourseId']);
        array_push($this->title, $course['Title']);
        array_push($this->creditHours, $course['CreditHours']);
        array_push($this->description, $course['Description']);
        array_push($this->classes, $this->pullClassData($this->termId, $course['Classes']));
      }
    } else {
      $this->courseId = $this->courses[0]['CourseId'];
      $this->title = $this->courses[0]['Title'];
      $this->creditHours = $this->courses[0]['CreditHours'];
      $this->description = $this->courses[0]['Description'];
      $this->classes = $this->pullClassData($this->termId, $this->courses[0]['Classes']);
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
    $course_data = array();

    if ($this->count_courses > 1) {
      for ($i = 0; $i < $this->count_courses; $i++) {
        array_push($course_data, [
          'CourseId'    => $this->courseId[$i],
          'Title'       => $this->title[$i],
          'CreditHours' => $this->creditHours[$i],
          'Description' => $this->description[$i],
          'Classes'     => $this->classes[$i]
        ]);
      }
    } else {
      $course_data = [
        'CourseId'    => $this->courseId,
        'Title'       => $this->title,
        'CreditHours' => $this->creditHours,
        'Description' => $this->description,
        'Classes'     => $this->classes
      ];
    }

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
}
