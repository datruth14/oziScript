<?php 

function JavascriptDependency() {
    ?>
            <!-- Bootstrap JS File -->
            <script src="assets/style/default_js/bootstrap.bundle.min.js"></script> 

            <!--sweet alert-->
            <script src="assets/style/default_js/sweetalert.js"></script>

            <!--Default javascript-->
            <script src="assets/style/default_js/main.js"></script>

            <!--calling HTMX-->
            <script src="assets/style/default_js/htmx.js"></script>

            <!--Dynamic navigation system-->
            <script>
            document.addEventListener("DOMContentLoaded", () => {
            const app = document.getElementById("app");

            document.body.addEventListener("click", (e) => {
                const link = e.target.closest("[data-linkto]");
                if (!link) return;
                e.preventDefault();

                const url = link.getAttribute("data-linkto");
                navigateTo(url);
            });

            function navigateTo(url) {
                history.pushState({ url }, "", url || "index.php");
                loadScreen(url);
            }

            function loadScreen(url) {
                const targetUrl = url && url !== "" ? url : "index.php";
                htmx.ajax("GET", targetUrl, { target: "#app", swap: "innerHTML" });
            }

            window.addEventListener("popstate", (e) => {
                const url = e.state?.url || "";
                loadScreen(url);
            });

            // Initial page load
            loadScreen(location.search);
            });
            </script>






   <?php 
}
?>