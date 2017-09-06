<?php
class Model {
    protected $db;

    function __construct()
    {
        $this->db = DB::getConnection();
    }

    public function getCount($table){
        $db = $this->db;
        $request = 'SELECT count(id) AS count FROM '. $table;

        $result = $db->prepare($request);

        $result->execute();

        $row = $result->fetch();
        return $row['count'];
    }


    public function getAll($table, $page = 1, $limit = 6, $order = 'id'){
        $offset = ($page - 1) * $limit;
        $db = $this->db;
        $result = $db->query('SELECT * FROM '. $table .' ORDER by '.$order.' LIMIT '.$limit .' OFFSET ' . $offset);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getSingle($table, $id){
        $db = $this->db;
        $result = $db->query('SELECT * FROM '. $table .' WHERE id =' .$id);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


}