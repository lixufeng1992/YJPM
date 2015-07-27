<?php
import("@.Model.CommonDao");
class MaterialInventoryDao extends CommonDao{
		public function findAll(){
			
			$sql="select * from tb_material_inventory order by inventory_id asc";
			$statement = $this->commonPDO->query($sql);
			return $statement->fetchAll();
		}
                public function findByMaterialIdWarehouseId($material_id,$warehouse_id){
		   
		    $sql="select * from tb_material_inventory where material_id=? and warehouse_id=?";
		    $statement = $this->commonPDO->prepare($sql);
		    $statement->execute(array($material_id,$warehouse_id));
		    return $statement->fetch();
                }
                public function findByWarehouseId($warehouse_id){
		   
		    $sql="select * from tb_material_inventory where warehouse_id=?";
		    $statement = $this->commonPDO->prepare($sql);
		    $statement->execute(array($warehouse_id));
		    return $statement->fetchAll();
                }

    public function add($warehouse_id,$material_id,$count){
      
	$sql="insert into tb_material_inventory(warehouse_id,material_id,count) values(?,?,?)";
	$statement = $this->commonPDO->prepare($sql);
	$result = $statement->execute(array($warehouse_id,$material_id,$count));
	if($result == false)return -1;
	else return $this->commonPDO->lastInsertId();
    }
        public function findById($inventory_id){
           
            $sql="select * from tb_material_inventory where inventory_id=?";
            $statement = $this->commonPDO->prepare($sql);
            $statement->execute(array($inventory_id));
            return $statement->fetch();
        }

	public function updateCountById($count,$inventory_id){
		
		$sql="update tb_material_inventory set count=? where inventory_id=?";
		$statement = $this->commonPDO->prepare($sql);
		$result = $statement->execute(array($count,$inventory_id));
	}
}
?>

