<?php
	class BiddingrivalDao extends CommonDao{
		public function findAll(){
			
			$sql="select * from tb_biddingrival order by biddingrivalid asc";
			$statement = $this->commonPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($biddingrivalid){
			
			$sql="select * from tb_biddingrival where biddingrivalid=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($biddingrivalid));
			return $statement->fetch();
		}

		public function findByProjectid($projectid){
			
			$sql="select * from tb_biddingrival where projectid=? order by biddingrivalid asc";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($projectid));
			return $statement->fetchAll();
		}


		public function add($projectid,$name,$linkman,$linkman_phone,
								$linkman_ourside,$cooperation_type,$remark){
			
			$sql="insert into tb_biddingrival(projectid,name,linkman,linkman_phone,
								linkman_ourside,cooperation_type,remark) values(?,?,?,?,?,?,?)";
			$statement = $this->commonPDO->prepare($sql);
			$result = $statement->execute(array($projectid,$name,$linkman,$linkman_phone,
								$linkman_ourside,$cooperation_type,$remark));
			if($result == false)return -1;
			else return $this->commonPDO->lastInsertId();
		}

		public function updateById($biddingrivalid,$projectid,$name,$linkman,$linkman_phone,
								$linkman_ourside,$cooperation_type,$remark){
			
			$sql="update tb_biddingrival set projectid=?,name=?,linkman=?,linkman_phone=?,
								linkman_ourside=?,cooperation_type=?,remark=? where biddingrivalid=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($projectid,$name,$linkman,$linkman_phone,
								$linkman_ourside,$cooperation_type,$remark,$biddingrivalid));		
		}

		public function deleteById($biddingrivalid){
			
			$sql="delete from tb_biddingrival where biddingrivalid=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($biddingrivalid));		
		}

	}




?>