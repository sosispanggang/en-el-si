<?php
session_start();
include "../../library/config.php";

if($_GET['action'] == "table_data"){
   $query = mysqli_query($mysqli, "SELECT * FROM peserta ORDER BY id_tim");
   $data = array();
   $no = 1;
   while($r = mysqli_fetch_array($query)){
      $edisi = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM edisi WHERE id_edisi='$r[id_edisi]'"));

      if($r['status'] == "on") $status = '<b class="text-primary">login</b>';
      elseif($r['status'] == "mengerjakan") $status = '<b class="text-danger">mengerjakan</b>';
      else $status = '<b class="text-muted">offline</b>';
      
      $row = array();
      $row[] = $no;
      $row[] = $r['id_tim'];
      $row[] = $r['nama'];
      $row[] = md5($r['id_tim']);
      $row[] = $edisi['edisi'];
      $row[] = $status;
      $row[] = '<a class="btn btn-danger" onclick="reset_login(\''.$r['id_tim'].'\')"><i class="glyphicon glyphicon-off"></i> Reset Login</a>';
      $data[] = $row;
      $no++;
   }
   
   $output = array("data" => $data);
   echo json_encode($output);
}

elseif($_GET['action'] == "reset_login"){
   mysqli_query($mysqli, "UPDATE peserta set status='off' WHERE id_tim='$_GET[id_tim]'");
}

elseif($_GET['action'] == "reset_login_all"){
   mysqli_query($mysqli, "UPDATE peserta set status='off'");
}
?>