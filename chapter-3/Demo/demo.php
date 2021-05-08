<?php
  // 用 class 定義類別
  class User{
    // 宣告屬性
    public $name, $password;
    // 編寫方法
    function save_user(){
      echo "Save User code goes here";
    }
  }
  // 建立物件
  $object = new User();
  // 查看 $object 變數資訊
  print_r($object); echo "<br>";
  // 宣告屬性
  $object->name = "Joe";
  $object->password = "mypass";
  // 查看 $object 變數資訊
  print_r($object); echo "<br>";
  // 使用方法
  $object->save_user();
?>