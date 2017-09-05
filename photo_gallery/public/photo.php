<?php
require_once("../includes/initialise.php");

// must have an ID
if(empty($_GET['id'])) {
  $session->message("No photograph ID was provided.");
  redirect_to('index.php');
}

$photo = Photograph::find_by_id($_GET['id']);
if(!$photo) {
  $session->message("The photo could not be located.");
  redirect_to('index.php');
}

if(isset($_POST['submit'])) {
  $author = trim($_POST['author']);
  $body = trim($_POST['body']);

  $new_comment = Comment::make($photo->id, $author, $body);
  if($new_comment && $new_comment->save()) {
    // comment saved
    // No message needed; seeing the comment is proof enough

    // Send email
    // $new_comment->try_to_send_notification();


    // Important! you could just let the page render from here.
    // But then if the page is reloaded, the form will try
    // to resubmit the comment. So redirect instead:
    redirect_to("photo.php?id={$photo->id}");
  } else {
    // Failed
    $message = "There was an error that prevented the comment from being saved.";
  }
} else {
  $author = "";
  $body = "";
}

$comments = $photo->comments();

include_layout_template('header.php');
?>
<a href="index.php">&laquo; Back</a><br />
<br />

<div style="margin-left: 20px;">
  <img src="<?php echo $photo->image_path(); ?>" />
  <p><?php echo $photo->caption; ?></p>
</div>

<!-- list comments -->
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
    </div> <!-- ends comment -->
  <?php endforeach; ?>
  <?php if(empty($comments)) { echo "No comments."; } ?>
</div> <!-- ends comments -->

<div id="comment-form">
  <h3>New Comment</h3>
  <?php echo output_message($message); ?>
  <form action="photo.php?id=<?php echo $photo->id; ?>" method="post">
    <table>
      <tr>
        <td>Your name:</td>
        <td><input type="text" name="author" value="<?php echo $author; ?>"/></td>
      </tr>
      <tr>
        <td>Your comment:</td>
        <td><textarea name="body" cols="40" rows="8"><?php echo $body; ?></textarea></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" name="submit" value="Submit Comment"/></td>
      </tr>
    </table>
  </form>
</div> <!-- ends comment-form -->

<?php include_layout_template('footer.php'); ?>
