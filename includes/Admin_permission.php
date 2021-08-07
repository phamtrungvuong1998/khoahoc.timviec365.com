<script type="text/javascript">
    var adm_type = <?php echo $row['adm_type']; ?>;
    if (adm_type != 1) {
      $("#admin-nav-1").remove();
      $('#action1').remove();
  }

  var adm_student_type = <?php 
  if ($row['adm_type'] == 1) {
    echo $row['adm_type'];
}else{
    echo $row['student_see'];
}
?>;

if (adm_student_type == 0) {
   $("#action2").remove();
   $("#adm_student").remove();
}

var adm_student_create = <?php 
if ($row['adm_type'] == 1) {
    echo $row['adm_type'];
}else{
    echo $row['student_create'];
}
?>;

if (adm_student_create == 0) {
    $("#create_student").remove();
}

var adm_student_delete = <?php 
if ($row['adm_type'] == 1) {
    echo $row['adm_type'];
}else{
    echo $row['student_delete'];
}
?>;
</script>