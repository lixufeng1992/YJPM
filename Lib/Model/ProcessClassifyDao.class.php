<?php

class ProcessClassifyDao extends Model
{

    public function findAll()
    {
        $sql = "select * from tb_process_classify order by process_classify_id asc";
        $statement = $this->commonPDO->query($sql);
        return $statement->fetchAll();
    }

    public function findById($process_classify_id)
    {
        $sql = "select * from tb_process_classify where process_classify_id = ?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $process_classify_id
        ));
        $employerrow = $statement->fetch();
        return $employerrow;
    }

    public function add($process_classify_name)
    {
        $sql = "insert into tb_process_classify(process_classify_name) values(?)";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $process_classify_name
        ));
        if ($result == false)
            return - 1;
        else
            return $this->commonPDO->lastInsertId();
    }

    public function updateById($process_classify_id, $process_classify_name)
    {
        $sql = "update tb_process_classify set process_classify_name=? where process_classify_id=?";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $process_classify_name,
            $process_classify_id
        ));
    }

    public function deleteById($process_classify_id)
    {
        $sql = "delete from tb_process_classify where process_classify_id=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $process_classify_id
        ));
    }
}

?>