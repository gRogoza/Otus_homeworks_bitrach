<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Models\Lists\DoctorsPropertyValuesTable;
use Models\Lists\ProceduresPropertyValuesTable;

Loc::loadMessages(__File__);
Loader::requireModule("iblock");

$APPLICATION->SetTitle(Loc::getMessage('MED_TITLE'));

$request = Application::getInstance()->getContext()->getRequest();

if ($request->isPost() && check_bitrix_sessid()){
    $action = (string)$request->getPost('action');
    $name = trim((string)$request->getPost('name'));
    if ($action === 'add_doctor' && $name!=''){
        DoctorsPropertyValuesTable::add([
            'NAME' => $name,
            'SPECIALIZATION' => trim((string)$request->getPost('specialization')),
        ]);
    }
    if ($action === 'add_procedure' && $name!=''){
        ProceduresPropertyValuesTable::add(['NAME' => $name]);
    }
    if ($action === 'link'){
        DoctorsPropertyValuesTable::linkProcedure(
            (int)$request->getPost('doctor_id'),
            (int)$request->getPost('procedure_id'),
        );
    }
}
$doctors = DoctorsPropertyValuesTable::getList([
    'select' => ['ID' => 'IBLOCK_ELEMENT_ID', 'NAME' => 'ELEMENT.NAME
', 'SPECIALIZATION'],
    'order' => ['NAME' => 'ASC'],
])->fetchAll();

$allProcedures = ProceduresPropertyValuesTable::getList([
    'select' => ['ID' => 'IBLOCK_ELEMENT_ID', 'NAME' => 'ELEMENT.NAME
'],
    'order' => ['NAME' => 'ASC'],
])->fetchAll();

$doctorId = (int)$request->get('doctor');
$doctorProcedures = [];
if ($doctorId > 0) {
    $ids = DoctorsPropertyValuesTable::getProcedureIds($doctorId);
    if ($ids) {
        $doctorProcedures = ProceduresPropertyValuesTable::getList([
            'select' => ['ID' => 'IBLOCK_ELEMENT_ID', 'NAME' => 'ELEMENT.NAME
'],
            'filter' => ['@IBLOCK_ELEMENT_ID' => $ids],
        ])->fetchAll();
    }
}
?>

<h2><?= Loc::getMessage('MED_DOCTORS') ?></h2>
<ul>
    <?php foreach ($doctors as $doctor): ?>
        <li>
            <a href="?doctor=<?= (int)$doctor['ID'] ?>">
                <?= htmlspecialcharsbx($doctor['NAME']) ?>
            </a>
            <?php if ($doctor['SPECIALIZATION']): ?>
                (<?= htmlspecialcharsbx($doctor['SPECIALIZATION']) ?>)
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>

<?php if ($doctorId > 0): ?>
    <h3><?= Loc::getMessage('MED_PROCEDURES') ?></h3>
    <?php if ($doctorProcedures): ?>
        <ul>
            <?php foreach ($doctorProcedures as $procedure): ?>
                <li><?= htmlspecialcharsbx($procedure['NAME']) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p><?= Loc::getMessage('MED_NO_PROCEDURES') ?></p>
    <?php endif; ?>
<?php endif; ?>

<hr>
<h3><?= Loc::getMessage('MED_ADD_DOCTOR') ?></h3>
<form method="post">
    <?= bitrix_sessid_post() ?>
    <input type="hidden" name="action" value="add_doctor">
    <input type="text" name="name" placeholder="<?= Loc::getMessage('MED_NAME') ?>" required>
    <input type="text" name="specialization" placeholder="<?= Loc::getMessage('MED_SPECIALIZATION') ?>">
    <button><?= Loc::getMessage('MED_ADD') ?></button>
</form>

<h3><?= Loc::getMessage('MED_ADD_PROCEDURE') ?></h3>
<form method="post">
    <?= bitrix_sessid_post() ?>
    <input type="hidden" name="action" value="add_procedure">
    <input type="text" name="name" placeholder="<?= Loc::getMessage('MED_NAME') ?>" required>
    <button><?= Loc::getMessage('MED_ADD') ?></button>
</form>

<h3><?= Loc::getMessage('MED_LINK') ?></h3>
<form method="post">
    <?= bitrix_sessid_post() ?>
    <input type="hidden" name="action" value="link">
    <select name="doctor_id">
        <?php foreach ($doctors as $d): ?>
            <option value="<?= (int)$d['ID'] ?>"><?= htmlspecialcharsbx($d['NAME']) ?></option>
        <?php endforeach; ?>
    </select>
    <select name="p
11:13
rocedure_id">
        <?php foreach ($allProcedures as $p): ?>
            <option value="<?= (int)$p['ID'] ?>"><?= htmlspecialcharsbx($p['NAME']) ?></option>
        <?php endforeach; ?>
    </select>
    <button><?= Loc::getMessage('MED_ADD') ?></button>
</form>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>
11:13
