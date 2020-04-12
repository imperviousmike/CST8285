<?php
class menuItem{
  private $itemName;
  private $description;
  private $price;

  function __construct($itemName, $description, $price)
  {
    $this->itemName = (string)$itemName;
    $this->description = (string)$description;
    $this->price = (string)$price;
  }

  public function getItemName(){
    return (string)$this->itemName;
  }

  public function getDescription(){
    return (string)$this->description;
  }

  public function getPrice(){
    return (string)$this->price;
  }


}



?>
