<?php 
// Include the database config file 
session_start();
 if(!isset($_SESSION['Email']))
        {
                header("location: login.php");
        }
        $name=$_SESSION['Email'];
 include_once ('conn.php');



if(!empty($_POST["prop_type_id"])){ 

$prop_type_id = $_POST["prop_type_id"];


$result = $dbConn->query("SELECT id ,prop_sub_type  FROM m_property_type where prop_type = '$prop_type_id'");

    $result->execute();
    // $row = $result->fetch(PDO::FETCH_ASSOC);
     
    // Generate HTML of state options list 
    if($result->rowCount() > 0){ 
        echo '<option value="">Select Property Type</option>'; 
        while($row = $result->fetch(PDO::FETCH_ASSOC)){  
            echo '<option value="'.$row['id'].'">'.$row['prop_sub_type'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">Property Type Not Available</option>'; 
    } 
}

if(!empty($_POST["state_id"])){ 

    $state_id = $_POST["state_id"];
    // Fetch city data based on the specific state 
    $result = $dbConn->query("select id, name from cities where state_id = '$state_id'");

    $result->execute();
    // $row = $result->fetch(PDO::FETCH_ASSOC);
     
    // Generate HTML of city options list 
    if($result->rowCount() > 0){ 
        echo '<option value="">Select City</option>'; 
        while($row = $result->fetch(PDO::FETCH_ASSOC)){  
            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">City not available</option>'; 
    } 
}

if(!empty($_POST["tenant_id"])){ 

    $tenant_id = $_POST["tenant_id"];
    // Fetch property data based on the specific tenant
    $result = $dbConn->query("select p.property_id, a.agreement_id,
 concat(p.property_name,' - ',p.flat_no,', ',p.city_id,' - ',p.pincode) as property_name from det_property p 
 inner join det_agreement a on p.property_id = a.property_id and p.status = 'Active'
 inner join det_tenant t on a.tenant_id = '$tenant_id' and a.status = 'Active'");
    $result->execute();
    // $row = $result->fetch(PDO::FETCH_ASSOC);    
    // Generate HTML of property options list 
    if($result->rowCount() > 0){         
        echo '<option value="">Select Property</option>'; 
        while($row = $result->fetch(PDO::FETCH_ASSOC)){  
            echo '<option value="'.$row['property_id'].'">'.$row['property_name'].'</option>'; 
        } 
    }else {
        echo '<option value="">Agreement not done</option>'; 
    } 
}

if(!empty($_POST["property_id"])){ 

    $property_id = $_POST["property_id"];
    echo "<script>alert('$property_id')</script>";
    // Fetch property data based on the specific tenant
    $result = $dbConn->query("select agreement_id from det_agreement where property_id = '$property_id' and status = 'Active'");
    $result->execute();
    $row = $result->fetch(PDO::FETCH_ASSOC);    
    // Generate HTML of property options list 
    //echo "<script>alert('$property_id')</script>";
    echo '<script>alert('.$row['agreement_id'].')</script>';
    if($row > 0){         
            echo '<script>
                    document.getElementById("agreementId").value = '.$row['agreement_id'].'
            </script>';  
    }else {
        echo '<option value="">Agreement not done</option>'; 
    } 
}

if(!empty($_POST["owner_property_id"])){ 
    $property_id = $_POST["owner_property_id"];

    $result = $dbConn->query("SELECT op.id ,o.owner_id,o.owner_name,op.unitNo ,op.property_id  FROM det_owner_property op JOIN det_owner o ON op.owner_id = o.owner_id  where op.property_id = '$property_id'");
        $result->execute();
        // $row = $result->fetch(PDO::FETCH_ASSOC);
        // Generate HTML of state options list 
        if($result->rowCount() > 0){ 
            echo '<option value="">Select Owner Name</option>'; 
            while($row = $result->fetch(PDO::FETCH_ASSOC)){  
                echo '<option value="'.$row['owner_id'].'">'.$row['owner_name'].' - '.$row['unitNo'].'</option>'; 
            } 
        }else{ 
            echo 'false';
        } 
}


if(!empty($_POST["owner_prop_id"])){ 

    $id = $_POST["owner_prop_id"];
    $result = $dbConn->query("SELECT * FROM det_owner_property where id = '$id'");
        $result->execute();
        if($result->rowCount() > 0){
            $response_array = $result->fetch(PDO::FETCH_ASSOC);
            echo json_encode(['success'=>true ,'data'=>$response_array]); 
        }else{ 
            echo json_encode(['success'=>false,'error'=>$result->errorInfo()]);
        } 
}

if(!empty($_POST["doc_id"])){ 
    try {
        $id = $_POST["doc_id"];
        $result = $dbConn->query("SELECT * FROM det_file_upload where doc_id = '$id'");
        $result->execute();
        if($result->rowCount() > 0){
            $response_array = $result->fetch(PDO::FETCH_ASSOC);
            echo json_encode(['success'=>true ,'data'=>$response_array]); 
        }else{ 
            echo json_encode(['success'=>false,'error'=>$result->errorInfo()]);
        } 
    }   catch(PDOException $e) {
        echo json_encode(['success'=>false,'error'=>$e->getMessage()]);
    }
}

if(!empty($_POST["director_id"])){ 
    try {
        $id = $_POST["director_id"];
        $result = $dbConn->query("SELECT * FROM det_director where id = '$id'");
        $result->execute();
        if($result->rowCount() > 0){
            $response_array = $result->fetch(PDO::FETCH_ASSOC);
            echo json_encode(['success'=>true ,'data'=>$response_array]); 
        }else{ 
            echo json_encode(['success'=>false,'error'=>$result->errorInfo()]);
        } 
    }   catch(PDOException $e) {
        echo json_encode(['success'=>false,'error'=>$e->getMessage()]);
    }
}

if(!empty($_POST["rent_details_id"])){ 
    try {
        $id = $_POST["rent_details_id"];
        $result = $dbConn->query("SELECT * FROM det_rent_details where rent_details_id = '$id'");
        $result->execute();
        if($result->rowCount() > 0){
            $response_array = $result->fetch(PDO::FETCH_ASSOC);
            echo json_encode(['success'=>true ,'data'=>$response_array]); 
        }else{ 
            echo json_encode(['success'=>false,'error'=>$result->errorInfo()]);
        } 
    }   catch(PDOException $e) {
        echo json_encode(['success'=>false,'error'=>$e->getMessage()]);
    }
}