<?php

class WarehouseDao extends Model
{

    public function findAll()
    {
        
        $sql = "select * from tb_pr_warehouse order by warehouse_id asc";
        $statement = $this->commonPDO->query($sql);
        return $statement->fetchAll();
    }

    public function findById($warehouse_id)
    {
        
        $sql = "select * from tb_pr_warehouse where warehouse_id=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $warehouse_id
        ));
        return $statement->fetch();
    }

    public function getByResourceId($resource_id)
    {
       
        $sql = "select * from tb_pr_warehouse where resource_id=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $resource_id
        ));
        return $statement->fetchAll();
    }

    public function add($warehouse_name, $resource_id)
    {
       
        $sql = "insert into tb_pr_warehouse(warehouse_name,resource_id) values(?,?)";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $warehouse_name,
            $resource_id
        ));
        if ($result == false)
            return - 1;
        else
            return $this->commonPDO->lastInsertId();
    }

    public function updateById($warehouse_name, $warehouse_id)
    {
       
        $sql = "update tb_pr_warehouse set warehouse_name=? where warehouse_id=?";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $warehouse_name,
            $warehouse_id
        ));
    }

    public function deleteById($warehouse_id)
    {
        
        $sql = "delete from tb_pr_warehouse where warehouse_id=?";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $warehouse_id
        ));
    }

    public function deleteByResourceId($resource_id)
    {
       
        $sql = "delete from tb_pr_warehouse where resource_id=?";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $resource_id
        ));
    }
}
?>
