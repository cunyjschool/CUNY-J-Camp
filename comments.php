<?php // Do not delete these lines
    if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
        die ('Please do not load this page directly. Thanks!');

    if (!empty($post->post_password)) { // if there's a password
        if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
            ?>

            <p class="nocomments">This post is password protected. Enter the password to view comments.</p>

            <?php
            return;
        }
    }

?>

<!-- You can start editing here. -->
<div class="comments">
    <h3>Discussion</h3>
    
    <div class="comment">
        
        <h4>This is the comment title</h4>
        <div class="comment-meta">
            <span>By Jimmy James</span>
            <span>Posted July 23, 2011</span>
            
        </div>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim.</p>

    </div>
    
    <div class="comment">
        
        <h4>This is a second, slightly longer comment title. Oh, and this comment has two paragraphs.</h4>
        <div class="comment-meta">
            <span>By Jimmy James</span>
            <span>Posted July 23, 2011</span>
            
        </div>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
        <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim.</p>

    </div>

</div>


<?php if ($comments) : ?>
    <div class="comment-section">
    
        <h3 class="comments-title"><?php comments_number('No Responses', 'One Response', '% Responses' ); ?> to &#8220;<?php the_title(); ?>&#8221;</h3>
    
        <ol class="commentlist">

        <?php foreach ($comments as $comment) : ?>

          <li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">

            <div class="comment-info">

              <div class="left"><?php echo get_avatar( $comment, 32 ); ?></div>
              <cite><?php comment_author_link() ?></cite> says:

              <?php if ($comment->comment_approved == '0') : ?>
                <em>Your comment is awaiting moderation.</em>
              <?php endif; ?>

              <br />

              <small class="commentmetadata">
                <a href="#comment-<?php comment_ID() ?>" title=""><?php docredux_timestamp(); ?></a> 
              </small>

            </div>

            <div class="comment-content">
              <?php comment_text() ?>
              <div class="reply">
                <?php comment_reply_link() ?><?php edit_comment_link('Edit',' - ',''); ?>
              </div>
            </div>

            <div class="clear"></div>

          </li>

        <?php endforeach; /* end for each comment */ ?>

        </ol>

     <?php else : // this is displayed if there are no comments so far ?>

        <?php if ('open' == $post->comment_status) : ?>
            <!-- If comments are open, but there are no comments. -->

         <?php else : // comments are closed ?>
            <!-- If comments are closed. -->
            <p class="nocomments">Comments are closed.</p>

        <?php endif; ?>
    <?php endif; ?>

    <br />

    <?php if ('open' == $post->comment_status) : ?>

        <div id="respond">

            <h3><?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?></h3>

            <div class="cancel-comment-reply">
                <small><?php cancel_comment_reply_link(); ?></small>
            </div>
    

            <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
                <p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
            <?php else : ?>

                <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
                
                    <?php comment_id_fields(); ?>

                    <?php if ( $user_ID ) : ?>

                        <p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Log out &raquo;</a></p>

                    <?php else : ?>

                        <p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
                            <label for="author"><small>Name <?php if ($req) echo "(required)"; ?></small></label></p>

                        <p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
                            <label for="email"><small>Mail (will not be published) <?php if ($req) echo "(required)"; ?></small></label></p>

                        <p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
                            <label for="url"><small>Website</small></label></p>

                    <?php endif; ?>

                    <!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->

                    <p><textarea name="comment" id="comment" rows="8" tabindex="4"></textarea></p>

                    <p><input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
                        <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
                    </p>
                <?php do_action('comment_form', $post->ID); ?>

                </form>

            </div><!-- END #respond -->
        
        <?php endif; // If registration required and not logged in ?>

    <?php endif; // if you delete this the sky will fall on your head ?>

</div><!-- END .comment-section -->