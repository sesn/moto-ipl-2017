<?php
session_start();
require_once('../../lib/config.php');

//Check whether the user is logged in or not
checkLogin($_SESSION['admin_logged_in'], $admin_path);

$db = new db;

$page_heading="Form Manager";
	
//Table
$table_name = 'tbl_form_entry'; 

//set the show variable
if(isset($_REQUEST['show'])) {
    $show = strtolower($db->escape(trim($_REQUEST['show'])));
} else {
    $show = 'view_all';
}

//Show variables Initalization
$view_all = 'view_all';
$activated = 'activated';
$deactivated = 'deactivated';


//Pagination variables Initalization
if(!isset($_REQUEST['page_size'])) 
    $_REQUEST['page_size'] = $num_record_per_page;

$page_size = $db->escape($_REQUEST['page_size']);

if(isset($_REQUEST['page'])) { 
    $page = $db->escape(trim($_REQUEST['page'])); 
} else { 
    $page = 1; 
}


?>
<!-- header -->
<?php include("../header.php"); ?>
<!-- .header -->

<!-- container -->
<div class="container-fluid">


    <?php 
    /**
     * Row for displaying the session message for adding or updating functionality
     */
    if(isset($_SESSION['message'])): ?>
    <div class="row message">
        <div class="col s12">
            <?php echo $_SESSION['message']; $_SESSION['message'] = ''; ?>
        </div>
    </div>
    <?php endif; ?>


    <?php 
    /**
        Display all data when the show variable is one of these values : activated, deactivated or view_all
    */
    if($show == $view_all || $show == $activated || $show == $deactivated ): ?>

    <form action="<?php print $_SERVER['PHP_SELF'];?>" method="post" name="frmList" id="frmList">

        <?php 

            /**
            Select Query for table
            */
            $query_member = "SELECT * FROM {$table_name}";

            $order_query = " ORDER BY created_at DESC";

            /**
            Conditional Query for Search 
            */
            if(isset($_REQUEST['search']) && $db->escape(trim($_REQUEST['search']))!='') {
                $search = $db->escape(trim($_REQUEST['search']));

                switch($show) {
                    case $activated:
                        $where = " WHERE status = '1' and applicant_name like '%$search%' ";
                        break;
                    case $deactivated:
                        $where = " WHERE status = '0' and applicant_name like '%$search%' ";
                        break;
                    default:
                        $where = " WHERE applicant_name like '%$search%' ";
                        break;
                }
            } 
            /**
            Conditional Query for non search
            */
            else {
                switch($show) {
                    case $activated:
                        $where = " WHERE status = '1'";
                        break;
                    case $deactivated:
                        $where = " WHERE status = '0'";
                        break;
                    default:
                        $where = "";
                        break;
                }
            }

            $total_records = $db->get_num_rows($table_name, 'id', str_replace("WHERE","", $where) );
            $total_pages = ceil($total_records / $page_size);

            $start_from = ($page-1) * $page_size;

            $limit = " LIMIT {$start_from}, {$page_size}";

            $updated_query_member = $query_member.$where.$order_query.$limit;

            $result_member = $db->select($updated_query_member);
            $result_count = $page * $page_size - $page_size;

        ?>
        <!-- contentLink -->
        <div class="row linkContentContainer">
            <div class="row pafeHeadingContainer">
                <div class="col s12">
                    <h5 class="pageHeading"><?php echo $page_heading; ?></h5>
                </div>
            </div>
            <div class="col s12">
                <div class="col s6">
                    <ul class="inline-block">
                        <li><a class="waves-effect waves-light btn" href="index.php?show=view_all">View All (<?php echo $total_records; ?>)</a></li>
                        <li><a class="waves-effect waves-light btn" href="index.php?show=activated">Activated</a></li>
                        <li><a class="waves-effect waves-light btn" href="index.php?show=deactivated">Deactivated</a></li>
                    </ul>
                </div>
                <!-- search-->
                <div class="col s6">
                    <div class="input-field col s4 offset-s4">
                        <input id="searchName" name="searchName" type="text" class="validate">
                        <label for="searchName">Search here</label>
                    </div>
                    <div class="col s3" style="padding-top: 10px;">
                        <a class="waves-effect waves-light btn" href="index.php?show=view_all" id="searchBtn" onclick=" return searchFn()">Search</a>
                    </div>
                </div>
                <!-- .search-->
            </div>
        </div>
        <!-- .contentLink -->

        <!-- -->
        
        <div class="row contentContainer">
            <div class="col s12">
                <table class="striped tableContainer">
                    <thead>
                        <th>No.</th>
                        <th>Applicant name</th>
                        <th>Gender</th>
                        <th>DOB</th>
                        <th>Shirt Size</th>
                        <th>Child Chance</th>
                        <th>Pune Different</th>
                        <th>Parent name</th>
                        <th>Parent Email</th>
                        <th>Parent Mobile</th>
                        <th>Parent Address</th>
                        <th>Home Match</th>
                        <th>Created</th>
                        <th>Modified</th>
                        <th>Status</th>
                        <th>
                            <input id="selectAll" name="selectAll" value="SelectAll" type="checkbox">
                            <label for="selectAll"></label>
                        </th>
                    </thead>

                    <tbody>
                        <?php while($result = $result_member->fetch_assoc()):
                        $result_count++; 
                        ?>
                        <tr class="custom-row">
                        <td><?php echo $result_count; ?></td>
                        <td><a href="?show=edit&id=<?php echo $result['id']; ?>"><?php echo $result['applicant_name']; ?></a></td>
                        <td><?php echo $result['gender']; ?></td>
                        <td><?php echo $result['dob']; ?></td>
                        <td><?php echo $result['shirt_size']; ?></td>
                        <td><?php echo $result['child_chance']; ?></td>
                        <td><?php echo $result['pune_different']; ?></td>
                        <td><?php echo $result['parent_name']; ?></td>
                        <td><?php echo $result['parent_email']; ?></td>
                        <td><?php echo $result['parent_mobile']; ?></td>
                        <td><?php echo $result['parent_address']; ?></td>
                        <td><?php echo $result['home_match']; ?></td>
                        <td><?php echo $result['created_at']; ?></td>
                        <td><?php echo $result['modified_at']; ?></td>
                        <td><?php 
                            echo ($result['status'] == '1') ? 'Active' : ( ($result['status'] == '0') ? 'Inactive': 'Neither active or deactivate' );
                            ?>
                        </td>
                        <td>
                        <input type="checkbox" name="ID[]" id="ID<?php print $result_count;?>" value="<?php print $result["id"];?>" class="selectedCheckbox">
                        <label for="ID<?php print $result_count;?>"></label>
                        </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <div class="col s12 bottomLinkContainer">
                <div class="col s1" style="margin-top: 30px;">View</div>
                <div class="input-field col s1">
                    <select name="page_size" >
                    <?php

                        $Result = "";
                        for( $i = 1 ; $i <= 4 ; $i++){
                            if( $i == $page_size){
                                $Result .= "<option value=\"$i\" selected>$i</option>";
                            }                       
                            else{
                                $Result .= " <option value=\"$i\">$i</option>";
                            }
                        } // end of for loop
                        
                        for( $i = 1 ; $i <= 99 ; $i++)  {
                            if(($i%5) == 0){
                                if( $i == $page_size){
                                    $Result .= "<option value=\"$i\" selected>$i</option>";
                                }                       
                                else{   
                                    $Result .= " <option value=\"$i\">$i</option>";
                                }
                            }
                        } // end of for loop
                        print $Result;
                    ?>
                    </select>
                </div>
                <div class="col s1" style="margin-top: 30px;">records per page</div>
                <div class="col s2 linkContentContainer" style="margin-top: 30px;">
                    <a class="waves-effect waves-light btn" id="pageButton">Change pagesize</a>
                </div> 

                <div class="col s7 linkContentContainer tableLinkContainer right-align">
                <a class="waves-effect waves-light btn" onClick="ChangeSelectedStatus('Activate')">Activate</a>
                <a class="waves-effect waves-light btn" onClick="ChangeSelectedStatus('Inactivate')">Deactivate</a>

                <?php if($_SESSION['admin_permission'] == 'write') {
                    ?>
                    <a class="waves-effect waves-light btn" onClick="DeleteSelected()">Delete</a>    
                    <?php
                }
                ?>

                <?php 
                    if ($page > 1)
                    {
                    ?>
                        <a class="waves-effect waves-light btn" onClick="prevPage()">Previous Page</a>
                    <?php 
                    }
                    if ($page < $total_pages)
                    {
                    ?>
                        <a class="waves-effect waves-light btn" onClick="nextPage();">Next page</a>
                    <?php } ?>
                                
              </div>

            </div>

        </div>
         <?php if($total_records ==0) { echo "<div class='row' style='margin-top: -60px;'><div class='col s12'>No Records available</div></div>"; } ?>
         
    </form>
    <?php endif; ?>


</div>
<!-- .container-->
		
<!-- footer -->
<?php require('../footer.php'); ?>
<!-- .footer -->

<script src="../lib/jquery.validate.min.js"></script>
<script type="text/javascript">
function searchFn() {
    var curHref = document.getElementById('searchBtn').getAttribute('href');
    searchName = $('input[name=searchName]').val();
    window.location.href = curHref + '&search=' + searchName;
    return false;
}

function prevPage() {
    window.location.href = "<?php echo $site_url.$_SERVER['PHP_SELF'].'?show='.$show.'&page_size='.$page_size.'&page='.($page-1); ?>"
}

function nextPage() {
    window.location.href = "<?php echo $site_url.$_SERVER['PHP_SELF'].'?show='.$show.'&page_size='.$page_size.'&page='.($page+1); ?>";
}

function ChangeSelectedStatus(Status) {
    var confirmstatuschange = window.confirm("Are you sure you want to "+Status+" the selected Record?")
    if (confirmstatuschange) {
        document.frmList.action="changestatus.php?status="+Status+"&redirect=index.php?show=View_All";
        document.frmList.submit();
    }
}

function DeleteSelected() {
    var confirmdelete = window.confirm("Are you sure you want to PERMANENTLY delete the selected Record(s)?\n\nPlease note that you do have an option of Inactivating a Record, instead of PERMANENTLY deleting it.")
    if (confirmdelete) {
        document.frmList.action="deletemember.php";
        document.frmList.submit();
    }
}



$(function(){
    $('select').material_select();

     $("#pageButton").click(function() {
         var pageSizeIndex = $('.dropdown-content li.active.selected span').html();

         window.location.href = "<?php echo $site_url.$_SERVER['PHP_SELF'].'?show='.$show.'&page_size="+pageSizeIndex+"&page='.($page); ?>"
         
    });
    $('.selectedCheckbox').click(function(){
        if($(this).closest('tr').hasClass('highlight-row')) {
            $(this).closest('tr').removeClass('highlight-row');
        } else {
            $(this).closest('tr').addClass('highlight-row');    
        }
        
    });
})
   
</script>

</body>    
</html>