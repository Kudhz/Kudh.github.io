
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="http://refildisini.xyz:81/style.css">
</head>
<?php 
error_reporting(0);
header("Content-type: text/html; charset=utf8");
date_default_timezone_set("PRC");
function http_post($url, $data) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $res = curl_exec($ch);
    curl_close($ch);

    $res = urldecode($res);
    return json_decode($res, true);
}
if($_POST['submit']){
	$uid=trim($_POST['uid']);
	$item=trim($_POST['item']);
	$item2=trim($_POST['item2']);
	$item3=trim($_POST['item3']);
	$num=trim($_POST['num']);
	if(empty($uid)){
		echo "<script>alert('Please enter your player UID!');history.go(-1)</script>";
		exit;		
	}
	if(empty($item)){
		echo "<script>alert('Please select an item!');history.go(-1)</script>";
		exit;		
	}
	if(empty($num) && $num<1){
		echo "<script>alert('The number of items is incorrect!');history.go(-1)</script>";
		exit;		
	}


	$url = 'http://139.180.222.189:8001/idip';
	$group_id=1003;
	$role_id=$uid;
	$items='{"ItemList_count":1,"ItemList":[{"ItemId":'.$item.',"ItemNum":'.$num.'}],"IsBind":0,"Time":0,"LanguageId":["zh","cht"],"MailTitle":["\u7cfb\u7edf\u90ae\u4ef6","\u7cfb\u7edf\u90ae\u4ef6"],"MailContent":["\u8bf7\u6ce8\u610f\u67e5\u6536\u0021","\u8bf7\u6ce8\u610f\u67e5\u6536\u0021"]}';
	$items3='{"ItemList_count":1,"ItemList":[{"ItemId":'.$item3.',"ItemNum":'.$num.'}],"IsBind":0,"Time":0,"LanguageId":["zh","cht"],"MailTitle":["\u7cfb\u7edf\u90ae\u4ef6","\u7cfb\u7edf\u90ae\u4ef6"],"MailContent":["\u8bf7\u6ce8\u610f\u67e5\u6536\u0021","\u8bf7\u6ce8\u610f\u67e5\u6536\u0021"]}';
	$mail_body = json_decode($items, true);
	$mail_body['Partition'] = (int)$group_id;
	$mail_body['RoleId'] = (string)$role_id;
	$post_data = array(
	'head' => array('Cmdid' => 4143),
	'body' => $mail_body,
	);
	$response = http_post($url, 'data_packet=' . json_encode($post_data));
	if ($response['head']['Result'] == 0){	
		echo "<script>alert('Sent successfully, check the email!');history.go(-1)</script>";
		exit;		
	}else{
		echo "<script>alert('Sending failed, error message【{$response['head']['RetErrMsg']}】！');history.go(-1)</script>";
		exit;		
	}
}
?>
<body>
<div class="vh-100" style="background-color: #9A616D;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
              <div class="card" style="border-radius: 1rem;">
                <div class="row g-0">
                  <div class="col-md-6 col-lg-5 d-md-block">
                    <img src="https://e1.pxfuel.com/desktop-wallpaper/564/816/desktop-wallpaper-cellsatwork-anime-loli.jpg"
                      alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                  </div>
                  <div class="col-md-6 col-lg-7 d-flex align-items-center">
                    <div class="card-body p-4 p-lg-5 text-black">
      
                
                        <div class="d-flex align-items-center mb-3 pb-1">
                          <span class="h1 fw-bold mb-0">Dragon Nest Mobile</span>
                        </div>
      
                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Send Item</h5>
                                                                        <div class="alert alert-success" role="alert">
                          <ul>
                            <li>
                              Success Login, Enjoy
                            </li>
                          </ul>
                        </div>
                  <form name="form1" method="post" action="">

                  <div class="form-outline mb-4">
                            <label for="uid" class="control-label">UID</label>
                            <input type="text" id="uid" name="uid" class="form-control form-control-lg" value="" placeholder="1 atau 1,2,3 atau 1-10 (bukan 1 - 10)"/>
                         </div>
                        <div class="form-outline mb-4">
                          <label class="form-label" for="num">Quantity</label>
                          <input type="num" id="num" name="num" class="form-control form-control-lg" value="" />
                        </div>
      
                        <div class="form-outline mb-4">
                            <label for="Item" class="control-label">Item</label>
                            
                            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" id="select-item" name="item">
                                <option value="">Select Item</option>
                            </select>
                            <p class="text-center">OR</p>
                            <input type="text" id="item" name="item" class="form-control form-control-lg" placeholder="Input Code (multiple item : 1,2,3,5)" />
							
                         </div>
                        <br>

	<div class="pt-1 mb-4">
		<input type="submit" class="btn btn-dark btn-lg btn-block button-send-item" name="submit" value='Send'>
	</div>	
	<br><br>
    <div class="pt-1 mb-4">
                        <a href="http://170.64.204.125:81/test/logout.php" class="btn btn-danger btn-lg btn-block">Logout</a>
                      </div>

</form>	
</div>
<script>
	
		$(function(){
			$('select').searchableSelect();
		});
</script>
</div>
                        <br>
                        
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {
    $('#select-item').select2({
      placeholder: 'Select an item',
        ajax: {
            url: 'dnnandar.xyz/getItem',
            dataType: '.json',
            delay: 250,
            data: function (params) {
                return {
                    search: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            id: item.id,
                            text: item.name
                        }
                    })
                };
            },
            cache: true
        }
    });
});

</script>

</html>