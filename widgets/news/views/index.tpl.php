<?php foreach ($data['news'] as $news): ?>
<div class="media">
	<div class="media-left">
	<?php if ($news['user_id']): ?>
		<?php echo $NeoFrag->user->avatar($news['avatar'], $news['sex'], $news['user_id'], $news['username']); ?>
	<?php else: ?>
		<?php echo $NeoFrag->user->avatar(NULL); ?>
	<?php endif; ?>
	</div>
	<div class="media-body">
		<h4 class="media-heading"><a href="<?php echo url('news/'.$news['news_id'].'/'.url_title($news['title']).'.html'); ?>"><?php echo $news['title']; ?></a></h4>
		<?php echo icon('fa-clock-o').' '.time_span($news['date']); ?> <a href="<?php echo url('news/'.$news['news_id'].'/'.url_title($news['title']).'.html'); ?>#comments"><?php echo icon('fa-comment-o').' '.$NeoFrag->library('comments')->count_comments('news', $news['news_id']); ?></a>
	</div>
</div>
<?php endforeach; ?>