<?php
class pictureController
{
    public function index()
    {
        $view = new View('gallery_index');
        $view->display();
    }

    function createThumbnail($filename) {

        $gallery_id = 2;
        if(!empty($_SESSION['id'])) $gallery_id = $_SESSION['id'];

        if(preg_match('/[.](jpg)$/', $filename)) {
            $im = imagecreatefromjpeg('data/'.$gallery_id.'/' . $filename);
        } else if (preg_match('/[.](gif)$/', $filename)) {
            $im = imagecreatefromgif('data/'.$gallery_id.'/' . $filename);
        } else if (preg_match('/[.](png)$/', $filename)) {
            $im = imagecreatefrompng('data/'.$gallery_id.'/' . $filename);
        }

        $ox = imagesx($im);
        $oy = imagesy($im);

        $nx = 250;
        $ny = floor($oy * ($nx / $ox));

        $nm = imagecreatetruecolor($nx, $ny);

        imagecopyresized($nm, $im, 0,0,0,0,$nx,$ny,$ox,$oy);

        if(!file_exists('data/'.$gallery_id.'/thumbs')) {
            if(!mkdir('data/'.$gallery_id.'/thumbs')) {
                die("There was a problem. Please try again!");
            }
        }

        imagejpeg($nm, 'data/'.$gallery_id.'/thumbs/' . $filename);
    }

    public function upload(){
        require_once '../lib/connectionhandler.php';
        connectionhandler::connect();

        if(isset($_FILES['image'])){

            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

            $extension= array("jpeg","jpg","png", "gif");

            $title = htmlentities($_POST['title']);
            $desc = htmlentities($_POST['desc']);
            $gallery_id = 2;
            if(!empty($_SESSION['id'])) $gallery_id = $_SESSION['id'];


            if(in_array($file_ext,$extension)=== false){
                $error = "extension not allowed, please choose a JPEG or PNG file.";
            } else if($file_size > 8388608) {
                $error = "File size must be less than 8 MB";
            } else {
                $error = "true";
            }

            if($error == "true") {
                move_uploaded_file($file_tmp,"data/".$gallery_id."/".$file_name);

                $query = "insert into picture (gallery_id, filename, name, description) values (?, ?, ?, ?);";

                $statement = connectionhandler::connect()->prepare($query);
                $statement->bind_param('ssss', $gallery_id, $file_name, $title, $desc);

                if (!$statement->execute()) {
                    throw new Exception($statement->error);
                } else {
                    header('Location: /picture');
                }
                if (file_exists('data/$file_name') == false ) {
                    $this->createThumbnail($file_name);
                }

            } else {
                echo '<p>$error</p>';
            }
            header('Location: /picture');
        }
    }
}