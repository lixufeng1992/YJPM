<?php

class MaterialPurchaseOrderDetailsDao extends Model
{

    public function findAll()
    {
        $sql = "select * from tb_material_purchase_order_details order by detail_id asc";
        $statement = $this->commonPDO->query($sql);
        return $statement->fetchAll();
    }

    public function add($material_id, $specification, $unit_price, $count, $price, $remark, $warehouse_id, $administrator_id, $order_id)
    {
        $sql = "insert into tb_material_purchase_order_details(material_id,specification,unit_price,count,price,remark,warehouse_id,administrator_id,order_id) values(?,?,?,?,?,?,?,?,?)";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $material_id,
            $specification,
            $unit_price,
            $count,
            $price,
            $remark,
            $warehouse_id,
            $administrator_id,
            $order_id
        ));
        if ($result == false)
            return - 1;
        else
            return $this->commonPDO->lastInsertId();
    }

    public function getByOrderId($order_id)
    {
        $sql = "SELECT details.material_id, details.specification, details.unit_price, details.count, details.price, details.remark, details.warehouse_id, details.administrator_id, details.order_id, material.worktype, material.`name`, material.unit from tb_material_purchase_order_details as details left join tb_material as material on details.material_id = material.materialid where order_id = ?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $order_id
        ));
        return $statement->fetchAll();
    }

    public function findById($order_id)
    {
        $sql = "select * from tb_material_purchase_order_details where order_id=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $order_id
        ));
        return $statement->fetchAll();
    }

    public function deleteByOrderId($order_id)
    {
        $sql = "delete from tb_material_purchase_order_details where order_id=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $order_id
        ));
    }
}

?>
