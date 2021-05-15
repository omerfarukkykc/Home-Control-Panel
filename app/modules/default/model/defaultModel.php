<?php

class defaultModel extends Model {

    public function indexModel($param = null)
    {
        $this->db->groupBy("name");
        $this->db->orderBy("name", "DESC");
        $sql = $this->db->get("user");

        return $sql;
    }

    public function insertUserModel()
    {
        $insert = array();
        $insert['name'] = "Deneme";
        $insert['surname'] = "Türk";

        $lastId = $this->db->insert("user", $insert);

        echo $this->db->getInsertId();
    }

    public function updateUserModel($id)
    {
        $update = array();
        $update['name'] = "Koray";

        $this->db->where("id", $id);
        $this->db->update("user", $update);
    }

    public function deleteUserModel($id)
    {
        $this->db->where("id", $id);
        $this->db->delete("user");
    }

}


?>