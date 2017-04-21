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
        require_once '../lib/connectionhandler.php';
        connectionhandler::connect();

        if(isset($_FILES['image'])){

            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

            $extensions= array("jpeg","jpg","png");

            $title = $_POST['title'];
            $desc = $_POST['desc'];
            $galleryid = 2;

            if(in_array($file_ext,$extensions)=== false){
                $error = "extension not allowed, please choose a JPEG or PNG file.";
            } else if($file_size > 8388608) {
                $error = "File size must be less than 8 MB";
            } else {
                $error = "true";
            }

            if($error == "true") {

                $gallery = new galleryController();
                move_uploaded_file($file_tmp,"data/".$file_name);

                $query = "insert into picture (gallery_id, filename, name, description) values (?, ?, ?, ?);";

                $statement = connectionhandler::connect()->prepare($query);
                $statement->bind_param('ssss', $galleryid, $file_name, $title, $desc);

                if (!$statement->execute()) {
                    throw new Exception($statement->error);
                } else {
                    header('Location: /gallery');
                }
                if (file_exists('data/$file_name') == false ) {
                    $gallery->createThumbnail($file_name);
                }

            } else {
                echo '<p>$error</p>';
            }
            header('Location: /gallery');
        }


    }
    public function deletepicture() {

    }
}
?>