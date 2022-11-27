<?php
// print_r($data);
// exit;
?>

<!-- ======= Hero Section ======= -->
<section>

</section><!-- End Hero -->
<?php
    if(isset($_GET['updatesucess'])){
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Update sucessfully!</strong> You should check your detail fields below.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
    }
?>

<div class="" style="background:black;">
    <div class="row">
        <h1 style="text-align:center;" class="m-2">Member Portal</h1>

        <div class="col">
            <div class="row">
                <div class="col m-5" style="border:solid 2px white;border-radius:10px;">
                    <h1>DETAIL</h1>
                    <button class="btn btn-outline-warning mb-2" style="text-align:right;"
                        id="liveToastBtn">EDIT</button>

                    <?php
                        if(!empty($member)){
                    ?>
                    <table class="table table-hover">
                        <tr>
                            <th>Name : </th>
                            <td><span class="badge bg-light text-dark"><?=$member['member_name']?></span></td>
                        </tr>

                        <tr>
                            <th>Email : </th>
                            <td><span class="badge bg-light text-dark"><?=$member['member_email']?></span></td>
                        </tr>

                        <tr>
                            <th>Mobile : </th>
                            <td><span class="badge bg-light text-dark"><?=$member['member_mobile']?></span></td>
                        </tr>
                    </table>
                    <?php
                        }
                    ?>

                </div>


            </div>

        </div>
        <div class="col">
            <div class="row">

                <div class="col m-5" style="border:solid 2px white;border-radius:10px;">
                    <h1 class="mb-4">RECORD</h1>

                    <?php
                    if(!empty($data)){
                        foreach($data as $v){
                    ?>
                    <div class="row m-2" style="border:solid 2px white;border-radius:10px;">
                        <div class="col m-3">
                            Serial : <?=$v['serial']?>
                        </div>
                        <div class="col m-3" style="text-align:right;">
                            Date : <?=$v['date']?>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col">
                                <span class="badge rounded-pill bg-light text-dark">People
                                    :<?=$v['person_number']?></span>
                                <span class="badge rounded-pill bg-light text-dark">Remark :<?=$v['remark']?></span>

                            </div>
                        </div>

                        <div class="mt-3">
                            <table class="table table-dark table-hover">

                                <tr>
                                    <?php
                                    foreach($v['order'] as $o => $b){
                                    ?>
                                    <tb>
                                        <div class="menu-content">1. <a href="#"><?=$b['menu_title']?>
                                            </a>--------------------------------<span> $<?=$b['menu_price']?></span> x
                                            <?=$b['menu_qty']?></div>
                                    </tb>

                                    <?php
                                    }
                                    ?>
                                </tr>
                            </table>
                        </div>

                        <hr />

                        <div>
                            <table class="table table-dark table-hover">
                                <tr>
                                    <td>Total Amount :</td>
                                    <td>RM<?=$v['total_amount']?></td>


                                </tr>
                                <tr>
                                    <td>Qty :</td>
                                    <td><?=count($v['order'])?></td>


                                </tr>
                            </table>
                        </div>

                    </div>

                    <?php
                        }
                    }
                    ?>
                </div>


            </div>
        </div>



    </div>


</div>




<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <img src="..." class="rounded me-2" alt="...">
            <strong class="me-auto">Edit Detail</strong>
            <small>Now...</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <form actio="member_edit_submit" method="post">
            <input name="name" placeholder="Input Your Name" class="form-control mb-1 mt-1"/>
            <input name="email" placeholder="Input Your Email" class="form-control mb-1"/>
            <input name="mobile" placeholder="Input Your Mobile" class="form-control mb-1"/>

            <button type="submit" class="btn btn-primary m-1" style="text-align:center;"> EDIT </button>
        </form>
        
    </div>
</div>
<script>
var toastTrigger = document.getElementById('liveToastBtn')
var toastLiveExample = document.getElementById('liveToast')
if (toastTrigger) {
    toastTrigger.addEventListener('click', function() {
        var toast = new bootstrap.Toast(toastLiveExample)

        toast.show()
    })
}
</script>