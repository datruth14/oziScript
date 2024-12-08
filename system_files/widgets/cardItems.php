<?php 
/** Installation Guide (How To Use cardItems Widget)
 * After Downloading this widget, 
 * move it into your project file in (assets/widgets/cardItems.php)
 * require it in between  the /*=== WIDGETS ==============/* Comment inside your project file in system_config.php 
 * save and call the widget cardItems() inside any of your componets root files (components/index.php etc)  and add the required parameters as follows::
 * Sample ::: <?php cardItems("Imageurl","title","Des");?>
 * leave empty to see default values or update parameters as it suites you
 * thank you for chosing ozi...
 */

function cardItemStyle($bgcolor="white",$color="black"){
?>
<style> 
.card {
    background:<?php echo $bgcolor;?>;
    color:<?php echo $color; ?>
 }
</style>
<?php 
} 


  
function cardItem($imgUrl="https://media.istockphoto.com/id/611618092/photo/european-street-at-night.jpg?s=612x612&w=0&k=20&c=5sJjrSo8-jqcu8hnM6ws94yfgpxLbWvZg8WvmyKc2-g=", $title="Card Title", $des="This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.", $spaceBetween="10px 5px") {
?>

    <div class="col-6 col-sm-6 col-md-4 col-lg-4">
        <div class="card" style="margin:<?php echo $spaceBetween ?>" >
        <img src="<?php echo $imgUrl;?>" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?php echo $title; ?></h5>
            <p class="card-text"><?php echo $des; ?></p>
        </div>
        </div>
    </div>

<?php 
}