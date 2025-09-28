<?php
function linkTo(string $screen, string $params = ""): string {
    $query = "?s={$screen}" . $params;
    return "data-linkto='{$query}'";
}
?>
