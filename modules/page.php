<?php
define(root, $_SERVER["DOCUMENT_ROOT"]);
require_once root."/modules/base.php";
require_once root."/modules/html/header.php";

$data = $db->selectRow("select * from page where id={?}", [$_GET['id']]);

if(empty($data->title)){
    $title = "Страница не найдена";
    $text = "Извините, данная страница не найдена.";
} else {
    $title = $data->title;
    $text = $data->text;
}
?>

<div class="container">
    <div class="content-page p-4">
        <h1><?php echo $title; ?></h1>
        <?php echo $text; ?>
    </div>
</div>

<?php
require_once root."/modules/html/footer.php";
?>