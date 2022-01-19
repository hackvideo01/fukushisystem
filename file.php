<?php
  header("Content-Type:image/png"); //passing the mimetype

  $image = '/public/images/' . $_GET['image']; 

  if(is_file($image) ||  is_file($image = "/public/images/no_image.png"))
    readfile($image);
?>