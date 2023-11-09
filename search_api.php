<?php
    require('./dbconfig.php');

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $items_arr['result'] = array();

        $keyword = $_POST['keyword'];
        $type = $_POST['type'];

        if($type == "id") {
            $type = "ID";
        } else if($type == "product") {
            $type = "Product";
        } else if($type == "price") {
            $type = "Price";
        }

        $query = "SELECT * FROM tbl_bakery WHERE `$type` LIKE '%$keyword%' ";
        $stmt = $db->prepare($query);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            array_push($items_arr['result'], $row);
        }
        echo json_encode($items_arr);
        http_response_code(200);


    }
?>