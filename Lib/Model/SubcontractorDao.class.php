<?php

class SubcontractorDao extends CommonDao
{

    public function findAll()
    {
        
        $sql = "select * from tb_pr_subcontractor order by subcontractor_id asc";
        $statement = $this->commonPDO->query($sql);
        return $statement->fetchAll();
    }

    public function findById($subcontractor_id)
    {
        
        $sql = "select * from tb_pr_subcontractor where subcontractor_id=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $subcontractor_id
        ));
        return $statement->fetch();
    }

    public function getByResourceId($resource_id)
    {
       
        $sql = "select * from tb_pr_subcontractor where resource_id=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $resource_id
        ));
        return $statement->fetchAll();
    }

    public function add($resource_id, $enterprise_id, $subcontractor_name)
    {
        
        $sql = "insert into tb_pr_subcontractor(resource_id,enterprise_id,subcontractor_name) values(?,?,?)";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $resource_id,
            $enterprise_id,
            $subcontractor_name
        ));
        if ($result == false)
            return - 1;
        else
            return $this->commonPDO->lastInsertId();
    }

    public function deleteById($subcontractor_id)
    {
       
        $sql = "delete from tb_pr_subcontractor where subcontractor_id=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $subcontractor_id
        ));
    }

    public function deleteByResourceId($resource_id)
    {
       
        $sql = "delete from tb_pr_subcontractor where resource_id=?";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $resource_id
        ));
    }
}
?>
