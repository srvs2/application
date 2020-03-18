========================== Html code ========================================
<!DOCTYPE html>
  <html>
  <head>
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <style type="text/css">
  .progress {
    width:51%;
    overflow: hidden;
    height: 8px;
    margin: 7px 2px;
    background-color: #f5f5f5;
    border-radius: 8px;
    -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
}   
.progress-bar {
    float: left;
    width: 0%;
    height: 100%;
    font-size: 12px;
    line-height: 20px;
    color: #ffffff;
    text-align: center;
    background-color: #2fa4e7;
    -webkit-box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);
    box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);
    -webkit-transition: width 0.6s ease;
    -o-transition: width 0.6s ease;
    transition: width 0.6s ease;
}
.upload_btn{
    border: #2fa4e7;
    border-radius: 4px;
    background-color: #2fa4e7;
    color: #ffff;
    padding: 11px 20px;
}
.panel-body{
    margin: 125px 460px;
    width: 23%;
    border: solid 1px black;
    padding: 35px 39px;
}
</style> 
  </head>
  <body>
    <div class="container">
        <div class="panel-body">
          <form id="uploadImage" action="action.php" method="post" enctype="multipart/form-data">
            <div class="file_upload">
              <input type="file" name="uploadFile[]" id="uploadFile" multiple/>
            </div>
              <div class="progress">
              <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div id="targetLayer" style="display:none;"></div>
              <input type="submit" id="uploadSubmit" value="Upload" class="upload_btn" />
          </form>
        </div>
    </div>
  </body>
</html>

<script>
$(document).ready(function(){
  $('#uploadImage').submit(function(event){
    if($('#uploadFile').val())
    {
      event.preventDefault();
      $('#loader-icon').show();
      $('#targetLayer').hide();
      $(this).ajaxSubmit({
        target: '#targetLayer',
        beforeSubmit:function(){
          $('.progress-bar').width('50%');
        },
        uploadProgress: function(event, position, total, percentageComplete)
        {
          $('.progress-bar').animate({
            width: percentageComplete + '%'
          }, {
            duration: 1000
          });
        },
        success:function(){
          $('#loader-icon').hide();
          $('#targetLayer').show();
        },
        resetForm: true
      });
    }
    return false;
  });
});
</script>

=================== Php Script ====================================
<?php 
if(!empty($_FILES)){
$total = count($_FILES['uploadFile']['name']);
for( $i=0 ; $i < $total ; $i++ ) {
  $tmpFilePath = $_FILES['uploadFile']['tmp_name'][$i];
  if ($tmpFilePath != ""){
    $newFilePath = "./uploads/" . $_FILES['uploadFile']['name'][$i];
    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
      }
    }
 }
 echo "file uploaded";
}
?>
