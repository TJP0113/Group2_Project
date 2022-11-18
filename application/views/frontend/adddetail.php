<h1>Memeber</h1>
<form action="<?=base_url('adddetail_submit')?>" method="POST">
    <input name="name"/>
    <input name="email"/>
    <input name="mobile"/>
    <input name="password"/>

    <button type="submit">submit</button>

</form>

<h1>Cheft</h1>
<form action="<?=base_url('adddetail_submit')?>" method="POST">
    <input name="cheft_name"/>
    <input name="cheft_img" type="file"/>
    <input name="cheft_type"/>
    <input name="FB_link"/>
    <input name="IG_link"/>
    <input name="TWINTTER_link"/>
    


    <button type="submit">submit</button>

</form>

<h1>Table</h1>
<form action="<?=base_url('adddetail_submit')?>" method="POST">
    <input name="table_name"/>
    <input name="type"/>
    <input name="max_person"/>
    <input name="min_person"/>

    <button type="submit">submit</button>

</form>

