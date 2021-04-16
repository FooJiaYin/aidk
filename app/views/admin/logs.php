<div class="pad30">

    <div class="titleJL textC marT0 marB0">
        <h1>log歷史紀錄</h1>
    </div>

    <table class="table table-bordered marT30">

        <thead>
            <tr>
                <th scope="col" width="18%">紀錄ID</th>
                <th scope="col">使用者ID</th>
                <th scope="col">身份</th>
                <th scope="col">紀錄說明</th>
                <th scope="col">時間</th>
            </tr>
        </thead>
        <tbody>
            <?php $userType = ['1' => '學生', '2' => '老師', '3' => '管理員']; ?>
            <?php foreach ($logs as $log) : ?>
                <tr class="alert alert-dismissible fade show" role="alert">
                    <td scope="row">LOG-<?= $log['id'] ?></td>
                    <td scope="row"><?= $log['user'] ?></td>
                    <td scope="row"><?= $userType[$log['type']] ?></td>
                    <td scope="row"><?= $log['log'] ?></td>
                    <td scope="row"><?= $log['log_time'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>

    </table>

</div>