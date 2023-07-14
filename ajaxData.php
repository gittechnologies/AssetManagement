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

if(!empty($_POST['function_name'])) {
    $functionName = $_POST['function_name'];

    switch ($functionName) {
        case 'getData':
            $table_name = $_POST['table_name'];
            $col_name = $_POST['col_name'];
            $col_val = $_POST['col_val'];

            echo getData($table_name,$col_name,$col_val,$dbConn);
            break;
        case 'searchPendingRent':
            $search = $_POST['search'];
            $agreement_id = $_POST['agreement_id'];

            echo searchPendingRent($search,$dbConn,$agreement_id);
            break;
        default:
            echo json_encode([
                'success'=>false,
                'error'=>"Something Went Wrong.Please try again",
            ]);
    }
}

function getData($table_name,$col_name,$col_val,$dbConn) 
{
    if(!empty($col_val)) {
        try {
            $id = $col_val;
            $result = $dbConn->query("SELECT * FROM $table_name where $col_name = '$id'");
            $result->execute();

            if($result->rowCount() > 0){
                $response_array = $result->fetch(PDO::FETCH_ASSOC);
                return json_encode(['success'=>true ,'data'=>$response_array]); 
            }else{ 
                return json_encode(['success'=>false,'error'=>$result->errorInfo()]);
            } 
        }   catch(PDOException $e) {
            return json_encode(['success'=>false,'error'=>$e->getMessage()]);
        }
    }   else {
        return json_encode(['success'=>false,'error'=>"Something Went Wrong.Please try again"]);
    }
}

function searchPendingRent($search,$dbConn,$agreement_id=null)
{   
    $subQuery = '';

    if (isset($agreement_id) && !empty($agreement_id)) {
        $subQuery = " and r.agreement_id='".$agreement_id."' "; 
    }

    try {
        $result = $dbConn->query("SELECT r.rent_id FROM `det_tenant` t left JOIN det_agreement a ON t.tenant_id= a.tenant_id left JOIN det_rent r ON a.agreement_id= r.agreement_id LEFT JOIN det_agreement da ON da.agreement_id= r.agreement_id LEFT JOIN det_property p ON p.property_id=da.property_id where r.rent_status <> 'PAID' ".$subQuery . " AND (DATE_FORMAT(r.rent_date, '%b-%Y') LIKE '%".$search."%' OR p.property_name LIKE '%".$search."%' OR t.tenant_name LIKE '%".$search."%') ORDER BY r.rent_id DESC");
        $result->execute();

        if($result->rowCount() > 0){
            $response_array = $result->fetchAll(PDO::FETCH_ASSOC);

            $rent_ids = array_column($response_array, 'rent_id');

            return json_encode(['success'=>true ,'data'=> ['rent_ids' => $rent_ids]]); 
        }else{ 
            return json_encode(['success'=>false,'error'=>$result->errorInfo()]);
        } 
    }   catch(PDOException $e) {
        return json_encode(['success'=>false,'error'=>$e->getMessage()]);
    }
}