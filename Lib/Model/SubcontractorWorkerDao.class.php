<?php

class SubcontractorWorkerDao extends Model
{

    public function findAll()
    {
        
        $sql = "select * from tb_pr_subcontractorworker order by subcontractor_worker_id asc";
        $statement = $this->commonPDO->query($sql);
        return $statement->fetchAll();
    }

    public function findById($subcontractor_worker_id)
    {
        
        $sql = "select * from tb_pr_subcontractorworker where subcontractor_worker_id=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $subcontractor_worker_id
        ));
        return $statement->fetch();
    }

    public function getBySubcontractorId($subcontractor_id)
    {
       
        $sql = "select * from tb_pr_subcontractorworker where subcontractor_id=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $subcontractor_id
        ));
        return $statement->fetchAll();
    }

    public function add($subcontractor_worker_name, $subcontractor_id)
    {
      
        $sql = "insert into tb_pr_subcontractorworker(subcontractor_worker_name,subcontractor_id) values(?,?)";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $subcontractor_worker_name,
            $subcontractor_id
        ));
        if ($result == false)
            return - 1;
        else
            return $this->commonPDO->lastInsertId();
    }

    public function updateById($subcontractor_worker_id, $subcontractor_worker_name)
    {
     
        $sql = "update tb_pr_subcontractorworker set subcontractor_worker_name=? where subcontractor_worker_id=?";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $subcontractor_worker_name,
            $subcontractor_worker_id
        ));
    }

    public function deleteById($subcontractor_worker_id)
    {
       
        $sql = "delete from tb_pr_subcontractorworker where subcontractor_worker_id=?";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $subcontractor_worker_id
        ));
    }

    public function deleteBySubcontractorId($subcontractor_id)
    {
       
        $sql = "delete from tb_pr_subcontractorworker where subcontractor_id=?";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $subcontractor_id
        ));
    }

    public function deleteByResourceId($resource_id)
    {
       
        $sql = "delete from tb_pr_subcontractorworker where resource_id=?";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $resource_id
        ));
    }
}
?>
