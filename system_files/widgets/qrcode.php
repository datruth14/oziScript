
<?php 
/** Installation Guide (How To Use FAB Widget)
 * After Downloading this widget, 
 * move it into your project file in (assets/widgets/qrcode.php)
 * require it in between  the /*=== WIDGETS ==============/* Comment inside your project file in system_config.php 
 * save and call the widget qrcodeGen() inside any of your componets root files (components/index.php etc)  and add the required parameters as follows::
 * Sample ::: <?php qrcodeGen("url","width","height","300");?>
 * leave empty to see default values or update parameters as it suites you
 * thank you for chosing ozi...
 */


 //creating qrcode genarator component
function qrcodeGen($url='ozi.com.ng',$width='300',$height="300"){
 ?>

<script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>

<center><br><Br><Br>
   <div id="qrcode"></div>
</center>

<script>
const qrcode = new QRCode(document.getElementById('qrcode'), {
  text: '<?php echo $url ;?>',
  width: <?php echo $width ;?>,
  height: <?php echo $height ;?>,
  colorDark : '#000',
  colorLight : '#fff',
  correctLevel : QRCode.CorrectLevel.H
});
</script>

<?php
}
?>
