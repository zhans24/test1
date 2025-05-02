<?php

namespace Controller;

use config\Database;
use models\User;
use Repository\UserRepository;

class UserController
{
    private UserRepository $userRepo;
    private Database $db;
    public function __construct()
    {
        $this->db=new Database('localhost','root','1234','learn');
        $this->userRepo=new UserRepository($this->db);
    }

    public function login(array $data) : void
    {
        $user=$this->userRepo->getByEmail($data['email']);
        if ($user && password_verify($data['password'],$user->getPassword())){
            $_SESSION['user_id']=$user->getId();
            echo json_encode(['success' => true]);
            }else
            echo json_encode("Login or password is incorrect.Try again");
    }
    public function register(array $data): void
    {
        if ($this->userRepo->getByEmail($data['email'])){
            echo json_encode("This email is exist");
        }else {
            $hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);
            $user = new User(null,$data['username'], $data['email'], $hashed_password);

            $isAdd = $this->userRepo->addUser($user);

            if ($isAdd) {
                echo json_encode('User is added');
            } else
                echo json_encode("Troubles in server.Try later!");
        }
    }

    public function logout():void
    {
        if (session_status()===PHP_SESSION_NONE){
            session_start();
        }
        $_SESSION=[];
        session_regenerate_id(true);
        session_destroy();


        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        http_response_code(200);
        echo json_encode(['success' => true, 'message' => 'Successfully logged out']);
    }
}