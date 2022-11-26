<!-- ======= Hero Section ======= -->
<section >
  
</section><!-- End Hero -->


<div class="container m-5" style="background:black;">
    <h1 style="text-align:center;">Check Out</h1>
    <div class="m-3 p-3" style="border-radius: 10px; border:solid white 2px;">

        <div>
            <h2>Oder List</h2>
            <hr />
            <table class="table table-dark table-hover">
                <theard>
                    <tr>
                        <th>No.</th>
                        <th>Menu</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th style="text-align:right;">Total Price</th>
                    </tr>

                </theard>
                <tbody>
                    <tr>
                      <?php
                        if(!empty($booking_detail)){
                          foreach($booking_detail as $b){
                        
                      ?>
                        <td>1.</td>
                        <td><?=$b['menu_title']?></td>
                        <td>$<?=$b['price']?></td>
                        <td><?=$b['qty']?></td>
                        <td>
                          <form action="checkout_delete" method="post">
                            <input type="hidde" name="menu_id" value="<?=$b['menu_id']?>"/>
                            <button class="btn btn-danger" type="submit">X</button>
                          </form>
                          
                        </td>
                        <td style="text-align:right;">$<?=$b['total_amount']?></td>
                        
                      <?php
                        }}
                      ?>
                    </tr>
                </tbody>

                <tfoot>
                    <tr>
                        <th colspan="5">Total Item:</th>
                        
                    </tr>
                    <tr>
                        <th>5</th>
                        <th></th>
                        <th></th>
                        <th>10</th>
                        <th style="text-align:right;" id="final_amount">$<?=$final_amount?></th>
                    </tr>
                </tfoot>

            </table>


        </div>
    </div>
    <div class="m-3 p-3" style="border-radius: 10px; border:solid white 2px;">
        <h2>Inform</h2>


        <div class="form-check mt-3 mb-3">
          <input class="form-check-input" type="checkbox" id="autofill" />
          <label class="form-check-label" for="google"> Fill in as Member detail </label>
        </div>
        <form action="checkout_submit" method="post" role="form" class="php-email-form">
            <div class="row">

                <div class="col-md-6 form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
            </div>
            <div class="row">
              <div class="form-group mt-3 col-md-6">
                  <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Your Mobile" required>
              </div>
              <div class="form-group mt-3 col-md-3">
                  <input type="number" class="form-control" name="qty" id="qty" placeholder="Person/Pax" max="12" min="2" required>
              </div>

              <div class="form-group mt-3 col-md-3">
                  <input type="date" class="form-control" name="date" id="date"  required>
              </div>
            </div>
            
            <div class="form-group mt-3">
                <textarea class="form-control" name="remark" rows="8" placeholder="Your Remark" ></textarea>
            </div>

            <input type="hidden" name="final_amount" value="<?=$final_amount?>"/>
            
            <div class="text-center m-3"><button type="submit" class="btn btn-secondary">Check Out</button></div>
        </form>

    </div>

</div>

<script>
  $('#autofill').click(function(){

    console.log('hi');
    $("#name").val($member_data['member_name']);
    $("#email").val($member_data['member_email']);
    $("#mobile").val($member_data['member_mobile']);
  })

  
</script>