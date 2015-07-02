<?php
	class ExacctDao extends Model{
		public function findAll(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_exacct left join tb_exacctclass on tb_exacct.classid = tb_exacctclass.exacctclassid order by exacctid asc";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findByParentId($id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_exacct left join tb_exacctclass on tb_exacct.classid = tb_exacctclass.exacctclassid where parentid=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($id));
			return $statement->fetch();
		}
		public function findById($id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;'); 
			$sql="select * from tb_exacct left join tb_exacctclass on tb_exacct.classid = tb_exacctclass.exacctclassid where exacctid=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($id));
			return $statement->fetch();
		}

		public function add($name,$remark,$classid,$parentid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_exacct(exacctname,remark,classid,parentid) values(?,?,?,?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($name,$remark,$classid,$parentid));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}

		public function updateById($id,$name,$remark,$classid){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_exacct set exacctname=?,remark=?,classid=? where exacctid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($name,$remark,$classid,$id));		
		}

		public function deleteById($id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql = "select count(*) as c from tb_exacct where parentid=?";
			$statement = $myPDO->prepare($sql);
			$statement->execute(array($id));
			$count = $statement->fetch();
			if ($count["c"]){
				return false;				
			}
			$sql="delete from tb_exacct where exacctid=?";
			$statement = $myPDO->prepare($sql);
			return $statement->execute(array($id));
		}

	}



?>
