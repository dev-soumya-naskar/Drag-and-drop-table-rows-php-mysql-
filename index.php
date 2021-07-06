<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drag & Drop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

</head>
<?php require_once('config.php');
$sql = "Select * FROM sorting_record order by display_order";
$datas = $mysqli->query($sql);
?>

<body>
    <div class="container">
        <h3 class="text-center">Dynamic Drag and Drop table rows</h3>
        <table class="table table-bordered" id="mytable">
            <thead>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
            </thead>
            <tbody class="row_position">
                <?php while ($data = $datas->fetch_assoc()) { ?>
                <tr
                    id="<?php echo $data['id']?>">
                    <td><?php echo $data['id']; ?>
                    </td>
                    <td><?php echo $data['name']; ?>
                    </td>
                    <td><?php echo $data['description']; ?>
                    </td>
                </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>


</body>
<script type="text/javascript">
    $(".row_position").sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $(".row_position>tr").each(function() {
                selectedData.push($(this).attr("id"));
            });
            updateOrder(selectedData);
        }
    });

    function updateOrder(aData) {
        $.ajax({
            url: 'ajaxPost.php',
            type: 'POST',
            data: {
                allData: aData
            },
            success: function() {
                alert("Your change successfully saved");
            }
        });
    }
</script>

</html>