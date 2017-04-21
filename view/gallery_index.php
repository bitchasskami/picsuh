<?php
require_once '../lib/connectionhandler.php';
connectionhandler::connect();
?>
<html>

<body>

<div class="container">

    <div class="panel panel-default">
        <div class="panel-body">
        <form id="flexer" action = "/gallery/upload" method = "POST" enctype = "multipart/form-data">
            <input type = "file" name = "image" />
            <input type = "text" name = "title" required />
            <textarea name = "desc" required></textarea>
            <input type = "submit"/>
        </form>
        </div>
    </div>

    <div class=""row">



<?php
$dir = 'data/thumbs/';
$file_display = array('jpg', 'jpeg', 'png', 'gif');

if ( file_exists( $dir ) == false ) {
    echo 'Directory \'', $dir, '\' not found!';
} else {
    $dir_contents = scandir( $dir );

    foreach ( $dir_contents as $file ) {

        $query = "select name, description from picture where filename = ?";
        $statement = connectionhandler::connect()->prepare($query);
        $statement->bind_param('s', $file);
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
            echo '<a data-fancybox="gallery" href="data/'.$file.'">';
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

