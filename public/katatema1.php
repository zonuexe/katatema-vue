<?php

final class Item
{
    private $name;
    private $desc;

    public function __construct(array $source)
    {
        $this->name = isset($source['name']) ? $source['name'] : '';
        $this->desc = isset($source['desc']) ? $source['desc'] : '';
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'desc' => $this->desc,
        ];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $items = [];
    foreach ($_POST['items'] as $i) {
        if (!is_array($i) || array_values($i) === ['']) {
            continue;
        }
        $items[] = new Item($i);
    }
} else {
    $items = [
        new Item(['name' => 'GameBoy Advance', 'desc' => '任天堂のスゴイ携帯ゲーム機だよ']),
        new Item(['name' => 'SwanCrystal',     'desc' => 'バンダイが生み出した史上最強の携帯ゲーム機だよ']),
    ];
}

?>
<!DOCTYPE html>
<title>アイテム管理画面</title>
<form method="post">
    <table border>
        <tr>
            <th>Name</th>
            <th>Description</th>
        </tr>
        <?php foreach ($items as $n => $item): ?>
            <tr>
                <td><input name="items[<?= htmlspecialchars($n) ?>][name]" value="<?= htmlspecialchars($item->name) ?>"></td>
                <td><input name="items[<?= htmlspecialchars($n) ?>][desc]" value="<?= htmlspecialchars($item->desc) ?>"></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td><input name="items[<?= htmlspecialchars($n + 1) ?>][name]" value=""></td>
            <td><input name="items[<?= htmlspecialchars($n + 1) ?>][desc]" value=""></td>
        </tr>
    </table>
    <button type="submit">保存</button>
</form>
