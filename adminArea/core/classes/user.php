<?php 
//class the control user activities

class User{
    protected $pdo;

    function __construct($pdo){
        $this->pdo = $pdo; 
    }

    public function checkInput($var){
        $var = htmlspecialchars($var);
        $var = trim($var);
        $var = stripcslashes($var);
        return $var;
    }

    public function login($email,$password){
        $stmt = $this->pdo->prepare("SELECT `id` FROM `user` WHERE `email` =:email AND `password` =:password");
        
        $stmt->bindparam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":password", md5($password), PDO::PARAM_STR);
        
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        $count = $stmt->rowCount();
        if ($count > 0) {
            $_SESSION['id'] = $user->id;
            header('Location: resturant.php');
        }else{
            return false;
        }
    }

    public function adminLogin($email, $password)
    {
        $stmt = $this->pdo->prepare("SELECT `id` FROM `admin` WHERE `email` =:email AND `password` =:password");

        $pass = md5($password);
        $stmt->bindparam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $pass , PDO::PARAM_STR);

        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        $count = $stmt->rowCount();
        if ($count > 0) {
            $_SESSION['id'] = $user->id;
            header('Location: index.php');
        } else {
            return false;
        }
    }


    public function userData($id){
        $stmt = $this->pdo->prepare("SELECT * FROM `user` WHERE `id` = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function adminUserData($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `admin` WHERE `id` = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }


    public function logout(){
        $_SESSION = array();
        session_destroy();
        header('Location: index.php');
    }

    public function checkEmail($email){
        $stmt = $this->pdo->prepare("SELECT `email` FROM `user` WHERE `email` = :email");
        $stmt->bindParam(":email",$email, PDO::PARAM_STR);
        $stmt->execute();

        $count = $stmt->rowCount();
        
        if ($count > 0) {
            return true;
        }else{
            return false;
        }
    }

    public function adminCheckEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT `email` FROM `admin` WHERE `email` = :email");
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();

        $count = $stmt->rowCount();

        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkPassword($password){
        $stmt = $this->pdo->prepare("SELECT `password` FROM `user` WHERE `password` = :password");
        $password = md5($password);
        $stmt->bindParam(":password",$password, PDO::PARAM_STR);
        $stmt->execute();

        $count = $stmt->rowCount();

        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function create($table, $fields = array()){
        $columns = implode(',', array_keys($fields));
        $values = ':'.implode(', :',array_keys($fields));
         $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$values})";
         if ($stmt = $this->pdo->prepare($sql)) {
             foreach ($fields as $key => $data) {
                 $stmt->bindValue(':'.$key, $data);
             }
             $stmt->execute();
             return $this->pdo->lastInsertId();
         }
    }

    public function update($table,$id, $fields = array()){
        $columns = '';
        $i = 1;

        foreach($fields as $name => $values){
            $columns .= "{$name} = :{$name}";
            if ($i < count($fields)) {
                $columns.= ', ';
            }
        }

    $sql = "UPDATE {$table} SET {$columns} WHERE `id` = {$id}";
    if ($stmt = $this->pdo->prepare($sql)) {
        foreach ($fields as $key => $value) {
                $stmt->bindValue(':'.$key, $value);
        }
        $stmt->execute();
    }
    }

    public function isUserLoggedIn(){
        return (isset($_SESSION['id'])) ? true : false;
    }

    public function  uploadImage($file){
        $filename = basename($file['name']);
        $fileTmp = $file['tmp_name'];
        $fileSize = $file['size'];
        $error = $file['error'];

        $ext = explode('.', $filename);
        $ext = strtolower(end($ext));
        $allowed_ext = array('jpg','png','jpeg');

        if (in_array($ext, $allowed_ext) === true) {
            if ($error === 0) {
                if ($fileSize <= 209272152) {
                    $fileRoot = 'products/' . $filename;
                    move_uploaded_file($fileTmp, $fileRoot);
                    return $fileRoot;
                }else{
                    $GLOBALS['imageError'] = "the extension is not allowed";
                }
            }
        }else{
            $GLOBALS['imageError'] = "the extension is not allowed";

        }
    }

}
?>