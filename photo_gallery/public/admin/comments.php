<?php
require_once("../../includes/initialise.php");
if(!$session->is_logged_in()) { redirect_to("login.php"); }

if(empty($_GET['id'])) {
  $session->message("No photograph ID was provided.");
  redirect_to('index.php');
}

$photo = Photograph::find_by_id($_GET['id']);
if(!$photo) {
  $session->message("The photo could not be located.");
  redirect_to('indx.php');
}

$comments = $photo->comments();

include_layout_template('admin_header.php');
?>

<a href="list_photos.php">&laquo; Back</a><br />
<br />

<h2>Comments on <?php echo $photo->filename; ?></h2>

<?php echo output_message($message); ?>
<div id="comments">
  <?php foreach($comments as $comment): ?>
    <div class="comment" style="margin-bottom: 2em;">
      <div class="author">
        <?php echo htmlentities($comment->author); ?> wrote:
      </div> <!-- ends author -->
      <div class="body">
        <?php echo strip_tags($comment->body, '<strong><em><p>'); ?>
      </div> <!-- ends body -->
      <div class="meta-info" style="font-size: 0.8em;">
        <?php echo datetime_to_text($comment->created); ?>
      </div> <!-- ends meta-info -->
      <div class="actions" style="font-size: 0.8em;">
        <a href="delete_comment.php?id=<?php echo $comment->id; ?>">Delete Comment</a>
      </div> <!-- ends actions -->
    </div> <!-- ends comment -->
  <?php endforeach; ?>
  <?php if(empty($comments)) { echo "No Comments."; } ?>
</div> <!-- ends comments -->

<?php include_layout_template('admin_footer.php'); ?>
