
<?php

class Pagination 
{
    // total records in table
    public $total_records;

    // limit of items per page
    private $limit;

    // total number of pages needed
    private $total_pages;

    // first and back links
    private $firstBack;

    // next and last links
    private $nextLast;

    // where are we among all pages?
    private $where;

    public function __construct() {
        
    }

    // determines the total number of records in table
    public function totalRecords($table)
    {
        $dbc = Database::getInstance();
        $query = 'select * from '.$table;
        $this->total_records = $dbc->getRows($query);
        if (!$this->total_records) {
            echo 'No records found!';
            return;
        }
    }

    // sets limit and number of pages
    public function setLimit($limit)
    {
        $this->limit = $limit;

        // determines how many pages there will be
        if (!empty($this->total_records)) {
            $this->total_pages = ceil($this->total_records / $this->limit);
        }
    }

    // determine what the current page is also, it returns the current page
    public function page($search)
    {
        $pageno =  (int)(isset($_GET['pageno'])) ? $_GET['pageno'] : $pageno = 1;

        // out of range check
        if ($pageno > $this->total_pages) {
            $pageno = $this->total_pages;
        } elseif ($pageno < 1) {
            $pageno = 1;
        }

        // links
        if ($pageno > 1) {
            // backtrack
            $prevpage = $pageno -1;

            // 'first' and 'back' links
            $this->firstBack = "<div><a href='$_SERVER[PHP_SELF]?submitted=1&search=$search&pageno=1'>First</a> <a href='$_SERVER[PHP_SELF]?submitted=1&search=$search&pageno=$prevpage'>Back</a></div>";
        }

        $this->where =  "<div>(Page $pageno of $this->total_pages)</div>";

        if ($pageno < $this->total_pages) {
            // forward
            $nextpage = $pageno + 1;

            // 'next' and 'last' links
            $this->nextLast =  "<div><a href='$_SERVER[PHP_SELF]?submitted=1&search=$search&pageno=$nextpage'>Next</a> <a href='$_SERVER[PHP_SELF]?submitted=1&search=$search&pageno=$this->total_pages'>Last</a></div>";
        }

        return $pageno;
    }

    // get first and back links
    public function firstBack()
    {
        return $this->firstBack;
    }

    // get next and last links
    public function nextLast()
    {
        return $this->nextLast;
    }

    // get where we are among pages
    public function where()
    {
        return $this->where;
    }
}