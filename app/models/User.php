<?php
    class User {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function register($data){
            $this->db->query('INSERT INTO users(name, email, password) VALUES(:name, :email, :password)');
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['pass']);
            
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        // Login User
        public function login($email, $password){
            $this->db->query('SELECT * FROM users WHERE email = :email');
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            $hashed_pass = $row->password;
            if(password_verify($password, $hashed_pass)){
                return $row;
            }
            else{
                return false;
            }
        }

        public function checkPassword($id, $password){
            $this->db->query('SELECT password FROM users WHERE id = :id');
            $this->db->bind(':id', $id);
            
            $row = $this->db->single();
            if(password_verify($password, $row->password)){
                return true;
            }
            else{
                return false;
            }
        }

        public function changePassword($id, $password){
            $this->db->query('UPDATE users SET password = :password WHERE id = :id');
            $this->db->bind(':password', $password);
            $this->db->bind(':id', $id);
            
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        public function findUserByEmail($email){
            $this->db->query('SELECT * FROM users WHERE email = :email');
            $this->db->bind(':email', $email);
            $row = $this->db->single();
            if($this->db->rowCount() > 0){
                return true;
            }
            else{
                return false;
            }
        }

        public function getUserById($id){
            $this->db->query('SELECT * FROM users WHERE id = :id');
            $this->db->bind(':id', $id);
            $row = $this->db->single();
            return $row;
        }
    }
?>