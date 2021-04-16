<div class="container-md">

    <div class="titleJL marT30 marB0 textC">
        <h1>正在進行付款，請勿重新整理頁面。。。</h1>
    </div>
    <input type="hidden" id="orderNo" value="<?= $user['id'] ?>-<?= date('YmdHis') ?>" />
    <input type="hidden" id="name" value="<?= $user['name'] ?>" />
    <input type="hidden" id="phone" value="<?= $user['phone'] ?>" />
    <input type="hidden" id="email" value="<?= $user['email'] ?>" />
    <input type="hidden" id="amount" value="<?= $_POST['amount'] ?>" />
</div>