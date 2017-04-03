<?php 
require_once('lib/config.php');

session_start();

$data = array();

$date=date("Y-m-d H:i:s");

if(!empty($_POST['token'])) {
    // echo json_encode($data);
    if (hash_equals($_SESSION['token'], $_POST['token'])) { 
        
        $condition_accept = filter_var($_POST['conditionAccept'],FILTER_SANITIZE_STRING);
        
        if($condition_accept == '1') {
        
            $applicant_name = filter_var($_POST['applicantName'], FILTER_SANITIZE_STRING);
            $gender = filter_var($_POST['gender'], FILTER_SANITIZE_STRING);
            $dob = filter_var($_POST['dob'], FILTER_SANITIZE_STRING);
            $shirt_size = filter_var($_POST['shirtSize'], FILTER_SANITIZE_STRING);
            $child_chance = filter_var($_POST['childChance'], FILTER_SANITIZE_STRING);
            $pune_different = filter_var($_POST['puneDifferent'], FILTER_SANITIZE_STRING);
            $parent_name = filter_var($_POST['parentName'], FILTER_SANITIZE_STRING);
            $parent_mobile = filter_var($_POST['parentMobile'], FILTER_SANITIZE_NUMBER_INT);
            $parent_email = filter_var($_POST['parentEmail'], FILTER_VALIDATE_EMAIL); 
            $parent_address = filter_var($_POST['parentAddress'], FILTER_SANITIZE_STRING);
            $home_match = filter_var($_POST['homeMatch'], FILTER_SANITIZE_STRING);    
            //check whether all values are entered or not
            if( ($applicant_name && $gender && $dob && $shirt_size && $child_chance && $pune_different && $parent_name && $parent_mobile && $parent_email && $parent_address && $home_match) === false) {

                $db = new db;

                $table_name = 'tbl_form_entry';

                $field_values = "applicant_name= '$applicant_name', ".
                                "gender = '$gender', ".
                                "dob = '$dob', ".
                                "shirt_size = '$shirt_size',".
                                "child_chance = '$child_chance', ".
                                "pune_different = '$pune_different', ".
                                "parent_name = '$parent_name', ".
                                "parent_email = '$parent_email', ".
                                "parent_mobile = '$parent_mobile', ".
                                "parent_address = '$parent_address', ".
                                "home_match = '$home_match', ".
                                "created_at = '$date'";
                
                $result = $db->insert($table_name, $field_values);

                if($result) {
                    $data['error'] = false;
                } else {
                    $data['error'] = true;
                    $data['error_type'] = 'db error';
                    $data['error_description'] = INSERTION_FAILED;
                }
                
            } else {
                $data['error'] = true;
                $data['error_type'] = 'validation';
                $data['error_description'] = FIELDS_MISSING;
            }

        // echo json_encode($data);    
        } else {
            $data['error'] = true;
            $data['error_type'] = 'validation';
            $data['error_description'] = CONDITION_NOT_ACCEPTED;
        }
    } else {
        $data['error'] = true;
        $data['error_type'] = 'validation';
        $data['error_description'] = TOKEN_VALIDATION_FAILED;
    }
} else {
    $data['error'] = true;
    $data['error_type'] = 'validation';
    $data['error_description'] = TOKEN_MISSING;
}


//JSON Encoding
echo json_encode($data);
