<?php

$id = $_GET ["id"];

$koneksi->query("delete from tb_anggota where id ='$id'");

?>

<script type="text/javascript">
    window.location.href="?page=anggota";
</script>