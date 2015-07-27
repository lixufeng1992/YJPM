<?php
import("@.Model.CommonDao");
class ResourceDocumentDao extends CommonDao
{

    public function findAll()
    {
        $sql = "select * from tb_resource_document order by documentid asc";
        $statement = $this->commonPDO->query($sql);
        return $statement->fetchAll();
    }

    public function findById($documentid)
    {
        $sql = "select * from tb_resource_document where documentid=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $documentid
        ));
        return $statement->fetch();
    }

    public function findByResourceid($resourceid)
    {
        $sql = "select * from tb_resource_document where resourceid=? order by documentid asc";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $resourceid
        ));
        return $statement->fetchAll();
    }

    public function add($resourceid, $serial_number, $name, $path, $update_date, $remark, $create_userid)
    {
        
        $sql = "insert into tb_resource_document(resourceid,serial_number,name,path,update_date,
								remark,create_userid) values(?,?,?,?,?,?,?)";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $resourceid,
            $serial_number,
            $name,
            $path,
            $update_date,
            $remark,
            $create_userid
        ));
        if ($result == false)
            return - 1;
        else
            return $this->commonPDO->lastInsertId();
    }

    public function updateById($documentid, $resourceid, $serial_number, $name, $path, $update_date, $remark, $create_userid)
    {
       
        $sql = "update tb_resource_document set resourceid=?,serial_number=?,name=?,path=?,update_date=?,
								remark=?,create_userid=? where documentid=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $resourceid,
            $serial_number,
            $name,
            $path,
            $update_date,
            $remark,
            $create_userid,
            $documentid
        ));
    }

    public function deleteById($documentid)
    {
       
        $sql = "delete from tb_resource_document where documentid=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $documentid
        ));
    }
}

?>