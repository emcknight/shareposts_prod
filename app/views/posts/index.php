<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('post_message'); ?>
<?php flash('password_change_success'); ?>
<div class="row mb-3 mt-3">
    <div class="col-md-6">
        <h1>Posts</h1>
    </div>
    <div class="col-md-6 my-auto">
        <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary pull-right">
            <i class="fa fa-pencil" aria-hidden="true"></i> Add Post
        </a>
    </div>
</div>
<?php foreach ($data['posts'] as $post) : ?>
    
    <div class="card card-body mb-3">
        <h4 class="card-title"><?php echo $post->postTitle; ?></h4>
        <div class="bg-light p-2mb-3">Written by: <?php echo $post->userName ?> on <?php echo $post->postCreatedAt ?></div>
        <p class="card-text"><?php echo $post->postBody; ?></p>
        <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId; ?>" class="btn btn-dark">More</a>
    </div>

<?php endforeach; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>