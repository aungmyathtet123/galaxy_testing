<!DOCTYPE html>
<html lang="en">
  <head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
  </head>
  <body>
    <div class="openbtn">
      <span class="icon">☰</span> <span class="text">Galaxy Testing</span><span class="save"><i class="fa fa-floppy-o fa-lg"></i><br>Save</span>
    </div>

    <div class="menu_item">
      <ul>
        <li id="setup">setup</li>
        <li id="purchase">Purchase</li>
        <li id="sale">Sales</li>
        <li id="report">Report</li>
      </ul>
    </div>

<?php

    include 'dbconnect.php';
    $sql = "SELECT * FROM purchase";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $purchases = $stmt->fetchAll();
?>


    <div>
      <table class="table">
        <tr>
          <th>Date</th>
          <th>Invoice No</th>
          <th>Qty</th>
          <th>Amount</th>
        </tr>

        <?php 
            $totqty=0;
            $totamount=0;
						foreach ($purchases as $purchase) {
							$date = $purchase['date_time'];
							$invoice = $purchase['invoice_no'];
							$qty = $purchase['qty'];
              $amount = $purchase['price'];
              $totqty+=$qty;
              $totamount+=$amount;
							
							?>
        <tr>
          <td><?= $date ?></td>
          <td><?= $invoice ?></td>
          <td><?= $qty ?></td>
          <td><?= $amount ?></td>
        </tr>

        <?php } ?>

          
        <tr id="footer">
          <td colspan="2">
            <span><i class="fa fa-plus fa-2x"></i></span>
            <span class="editicon"><i class="fa fa-edit fa-2x"></i></span>
          </td>
          <td><?= $totqty ?></td>
          <td><?= $totamount ?>MMK</td>
        </tr>
      </table>
    </div>




    <div class="sale">
      <table class="saletable">
        <tr>
          <td><label for="test">Date</label></td>
          <td>
            <input name="date" id="date" type="text" placeholder="30/01/2019"  readonly/>
          </td>
        </tr>
        <tr>
          <td><label for="test">Invoice No.</label></td>
          <td>
            <input
              name="date"
              id="invoice"
              type="text"
              placeholder="Inv-00001"
              readonly
            />
          </td>
        </tr>
        <tr>
          <td><button class="detail">Add Detail</button></td>
        </tr>
      </table>


      <div class="adddetail">
        <!-- <form action="create.php" method="post" id="myForm"> -->
        <table class="detailtable">
          <tr>
            <td><label for="test">Date</label></td>
            <td>
              <input
                name="date"
                id="dedate"
                type="text"
                placeholder="30/01/2019"
                onfocus="(this.type = 'date')"
                
              />
              <span class="dedate" style="color:red"></span>
            </td>
          </tr>
          <tr>
            <td><label for="test">Invoice No.</label></td>
            <td>
              <input
                name="invoice_no"
                id="deinvoice"
                type="text"
                placeholder="Inv-00001"
              />
              <span class="deinvoice" style="color:red"></span>
            </td>
          </tr>
          <tr>
            <td><label for="test">Code</label></td>
            <td>
              <input name="code" id="code" type="text" placeholder="1001" />
              <span class="code" style="color:red"></span>
            </td>
          </tr>
  
          <tr>
            <td><label for="test">Description</label></td>
            <td>
              <input
                name="description"
                id="description"
                type="text"
                placeholder="Book"
              />
              <span class="description" style="color:red"></span>
            </td>
          </tr>
          <tr>
            <td><label for="test">Qty</label></td>
            <td><input name="qty" id="qty" type="number" placeholder="10" />
            <span class="qty" style="color:red"></span>
          </td>
          </tr>
          <tr>
            <td><label for="test">Price</label></td>
            <td>
              <input name="price" id="price" type="number" placeholder="1000" />
              <span class="price" style="color:red"></span>
            </td>
          </tr>
          <tr>
            <td></td>
            <td><button class="add-detail">Add Data</button></td>
          </tr>
        </table>
      <!-- </form> -->
      </div>


      <div class="salelist">
        <table class="salelist-table">
          <tr>
            <th>sr</th>
            <th>Stock Code</th>
            <th>Description</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Amount</th>
          </tr>

          <?php 
            $totqty=0;
            $totamount=0;
            $i=1;
						foreach ($purchases as $purchase) {
							$date = $purchase['date_time'];
							$invoice = $purchase['invoice_no'];
							$qty = $purchase['qty'];
              $price = $purchase['price'];
              $code = $purchase['code'];
              $description = $purchase['description'];
              $totqty+=$qty;
              $amount=$qty*$price;
              $totamount+=$amount;
             

							
							?>
          <tr>
            <td><?= $i++ ?></td>
            <td><?= $code ?></td>
            <td><?= $description ?></td>
            <td><?= $qty ?></td>
            <td><?= $price ?></td>
            <td><?= $amount ?></td>
          </tr>
          <?php } ?>
        </table>
        <div id="footer">

        <p>Totalqty<span class="qty"><?= $totqty ?></span></p>
              <p>Total Amount <span class="amount"><?= $totamount ?></span></p>
        </div>
      </div>
    </div>
    
    <script src="jquery-3.6.2.min.js"></script>
    <script>
      $(document).ready(function () {

        $(".menu_item").hide();
        $(".table").hide();
        $(".sale").hide();
        $(".adddetail").hide();
        $('.save').hide();
        $(".icon").click(function () {
          $(".menu_item").toggle();
          $(".text").html("Title");
          $('.save').hide();
        });

        $(".menu_item").on("click", "#setup", function () {
          $(".text").html("Setup");
          $(".menu_item").hide();
          $(".sale").hide();
          $(".table").hide();
          $('.save').hide();
        });

        $(".menu_item").on("click", "#purchase", function () {
          $(".text").html("Purchase");
          $(".menu_item").hide();
          $(".sale").hide();
          $(".table").show();
          $('.save').hide();
         
        });

        $(".menu_item").on("click", "#sale", function () {
          $(".text").html("Sale Screen");
          $(".menu_item").hide();
          $(".sale").show();
          $(".table").hide();
          $(".adddetail").hide();
          $('.save').show();
          
        });

        $(".sale").on("click", ".detail", function () {
          $(".text").html("Sale Screen");
          $(".menu_item").hide();
          $(".sale").show();
          $(".table").hide();
          $(".adddetail").show();
          $('.save').show();
        });

        $(".menu_item").on("click", "#report", function () {
          $(".text").html("Report");
          $(".menu_item").hide();
          $(".sale").show();
          $(".table").hide();
          $(".adddetail").hide();
          $('.save').show();
        });

        function savedate(){
          var code=$("#code").val();
          var date =$("#dedate").val();
          var invoice =$("#deinvoice").val();
          var description=$('#description').val();
          var qty=$('#qty').val();
          var price=$('#price').val();
          $.ajaxSetup({
          headers:
          { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
          });

          
          if(!date || date.length==0){
            $('.dedate').html("*date is required")   
          }

          if(!code){
            $('.code').html("*code is required")   
          }
          
          if(!invoice){
            $('.deinvoice').html("*invoice-code is required")   
          }

          if(!description){
            $('.description').html("*description is required")   
          }

          if(!qty){
            $('.qty').html("*qty is required")   
          }
          

          if(!price){
            $('.price').html("*price is required")   
          }

          if(date && code && invoice && description && qty && price){
            $.post('create.php',{date:date,invoice:invoice,code:code,description:description,qty:qty,price:price},function(res){
            alert(res);
            location.reload();
            });
          }else{
            alert("field required")
          }
        }
        $(".add-detail").click(function(){ 
         
          savedate()

          });

    $(".save").click(function(){        
      savedate()
    });
      });
    </script>
  </body>
</html>
