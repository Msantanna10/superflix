<?php get_header(); ?>
	
<div class="header">
	<div class="container">
		<div class="content spaceTop">
			<h1><?php echo ucfirst(get_the_title()); ?></h1>        
		</div>
	</div>
</div>
<div class="postPage">
	<div class="container">
		<div class="content space">
			<div class="post-content">
				<?php 
					$id=get_the_ID(); 
					$post = get_post($id); 
					$content = apply_filters('the_content', $post->post_content); 
					echo $content;  
				?>	
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>