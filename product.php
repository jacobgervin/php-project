<?php

class product {
    var $name;
    function set_name($newName) {
        $this->name = $newName;
    }
    function get_name() {
        return $this->name;
    }
    var $image;
    var $price;
    var $description;
    var $category;
}
