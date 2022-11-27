<section></section>
<div class="row">
    <div class="col-4">
        <img src="<?= base_url($menu_detail['image']) ?>" class="menu-img" alt="">
    </div>
    <div class="col-8">
        <h1><?= $menu_detail['title'] ?></h1>
        <div>
            <h3>$<?= $menu_detail['price'] ?></h3>
        </div>
        <p><?= $menu_detail['description'] ?></p>
        
        <form action="<?=base_url('add_cart')?>" method="POST">
            <div>
                <input type="number" name="qty">
                <input type="hidden" value="<?=$menu_detail['menu_id']?>" name="menu_id"> 
                <input type="hidden" value="<?= $menu_detail['title'] ?>" name="menu_title">
                <input type="hidden" value="<?= $menu_detail['price'] ?>" name="price">
                <button type="submit" class="btn btn-secondary">Add</button>
            </div>
        </form>
    </div>
</div>