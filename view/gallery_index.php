<?php
require_once '../lib/connectionhandler.php';
connectionhandler::connect();

if(!empty($_GET['id'])) $_SESSION['id'] = $_GET['id'];
?>
<html>

<body>

<div class="container">

    <div class="panel panel-default">
        <div class="panel-body">
        <form id="flexer" action = "/picture/upload" method = "POST" enctype = "multipart/form-data">
            <input type = "file" name = "image" required />
            <input  class="form-control" type = "text" name = "title" placeholder="Name max 50 Chars" required />
            <textarea class="form-control" name = "desc" placeholder="Description max 150 Chars" required></textarea>
            <input type = "submit"/>
        </form>
        </div>
    </div>

    <div class=""row">



<?php
$gallery_id = 2;
if(!empty($_SESSION['id'])) $gallery_id = $_SESSION['id'];
$dir = 'data/'.$gallery_id.'/thumbs/';
$file_display = array('jpg', 'jpeg', 'png', 'gif');

if ( file_exists( $dir ) == false ) {
    echo 'Hoops! No pictures found';
} else {
    $dir_contents = scandir( $dir );

    foreach ( $dir_contents as $file ) {

        $query = "select name, description from picture where gallery_id = ? AND filename = ?";
        $statement = connectionhandler::connect()->prepare($query);
        $statement->bind_param('ss', $gallery_id, $file);
        $statement->execute();

        $result = $statement->get_result();
        $details = $result->fetch_object();

        if (empty($details))
            continue;

        $title = $details->name;
        $desc = $details->description;

        $file_type = strtolower( end( explode('.', $file ) ) );
        if ( ($file !== '.') && ($file !== '..') && (in_array( $file_type, $file_display)) ) {
            echo '<div class="col-md-3">';
            echo '<div class="thumbnail">';
            echo '<a data-fancybox="gallery" href="data/'.$gallery_id.'/'.$file.'">';
            echo '<img src="'. $dir . '/' . $file.'" alt="', $file , '" />';
            echo '</a>';
            echo '<h4>' . $title . '</h4>';
            echo '<p>' . $desc . '</p>';
            echo '</div>';
            echo '</div>';
        }

    }
}
?>
</div>
</div>
</body>
</html>

