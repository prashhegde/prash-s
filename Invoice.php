<?php
 session_start();
 include("includes/config.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Print Invoice</title>
    <style>
        *
        {
            margin:0;
            padding:0;
            font-family:Arial;
            font-size:10pt;
            color:#000;
        }
        body
        {
            width:100%;
            font-family:Arial;
            font-size:10pt;
            margin:0;
            padding:0;
        }
         
        p
        {
            margin:0;
            padding:0;
        }
         
        #wrapper
        {
            width:180mm;
            margin:0 15mm;
        }
         
        .page
        {
            height:297mm;
            width:210mm;
            page-break-after:always;
        }
 
        table
        {
            border-left: 1px solid #ccc;
            border-top: 1px solid #ccc;
             
            border-spacing:0;
            border-collapse: collapse; 
             
        }
         
        table td 
        {
            border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            padding: 2mm;
        }
         
        table.heading
        {
            height:50mm;
        }
         
        h1.heading
        {
            font-size:14pt;
            color:#000;
            font-weight:normal;
        }
         
        h2.heading
        {
            font-size:9pt;
            color:#000;
            font-weight:normal;
        }
         
        hr
        {
            color:#ccc;
            background:#ccc;
        }
         
        #invoice_body
        {
            height: 149mm;
        }
         
        #invoice_body , #invoice_total
        {   
            width:100%;
        }
        #invoice_body table , #invoice_total table
        {
            width:100%;
            border-left: 1px solid #ccc;
            border-top: 1px solid #ccc;
     
            border-spacing:0;
            border-collapse: collapse; 
             
            margin-top:5mm;
        }
         
        #invoice_body table td , #invoice_total table td
        {
            text-align:center;
            font-size:9pt;
            border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            padding:2mm 0;
        }
         
        #invoice_body table td.mono  , #invoice_total table td.mono
        {
            font-family:monospace;
            text-align:right;
            padding-right:3mm;
            font-size:10pt;
        }
         
        #footer
        {   
            width:180mm;
            margin:0 15mm;
            padding-bottom:3mm;
        }
        #footer table
        {
            width:100%;
            border-left: 1px solid #ccc;
            border-top: 1px solid #ccc;
             
            background:#eee;
             
            border-spacing:0;
            border-collapse: collapse; 
        }
        #footer table td
        {
            width:25%;
            text-align:center;
            font-size:9pt;
            border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
        }
    </style>
</head>
<body>

<?php $query=mysql_query("select products.productImage1 as pimg1,products.productName as pname,orders.productId as opid,orders.quantity as qty,products.productPrice as pprice,orders.paymentMethod as paym,orders.orderDate as odate,orders.id as orderid from orders join products on orders.productId=products.id where orders.userId='".$_SESSION['id']."' and orders.paymentMethod is not null");
$cnt=1;
while($row=mysql_fetch_array($query))
{
?>

	
<div id="wrapper">
     
    <p style="text-align:center; font-weight:bold; padding-top:5mm;">INVOICE</p>
    <br />
    <table class="heading" style="width:100%;">
        <tr>
            <td style="width:80mm;">
                <h1 class="heading">Modern Agencies</h1>
                <p>Opposite To Railway Station </p>
                <p>Hubli -02</p>
            </td>
            <td rowspan="2" valign="top" align="right" style="padding:3mm;">
               <?php
				
				$uid=$_SESSION['id'];
				
				$ordID=$_GET['OrdNo']; 
				
				$sql="select * from orders where userid=$uid and orderStatus='P' and id=$ordID;";
			
				//echo $sql;				
						
				$con = mysqli_connect("localhost","root","","shopping");
				
				$result = $con->query($sql);
    
				if($result->num_rows > 0) // if more than 1 record, 
	    		 { 
					 while($row=$result->fetch_assoc())
		  			 {
		              $invno = $row['id']; 
					  $dt=$row['orderDate'];
 	 
				?>
                <table>
                    <tr><td>Invoice No :</td><td> <?php echo $invno; ?> </td></tr>
                    <tr><td>Dated : </td><td><?php echo date('d-m-Y',strtotime($dt)); ?></td></tr>
                    <tr><td>Currency : </td>
                    <td>Rs.</td></tr>
                </table>
              
                <?php
					 }//end while
				 }//end if
			   ?>
           
           
            </td>
        </tr>
        <tr>
            <td>
              <?php $uname="select * from users where userid=$uid";
				 $ui
				?>
              
                <b>Buyer</b> :<br /> <?php echo $uname; ?> <br/>
            </td>
        </tr>
    </table>
         
         
    <div id="content">
         
        <div id="invoice_body">
            <table>
            <tr style="background:#eee;">
                <td style="width:8%;"><b>Sl. No.</b></td>
                <td><b>Product</b></td>
                <td style="width:15%;"><b>Quantity</b></td>
                <td style="width:15%;"><b>Rate</b></td>
                <td style="width:15%;"><b>Total</b></td>
            </tr>
            </table>
             
            <table>
            <tr>
                <td style="width:8%;">1</td>
                <td style="text-align:left; padding-left:10px;">Software Development<br />Description : Upgradation of telecrm</td>
                <td class="mono" style="width:15%;">1</td><td style="width:15%;" class="mono">157.00</td>
                <td style="width:15%;" class="mono">157.00</td>
            </tr>         
            <tr>
                <td colspan="3"></td>
                <td></td>
                <td></td>
            </tr>
             
            <tr>
                <td colspan="3"></td>
                <td>Total :</td>
                <td class="mono">157.00</td>
            </tr>
        </table>
        </div>
        <div id="invoice_total">
            Total Amount :
            <table>
                <tr>
                    <td style="text-align:left; padding-left:10px;">One  Hundred And Fifty Seven  only</td>
                    <td style="width:15%;">Rs.</td>
                    <td style="width:15%;" class="mono">157.00</td>
                </tr>
            </table>
        </div>
        <br />
        <hr />
        <br />
         
        <table style="width:100%; height:35mm;">
            <tr>
                <td style="width:65%;" valign="top">
                    Payment Information :<br />
                    Please make cheque payments payable to : <br />
                    <b>ABC Corp</b>
                    <br /><br />
                    The Invoice is payable within 7 days of issue.<br /><br />
                </td>
                <td>
                <div id="box">
                    E &amp; O.E.<br />
                    For ABC Corp<br /><br /><br /><br />
                    Authorised Signatory
                </div>
                </td>
            </tr>
        </table>
    </div>
     
    <br />
     
    </div>
     
    <htmlpagefooter name="footer">
        <hr />
        <div id="footer"> 
            <table>
                <tr><td>Software Solutions</td><td>Mobile Solutions</td><td>Web Solutions</td></tr>
            </table>
        </div>
    </htmlpagefooter>
    <sethtmlpagefooter name="footer" value="on" />
     
</body>
</html>