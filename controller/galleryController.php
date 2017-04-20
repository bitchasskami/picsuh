<?php
class galleryController
{
    public function index()
    {
        $view = new View('gallery_index');
        $view->display();
    }

    function createThumbnail($filename) {
        if(preg_match('/[.](jpg)$/', $filename)) {
            $im = imagecreatefromjpeg('data/' . $filename);
        } else if (preg_match('/[.](gif)$/', $filename)) {
            $im = imagecreatefromgif('data/' . $filename);
        } else if (preg_match('/[.](png)$/', $filename)) {
            $im = imagecreatefrompng('data/' . $filename);
        }

        $ox = imagesx($im);
        $oy = imagesy($im);

        $nx = 250;
        $ny = floor($oy * ($nx / $ox));

        $nm = imagecreatetruecolor($nx, $ny);

        imagecopyresized($nm, $im, 0,0,0,0,$nx,$ny,$ox,$oy);

        if(!file_exists('data/thumbs')) {
            if(!mkdir('data/thumbs')) {
                die("There was a problem. Please try again!");
            }
        }

        imagejpeg($nm, 'data/thumbs/' . $filename);
    }

    public function upload(){
        if(isset($_FILES['image'])){

            $errors= array();
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];
            $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

            $expensions= array("jpeg","jpg","png");

            if(in_array($file_ext,$expensions)=== false){
                $errors[]="extension not allowed, please choose a JPEG or PNG file.";
            }

            if($file_size > 2097152) {
                $errors[]='File size must be excately 2 MB';
            }

            if(empty($errors)==true) {
                $gallery = new galleryController();
                move_uploaded_file($file_tmp,"data/".$file_name);
                if (file_exists('data/$file_name') == false ) {
                    $gallery->createThumbnail($file_name);
                }
            } else {
                print_r($errors);
            }
            header('Location: /gallery');
        }
    }
}
?>