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
   * @var [type]
   */
  public $termBegin;

  /**
   * Term ending date
   *
   * @var [type]
   */
  public $termEnd;

  /**
   * Contstructor
   */
  public function __construct()
  {
    $this->initiateTerms();
  }

  /**
   * Load all terms via guzzle
   */
  protected function initiateTerms()
  {
    $response = $this->requester()->request('GET', 'Terms');

    $terms = json_decode($response->getBody(), true);

    $this->terms = $terms['value'];
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
    foreach($this->terms as $term) {
      if ($term['Name'] == $term_name . ' ' . $year) {

        $this->termId = $term['TermId'];
        $this->termName = $term['Name'];
        $this->termBegin = $term['StartDate'];
        $this->termEnd = $term['EndDate'];

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
   protected function currentTerm()
   {
     return 'c543a529-fed4-4fd0-b185-bd403106b4ea';
   }
}
