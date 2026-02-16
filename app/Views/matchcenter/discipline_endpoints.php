

<h4><a href="/matchcenter">Матч-центр</a> > <a href="/matchcenter/<?= $discipline['slug'] ?>"><?= $discipline['name'] ?></a> > <?= $endpoint['name'] ?></h4>


<?php if (isset($apiResponse)) : ?>
    <?php $responseArray = json_decode($apiResponse, true); ?>
    <?= dd($responseArray); ?>
    <?php if (isset($responseArray['Ccg'])) : ?>
        
            <?php foreach ($responseArray['Ccg'] as $item) : ?>
                <a href="<?= current_url() ?>/<?= $item['Ccd'] ?>" class="button"><?= $item['Cnm'] ?></a>
            <?php endforeach; ?>
        
    <?php endif; ?>
<?php endif; ?>

<?php if ($endpoint['slug'] === 'leagues') : ?>
   
        <?php foreach ($leagues as $league) : ?>
           <a href="<?= current_url() ?>/<?= $league['slug'] ?>" class="button"><?= $league['name'] ?></a>
        <?php endforeach; ?>
    
<?php endif; ?>
