
<h1><?= $discipline ?></h1>
<h2><?= $endpoint ?></h2>


<?php if (isset($apiResponse)) : ?>
    <?php $responseArray = json_decode($apiResponse, true); ?>

    <h2><?= $responseArray['Snm'] ?></h2>

    <h3>League Table</h3>



<?php endif; ?>


<?php if (isset($apiResponse)) : ?>
    <?php $responseArray = json_decode($apiResponse, true); ?>
    <pre>
        <?php dd($responseArray); ?>
    </pre>
<?php endif; ?>

