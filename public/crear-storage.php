<?php 

    $targetFolder = '/home/ticcom/laravel/storage/app/public';
    $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/fondo/storage';
    symlink($targetFolder,$linkFolder);
    
    //echo $targetFolder . ' ----- ' . $linkFolder;
    
    echo 'Symlink para <storage> creado exitosamente.';

?>

