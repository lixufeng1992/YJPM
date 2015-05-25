<?php
class MaterialEnquiryDao extends Model{
    public function findAll(){
        $dsn = C('DB_DSN1');
        $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
        $myPDO->query('set names utf8;');
        $sql="select * from tb_material_enquiry order by enquiry_id asc";
        $statement=$myPDO->query($sql);
        return $statement->fetchAll();
    }
    
    public function findById($enquiry_id){
		$dsn = C('DB_DSN1');
		$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
		$myPDO->query('set names utf8;'); 
		$sql="select * from tb_material_enquiry where enquiry_id=?";
		$statement = $myPDO->prepare($sql);
		$statement->execute(array($enquiry_id));
		return $statement->fetch();
	}

    public function add($enterprise_id,$enquiry_offer,$offer_date,$material_id){
        $dsn = C('DB_DSN1');
        $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
	$myPDO->query('set names utf8;');
	$sql="insert into tb_material_enquiry(enterprise_id,enquiry_offer,enquiry_offerdate,material_id) values(?,?,?,?)";
	$statement = $myPDO->prepare($sql);
	$result = $statement->execute(array($enterprise_id,$enquiry_offer,$offer_date,$material_id));
	if($result == false)return -1;
	else return $myPDO->lastInsertId();
    }
	public function findByMaterialId($material_id){
		$dsn = C('DB_DSN1');
		$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
		$myPDO->query('set names utf8;'); 
		$sql="select * from tb_material_enquiry where material_id=?";
		$statement = $myPDO->prepare($sql);
		$statement->execute(array($material_id));
		return $statement->fetchAll();
	}
	public function deleteById($enquiry_id){
		$dsn = C('DB_DSN1');
		$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
		$myPDO->query('set names utf8;');
		$sql="delete from tb_material_enquiry where enquiry_id=?";
		$statement = $myPDO->prepare($sql);
		return $statement->execute(array($enquiry_id));
        }

	public function updateById($enquiry_id,$enterprise_id,$enquiry_offer,$offer_date){
		$dsn = C('DB_DSN1');
		$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
		$myPDO->query('set names utf8;');
		$sql="update tb_material_enquiry set enterprise_id=?,enquiry_offer=?,enquiry_offerdate=? where enquiry_id=?";
		$statement = $myPDO->prepare($sql);
		$result = $statement->execute(array($enterprise_id,$enquiry_offer,$offer_date,$enquiry_id));
	}
}
?>
