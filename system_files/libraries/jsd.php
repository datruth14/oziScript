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

                // Click delegation for all linkTo elements
                document.body.addEventListener("click", (e) => {
                    const link = e.target.closest("[data-linkto]");
                    if (!link) return;

                    e.preventDefault();
                    const url = link.getAttribute("data-linkto");
                    navigateTo(url);
                });

                function navigateTo(url) {
                    history.pushState({ url }, "", url);
                    loadScreen(url);
                }

                function loadScreen(url) {
                    // Ensure default homepage loads if no screen param
                    if (!url.includes("s=")) {
                    htmx.ajax("GET", "index.php", { target: "#app", swap: "innerHTML" });
                    } else {
                    htmx.ajax("GET", url, { target: "#app", swap: "innerHTML" });
                    }
                }

                window.addEventListener("popstate", (e) => {
                    const url = e.state?.url || location.search || "index.php";
                    loadScreen(url);
                });

                // Initial load
                loadScreen(location.search || "index.php");
                });
            </script>


   <?php 
}
?>