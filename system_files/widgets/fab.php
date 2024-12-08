<?php 
/** Installation Guide (How To Use FAB Widget)
 * After Downloading this widget, 
 * move it into your project file in (assets/widgets/fab.php)
 * require it in between  the /*=== WIDGETS ==============/* Comment inside your project file in system_config.php 
 * save and call the widget fab() inside any of your componets root files (components/index.php etc)  and add the required parameters as follows::
 * Sample ::: <?php fab("direction","bgColor","iconColor","IconName","url","OnclickEvent");?>
 * leave empty to see default values or update parameters as it suites you
 * thank you for chosing ozi...
 */

//creating a floating action button library 
function fab($direction="right",$bgColor="#0C5ED7",$color="white",$icon="home",$href="",$onClick=""){
$link = "href='".$href."'";
 ?>

<div class="fixed-bottom" >
 <a  <?php echo $link; ?> onclick="<?php echo $onClick; ?>"
 style="float:<?php echo $direction;?>;padding:12px;background:<?php echo $bgColor;?>;color:<?php echo $color; ?>;margin:18px;border-radius:100%;height:50px;width:50px;box-shadow:0px 0px 35px  <?php echo $bgColor;?>;"><center><i class="fas fa-<?php echo $icon;?>"></i></center></a>     
</div>

<?php
}