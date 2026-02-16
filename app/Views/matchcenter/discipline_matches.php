

<h4><a href="/matchcenter">Матч-центр</a> > <a href="/matchcenter/<?= $discipline['slug'] ?>"><?= $discipline['name'] ?></a> > <?= $endpoint['name'] ?></h4>


<?php if (isset($apiResponse)) : ?>
    <?php $responseArray = json_decode($apiResponse, true); ?>
    <?php foreach ($responseArray['Stages'] as $item) : ?>
            <a href="<?= current_url() ?>/<?= $item['Scd'] ?>" class="button"><?= $item['Snm'] ?></a>
     <?php endforeach; ?>
<?php endif; ?>
