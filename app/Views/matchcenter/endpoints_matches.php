<?php if (isset($apiResponse)) : ?>
    <?php $responseArray = json_decode($apiResponse, true); ?>
    <?php if (!empty($responseArray)): ?>
        <?php foreach ($responseArray as $resparray) : ?>
            <?php foreach ($resparray['Events'] as $event) : ?>
                <h4><a href="/matchcenter">Матч-центр</a> > <a href="/matchcenter/<?= $discipline['slug'] ?>"><?= $discipline['name'] ?></a> > <a href="/matchcenter/<?= $discipline['slug'] ?>/<?= $endpoint['slug'] ?>"><?= $endpoint['name'] ?></a></h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="3"><?= htmlspecialchars($event['Eid'], ENT_QUOTES, 'UTF-8') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Счет</td>
                            <td><?= htmlspecialchars($event['Tr1'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($event['Tr2'], ENT_QUOTES, 'UTF-8') ?></td>
                        </tr>
                        <tr>
                            <td>Время</td>
                            <td colspan="2"><?= htmlspecialchars($event['Eps'], ENT_QUOTES, 'UTF-8') ?></td>
                        </tr>
                        <?php if (!empty($event['T1'])): ?>
                        <tr>
                            <td>Команда 1</td>
                            <td colspan="2"><?= htmlspecialchars($event['T1'][0]['Nm'], ENT_QUOTES, 'UTF-8') ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if (!empty($event['T2'])): ?>
                        <tr>
                            <td>Команда 2</td>
                            <td colspan="2"><?= htmlspecialchars($event['T2'][0]['Nm'], ENT_QUOTES, 'UTF-8') ?></td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            <?php endforeach; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Нет событий</p>
    <?php endif; ?>
<?php else: ?>
    <p>Нет данных для отображения</p>
<?php endif; ?>
