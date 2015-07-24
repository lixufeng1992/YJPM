<?php
	class MargindateDao extends CommonDao{
		public function findAll(){
			
			$sql="select * from tb_margindate order by margindate_id asc";
			$statement = $this->commonPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findByProjectid($projectid){
			
			$sql="select * from tb_margindate where projectid=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($projectid));
			return $statement->fetch();
		}

		public function findById($margindate_id){
			
			$sql="select * from tb_margindate where margindate_id=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($margindate_id));
			return $statement->fetch();
		}

		public function add($projectid,$date,$preremind_days,$amount,$is_submit,$is_getback){
			
			$sql="insert into tb_margindate(projectid,date,preremind_days,amount,is_submit,is_getback) values(?,?,?,?,?,?)";
			$statement = $this->commonPDO->prepare($sql);
			$result = $statement->execute(array($projectid,$date,$preremind_days,$amount,$is_submit,$is_getback));
			if($result == false)return -1;
			else return $this->commonPDO->lastInsertId();
		}

		public function updateById($margindate_id,$projectid,$date,$preremind_days,$amount,$is_submit,$is_getback){
			
			$sql="update tb_margindate set projectid=?,date=?,preremind_days=?,amount=?,is_submit=?,is_getback=? where margindate_id=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($projectid,$date,$preremind_days,$amount,$is_submit,$is_getback,$margindate_id));		
		}

		public function deleteById($margindate_id){
			
			$sql="delete from tb_margindate where margindate_id=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($margindate_id));		
		}

	}




?>