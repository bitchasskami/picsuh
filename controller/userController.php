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
        $view = new View('login_index');
        $view->display();
    }

    public function doLogin(){
        require_once '../lib/connectionhandler.php';
        connectionhandler::connect();

        if(isset($_POST['login'])){
            $email = $_POST['email'];
            $password = sha1($_POST['password']);

            $query = "select * from user where email = ?";
            $statement = connectionhandler::connect()->prepare($query);
            $statement->bind_param('s', $email);
            $statement->execute();

            $result = $statement->get_result();
            $user = $result->fetch_object();

                session_start();
                $_SESSION['user'] = $user;
                header('Location: /');
            }
        }
    }

    public function doRegistration(){
        require_once '../lib/connectionhandler.php';
        connectionhandler::connect();

        if (isset($_POST['reg'])) {
            $email = $_POST['email'];
            $username = htmlentities($_POST['username']);
            $password = $_POST['password'];
            $passwordrep = $_POST['passwordrep'];

            if($password != $passwordrep){
                echo 'Passwords do not match.';
            }
            else{
                $query = "select * from user where email = ?";
                $statement = connectionhandler::connect()->prepare($query);
                $statement->bind_param('s', $email);
                $statement->execute();

                $result = $statement->get_result();
                if ($result->num_rows == 0) {

                    $password = sha1($password);

                    $query = "Insert into user (email, username, password) values (?,?,?);";

                    $statement = connectionhandler::connect()->prepare($query);
                    $statement->bind_param('sss', $email, $username, $password);

                    if (!$statement->execute()) {
                        throw new Exception($statement->error);
                    } else {
                        header('Location: /user/login');
                        //doLogin();
                    }
                }
            }
        }
    }

    public function doLogout(){
        unset($_SESSION['user']);
        session_destroy();
        header('Location: /');
    }

    public function doDelete(){
        require_once '../lib/connectionhandler.php';
        connectionhandler::connect();

        $email = $_SESSION['user']->email;

        var_dump($email);

        $query = "delete from user where email = ?";
        $statement = connectionhandler::connect()->prepare($query);
        $statement->bind_param('s', $email);
        $statement->execute();

        $this->doLogout();
    }

    public function doAlter(){
        require_once '../lib/connectionhandler.php';
        connectionhandler::connect();
        $email = $_SESSION['user']->email;

        if(isset($_POST['alterusrnm'])){
            $username = htmlentities($_POST['username']);

            $query = "update user set username = ? where email = ?";
            $statement = connectionhandler::connect()->prepare($query);
            $statement->bind_param('ss', $username,$email);
            $statement->execute();
        }
        else{
            if($_POST['password'] == $_POST['passwordrep']) {

                $password = sha1($_POST['password']);

                $query = "update user set password = ? where email = ?";
                $statement = connectionhandler::connect()->prepare($query);
                $statement->bind_param('ss', $password, $email);
                $statement->execute();
            }
            else echo 'Passwords do not match';

        }
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        } else {
            $this->doLogout();
            header('Location: /user/login');
        }
    }
}