<?php

class QuestionanswerdateDao extends Model
{

    public function findAll()
    {
        
        $sql = "select * from tb_questionanswerdate order by questionanswerdate_id asc";
        $statement = $this->commonPDO->query($sql);
        return $statement->fetchAll();
    }

    public function findByProjectid($projectid)
    {
        
        $sql = "select * from tb_questionanswerdate where projectid=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $projectid
        ));
        return $statement->fetch();
    }

    public function findById($questionanswerdate_id)
    {
        
        $sql = "select * from tb_questionanswerdate where questionanswerdate_id=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $questionanswerdate_id
        ));
        return $statement->fetch();
    }

    public function add($projectid, $date, $preremind_days, $is_finished)
    {
       
        $sql = "insert into tb_questionanswerdate(projectid,date,preremind_days,is_finished) values(?,?,?,?)";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $projectid,
            $date,
            $preremind_days,
            $is_finished
        ));
        if ($result == false)
            return - 1;
        else
            return $this->commonPDO->lastInsertId();
    }

    public function updateById($questionanswerdate_id, $projectid, $date, $preremind_days, $is_finished)
    {
       
        $sql = "update tb_questionanswerdate set projectid=?,date=?,preremind_days=?,is_finished=? where questionanswerdate_id=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $projectid,
            $date,
            $preremind_days,
            $is_finished,
            $questionanswerdate_id
        ));
    }

    public function deleteById($questionanswerdate_id)
    {
       
        $sql = "delete from tb_questionanswerdate where questionanswerdate_id=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $questionanswerdate_id
        ));
    }
}

?>