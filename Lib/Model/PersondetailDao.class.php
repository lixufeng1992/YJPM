<?php
import("@.Model.CommonDao");
class PersondetailDao extends CommonDao
{
    // 插入用户数据
    // 返回-1表示插入失败 成功则返回表中的id号
    public function add($name, $phone, $gender, $idcard, $birthday, 
                        $qq, $email, $deploma, $political_status, $address, 
                        $zip,$hometown,$enterpriseid,$departmentid,$positionid,
                        $salaryid,$is_atposition,$person_id)
    {
        $sql = "insert into tb_persondetail($name, $phone, $gender, $idcard, $birthday, 
                        $qq, $email, $deploma, $political_status, $address, 
                        $zip,$hometown,$enterpriseid,$departmentid,$positionid,
                        $salaryid,$is_atposition,$person_id) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $name, $phone, $gender, $idcard, $birthday, 
            $qq, $email, $deploma, $political_status, $address, 
            $zip,$hometown,$enterpriseid,$departmentid,$positionid,
            $salaryid,$is_atposition,$person_id
        ));
        if ($result == false)
            return - 1;
        else
            return $this->commonPDO->lastInsertId();
    }
    
    // 按id查找数据
    // 返回-1表示查找失败
    public function findById($id)
    {
        $sql = "select * from tb_persondetail where id = ?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array($id));
        $row = $statement->fetch();
        return $row;
    }

    public function findAll()
    {
        $sql = "select * from tb_persondetail where id <> 1 order by id asc";
        $statement = $this->commonPDO->query($sql);
        return $statement->fetchAll();
    }

 

    public function updateById($id,$name, $phone, $gender, $idcard, $birthday, 
                        $qq, $email, $deploma, $political_status, $address, 
                        $zip,$hometown,$enterpriseid,$departmentid,$positionid,
                        $salaryid,$is_atposition,$person_id)
    {
        $sql = "update tb_persondetail set name=?, phone=?, gender=?, idcard=?, birthday=?, 
                        qq=?, email=?, deploma=?, political_status=?, address=?, 
                        zip=?,hometown=?,enterpriseid=?,departmentid=?,positionid=?,
                        salaryid=?,is_atposition=?,person_id=? where id=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array($name, $phone, $gender, $idcard, $birthday, 
                        $qq, $email, $deploma, $political_status, $address, 
                        $zip,$hometown,$enterpriseid,$departmentid,$positionid,
                        $salaryid,$is_atposition,$person_id,$id));
    }

    public function deleteById($id)
    {
        $sql = "delete from tb_persondetail where id=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array($id));
    }
}

?>
