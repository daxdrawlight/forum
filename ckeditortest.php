<?php
//topic.php
include 'connect.php';
include 'header.php';

echo '<div class="pad20">Leave a response:</div></div><br />
					<form method="post" action="reply.php?id=' . $row['topic_id'] . '">
						<textarea  id="edit1" name="reply-content"></textarea><br /><br />
						<script>                		
                			CKEDITOR.replace("edit1");
            			</script>
						<input class="response_btn" type="submit" value="Submit response" />						
					</form></div>';

include 'footer.php';
?>