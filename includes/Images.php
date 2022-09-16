<?php
class Image_Compreser
{

  public static function Compreser($size)
  {
    if (isset($_FILES['image']) AND !$_FILES['image']['error']){
      $post_photo=$_FILES['image']['name'];
      $post_photo_tmp=$_FILES['image']['tmp_name'];
       $nom=rand()."fk".basename($_FILES['image']['name']);
      $verif_image_ext=getimagesize($post_photo_tmp);
      $ext=pathinfo($post_photo,PATHINFO_EXTENSION);
      if ($verif_image_ext && $verif_image_ext[2]<4) {


    if ( $ext=='jpg' || $ext=='jpeg' || $ext=='JPG' || $ext=='JPEG' ) {
  $src=imagecreatefromjpeg($post_photo_tmp);
}

if ($ext=='png' || $ext=='PNG') {
  $src=imagecreatefrompng($post_photo_tmp);
}
if ($ext=='gif' || $ext=='GIF') {
  $src=imagecreatefromgif($post_photo_tmp);
}
list($width_min,$height_min)=getimagesize($post_photo_tmp);
$newwidth_min=$size;
$newheight_min=($height_min /$width_min)*$newwidth_min;
$tmp_min=imagecreatetruecolor($newwidth_min,$newheight_min);

imagecopyresampled($tmp_min, $src, 0, 0, 0, 0, $newwidth_min, $newheight_min, $width_min, $height_min);
// imagejpeg($tmp_min, "uploads/e".$post_photo,8O);
if(imagejpeg($tmp_min,"images/".$nom,80)){
  return $nom;
}else {
  return false;
}
  }

    }else {
      unlink($_FILES['image']['tmp_name']);
      unset($_FILES['image']);
    }
    return false;
  }

  public static function NonCompresor()
  {
    if (isset($_FILES['image']) AND !$_FILES['image']['error']){
      $post_photo=$_FILES['image']['name'];
      $post_photo_tmp=$_FILES['image']['tmp_name'];
       $nom=rand()."fk".basename($_FILES['image']['name']);
      $verif_image_ext=getimagesize($post_photo_tmp);
      if ($verif_image_ext && $verif_image_ext[2]<4) {
if(move_uploaded_file($post_photo_tmp,"images/".$nom)){
  return $nom;
}else {
  return false;
}
      }
    }
    // }else {
    //   unlink($_FILES['image']['tmp_name']);
    //   unset($_FILES['image']);
    // }
    return false;
  }

    public static function UploadDocs($output=null)
  {
   
      $post_doc=$_FILES['doc']['name'];
      $post_doc_tmp=$_FILES['doc']['tmp_name'];
       $nom=rand()."fk".basename($_FILES['doc']['name']);

if(move_uploaded_file($post_doc_tmp,$output.'/'.$nom)){
  return $nom;
}else {
  return false;
}
   
  }
}
?>
