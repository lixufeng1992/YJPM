<?php
	class EnterpriseDao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_enterprise order by enterpriseid asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($enterpriseid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_enterprise where enterpriseid=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($enterpriseid));
			return $statement->fetch();
		}

		public function add($name,$address,$contact_person,$remark,$phone_number,$fax,$email,$website,$credit_rank,$zip_number,
							$legal_person,$tax_number,$service_zone,$is_1part,$is_divideman,$is_materialman,$is_machineman,$is_transman,$is_client,$is_otherpart){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_enterprise(name,address,contact_person,remark,phone_number,fax,email,website,credit_rank,zip_number,
				legal_person,tax_number,service_zone,is_1part,is_divideman,is_materialman,is_machineman,is_transman,is_client,is_otherpart) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($name,$address,$contact_person,$remark,$phone_number,$fax,$email,$website,$credit_rank,$zip_number,
				$legal_person,$tax_number,$service_zone,$is_1part,$is_divideman,$is_materialman,$is_machineman,$is_transman,$is_client,$is_otherpart));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}

		public function updateById($enterpriseid,$name,$address,$contact_person,$remark,$phone_number,$fax,$email,$website,$credit_rank,
								$zip_number,$legal_person,$tax_number,$service_zone,$is_1part,$is_divideman,$is_materialman,$is_machineman,$is_transman,$is_client,
								$is_otherpart){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_enterprise set name=?,address=?,contact_person=?,remark=?,phone_number=?,fax=?,email=?,website=?,credit_rank=?,zip_number=?,
				legal_person=?,tax_number=?,service_zone=?,is_1part=?,is_divideman=?,is_materialman=?,is_machineman=?,is_transman=?,is_client=?,is_otherpart=? where enterpriseid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($name,$address,$contact_person,$remark,$phone_number,$fax,$email,$website,$credit_rank,
								$zip_number,$legal_person,$tax_number,$service_zone,$is_1part,$is_divideman,$is_materialman,$is_machineman,$is_transman,$is_client,
								$is_otherpart,$enterpriseid));		
		}

		public function deleteById($enterpriseid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_enterprise where enterpriseid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($enterpriseid));
		}






	}




?>