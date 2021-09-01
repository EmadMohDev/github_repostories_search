<?php
include("repostories.php") ;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="m-5  bl-10 ">
        <b> Select Top Repostories </b>

        <div  class="m-5">
            <form action="">
                <label for="date">Select Top:</label>
                <select name="top" style="width:245px" onchange="this.form.submit()">
                    <option value=""> --- </option>
                    <?php echo  $topHtml ; ?>
                </select>


                <label for="date">Select Date:</label>
                <input type="date" name="date"
                    value="<?php echo  (isset($_REQUEST['date'])  && $_REQUEST['date'] != "" )?   $_REQUEST['date']:''   ?>"
                    onchange="this.form.submit()">


                <label for="date">Select Language:</label>

                <select name="language" style="width:245px" onchange="this.form.submit()">
                    <option value=""> --- </option>
                    <?php echo $languesHtml ; ?>
                </select>
            

                <button type="submit" class="btn-primary ml-5">Search</button>

            </form>
        </div>
    </div>


    <table>
        <tr>
            <th>SN</th>
            <th>ID</th>
            <th>language</th>
            <th>star Count</th>
            <th>Date</th>
        </tr>
        <?php echo $resultHtml  ;?>
    </table>

</body>

</html>