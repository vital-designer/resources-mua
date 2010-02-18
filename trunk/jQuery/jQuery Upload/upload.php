<?php

$uploaddir = 'E:/Work/MyBlog/jQuery/jQuery Upload/';
echo $uploaddir . basename($_FILES['myfile']['name']);
$uploadfile = $uploaddir . basename($_FILES['myfile']['name']);

if (move_uploaded_file($_FILES['myfile']['tmp_name'], $uploadfile)) {
  echo "success";
} else {
  // WARNING! DO NOT USE "FALSE" STRING AS A RESPONSE!
  // Otherwise onSubmit event will not be fired
  echo "error";
}


?>