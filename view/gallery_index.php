<?php

if(isset($_FILES['image'])){

    $errors= array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

    $expensions= array("jpeg","jpg","png");

    if(in_array($file_ext,$expensions)=== false){
        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }

    if($file_size > 2097152) {
        $errors[]='File size must be excately 2 MB';
    }

    if(empty($errors)==true) {
        $gallery = new galleryController();
        move_uploaded_file($file_tmp,"data/".$file_name);
        $gallery->createThumbnail($file_name);
        echo "Success";
    }else{
        print_r($errors);
    }
}
?>
<html>
<body>

<?php
$dir = 'data/thumbs/';
$file_display = array('jpg', 'jpeg', 'png', 'gif');

if ( file_exists( $dir ) == false ) {
    echo 'Directory \'', $dir, '\' not found!';
} else {
    $dir_contents = scandir( $dir );

    foreach ( $dir_contents as $file ) {
        $file_type = strtolower( end( explode('.', $file ) ) );
        if ( ($file !== '.') && ($file !== '..') && (in_array( $file_type, $file_display)) ) {
            echo '<img src="'. $dir . '/' . $file.'" alt="', $file, '"/>';
        }
    }
}
?>

<form action = "" method = "POST" enctype = "multipart/form-data">
    <input type = "file" name = "image" />
    <input type = "submit"/>

    <ul>
        <li>Sent file: <?php echo $_FILES['image']['name'];  ?>
        <li>File size: <?php echo $_FILES['image']['size'];  ?>
        <li>File type: <?php echo $_FILES['image']['type'] ?>
    </ul>

</form>

</body>
</html>

