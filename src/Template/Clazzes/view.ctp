<?php
/**
 * @var \App\Model\Entity\Clazz $clazz
 */
?><div id="ClazzesView">
    <nav class="large-3 medium-4 columns" id="actions-sidebar">
        <ul class="side-nav">
        </ul>
    </nav>
    <div class="sections view large-9 medium-8 columns content">
        <table id="ClazzViewTable" class="vertical-table">
            <tr id="section">
                <th><?= __('Section') ?></th>
                <td><?= $clazz->section->nickname ?></td>
            </tr>
            <tr id="event_datetime">
                <th><?= __('Datetime') ?></th>
                <td><?= $clazz->event_datetime ?></td>
            </tr>
            <tr id="comments">
                <th><?= __('Comments') ?></th>
                <td><?= $clazz->comments ?></td>
            </tr>
        </table>
    </div>
</div>