<?php
	class StartbiddateDao extends CommonDao{
		public function findAll(){
			
			$sql="select * from tb_startbiddate order by startbiddate_id asc";
			$statement = $this->commonPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findByProjectid($projectid){
			
			$sql="select * from tb_startbiddate where projectid=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($projectid));
			return $statement->fetch();
		}

		public function findById($startbiddate_id){
			
			$sql="select * from tb_startbiddate where startbiddate_id=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($startbiddate_id));
			return $statement->fetch();
		}

		public function add($projectid,$date,$preremind_days,$is_finished){
			
			$sql="insert into tb_startbiddate(projectid,date,preremind_days,is_finished) values(?,?,?,?)";
			$statement = $this->commonPDO->prepare($sql);
			$result = $statement->execute(array($projectid,$date,$preremind_days,$is_finished));
			if($result == false)return -1;
			else return $this->commonPDO->lastInsertId();
		}

		public function updateById($startbiddate_id,$projectid,$date,$preremind_days,$is_finished){
			
			$sql="update tb_startbiddate set projectid=?,date=?,preremind_days=?,is_finished=? where startbiddate_id=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($projectid,$date,$preremind_days,$is_finished,$startbiddate_id));		
		}

		public function deleteById($startbiddate_id){
			
			$sql="delete from tb_startbiddate where startbiddate_id=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($startbiddate_id));		
		}

	}




?>