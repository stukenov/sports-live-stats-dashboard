<h4><a href="/matchcenter" class="">Матч-центр</a></h4>


<?php foreach ($data as $slug => $name) : ?>
    <a href="/matchcenter/<?= $slug ?>" class="button"><?= $name ?></a>
<?php endforeach; ?>
