<?php
/** Installation Guide (How To Use FAB Widget)
 * After Downloading this widget, 
 * move it into your project file in (assets/widgets/nativeShare.php)
 * require it in between  the /*=== WIDGETS ==============/* Comment inside your project file in system_config.php 
 * save and call the widget nativeShare() inside any of your componets root files (components/index.php etc) and add the required parameters as follows::
 * Sample ::: <?php nativeShare('.buttonClassName','Product title or site name','Short description about the page');?>
 * thank you for chosing ozi...
 */
function nativeShare($btnClicked="", $shareTitle="", $shareText="")
{
    //getting this page url
    $shareUrl= $_SERVER['REQUEST_URI'];
?>
    <script>
        //native share API
        //native share API
        //native share API
        //native share API
        function nativeShare(btnClicked, shareTitle, shareText, shareUrl) {
            const shareData = {
                title: shareTitle,
                text: shareText,
                url: shareUrl,
            };

            const btn = document.querySelector(btnClicked);

            // Share must be triggered by "user activation"
            btn.addEventListener("click", async () => {
                try {
                    await navigator.share(shareData);
                    resultPara.textContent = "Done! Shared Successfully";
                } catch (err) {
                    resultPara.textContent = `Error: ${err}`;
                }
            });
        }
        nativeShare('<?php echo $btnClicked;?>','<?php echo $shareTitle;?>','<?php echo $shareText;?> ','<?php echo $shareUrl;?>');
        //End of native share API
        //End of native share API
        //End of native share API
        //End of native share API
        //End of native share API
        //End of native share API
    </script>
<?php
}
//sharePage API Component 
//sharePage API Component 
//sharePage API Component 
//sharePage API Component 
//sharePage API Component 
//sharePage API Component 
//sharePage API Component 


