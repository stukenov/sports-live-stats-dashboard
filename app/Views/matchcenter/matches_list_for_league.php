


<h1>Матчи</h1>
<table class="u-full-width">
    
    <tbody>
        <?php foreach ($matches as $matchdata) : ?>
        <tr>
            <th><a href="<?= current_url() ?>/<?= $matchdata['slug'] ?>"><?= $matchdata['name'] ?></a></th>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>


