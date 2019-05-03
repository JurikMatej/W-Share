<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="jumbotron jumbotron-fluid text-center">
  <div class="container"></div>
    <h1><?php echo $data['title']; ?></h1>
    <p class="lead"><?php echo $data['description']; ?></p>
    <p class="lead">Version <strong><?php echo APPVERSION; ?></strong></p>
  </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>