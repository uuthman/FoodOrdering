<?php 
class User{
    protected $con;

     function __construct($con){
         $this->con=$con;
     }

    public function update($table, $id, $fields = array())
    {
        $columns = '';
        $i = 1;

        foreach ($fields as $name => $values) {
            $columns .= "{$name} = :{$name}";
            if ($i < count($fields)) {
                $columns .= ', ';
            }
        }

        $sql = "UPDATE {$table} SET {$columns} WHERE `id` = {$id}";
        if ($stmt = $this->con->prepare($sql)) {
            foreach ($fields as $key => $value) {
                $stmt->bindValue(':' . $key, $value);
            }
            $stmt->execute();
        }
    }
}
?>