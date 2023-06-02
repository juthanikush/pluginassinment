<label for="post_editor">Author Name</label>
<input type="text" name="author" value="<?php echo esc_attr(get_post_meta(get_the_ID(),'author',true)); ?>"</input><br><br>
<label for="post_editor">Price</label>
<input type="text" name="price" value="<?php echo esc_attr(get_post_meta(get_the_ID(),'price',true)); ?>"></input><br><br>
<label for="post_editor">Publisher</label>
<input type="text" name="publisher" value="<?php echo esc_attr(get_post_meta(get_the_ID(),'publisher',true)); ?>"></input><br><br>
<label for="post_editor">Year</label>
<input type="text" name="year" value="<?php echo esc_attr(get_post_meta(get_the_ID(),'year',true)); ?>"></input><br><br>
<label for="post_editor">Edition</label>
<input type="text" name="edition" value="<?php echo esc_attr(get_post_meta(get_the_ID(),'edition',true)); ?>"></input><br><br>
<label for="post_editor">URL</label>
<input type="text" name="url" value="<?php echo esc_attr(get_post_meta(get_the_ID(),'url',true)); ?>"></input><br><br>