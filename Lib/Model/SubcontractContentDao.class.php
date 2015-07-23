<?php

class SubcontractContentDao extends CommonDao
{

    public function findAll()
    {
        
        $sql = "select * from tb_subcontract_content order by contentid asc";
        $statement = $this->commonPDO->query($sql);
        return $statement->fetchAll();
    }

    public function findById($contentid)
    {
        
        $sql = "select * from tb_subcontract_content where contentid=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $contentid
        ));
        return $statement->fetch();
    }

    public function findByContractid($contractid)
    {
        
        $sql = "select * from tb_subcontract_content where contractid=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $contractid
        ));
        return $statement->fetchAll();
    }

    public function add($contractid, $category, $name, $unit, $price_perunit, $amount, $remark)
    {
        
        $sql = "insert into tb_subcontract_content (contractid,category,name,unit,price_perunit,amount,remark) values(?,?,?,?,?,?,?)";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $contractid,
            $category,
            $name,
            $unit,
            $price_perunit,
            $amount,
            $remark
        ));
        if ($result == false)
            return - 1;
        else
            return $this->commonPDO->lastInsertId();
    }

    public function updateById($contentid, $contractid, $category, $name, $unit, $price_perunit, $amount, $remark)
    {
        
        $sql = "update tb_subcontract_content set contractid=?,category=?,name=?,unit=?,price_perunit=?,amount=?,remark=? where contentid=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $contractid,
            $category,
            $name,
            $unit,
            $price_perunit,
            $amount,
            $remark,
            $contentid
        ));
    }

    public function deleteById($contentid)
    {
        
        $sql = "delete from tb_subcontract_content where contentid=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $contentid
        ));
    }
}

?>