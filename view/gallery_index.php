<?php


?>
<html>

<body>

<div class="container">
    <div class=""row">

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
            echo '<div class="col-md-3">';
            echo '<div class="thumbnail">';
            echo '<a data-fancybox="gallery" href="data/'.$file.'">';
            echo '<img src="'. $dir . '/' . $file.'" alt="', $file , '" />';
            echo '</a>';
            echo '<h3>Image Title</h3>';
            echo '<p>The caption lololololol.</p>';
            echo '</div>';
            echo '</div>';
            // TODO Diashow
        }
    }
}
?>

<form action = "/gallery/upload" method = "POST" enctype = "multipart/form-data">
    <input type = "file" name = "image" />
    <input type = "submit"/>

</form>
</div>
</div>
</body>
</html>

