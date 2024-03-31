<br><br>
<div class="container">
    <h4>ID đơn hàng: <?=$id_donhang?></h4>
  <h2 class="mt-4 ">Đơn Hàng</h2>
    <div class="card mb-4">
        <div class="card-header cart text-primary fw-bold text-white">Thông tin đơn hàng</div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <td>Mã đơn hàng:</td>
                    <td><span class="fw-bold">PHVH-<?= $ma_donhang ?></span></td>
                </tr>
                <!-- <tr>
                    <td>Trạng thái:</td>
                    <td>
                        <span class="fw-bold">
                            <?php
                            if ($status_pay == 1) {
                                echo "Đã thanh toán";
                            } else {
                                echo "Chưa thanh toán";
                            }
                            ?>
                        </span>
                    </td>
                </tr>  -->
            </table>
        </div>
    </div>

    <div >
      <input type="hidden" name="tongdonhang" value="<?=$tong?>">
      <div class="card">
        <div class="card-header cart text-primary fw-bold text-white">Thông tin đặt hàng</div>
        <div class="card-body">
          <div class="wrap-infocart mar-t5">
            <span>Họ tên người đặt: </span>
            <input name="name" type="text" class="ip-cart ml-91" placeholder="Nhập họ tên người nhận"  value="<?= $name ?>">
          </div>
          <div class="wrap-infocart mar-t5">
            <span>Địa chỉ: </span>
            <input name="address" type="text" class="ip-cart ml-158" placeholder="Nhập địa chỉ nhận hàng"  value="<?= $address ?>">
          </div>
          <div class="wrap-infocart mar-t5">
            <span>Email: </span>
            <input name="email" type="email" class="ip-cart ml-166" placeholder="Nhập email người nhận"  value="<?= $email?>">
          </div>
          <div class="wrap-infocart mar-t5">
            <span>Điện thoại: </span>
            <input name="phone" type="text" class="ip-cart ml-134" placeholder="Nhập số điện thoại người nhận"  value="<?= $phone?>">
          </div>
        </div>
      </div>


  <div>
    <div>
      <?php if (!empty($Showcar)) {
                    $tong = 0;
                    $tongsp=0;
                    $i = 0;
                    
      ?>
      <table class="table">
        <thead>
          <tr>
            <th >STT</th>
            <th>Tên sản phẩm</th>
            <th>Hình</th>
            <th>Đơn giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          if(isset($_SESSION['id_donhang'])&&($_SESSION['id_donhang'])>0){
            $Showcart=getShowcart($id_donhang);
            foreach ($Showcar as $item) {
              $thanhtien=$item['soluong'] * $item['dongia'];
              $tong+=$thanhtien;
              $tongsp+=$item['4'];
            echo '<tr>
                    <td>'.($i+1).'</id>
                    <td>'.$item['ten_sanpham'].'</id>
                    <td> <img src="./uploads/'.$item['hinhanh'].'" width="60" alt=""></id>
                    <td>'.number_format($item['dongia']).'</id>
                    <td>'.$item['soluong'].'</id>
                    <td>'.number_format($thanhtien).'</id>
                  </tr>';
            $i++;
            }
          } ?>
        </tbody>
      </table>
    </div>

    <div style="margin-top: 100px;">
      <h4>Tổng Giỏ Hàng</h4>
        <ul class="list-group">
          <li class="list-group-item">Tổng sản phẩm: <span class="float-right text-danger fw-semibold"><?=$tongsp?></span></li>
          <li class="list-group-item">Tổng giá: <span class="float-right text-danger fw-semibold"><?=number_format($tong)?> VNĐ</span></li>
        </ul>
    </div>

    <div class="col-md-4">
      <?php }?>
    </div>
  </div>

  

      <!-- Thông tin đặt hàng -->
  <!-- <div style="width: 28%; float: right; margin-top: 30px">
      <input type="hidden" name="tongdonhang" value="<?=$tong?>">
      <div class="card">
        <div class="card-header cart text-primary fw-bold text-white">Thông tin đặt hàng</div>
        <div class="card-body">
          <div class="wrap-infocart mar-t5">
            <span>Họ tên người đặt: </span>
            <input name="name" type="text" class="ip-cart ml-91" placeholder="Nhập họ tên người nhận"  value="<?= $name ?>">
          </div>
          <div class="wrap-infocart mar-t5">
            <span>Địa chỉ: </span>
            <input name="address" type="text" class="ip-cart ml-158" placeholder="Nhập địa chỉ nhận hàng"  value="<?= $address ?>">
          </div>
          <div class="wrap-infocart mar-t5">
            <span>Email: </span>
            <input name="email" type="email" class="ip-cart ml-166" placeholder="Nhập email người nhận"  value="<?= $email?>">
          </div>
          <div class="wrap-infocart mar-t5">
            <span>Điện thoại: </span>
            <input name="phone" type="text" class="ip-cart ml-134" placeholder="Nhập số điện thoại người nhận"  value="<?= $phone?>">
          </div>
        </div>
      </div> -->

      <!-- phương thức thanh toán -->
      <!-- <div class="card mt-4 mb-4">
        <div class="card-header cart text-primary fw-bold">Phương thức thanh toán</div>
        <div class="card-body">
          <div class="payment-option">
            <input class="form-check-input" type="radio" name="pttt" id="inlineRadio1" value="1">
            <label for="inlineRadio1">Thanh toán khi nhận hàng</label>
          </div>
          <div class="payment-option">
            <input class="form-check-input" type="radio" name="pttt" id="inlineRadio2" value="2">
            <label class="form-check-label" for="inlineRadio2">Chuyển khoản ngân hàng</label>
          </div>
          <div class="payment-option">
            <input class="form-check-input" type="radio" name="pttt" id="inlineRadio3" value="3">
            <label class="form-check-label" for="inlineRadio3">Thanh toán qua Momo</label>
          </div>
        </div>
      </div>
  </div> -->
</div>
<style>
     /* Style for the card containing the "Thông tin đặt hàng" section */
     table{
        width: 100%;
        margin-top: 40px;
    }
    table, td, th{
        border: 1px solid black;
        border-collapse: collapse;
    }
    th{
        background-color: #f68e64ca;
        color: black;
        padding: 8px 0px;
    }
     .card {
         margin-bottom: 100px;
         border: 1px solid #ccc;
         border-radius: 5px;
         box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
     }

     /* Style for the card header */
     .card-header {
         background-color: #007bff;
         color: #fff;
         padding: 10px;
         font-weight: bold;
     }

     /* Style for the card body */
     .card-body {
         padding: 20px;
     }

     /* Style for the input fields in "Thông tin đặt hàng" */
     .wrap-infocart {
         display: flex;
         align-items: center;
         margin-bottom: 15px;
     }

     .wrap-infocart span {
         width: 180px;
         font-weight: bold;
     }

     .ip-cart {
         flex: 1;
         padding: 10px;
         border: 1px solid #ccc;
         border-radius: 5px;
     }

     /* Style for the success message */
     .text-success {
         color: #28a745;
         font-weight: bold;
         margin-top: 10px;
     }

     .payment-option {
         margin-bottom: 10px;
     }

     .payment-option label {
         cursor: pointer;
         display: inline-block;
         padding-left: 30px;
         position: relative;
     }

     .payment-option input[type="radio"] {
         position: absolute;
         opacity: 0;
         cursor: pointer;
     }

     /* Create custom radio button appearance */
     .payment-option label:before {
         content: '';
         position: absolute;
         left: 0;
         top: 1px;
         width: 20px;
         height: 20px;
         border: 2px solid #007bff;
         border-radius: 50%;
     }

     /* Style the custom radio button when selected */
     .payment-option input[type="radio"]:checked+label:before {
         background-color: #007bff;
     }

     /* Optional: Add some hover effect */
     .payment-option label:hover:before {
         border-color: #0056b3;
     }
 </style>