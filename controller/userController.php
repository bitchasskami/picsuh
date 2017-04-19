<?php
class userController
{
    public function index(){
        $view = new View('user_index');
        $view->display();
    }

    public function registration(){
        $view = new View('registration_index');
        $view->display();
    }

    public function login(){
        $view = new VIew('login_index');
        $view->display();
    }

    public function doLogin(){
        require_once '../lib/connectionhandler.php';
        connectionhandler::connect();
    }

    public function doRegistration(){
        require_once '../lib/connectionhandler.php';
        connectionhandler::connect();

        if (isset($_POST['reg'])) {
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $passwordrep = $_POST['passwordrep'];

            if($password != $passwordrep){
                echo 'Passwords do not match.';
            }
            else{
                $password = sha1($password);

                $query = "Insert into user (email, username, password) values (?,?,?);";

                $statement = connectionhandler::connect()->prepare($query);
                $statement->bind_param('sss', $email, $username, $password);

                if (!$statement->execute()) {
                    throw new Exception($statement->error);
                }

                header('Location: /user');
            }
        }
    }
}