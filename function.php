<?php

class crudApp{
    private $conn;
    
    public function __construct()
    {
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $dbname = "crud";

        $this->conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

        if(!$this->conn){
            die("Database Connection Failed!");
        }
    }

    public function add_data($data){
        $std_name = $data['std_name'];
        $std_roll = $data['std_roll'];
        $std_img = $_FILES['std_img']['name'];
        $tmp_name = $_FILES['std_img']['tmp_name'];

        $query = "INSERT INTO information(std_name, std_roll, std_img) VALUE('$std_name',$std_roll, '$std_img')";

        if(mysqli_query($this->conn, $query)){
            move_uploaded_file($tmp_name, './upload/'.$std_img);
            return "Information Added Successfully";
        }
    }

    public function display_data(){
        $query = "SELECT * FROM information";

        if(mysqli_query($this->conn, $query)){
            $returndata = mysqli_query($this->conn, $query);
            return $returndata;
        }

    }


    public function display_data_by_id($id){
        $query = "SELECT * FROM information WHERE id = $id";
        if(mysqli_query($this->conn, $query)){
            $returndata = mysqli_query($this->conn, $query);
            $studentData = mysqli_fetch_assoc($returndata);
            return $studentData;
        }
    }

    public function update_data($data){
        $std_name = $data['u_std_name'];
        $std_roll = $data['u_std_roll'];
        $idno = $data['std_id'];
        $std_img = $_FILES['u_std_img']['name'];
        $tmp_name = $_FILES['u_std_img']['tmp_name'];
        
        $query = "UPDATE information SET std_name = '$std_name', std_roll = $std_roll, 
        std_img = '$std_img' WHERE id = $idno";

        if(mysqli_query($this->conn, $query)){
            move_uploaded_file($tmp_name, './upload/'.$std_img);
            return "Information Updated Successfully";
        }
    }

    public function delete_data($id){
        $catch_img = "SELECT * FROM information WHERE id = $id";
        $delete_std_info = mysqli_query($this->conn, $catch_img);
        $std_infoDel = mysqli_fetch_assoc($delete_std_info);
        $delImg_data = $std_infoDel['std_img'];

        $query = "DELETE FROM information WHERE id= $id";
        if(mysqli_query($this->conn, $query)){
            unlink('./upload/'.$delImg_data);
            return "Deleted Successfully";
        }


    }



}
