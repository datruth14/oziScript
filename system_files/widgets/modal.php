<?php 
/** Installation Guide (How To Use modal)
 * After Downloading this widget, 
 * move it into your project file in (assets/widgets/modal.php)
 * require it in between  the /*=== WIDGETS ==============/* Comment inside your project file in system_config.php 
 * save and call the widget modal_trigger() inside any of your componets root files inside a button,div,a,h1 etc tags and add the required parameters as follows::
 * Sample ::: <div <?php modal_trigger("NameOfModal");?> > Am a div </div>
 * And at the bottom of your page call the modal() and pass the parameters as required
 * Sample ::: <?php modal("NameOfModalSameAsModal_trigger", "fileToDisplayPathEGcomp_files/sample.php", "ModalTitleEGmyApp", "DisplayAnimationEGfadeOrGetMoreFromAnimate.Style") ; ?>
 * leave empty to see default values or update parameters as it suites you
 * thank you for chosing ozi...
 */



 
/*call this function inside <a> tag , <h> tag or any html tag to make it trigger the modal screen you want to display content into */
//this is used for Single page application or you can use both in on
function modal_trigger($trigger="exampleModal"){
    ?>
      data-bs-toggle="modal" data-bs-target="#<?php echo $trigger; ?>"
    <?php
  }
  
  
  
  function modal($target="exampleModal", $body_contents="sample.php", $title="My Modal",$animate="fade") {
        ?>
        <!-- Modal-->
        <div class="modal animate__animated  <?php echo $animate; ?>" id="<?php echo $target; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
              <div class="modal-header">
                <h3><?php echo $title ; ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" style="color:black;">
                    <?php require("components/".$body_contents) ;?>
              </div>
            </div>
          </div>
        </div>
    <?php
  }