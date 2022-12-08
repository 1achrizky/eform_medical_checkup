<?php

// https://stackoverflow.com/questions/37648935/in-yii2-framework-better-place-to-define-common-function-which-is-accessible-ev/37649731

namespace app\common\helpers;

class Sitehelper 
{
  public static function dt(){
    return date('Y-m-d H:i:s');
  }


}

?>