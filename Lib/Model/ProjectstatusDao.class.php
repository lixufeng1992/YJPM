<?php

class ProjectstatusDao extends CommonDao
{

    public function findAll()
    {
       
        $sql = "select * from tb_projectstatus order by statusid asc";
        $statement = $this->commonPDO->query($sql);
        return $statement->fetchAll();
    }

    public function findById($statusid)
    {
       
        $sql = "select * from tb_projectstatus where statusid=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $statusid
        ));
        return $statement->fetch();
    }
    
   
}

?>