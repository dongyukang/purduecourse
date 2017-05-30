<?php

namespace DongyuKang\PurdueCourse\Classes;

use Carbon\Carbon;
use DongyuKang\PurdueCourse\Traits\HttpRequestManager;

class Term
{
  use HttpRequestManager;

  /**
   * Array that contains all terms in json type
   *
   * @var Array
   */
  protected $terms;

  /**
   * Today date
   *
   * @var Date
   */
  protected $today;

  /**
   * Term id
   *
   * @var String
   */
  public $termId;

  /**
   * Name of term
   *
   * @var String
   */
  public $termName;

  /**
   * Term beggining date
   *
   * @var Date
   */
  public $termBegin;

  /**
   * Term ending date
   *
   * @var Date
   */
  public $termEnd;

  /**
   * Term Code
   *
   * @var String
   */
  public $termCode;

  /**
   * Contstructor
   */
  public function __construct()
  {
    $this->terms = $this->requestAsGet('Terms');
    $this->today = Carbon::now()->format('Y-m-d');
  }

  /**
   * A method that iterates through 'Terms'
   * and returns the specific term id as an object
   *
   * @param  $term_name Name of the term season, such as 'fall'
   * @param  $year
   * @return $termId
   */
  protected function getTermId($term_name, $year)
  {
    foreach(array_reverse($this->terms) as $term) {
      if ($term['Name'] == $term_name . ' ' . $year) {

        $this->termId = $term['TermId'];
        $this->termName = $term['Name'];
        $this->termBegin = $term['StartDate'];
        $this->termEnd = $term['EndDate'];
        $this->termCode = $term['TermCode'];

        return $this;
      }
    }
  }

  /**
   * Returns term id of spring semester of specific year
   *
   * @param  $year
   * @return $termId
   */
   public function spring($year)
   {
     return $this->getTermId('Spring', $year);
   }

   /**
    * Returns term id of summer semester of specific year
    *
    * @param  $year
    * @return $termId
    */
   public function summer($year)
   {
     return $this->getTermId('Summer', $year);
   }

   /**
    * Returns term id of fall semester of specific year
    *
    * @param  $year
    * @return $termId
    */
   public function fall($year)
   {
     return $this->getTermId('Fall', $year);
   }

   /**
    * Returns term id of current semester of current year
    *
    * @param  $year
    * @return $termId
    */
   public function currentTerm()
   {
     foreach(array_reverse($this->terms) as $term) {
       if ($term['StartDate'] < $this->today && $this->today < $term['EndDate']) {
         $termData = explode(' ', $term['Name']);
         return $this->getTermId($termData[0], $termData[1]);
       }
     }

     return null;
   }
}
