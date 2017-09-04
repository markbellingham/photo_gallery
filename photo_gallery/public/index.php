<?php
require_once("../includes/initialise.php");

// Find all photos
$photos = Photograph::find_all();

include_layout_template('header.php');

foreach($photos as $photo): ?>
<div style="float: left; margin-left: 20px;">
  <a href="photo.php?id=<?php echo $photo->id; ?>">
    <img src="<?php echo $photo->image_path(); ?>" width="200" />
  </a>
  <p><?php echo $photo->caption; ?></p>
</div>
<?php endforeach;

include_layout_template('footer.php');

?>
