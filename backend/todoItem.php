<?php
class todoItem {
    public $title;
    public $status;
  
    function __construct($title) {
        $this->title = $title;
        $this->status = false;
    }
}
?>