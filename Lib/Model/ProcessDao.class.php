<?php
class ProcessDao extends Model{
    public function findAll(){
       
        $sql="select * from tb_process order by process_id asc";
        $statement=$this->commonPDO->query($sql);
        return $statement->fetchAll();
    }

	public function add($process_name,$process_classify_id){
		
		$sql="insert into tb_process(process_name,process_classify_id) values(?,?)";
		$statement = $this->commonPDO->prepare($sql);
		$result = $statement->execute(array($process_name,$process_classify_id));
		if($result == false)return -1;
			else return $this->commonPDO->lastInsertId();
        }

	public function deleteById($process_id){
		
		$sql="delete from tb_process where process_id=?";			
		$statement = $this->commonPDO->prepare($sql);
		$statement->execute(array($process_id));			
        }

	public function deleteByClassifyId($classify_id){
		
		$sql="delete from tb_process where process_classify_id=?";			
		$statement = $this->commonPDO->prepare($sql);
		$statement->execute(array($classify_id));			
        }

	public function updateById($process_id,$process_name,$process_classify_id){
		
		$sql="update tb_process set process_name=?,process_classify_id=? where process_id=?";
		$statement = $this->commonPDO->prepare($sql);
		$result = $statement->execute(array($process_name,$process_classify_id,$process_id));
	}
}
?>
