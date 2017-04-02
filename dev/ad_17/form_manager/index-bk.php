<?php
session_start();
require_once('../../lib/config.php');

//Check whether the user is logged in or not
checkLogin($_SESSION['admin_logged_in'], $admin_path);

$db = new db;

$page_heading="Question Manager";
	
//Table
$table_name = 'tbl_questions'; 

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
                        <li><a class="waves-effect waves-light btn" href="index.php?show=view_all">View All</a></li>
                        <li><a class="waves-effect waves-light btn" href="index.php?show=deactivated">Deactivated</a></li>
                        <li><a class="waves-effect waves-light btn" href="index.php?show=activated">Acitvated</a></li>
                        <li><a class="waves-effect waves-light btn" href="index.php?show=Add">Add new</a></li>
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
                $question_name= $db->escape(trim($_REQUEST['search']));

                switch($show) {
                    case $activated:
                        $where = " WHERE status = 'Y' and question_text like '%$question_name%' ";
                        break;
                    case $deactivated:
                        $where = " WHERE status = 'N' and question_text like '%$question_name%' ";
                        break;
                    default:
                        $where = " WHERE question_text like '%$question_name%' ";
                        break;
                }
            } 
            /**
            Conditional Query for non search
            */
            else {
                switch($show) {
                    case $activated:
                        $where = " WHERE status = 'Y'";
                        break;
                    case $deactivated:
                        $where = " WHERE status = 'N'";
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
        <div class="row contentContainer">
            <div class="col s12">
                <table class="striped tableContainer">
                    <thead>
                        <th>No.</th>
                        <th>Question Text</th>
                        <th>Question Class</th>
                        <!-- <th>Question Image</th> -->
                        <th>Question Color Code</th>
                        <th>Created</th>
                        <th>Modified</th>
                        <th>Status</th>
                        <th>
                            <input id="selectAll" name="selectAll" value="SelectAll" type="checkbox">
                            <label for="selectAll"></label>
                        </th>
                    </thead>

                    <tbody>
                        <?php while($result = $result_member->fetch_assoc()): ?>
                        <tr class="custom-row">
                        <td><?php echo $result_count; ?></td>
                        <td><a href="?show=edit&id=<?php echo $result['id']; ?>"><?php echo $result['question_text']; ?></a></td>
                        <td><?php echo $result['question_class']; ?></td>
                        <!-- <td>
                            <?php if($result['question_image']) { ?>
                            <a href="<?php echo $media_path.$result['question_image']; ?>" target="_blank">
                                <img src="<?php echo $media_path.$result['question_image'];?>" alt="<?php echo $result['question_text'];?>" style="width: 100px; height: 40px;">
                            </a>
                            <?php } ?>
                        </td> -->
                        <td><?php echo $result['question_bg_color']; ?></td>
                        <td><?php echo $result['created_at']; ?></td>
                        <td><?php echo $result['modified_at']; ?></td>
                        <td><?php 
                            echo ($result['status'] == 'Y') ? 'Active' : ( ($result['status'] == 'N') ? 'Inactive': 'Neither active or deactivate' );
                            ?>
                        </td>
                        <td>
                        <input type="checkbox" name="ID[]" id="ID<?php print $result_count;?>" value="<?php print $result["id"];?>" class="selectedCheckbox">
                        <label for="ID<?php print $result_count;?>"></label>
                        </td>
                        </tr>
                        <?php $result_count++; endwhile; ?>
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


    <?php 
    /**
     * Add functionality
     * @var [type]
     */
    if($show == 'add'):
    ?>
    <div class="row">
        <div class="col s12 offset-s1">
            <div class="col s10 card-panel adminFormWrapper siteOwnerSettings">
                <div class="col s12 card-panel center-align formHead">Add New Question</div>

                <form action="save_register.php" enctype="multipart/form-data" method="post" class="siteForm" id="teamForm" name="teamForm">
                    <div class="row">
                        <div class="col s4 siteCaptions">Question Name</div>
                        <div class="input-field col s8">
                            <input id="questionText" name="questionText" type="text" class="textbox" required>
                            <label for="questionText">Enter the name</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s4 siteCaptions">Specific Question Class</div>
                        <div class="input-field col s8">
                            <input id="questionClass" name="questionClass" type="text" class="textbox" required>
                            <label for="questionClass">Enter the class name</label>
                        </div>
                    </div>

                    <!-- <div class="row">
                        <div class="col s4 siteCaptions">Upload</div>
                        <div class="file-field col s8 input-field paddingZero">
                                <div class="col s10 paddingZero">
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" accept="image/*" type="text" placeholder="Upload question background image">
                                    </div>
                                </div>
                                <div class="col s2">
                                    <div class="btn" style="width: auto !important;">
                                        <span>File</span>
                                        <input type="file" name="questionImage">
                                    </div>
                                </div>
                          </div>
                    </div> -->

                    <div class="row">
                        <div class="col s4 siteCaptions">Question Bg Color <span style="color: green;">(HEX FORMAT)</span></div>
                        <div class="input-field col s8">
                            <input id="questionBgColor" name="questionBgColor" type="text" class="textbox" required>
                            <label for="questionBgColor">Enter the color code</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s4 siteCaptions">Question Type</div>
                        <div class="input-field col s8">
                            <p>
                              <input name="questionType" type="radio" id="normal" value="0" checked/>
                              <label for="normal">Normal</label>
                              
                                
                              <input name="questionType" type="radio" id="master" value="1" />
                              <label for="master">Master</label>
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s4 siteCaptions"></div>
                
                        <div class="addEditButtonWrap">
                            <div class="row">
                                <div class="col s2 input-field">
                                    <button class="btn waves-effect waves-light" type="submit" name="Submit">Add</button>
                                </div>
                                <div class="col s2 input-field">
                                     <a class="waves-effect waves-light btn text-center small" href="index.php">Back</a>
                                </div>

                                <?php 
                                    if (isset($_SESSION["Message"]) && $_SESSION["Message"] != "" ) { ?>
                                        <div class="statusMessage">
                                            <div class="col s3 input-field">
                                                <font color="green">
                                                    <?php print $_SESSION["Message"]; $_SESSION["Message"]=""; ?>   
                                               </font> 
                                            </div>
                                        </div>
                                    <?php } 
                                ?>                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php 
    /**
     * Edit functionality
     */
    if($show == 'edit' && isset($_REQUEST['id']) && $_REQUEST['id'] != ''):
        $id = $db->escape(trim($_REQUEST['id']));

        $result_fetch = $db->select("SELECT * FROM {$table_name} WHERE id = {$id}");
        $result = $result_fetch->fetch_object();

        $_SESSION['question_id'] = $result->id;

    ?>
    <div class="row">
        <div class="col s12 offset-s1">
            <div class="col s10 card-panel adminFormWrapper siteOwnerSettings">
                <div class="col s12 card-panel center-align formHead">Add New Question</div>

                <form action="edit_detail.php" enctype="multipart/form-data" method="post" class="siteForm" id="teamEditForm" name="teamEditForm">
                    <div class="row">
                        <div class="col s4 siteCaptions">Question Name</div>
                        <div class="input-field col s8">
                            <input id="questionText" name="questionText" type="text" class="textbox" required value="<?php echo $result->question_text; ?>">
                            <!-- <label for="questionText">Enter the name</label> -->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s4 siteCaptions">Specific Question Class</div>
                        <div class="input-field col s8">
                            <input id="questionClass" name="questionClass" type="text" class="textbox" required value="<?php echo $result->question_class; ?>">
                            <!-- <label for="questionClass">Enter the class name</label> -->
                        </div>
                    </div>


                    <div class="row">
                        <div class="col s4 siteCaptions">Question Bg Color <span style="color: green;">(HEX FORMAT)</span></div>
                        <div class="input-field col s8">
                            <input id="questionBgColor" name="questionBgColor" type="text" class="textbox" required value="<?php echo $result->question_bg_color; ?>">
                            <!-- <label for="questionBgColor">Enter the color code</label> -->
                        </div>
                    </div>

                   <!--  <div class="row">
                        <div class="col s4 siteCaptions">Current Image</div>
                        <div class="col s8">
                            <div class="input-field col s8">
                                <?php 
                                    if($result->question_image == '' || $result->question_image == NULL) {
                                        echo '<div style="padding-top: 10px; color: red;">None</div>';
                                    } else {
                                        ?>
                                            <a href="<?php echo $media_path.$result->question_image;?>" target="_blank"><img src="<?php echo $media_path.$result->question_image;?>" alt="" class=" responsive-img thumbnail"></a>
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>

                   <div class="row">
                        <div class="col s4 siteCaptions">Upload</div>
                        <div class="file-field col s8 input-field paddingZero">
                                <div class="col s10 paddingZero">
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" accept="image/*" type="text" placeholder="Upload question background image">
                                    </div>
                                </div>
                                <div class="col s2">
                                    <div class="btn" style="width: auto !important;">
                                        <span>File</span>
                                        <input type="file" name="questionImage">
                                    </div>
                                </div>
                          </div>
                    </div> -->

                    <div class="row">
                        <div class="col s4 siteCaptions">Question Type</div>
                        <div class="input-field col s8">
                            <p>
                              <input name="questionType" type="radio" id="normal" value="0" <?php echo ($result->question_type) ? '' : 'checked'; ?> />
                              <label for="normal">Normal</label>
                              
                                
                              <input name="questionType" type="radio" id="master" value="1" <?php echo ($result->question_type) ? 'checked' : ''; ?> />
                              <label for="master">Master</label>
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s4 siteCaptions"></div>
                
                        <div class="addEditButtonWrap">
                            <div class="row">
                                <div class="col s2 input-field">
                                    <button class="btn waves-effect waves-light" type="submit" name="Submit">Update</button>
                                </div>
                                <div class="col s2 input-field">
                                     <a class="waves-effect waves-light btn text-center small" href="index.php">Back</a>
                                </div>

                                <?php 
                                    if (isset($_SESSION["Message"]) && $_SESSION["Message"] != "" ) { ?>
                                        <div class="statusMessage">
                                            <div class="col s3 input-field">
                                                <font color="green">
                                                    <?php print $_SESSION["Message"]; $_SESSION["Message"]=""; ?>   
                                               </font> 
                                            </div>
                                        </div>
                                    <?php } 
                                ?>                                
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
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
    window.location.href = "<?php echo $_SERVER['PHP_SELF'].'?show='.$show.'&page_size='.$page_size.'&page='.($page-1); ?>"
}

function nextPage() {
    window.location.href = "<?php echo $_SERVER['PHP_SELF'].'?show='.$show.'&page_size='.$page_size.'&page='.($page+1); ?>";
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

         window.location.href = "<?php echo $_SERVER['PHP_SELF'].'?show='.$show.'&page_size="+pageSizeIndex+"&page='.($page); ?>"
         
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