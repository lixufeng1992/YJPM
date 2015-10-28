<?php
	class DevicePurchaseDao extends Model{
		/**
		 * [connectDatabase description] :创建数据库的连接
		 * @return [type] [description] :返回连接对象
		 */
		public function connectDatabase(){
			$dsn = C('DB_DSN1');
			$myPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
			$myPDO ->query('set names utf8');//设置编码方式
			return $myPDO;
		}

		/**
		 * [findAll 获得采购合同表中所有的元组
		 * @return ResultSet 返回查询结果集
		 */
		public function findAll(){
			$myPDO = $this->connectDatabase();
			$sql = "select * from tb_device_purchase";
			$statement = $myPDO->query($sql);
			return $statement->fetchAll();
		}

	}


