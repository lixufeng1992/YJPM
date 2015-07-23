<?php

class EmployerDao extends CommonDao
{
    // 插入用户数据
    // 返回-1表示插入失败 成功则返回表中的id号
    public function add($employer_number, $name, $entrytime, $company_entrytime, $birthday, $companyid, $departmentid, $gender, $deploma, $political_state, $positionid, $salaryid, $id_number, $phone_number, $address, $zip_number, $hometown, $email, $qq_number, $contact_employerid, $is_atposition, $is_user)
    {
        $sql = "insert into tb_employer(employer_number,name,entrytime,company_entrytime,birthday,companyid,departmentid,gender,deploma,political_state,positionid,
					salaryid,id_number,phone_number,address,zip_number,hometown,email,qq_number,contact_employerid,is_atposition,
					is_user) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $employer_number,
            $name,
            $entrytime,
            $company_entrytime,
            $birthday,
            $companyid,
            $departmentid,
            $gender,
            $deploma,
            $political_state,
            $positionid,
            $salaryid,
            $id_number,
            $phone_number,
            $address,
            $zip_number,
            $hometown,
            $email,
            $qq_number,
            $contact_employerid,
            $is_atposition,
            $is_user
        ));
        if ($result == false)
            return - 1;
        else
            return $this->commonPDO->lastInsertId();
    }
    
    // 按userId查找数据
    // 返回-1表示查找失败
    public function findById($employerid)
    {
        $sql = "select * from tb_employer where employerid = ?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $employerid
        ));
        $employerrow = $statement->fetch();
        return $employerrow;
    }

    public function findAll()
    {
        
        // $sql="select * from tb_employer order by employerid asc";
        $sql = "select * from tb_employer where employerid <> 1 order by employerid asc";
        $statement = $this->commonPDO->query($sql);
        return $statement->fetchAll();
    }

    public function findAll_idName()
    {
        $sql = "select employerid,name from tb_employer order by employerid asc";
        $statement = $this->commonPDO->query($sql);
        return $statement->fetchAll();
    }

    public function findAll_idEmployernumberName()
    {
        $sql = "select employerid,employer_number,name,companyid,departmentid from tb_employer order by employerid asc";
        $statement = $this->commonPDO->query($sql);
        return $statement->fetchAll();
    }

    public function updateById($employerid, $employer_number, $name, $entrytime, $company_entrytime, $birthday, $companyid, $departmentid, $gender, $deploma, $political_state, $positionid, $salaryid, $id_number, $phone_number, $address, $zip_number, $hometown, $email, $qq_number, $contact_employerid, $is_atposition, $is_user)
    {
        $sql = "update tb_employer set employer_number=?,name=?,entrytime=?,company_entrytime=?,birthday=?,companyid=?,departmentid=?,
					gender=?,deploma=?,political_state=?,positionid=?,salaryid=?,id_number=?,phone_number=?,address=?,zip_number=?,
					hometown=?,email=?,qq_number=?,contact_employerid=?,is_atposition=?,is_user=? where employerid=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $employer_number,
            $name,
            $entrytime,
            $company_entrytime,
            $birthday,
            $companyid,
            $departmentid,
            $gender,
            $deploma,
            $political_state,
            $positionid,
            $salaryid,
            $id_number,
            $phone_number,
            $address,
            $zip_number,
            $hometown,
            $email,
            $qq_number,
            $contact_employerid,
            $is_atposition,
            $is_user,
            $employerid
        ));
    }

    public function deleteById($employerid)
    {
        $sql = "delete from tb_employer where employerid=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $employerid
        ));
    }
}

?>
