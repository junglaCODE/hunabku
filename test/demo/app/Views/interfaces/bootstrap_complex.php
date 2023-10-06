<?= $this->extend('templates/complex') ?>

<?= $this->section('column_one') ?>

<h1 class="mt-5">
    <?= $title ?>
</h1>
<p class="lead">
    <?= $message ?>
</p>

<?= $this->endSection() ?>  

<?= $this->section('column_two') ?>

<div class="alert alert-success mt-5" role="alert">
  <h4 class="alert-heading">Well done!</h4>
  <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
  <hr>
  <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
</div>

<?= $this->endSection() ?>  