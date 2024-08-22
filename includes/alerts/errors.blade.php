<?php if($session->has('errors')): ?>
<?php 
        $errors = $session->get('errors');
        if (is_array($errors)): 
    ?>
<div class="alert alert-danger">
    <ul>
        <?php foreach ($errors as $error): ?>
        <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php else: ?>
<div class="alert alert-danger">
    <?= htmlspecialchars($errors) ?>
</div>
<?php endif; ?>

<?php $session->remove('errors'); ?>
<?php endif; ?>
