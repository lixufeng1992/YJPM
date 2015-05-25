<?php

	//删除文件夹
	function func_deleteDir($dir){
  	//先删除目录下的文件：
  		$dh=opendir($dir);
  		while ($file=readdir($dh)) {
    		if($file!="." && $file!="..") {
      			$fullpath=$dir."/".$file;
      			if(!is_dir($fullpath)) {
          			unlink($fullpath);
      			}
      			else {
          			func_deleteDir($fullpath);
      			}
    		}
  		}
 		closedir($dh);
  		//删除当前文件夹：
  		if(rmdir($dir)) {
    		return true;
  		}
  		else {
    		return false;
  		}
	}
	//创建文件
	//成功返回1，文件上传失败返回-1，文件数组参数有误返回-2，该路径文件已存在返回-3,存储文件失败-4
	function func_createFile($dirPath,$fileName,$fileArray,&$suffix_r){	
		if($fileArray['error'] > 0)return -1;
		if(isset($fileArray['name']) == false)return -2;
		//$fileName = iconv('utf-8','gbk', $fileName);
		$suffix = strrchr($fileArray["name"],'.');
		$suffix = substr($suffix,1);
		$suffix_r = $suffix;
		if(file_exists($dirPath.'/'.$fileName.'.'.$suffix))return -3;
		func_createFolder($dirPath);
		// while(!is_dir($dirPath)){
		// 	mkdir(dirname($dirPath), 0777);
		// }
		$result = move_uploaded_file($fileArray["tmp_name"],$dirPath.'/'.$fileName.'.'.$suffix);
		if($result == false)return -4;
		return 1;
	}

	function func_createFolder($dirPath){
		if(is_dir($dirPath))return true;
		//if(mkdir($dirPath,0777) == true)return true;
		$dirPath1= dirname($dirPath);
		func_createFolder($dirPath1);
		return mkdir($dirPath,0777);
	}

	//下载文件
	function func_downloadFile($filepath){
		$fp=fopen($filepath,"r+");//下载文件必须先要将文件打开，写入内存
		if(!file_exists($filepath)){//判断文件是否存在
			echo "文件不存在";
			exit();
		}

		$file_size=filesize($filepath);//判断文件大小
		//返回的文件
		header("Content-type:application/octet-stream");
		//按照字节格式返回
		header("Accept-Ranges:bytes");
		//返回文件大小
		header("Accept-Length:".$file_size);
		//弹出客户端对话框，对应的文件名
		header("Content-Disposition:attachment;filename=".basename($filepath));
		//防止服务器瞬时压力增大，分段读取
		$buffer=1024;
		while(!feof($fp)){
			$file_data=fread($fp,$buffer);
			echo $file_data;
		}
		//关闭文件
		fclose($fp);
	}
  //array_column兼容设定
  function arrayColumn($array,$column,$key_column = null){
    if(function_exists(array_column) == true)return array_column($array,$column,$key_column);
    else{
      $result = array();
      foreach($array as $value){
        if(is_array($value) == false)continue;
        if(is_null($column))$entity = $value;
        else $entity = $value[$column];

        if(is_null($key_column) != true){
          $result[$array[$key_column]] = $entity;
        }
        else $result[]=$entity;
      }
      return $result;
    }
  }



?>
