<?php
// Ensure the session is started only once
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'database.php';
include 'functions.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$rentedVideos = getRentedVideos($user_id);
?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Rented Videos</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Director</th>
                    <th>Release Year</th>
                    <th>Rent Date</th>
                    <th>Due</th>
                    <th>Days Rented</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($rentedVideos)): ?>
                    <?php foreach ($rentedVideos as $video): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($video['title']); ?></td>
                            <td><?php echo htmlspecialchars($video['director']); ?></td>
                            <td><?php echo htmlspecialchars($video['release_year']); ?></td>
                            <td><?php echo htmlspecialchars($video['rent_date']); ?></td>
                            <td><?php echo htmlspecialchars($video['return_date']); ?></td>
                            <td><?php echo htmlspecialchars($video['days']); ?></td>
                            <td><?php echo htmlspecialchars($video['cost']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No rented videos found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>