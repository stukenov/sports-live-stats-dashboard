
<?php if (isset($apiResponse)) : ?>
    <?php $responseArray = json_decode($apiResponse, true); ?>
    <?php if (isset($responseArray['Ccg'])) : ?>
        <?php foreach ($responseArray['Ccg'] as $item) : ?>
            <?php if ($item['Ccd'] === $firstpoint['slug']) : ?>
                <h4><a href="/matchcenter">Матч-центр</a> > <a href="/matchcenter/<?= $discipline['slug'] ?>"><?= $discipline['name'] ?></a> > <a href="/matchcenter/<?= $discipline['slug'] ?>/<?= $endpoint['slug'] ?>"><?= $endpoint['name'] ?></a> > <?= $item['Cnm'] ?></h4>
                <?php if (isset($item['Stages']) && is_array($item['Stages'])) : ?>
                    
                        <?php foreach ($item['Stages'] as $stage) : ?>
                            <?php if ($stage['Shi'] == 0) : ?>
                                
                                    <a href="<?= $item['Ccd'] ?>/<?= $stage['Scd'] ?>" class="button"><?= $stage['Sdn'] ?></a>
                                
                            <?php endif; ?>
                        <?php endforeach; ?>
                    
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
<?php endif; ?>



<h4><a href="/matchcenter">Матч-центр</a> > <a href="/matchcenter/<?= $discipline['slug'] ?>"><?= $discipline['name'] ?></a> > <?= $endpoint['name'] ?></h4>


<?php if ($endpoint['slug'] === 'leagues') : ?>
   
   <?php foreach ($stages as $stagedata) : ?>
        <?php foreach ($stagedata as $stagedataone) : ?>
         <a href="<?= current_url() ?>/<?= $stagedataone['slug'] ?>" class="button"><?= $stagedataone['name'] ?></a>
        <?php endforeach; ?>
   <?php endforeach; ?>

<?php endif; ?>
