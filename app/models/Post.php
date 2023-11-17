<?php
    class Post {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getPosts(){
            $this->db->query(
                'SELECT p.id postId
                       ,u.id userId
                       ,u.name userName
                       ,p.title postTitle
                       ,p.body postBody
                       ,p.created_at postCreatedAt
                 FROM posts p
                 INNER JOIN users u ON p.user_id = u.id
                 ORDER BY p.created_at DESC'
            );

            return $this->db->resultSet();
        }

        public function getPostById($id){
            $this->db->query(
                'SELECT *
                 FROM posts p
                 WHERE p.id = :id
                 ORDER BY p.created_at DESC'
            );
            $this->db->bind(':id', $id);

            $row = $this->db->single();

            return $row;
        }

        public function addPost($data){
            $this->db->query('INSERT INTO posts(user_id, title, body) VALUES(:user_id, :title, :body)');
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':body', $data['body']);
            
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        public function updatePost($data){
            $this->db->query('UPDATE posts SET title = :title, body = :body WHERE id = :id');
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':body', $data['body']);
            
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        public function deletePost($id){
            $this->db->query('DELETE FROM posts WHERE id = :id');
            $this->db->bind(':id', $id);
            
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }
    }
?>