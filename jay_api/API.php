<?php 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

header('Content-Type: application/json'); // ตั้งค่าให้ส่งข้อมูลกลับเป็น json

require 'core/Controller.php';
require_once 'core/config.php';

$JSON = file_get_contents('php://input');
$DATA = json_decode($JSON, true);
$METHOD = $_SERVER['REQUEST_METHOD'];

$postObj = new Postman($conn);


if ($METHOD === 'GET') {
    
    $URI = $_SERVER['PATH_INFO'];

    /**
     *  TODO: สร้างเส้นทาง API มี 3 เส้น ดังนี้
     * * 1. / : เอาไว้ดึงข้อมูลทั้งหมด
     * * 2. /province : เอาไว้ดึงข้อมูลจังหวัด
     * * 3. /provinceid : เอาไว้ดึงข้อมูลจังหวัดด้วย id
    */


    if ($URI == '/province')   //! ดึงข้อมูลจังหวัด
    {
        $province = $postObj->get_province();
        print(json_encode($province));
    }
    elseif (($URI == '/provinceid') &&(isset($_GET['id']))) //! ดึงข้อมูลจังหวัดด้วย id
    {
        $id = $_GET['id'];
        $result = $postObj->get_province_byID($id);
        print(json_encode($result));
    }
    elseif ($URI == '/') //! ดึงข้อมูลทั้งหมด
    { 
        $postman = $postObj->get_subdistrict(); 
        print(json_encode($postman));   
    }
    else // ! ไม่พบเส้นทาง
    {
        print(json_encode(['message' => 'Not found']));
    }
    
}
elseif ($METHOD == 'POST') {
    
    $URI = $_SERVER['PATH_INFO'];

    
}



?>