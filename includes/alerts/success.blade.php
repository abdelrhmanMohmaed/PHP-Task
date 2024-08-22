<?php

if ($session->has('success')) : ?>
<div class="alert alert-success text-center w-3"><?= $session->get('success') ?></div>
<?php endif;
$session->remove('success'); ?>
