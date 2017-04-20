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

        $nx = 150;
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

    public function blur() {
        echo '<div class = "blurredbackground">';
        echo '</div>';
}
}
?>