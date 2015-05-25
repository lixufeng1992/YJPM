<?php
class ProcessDao extends Model{
    public function findAll(){
        $dsn = C('DB_DSN1');
        $myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
        $myPDO->query('set names utf8;');
        $sql="select * from tb_process order by process_id asc";
        $statement=$myPDO->query($sql);
        return $statement->fetchAll();
    }

	public function add($process_name,$process_classify_id){
		$dsn = C('DB_DSN1');
		$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
		$myPDO->query('set names utf8;');
		$sql="insert into tb_process(process_name,process_classify_id) values(?,?)";
		$statement = $myPDO->prepare($sql);
		$result = $statement->execute(array($process_name,$process_classify_id));
		if($result == false)return -1;
			else return $myPDO->lastInsertId();
        }

	public function deleteById($process_id){
		$dsn = C('DB_DSN1');
		$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
		$myPDO->query('set names utf8;');
		$sql="delete from tb_process where process_id=?";			
		$statement = $myPDO->prepare($sql);
		$statement->execute(array($process_id));			
        }

	public function deleteByClassifyId($classify_id){
		$dsn = C('DB_DSN1');
		$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
		$myPDO->query('set names utf8;');
		$sql="delete from tb_process where process_classify_id=?";			
		$statement = $myPDO->prepare($sql);
		$statement->execute(array($classify_id));			
        }

	public function updateById($process_id,$process_name,$process_classify_id){
		$dsn = C('DB_DSN1');
		$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
		$myPDO->query('set names utf8;');
		$sql="update tb_process set process_name=?,process_classify_id=? where process_id=?";
		$statement = $myPDO->prepare($sql);
		$result = $statement->execute(array($process_name,$process_classify_id,$process_id));
	}
}
?>
