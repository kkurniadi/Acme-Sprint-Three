<!doctype html>
<html lang="en">

<head>
    <?php
    include_once('head.php');
    ?>
    <title>All Artists | Acme Art Gallery</title>
</head>

<body>
    <?php
    include_once('inc_nav.php');
    ?>
    <!-- START PHP -->
    <?php
    session_start();
    if (isset($_SESSION['message'])) {
    ?>
        <div class="alert alert-info text-center" style="margin-top:20px;">
            <?php echo $_SESSION['message']; ?>
        </div>
    <?php

        unset($_SESSION['message']);
    }
    ?>
    <!-- FINISH PHP-->

    <!--Start of table.-->
    <div class="container-fluid" id="containerStyle">
        <!--Testing Search bar Start -->
        <form class="d-flex mt-3" role="search" action="all_artists.php" method="GET">
            <input class="form-control me-2" type="text" name="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-success" type="submit">Search</button>
        </form>
        <!--Search Bar Finish -->
        <table class="table table-hover" style="margin-top:20px;">
            <thead class="table-secondary">
                <th>ID</th>
                <th>Artist</th>
                <th>Lifespan</th>
                <th>Thumbnail</th>
            </thead>
            <?php
            $search = $_GET['search'];
            include_once('connection.php');
            $database = new Connection();
            $db = $database->open();
            try {
                $sql = "SELECT Id, Artist, Lifespan, Painting FROM Artist_Data WHERE Artist LIKE '%$search%'";
                $row = $db->query($sql);
                foreach ($db->query($sql) as $row) {
            ?>
                    <tr>
                        <td><?php echo $row['Id']; ?></td>
                        <td><?php echo $row['Artist']; ?></td>
                        <td><?php echo $row['Lifespan']; ?></td>
                        <td><?php echo '<img class="thumb" src="data:image/png;base64,' . base64_encode($row['Painting']) . '"/>'; ?></td>
                    </tr>
            <?php
                }
            } catch (PDOException $e) {
                echo "There is some problem in connection: " . $e->getMessage();
            }
            $database->close();
            ?>
            </tbody>
        </table>
    </div>
    <?php
    include_once('footer.php');
    ?>
</body>

</html>