<!DOCTYPE html>
<html>
<head>
    <title>Select Banks</title>
    <style>
        /* Add some style to the page */
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0px 0px 5px #aaa;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
            margin-bottom: 10px;
            display: block;
        }
        select {
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 100%;
            margin-bottom: 20px;
        }
        input[type="submit"] {
            padding: 10px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>
<?php
function getbank($idbank) {
    $banks = array('Bank 1', 'Bank 2', 'Bank 3', 'Bank 4', 'Bank 5', 'Bank 6', 'Bank 7', 'Bank 8', 'Bank 9', 'Bank 10', 'Bank 11', 'Bank 12', 'Bank 13', 'Bank 14', 'Bank 15', 'Bank 16', 'Bank 17', 'Bank 18', 'Bank 19', 'Bank 20');
    return $banks[$idbank-1];
}
?>
<body>
    <div class="container">
        <h1>Select Banks</h1>
        <form method="post">
            <div>
                <label for="bank1">Select Bank 1:</label>
                <select id="bank1" name="bank1">
                    <?php for ($i = 1; $i <= 20; $i++) { ?>
                        <option value="<?php echo $i; ?>"><?php echo getbank($i); ?></option>
                    <?php } ?>
                </select>
            </div>
            <div>
                <label for="bank2">Select Bank 2:</label>
                <select id="bank2" name="bank2">
                    <?php for ($i = 1; $i <= 20; $i++) { ?>
                        <option value="<?php echo $i; ?>"><?php echo getbank($i); ?></option>
                    <?php } ?>
                </select>
            </div>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
