<?php require("LinkToSQL.php")?>
請輸入信箱：
<form action="subscribe.php" method="post" enctype="multipart/form-data">
    <input type="email" name="email">
    <input type="submit">
</form>
<?php
    
    if(isset($_POST["email"])){
        $email=$_POST["email"];
        $noData="true";
        $SQLTable="SELECT * FROM email";
        if($email!=null){
            $result=mysqli_query($LinkToSQL,$SQLTable);
            if($result){
                while($row=mysqli_fetch_assoc($result)){
                    if($row["userEmail"]==$email){
                        $noData="false";
                        break;
                    }else{
                        $noData="true";
                    }
                }
            }
            if($noData=="true"){
                $SQL="INSERT INTO email (no, userEmail) VALUES (null,'$email')";
                $insert=mysqli_query($LinkToSQL,$SQL);
                if($insert){
                    echo "<script type='text/javascript'>";
                    echo "alert('成功加入歡迎訂閱!');";
                    echo "</script>";
                    echo "<meta http-equiv='Refresh' content='0;url=subscribe.php'>";
                }
            }else{
                echo "<script type='text/javascript'>";
                echo "alert('您以訂閱過!');";
                echo "</script>";
                echo "<meta http-equiv='Refresh' content='0;url=subscribe.php'>";
            }

        }
    }
?>