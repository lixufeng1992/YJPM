<?php

class MaterialOutboundOrderDetailsDao extends CommonDao
{

    public function findAll()
    {
        $sql = "select * from tb_material_outbound_order_details order by detail_id asc";
        $statement = $this->commonPDO->query($sql);
        return $statement->fetchAll();
    }

    public function add($material_id, $count, $remark, $outbound_id)
    {
        $sql = "insert into tb_material_outbound_order_details(material_id,count,remark,outbound_id) values(?,?,?,?)";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $material_id,
            $count,
            $remark,
            $outbound_id
        ));
        if ($result == false)
            return - 1;
        else
            return $this->commonPDO->lastInsertId();
    }

    public function findById($detail_id)
    {
        $sql = "select * from tb_material_outbound_order_details where detail_id=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $detail_id
        ));
        return $statement->fetch();
    }

    public function findByOutboundOrderId($outbound_id)
    {
        $sql = "select * from tb_material_outbound_order_details where outbound_id=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $outbound_id
        ));
        return $statement->fetchAll();
    }

    public function deleteByOutboundId($outbound_id)
    {
        $sql = "delete from tb_material_outbound_order_details where outbound_id=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $outbound_id
        ));
    }
}
?>


