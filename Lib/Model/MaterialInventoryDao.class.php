<?php
class MaterialInventoryDao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_material_inventory order by inventory_id asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}
                public function findByMaterialIdWarehouseId($material_id,$warehouse_id){
		    $dsn = C('DB_DSN1');
		    $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
		    $myPDO->query('set names utf8;'); 
		    $sql="select * from tb_material_inventory where material_id=? and warehouse_id=?";
		    $statement = $myPDO->prepare($sql);
		    $statement->execute(array($material_id,$warehouse_id));
		    return $statement->fetch();
                }
                public function findByWarehouseId($warehouse_id){
		    $dsn = C('DB_DSN1');
		    $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
		    $myPDO->query('set names utf8;'); 
		    $sql="select * from tb_material_inventory where warehouse_id=?";
		    $statement = $myPDO->prepare($sql);
		    $statement->execute(array($warehouse_id));
		    return $statement->fetchAll();
                }

    public function add($warehouse_id,$material_id,$count){
        $dsn = C('DB_DSN1');
        $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
	$myPDO->query('set names utf8;');
	$sql="insert into tb_material_inventory(warehouse_id,material_id,count) values(?,?,?)";
	$statement = $myPDO->prepare($sql);
	$result = $statement->execute(array($warehouse_id,$material_id,$count));
	if($result == false)return -1;
	else return $myPDO->lastInsertId();
    }
        public function findById($inventory_id){
            $dsn = C('DB_DSN1');
            $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
            $myPDO->query('set names utf8');
            $sql="select * from tb_material_inventory where inventory_id=?";
            $statement = $myPDO->prepare($sql);
            $statement->execute(array($inventory_id));
            return $statement->fetch();
        }

	public function updateCountById($count,$inventory_id){
		$dsn = C('DB_DSN1');
		$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
		$myPDO->query('set names utf8;');
		$sql="update tb_material_inventory set count=? where inventory_id=?";
		$statement = $myPDO->prepare($sql);
		$result = $statement->execute(array($count,$inventory_id));
	}
}
?>

