<!DOCTYPE html>
<html>
<head></head>
<body>
    <header>
        <div class="header-image">
        </div>
    </header>

    <nav class="large-3 medium-4 columns" id="actions-sidebar">
        <ul class="side-nav">
            <li class="heading"><?= __('Actions') ?></li>
            <li><?= $this->Html->link(__('Classes'),      ['controller' => 'Clazzes'])       ?></li>
            <li><?= $this->Html->link(__('Herds'),        ['controller' => 'Herds'])         ?></li>
            <li><?= $this->Html->link(__('Interactions'), ['controller' => 'Interactions'])  ?></li>
            <li><?= $this->Html->link(__('Majors'),       ['controller' => 'Majors'])        ?></li>
            <li><?= $this->Html->link(__('Sections'),     ['controller' => 'Sections'])      ?></li>
            <li><?= $this->Html->link(__('Semesters'),    ['controller' => 'Semesters'])     ?></li>
            <li><?= $this->Html->link(__('Students'),     ['controller' => 'Students'])      ?></li>
            <li><?= $this->Html->link(__('Subjects'),     ['controller' => 'Subjects'])      ?></li>
            <li><?= $this->Html->link(__('Teachers'),     ['controller' => 'Teachers'])      ?></li>
        </ul>
    </nav>

    <footer>
    </footer>
</body>
</html>
