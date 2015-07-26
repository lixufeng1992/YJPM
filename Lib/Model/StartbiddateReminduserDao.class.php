<?php

class StartbiddateReminduserDao extends CommonDao
{

    public function findAll()
    {
       
        $sql = "select * from tb_startbiddate_reminduser order by id asc";
        $statement = $this->commonPDO->query($sql);
        return $statement->fetchAll();
    }

    public function findByStartbiddateid($startbiddate_id)
    {
        
        $sql = "select * from tb_startbiddate_reminduser where startbiddate_id=? order by id asc";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $startbiddate_id
        ));
        return $statement->fetchAll();
    }

    public function findById($id)
    {
        
        $sql = "select * from tb_startbiddate_reminduser where id=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $id
        ));
        return $statement->fetch();
    }

    public function add($startbiddate_id, $userid)
    {
        
        $sql = "insert into tb_startbiddate_reminduser(startbiddate_id,userid) values(?,?)";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $startbiddate_id,
            $userid
        ));
        if ($result == false)
            return - 1;
        else
            return $this->commonPDO->lastInsertId();
    }
    
   
    public function deleteById($id)
    {
        
        $sql = "delete from tb_startbiddate_reminduser where id=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $id
        ));
    }
}

?>