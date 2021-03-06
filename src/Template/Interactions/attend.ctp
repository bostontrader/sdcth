<?php
/**
 * @var array $attend
 * @var array $attendResults
 */
?>
<div id="InteractionsAttend">
    <div class="interactions index large-9 medium-8 columns content">
        <h3><?= __('Interactions') ?></h3>
        <?= $this->Form->create(null,['id'=>'InteractionAttendForm']) ?>

        <table id="InteractionsTable" cellpadding="0" cellspacing="0">
            <thead>
            <tr>
                <th id="sort"><?= __('Sort') ?></th>
                <th id="sid"><?= __('SID') ?></th>
                <th id="fam_name"><?= __('Fam Name') ?></th>
                <th id="giv_name"><?= __('Giv Name') ?></th>
                <th id="phonetic_name"><?= __('Phonetic Name') ?></th>
                <th id="attend"><?= __('Attend') ?></th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($attendResults as $attend): ?>
                    <tr>
                        <td><?= $attend['sort'] ?></td>
                        <td><?= $attend['sid'] ?></td>
                        <td><?= $attend['fam_name'] ?></td>
                        <td><?= $attend['giv_name'] ?></td>
                        <td><?= $attend['phonetic_name'] ?></td>
                        <td><?= $this->Form->input('attend.' . $attend['student_id'], ['type' => 'checkbox', 'checked' => $attend['itype_id']]); ?></td>
                    </tr>
                <?php endforeach; ?>
                <?= $this->Form->button(__('Submit')) ?>
                <?= $this->Form->end() ?>
            </tbody>
        </table>
    </div>
</div>
