<script type="text/javascript" src="script/script_peserta_operator.js"> </script>

<?php
session_start();
if(empty($_SESSION['username']) or empty($_SESSION['password']) or $_SESSION['leveluser']!="operator"){
	header('location: ../login.php');
}

include "../../library/config.php";
include "../../library/function_view.php";
include "../../library/function_form.php";

create_title("list-alt", "Manajemen Peserta");
create_button("success", "refresh", "Refresh", "btn-refresh", "refresh_data()");
create_button("success", "refresh", "Reset all", "btn-refresh", "reset_login_all()");

create_table(array("ID Tim", "Nama Tim", "Password", "Edisi", "Status", "Aksi"));
?>