<?php

require __DIR__ . '/../src/bootstrap.php';

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

$json = json_encode([
    'items' => array_map(function($i) { return $i->toArray(); }, $items),
]);

?>
<!DOCTYPE html>
<title>アイテム管理画面</title>
<style>[v-cloak] { display: none; }</style>
<script src="//cdnjs.cloudflare.com/ajax/libs/vue/2.1.5/vue.js"></script>
<script id="json-vue" data-json="<?= h($json) ?>"></script>

<section id="app">
    <form method="post">
        <table v-cloak border id="items">
        <tr>
            <th>Name</th>
            <th>Description</th>
        </tr>
        <tr v-for="(item, index) in items">
            <td><input :name="'items[' + index + '][name]'" v-model="item.name"></td>
            <td><input :name="'items[' + index + '][desc]'" v-model="item.desc"></td>
        </tr>
        </table>
        <button type="button" v-on:click="add">追加</button>
        <button type="submit">保存</button>
    </form>
</section>
<script>
 var v = new Vue({
     el: "#app",
     data: JSON.parse(document.getElementById('json-vue').dataset.json),
     methods: {
         add: function (event) {
             v.$data.items.push({});
             return false;
         }
     }
 });
</script>
