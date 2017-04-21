<?php
if(empty($_SESSION['user'])) header('Location: /user/login');
?>
<div>
    <ul class="list-group">
        <li class="list-group-item"><h2>Galleries</h2></li>
        <?php
        $galleryob = $_SESSION['galleries'];
        foreach ($galleryob as $gallery){
            echo '<li class="list-group-item"><a href="/picture?id='. $gallery->id .'&name='. $gallery->name .'">'. $gallery->name .'</a></li>';
        }
        ?>
        <a href="/default/create"><li class="list-group-item"><span class="glyphicon glyphicon-plus"></span> Create New Gallery</li></a>
    </ul>
</div>