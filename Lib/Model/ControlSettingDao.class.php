<?php
	class ControlSettingDao extends Model{
		public function add($resource_id,$refuse_buyingplan_nobudget,$refuse_buyingplan_excessbudget,
											$refuse_materialbuying_nobudget,$refuse_materialbuying_excessbudget,$refuse_materialout_nobudget,$refuse_materialout_excessbudget,
											$refuse_materialallocate_nobudget,$refuse_materialallocate_excessbudget,$refuse_otherin_nobudget,$refuse_otherin_excessbudget){
											
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="insert into tb_pr_controlsetting(resource_id,refuse_buyingplan_nobudget,refuse_buyingplan_excessbudget,
											refuse_materialbuying_nobudget,refuse_materialbuying_excessbudget,refuse_materialout_nobudget,refuse_materialout_excessbudget,
											refuse_materialallocate_nobudget,refuse_materialallocate_excessbudget,refuse_otherin_nobudget,refuse_otherin_excessbudget) values(?,?,?,?,?,?,?,?,?,?,?)";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($resource_id,$refuse_buyingplan_nobudget,$refuse_buyingplan_excessbudget,
											$refuse_materialbuying_nobudget,$refuse_materialbuying_excessbudget,$refuse_materialout_nobudget,$refuse_materialout_excessbudget,
											$refuse_materialallocate_nobudget,$refuse_materialallocate_excessbudget,$refuse_otherin_nobudget,$refuse_otherin_excessbudget));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();
		}
		
		public function updateById($exist_id,$refuse_buyingplan_nobudget,$refuse_buyingplan_excessbudget,
											$refuse_materialbuying_nobudget,$refuse_materialbuying_excessbudget,$refuse_materialout_nobudget,$refuse_materialout_excessbudget,
											$refuse_materialallocate_nobudget,$refuse_materialallocate_excessbudget,$refuse_otherin_nobudget,$refuse_otherin_excessbudget){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="update tb_pr_controlsetting set refuse_buyingplan_nobudget=?,refuse_buyingplan_excessbudget=?,
											refuse_materialbuying_nobudget=?,refuse_materialbuying_excessbudget=?,refuse_materialout_nobudget=?,refuse_materialout_excessbudget=?,
											refuse_materialallocate_nobudget=?,refuse_materialallocate_excessbudget=?,refuse_otherin_nobudget=?,refuse_otherin_excessbudget=? where controlsetting_id=?";
			$statement=$myPDO->prepare($sql);
			$result=$statement->execute(array($refuse_buyingplan_nobudget,$refuse_buyingplan_excessbudget,
											$refuse_materialbuying_nobudget,$refuse_materialbuying_excessbudget,$refuse_materialout_nobudget,$refuse_materialout_excessbudget,
											$refuse_materialallocate_nobudget,$refuse_materialallocate_excessbudget,$refuse_otherin_nobudget,$refuse_otherin_excessbudget,$exist_id));
			if($result == false)return -1;
			else return $myPDO->lastInsertId();								
		}
		
		public function findExistId($resource_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="select controlsetting_id from tb_pr_controlsetting where resource_id=?";
			$statement=$myPDO->prepare($sql);
			$statement->execute(array($resource_id));
			return $statement->fetch();	
		}
		
		public function findByResourceId($resource_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="select * from tb_pr_controlsetting where resource_id=?";
			$statement=$myPDO->prepare($sql);
			$statement->execute(array($resource_id));
			$result=$statement->fetch();
			return $result;
		}
		
		public function deleteByResourceId($resource_id){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO->query('set names utf8;');
			$sql="delete from tb_pr_controlsetting where resource_id=?";
			$statement = $myPDO->prepare($sql);
			$result = $statement->execute(array($resource_id));
		}
	}
?>