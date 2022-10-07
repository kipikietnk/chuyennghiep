<?php
$connect = mysqli_connect("localhost", "root", "", "php_mvc_banhang");

function make_slides($connect)
{
    $output = '';
    $count = 0;
    $query = "SELECT * FROM tbl_slider WHERE type = '1' ORDER BY sliderId DESC";

    $result = mysqli_query($connect, $query);;
    while ($row = mysqli_fetch_array($result)) {
        if ($count == 0) {
            $output .= '<div class="item active">';
        } else {
            $output .= '<div class="item">';
        }
        $output .= '<img src="admin/uploads/' . $row["slider_image"]. '" /></div>';
        $count = $count + 1;
    }
    return $output;
}

?>

<div class="container" style="width: 100%; height: 200%">
    <br />
    <div id="dynamic_slide_show" class="carousel slide" data-ride="carousel">

        <div class="carousel-inner">
            <?php echo make_slides($connect); ?>
        </div>
        <a class="left carousel-control" href="#dynamic_slide_show" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>

        <a class="right carousel-control" href="#dynamic_slide_show" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>

    </div>
</div>
