<?php
    if (isset($_POST['insert'])) {
        
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $rollno=$_POST['rollno'];
        $email=$_POST['email'];

        if($fname=="")
            $fname="null";
        if($lname=="")
            $lname="null";
        if($rollno=="")
            $rollno="null";
        if($email=="")
            $email="null";

        $row = 0;
        if (($handle = fopen("data.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if($data[2]==$rollno) {
                    $num = count($data);
                    echo "data already exist as :\n\n";
                    echo "<p> $num fields in line $row: <br /></p>\n";
                    for ($c=0; $c < $num; $c++) {
                        echo $data[$c] . "<br />\n";
                    }
                    $row=1;
                    break;
                }                
            }
            fclose($handle);
        }

        if($row==0) {
            $data=array($fname, $lname, $rollno, $email);

            $file=fopen("data.csv", 'a+');
            fputcsv($file, $data);
            echo("data saved");
            fclose($file);
        }

?>
        <html>
        <body>
            <a href="form.html">go back</a>
        </body>
        </html>
<?php
    }
?>


<?php
    if (isset($_POST['delete'])) {
        $rollno=$_POST['rollno'];
        $row = 0;
        $f=0;
        if (($handle = fopen("data.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if($data[2]==$rollno) {
                    $num = count($data);
                    echo "entry found at row $row";
                    echo "<p> data deleted is : <br /></p>\n";
                    for ($c=0; $c < $num; $c++) {
                        echo $data[$c] . "<br />\n";
                    }
                    $f++;                
                    break;
                }
                $row++;
            }
            fclose($handle);
                
        }
        if($f==0)
            echo"entry not found";
        else {
            $fname=$_POST['fname'];
            $lname=$_POST['lname'];
            $rollno=$_POST['rollno'];
            $email=$_POST['email'];

            if($fname=="")
                $fname="null";
            if($lname=="")
                $lname="null";                
            if($rollno=="")
                $rollno="null";
            if($email=="")
                $email="null";

            $count=0;
            $newdata = [];
            if (($handle = fopen("data.csv", "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    if($count==$row) {                        
                        $count++;
                        continue;                    
                    }
                    $newdata[$count][0]=$data[0];
                    $newdata[$count][1]=$data[1];
                    $newdata[$count][2]=$data[2];
                    $newdata[$count][3]=$data[3];
                    $count++;
                }
                fclose($handle);
            }
            $fp = fopen('NewFile.csv', 'w');    
            foreach ($newdata as $rows) {
                fputcsv($fp, $rows);
            }    
            fclose($fp);
            rename('NewFile.csv', 'Data.csv');
        }
    }
?>

<?php
if(isset($_POST['update'])) {
    $rollno=$_POST['rollno'];
    $row = 0;
    $f=0;
    if (($handle = fopen("data.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if($data[2]==$rollno) {
                $num = count($data);
                echo "entry found at row $row";
                echo "<p> old data : <br /></p>\n";
                for ($c=0; $c < $num; $c++) {
                    echo $data[$c] . "<br />\n";
                }
                $f++;                
                break;
            }
            $row++;
        }
        fclose($handle);
            
    }
    if($f==0)
        echo"entry not found";
    else {
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $rollno=$_POST['rollno'];
        $email=$_POST['email'];

        if($fname=="")
            $fname="null";
        if($lname=="")
            $lname="null";                
        if($rollno=="")
            $rollno="null";
        if($email=="")
            $email="null";

        $count=0;
        $newdata = [];
        if (($handle = fopen("data.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if($count==$row) {
                    $num = count($data);
                    $newdata[$count][0]=$fname;
                    $newdata[$count][1]=$lname;
                    $newdata[$count][2]=$rollno;
                    $newdata[$count][3]=$email;

                    echo "<br><br><p>new data : <br /></p>\n";
                    for ($c=0; $c < $num; $c++) {
                        echo $newdata[$row][$c] . "<br />\n";
                    }
                    $count++;
                    continue;                    
                }
                $newdata[$count][0]=$data[0];
                $newdata[$count][1]=$data[1];
                $newdata[$count][2]=$data[2];
                $newdata[$count][3]=$data[3];
                $count++;
            }
            fclose($handle);
        }
        $fp = fopen('NewFile.csv', 'w');    
        foreach ($newdata as $rows) {
            fputcsv($fp, $rows);
        }    
        fclose($fp);
        rename('NewFile.csv', 'Data.csv');
    }
}
?>

<?php
if(isset($_POST['search'])) {
    $rollno=$_POST['rollno'];
    $row = 1;
    if (($handle = fopen("data.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if($data[2]==$rollno) {
                $num = count($data);
                echo "<p> $num fields in line $row: <br /></p>\n";
                for ($c=0; $c < $num; $c++) {
                    echo $data[$c] . "<br />\n";
                }
                break;
            }
            $row++;
        }
        fclose($handle);
    }
}
?>

<?php
if(isset($_POST['display'])) {
    $row = 1;
    if (($handle = fopen("data.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $num = count($data);
            echo "<p> $num fields in line $row: <br /></p>\n";
            $row++;
            for ($c=0; $c < $num; $c++) {
                echo $data[$c] . "<br />\n";
            }
        }
        fclose($handle);
    }
    if($row==1)
        echo "There is no data currently. Try inserting data first.";
}
?>
