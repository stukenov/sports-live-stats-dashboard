<h4><a href="/matchcenter">Матч-центр</a> > <?= $discipline['name'] ?></h4>


<?php foreach ($endpoints as $endpoint): ?>
    <a href="/matchcenter/<?= $discipline['slug'] ?>/<?= $endpoint['slug'] ?>" class="button"><?= $endpoint['name'] ?></a>
<?php endforeach; ?>