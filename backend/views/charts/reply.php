<?php
 if (isset($_POST['submit'])){
  if (isset($_POST['extrafield5'])){
   echo $extrafield5 = $_POST['extrafield5'];
  }
  else {$extrafield5 = '';}
}
 ?>