<?php
	class ExacctDao extends Model{
		public function findAll(){
		
			$sql="select * from tb_exacct left join tb_exacctclass on tb_exacct.classid = tb_exacctclass.exacctclassid order by exacctid asc";
			$statement = $this->commonPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findByParentId($id){
			
			$sql="select * from tb_exacct left join tb_exacctclass on tb_exacct.classid = tb_exacctclass.exacctclassid where parentid=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($id));
			return $statement->fetch();
		}
		public function findById($id){
			
			$sql="select * from tb_exacct left join tb_exacctclass on tb_exacct.classid = tb_exacctclass.exacctclassid where exacctid=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($id));
			return $statement->fetch();
		}

		public function add($name,$remark,$classid,$parentid){
			
			$sql="insert into tb_exacct(exacctname,remark,classid,parentid) values(?,?,?,?)";
			$statement = $this->commonPDO->prepare($sql);
			$result = $statement->execute(array($name,$remark,$classid,$parentid));
			if($result == false)return -1;
			else return $this->commonPDO->lastInsertId();
		}

		public function updateById($id,$name,$remark,$classid){
		
			$sql="update tb_exacct set exacctname=?,remark=?,classid=? where exacctid=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($name,$remark,$classid,$id));		
		}

		public function deleteById($id){
			
			$sql = "select count(*) as c from tb_exacct where parentid=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($id));
			$count = $statement->fetch();
			if ($count["c"]){
				return false;				
			}
			$sql="delete from tb_exacct where exacctid=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($id));
		}

	}



?>
