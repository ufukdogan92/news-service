<?php
class pagination{
    public $page;

	public function __construct($page) {
        $this->page     = $page;
	}


    /*
     *  returns a start row number and page count for limit sql
     */
    function calculatePage($rowCount, $limit){ 
        $pageInfo['startRow'] = ($this->page -1) * $limit;
        $pageInfo['pageCount'] = ceil($rowCount/$limit);
        return $pageInfo;
    }

}
