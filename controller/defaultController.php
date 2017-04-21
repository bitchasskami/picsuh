<?php
class DefaultController{

    public function index(){
        require_once '../lib/connectionhandler.php';
        connectionhandler::connect();

        $a = array();

        $query = "select * from gallery";
        $statement = connectionhandler::connect()->prepare($query);

        $statement->execute();
        $result = $statement->get_result();

        while ($entry = $result->fetch_object()){
            if ($_SESSION['user']->id == $entry->user_id){
                $a[] = $entry;
            }
        }

        $_SESSION['galleries'] = $a;

        $view = new View('default_index');
        $view->display();
    }

    public function create(){
        $view = new View('gallery_create');
        $view->display();
    }

    public function doCreate(){
        require_once '../lib/connectionhandler.php';
        connectionhandler::connect();

        if (isset($_POST['gal'])){
            $user_id = $_SESSION['user']->id;
            $name = htmlentities($_POST['name']);
            $desc = $_POST['desc'];

            $query = "insert into gallery (user_id, name, description) values (?, ?, ?)";
            $statement = connectionhandler::connect()->prepare($query);
            $statement->bind_param('iss', $user_id, $name, $desc);

            if (!$statement->execute()) {
                throw new Exception($statement->error);
            } else {
                $this->createDir();
                header('Location: /');
            }
        }
    }

    public function createDir(){
        require_once '../lib/connectionhandler.php';
        connectionhandler::connect();

        $a = array();

        $query = "select id from gallery";
        $statement = connectionhandler::connect()->prepare($query);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }else{
            $result = $statement->get_result();
            while ($entry = $result->fetch_object()){
                $a[] = $entry;
            }

            foreach ($a as $gallery){
                if(!file_exists('data/'.$gallery->id)) {
                    if(!mkdir('data/'.$gallery->id)) {
                        die("There was a problem. Please try again!");
                    }
                }
            }
        }


    }
}