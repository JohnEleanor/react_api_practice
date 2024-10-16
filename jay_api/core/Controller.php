<?php 

class Postman { 

    private $conn;
    public function __construct($conn){
        $this->conn = $conn;
    }

    public function get_subdistrict(){
        // ! ดึงข้อมูลทั้งหมด
        $stmt = $this->conn->prepare("
        SELECT
            *,
            district.name_th AS dis_name,
            province.name_en AS pro_en,
            province.name_th AS pro_name,
            subdistrict.name_th AS sub_name
        FROM
            `subdistrict`,
            `province`,
            `district`
        WHERE
            district.district_id = subdistrict.district_id AND district.province_id = province.province_id
        LIMIT 25
        ");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    } 

    public function get_province(){ 
        // ! ดึงข้อมูลจังหวัด
        $stmt = $this->conn->prepare("
            SELECT * FROM `province` LIMIT 25
        ");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    } 

    public function get_province_byID($id){ 
        // ! ดึงข้อมูลจังหวัดด้วย id 
        /**
         * @param $id รับค่า id จังหวัด
        */
        $sql = "
        SELECT 
            *, 
            district.name_th AS dis_th, 
            province.name_th AS pro_th, 
            subdistrict.name_th AS sub_th
        FROM 
            subdistrict, district, province
        WHERE 
            district.district_id = subdistrict.district_id 
            AND district.province_id = province.province_id 
            AND province.province_id = :id
        ORDER BY 
            district.name_th ASC;
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }




}

?>