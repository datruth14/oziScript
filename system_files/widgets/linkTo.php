<?php
function linkTo(string $screen, string $params = "") {
    // homepage should clear query (?s=...)
    $query = ($screen === "homepage") ? "" : "?s={$screen}{$params}";
    echo "data-linkto='{$query}'";
}
?>
