<?php
$id = $_GET['id'];
$pres = new PrestationModel();
$table = 'table' . $id;
?>
<table id="<?php echo $table; ?>">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Categorie</th>
            <th>Prix</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $prpr = $pres->getPrestations($id);
        for ($i = 0; $i < sizeof($prpr); $i++) {
            echo '<tr>';
            echo '<td>' . $prpr[$i]->nom . '</td>';
            echo '<td>' . $prpr[$i]->categorie . '</td>';
            if ($prpr[$i]->prix == null) {
                echo '<td>' . '?' . '</td>';
            } else {
                echo '<td>' . $prpr[$i]->prix . '</td>';
            }


            echo '</tr>';
        }
        ?>
    </tbody>
</table>