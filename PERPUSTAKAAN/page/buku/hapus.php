<?php

$id = $_GET ["id"];

$koneksi->query("delete from perpustakaan where id ='$id'");

?>

<script type="text/javascript">
    window.location.href="?page=buku";
</script>