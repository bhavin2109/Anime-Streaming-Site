<?php
    include '../includes/dbconnect.php';
    
    // Fetch all anime from database
    $query = "SELECT * FROM anime ORDER BY id DESC";
    $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime Management</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-decoration-line: none;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Left Sidebar - 20% */
        .sidebar {
            width: 20%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }

        .sidebar-header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            margin-bottom: 30px;
        }

        .sidebar-header h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .nav-menu {
            list-style: none;
        }

        .nav-menu li {
            margin-bottom: 10px;
        }

        .nav-menu a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .nav-menu a:hover,
        .nav-menu a.active {
            background-color: rgba(255,255,255,0.2);
        }

        /* Main Content - 80% */
        .main-content {
            width: 100%;
            padding: 30px;
            overflow-y: auto;
        }

        .content-header {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .content-header h1 {
            color: #333;
            font-size: 28px;
        }

        .add-anime-btn {
            background: #667eea;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .add-anime-btn:hover {
            background: #5a6fd8;
        }

        .anime-table {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .anime-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .anime-table th,
        .anime-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .anime-table th {
            background: #f8f9fa;
            font-weight: 600;
            color: #333;
        }

        .anime-table tr:hover {
            background: #f8f9fa;
        }

        .thumbnail-img {
            width: 60px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-ongoing {
            background: #e3f2fd;
            color: #1976d2;
        }

        .status-completed {
            background: #e8f5e8;
            color: #388e3c;
        }

        .status-upcoming {
            background: #fff3e0;
            color: #f57c00;
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 5px;
        }

        .edit-btn {
            background-color: #ffc107;
            color: #333;
            padding: 8px 15px;
            border: 1px solid black;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .edit-btn:hover {
            background: #e0a800;
        }

        .delete-btn {
            background: #dc3545;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .delete-btn:hover {
            background: #c82333;
        }

        .no-data {
            text-align: center;
            padding: 50px;
            color: #666;
        }
    </style>
</head>
<body>
   
        <!-- Main Content -->
        <div class="main-content">
            <div class="content-header">
                <h1>Anime Management</h1>
                <a href="add_anime.php" class="add-anime-btn">Add New Anime</a>
            </div>

            <div class="anime-table">
                <?php if(mysqli_num_rows($result) > 0): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Thumbnail</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Genre</th>
                                <th>Release Year</th>
                                <th>Status</th>
                                <th>Episodes</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td>
                                        <?php if($row['thumbnail_url']): ?>
                                            <img src="<?php echo $row['thumbnail_url']; ?>" alt="<?php echo $row['title']; ?>" class="thumbnail-img">
                                        <?php else: ?>
                                            <div style="width: 60px; height: 80px; background: #eee; border-radius: 5px; display: flex; align-items: center; justify-content: center; color: #999;">No Image</div>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                                    <td><?php echo htmlspecialchars(substr($row['description'], 0, 100)) . (strlen($row['description']) > 100 ? '...' : ''); ?></td>
                                    <td><?php echo htmlspecialchars($row['genre']); ?></td>
                                    <td><?php echo $row['release_year']; ?></td>
                                    <td>
                                        <span class="status-badge status-<?php echo $row['status']; ?>">
                                            <?php echo ucfirst($row['status']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php
                                            // Count episodes for this anime (assuming you have an episodes table)
                                            $episode_query = "SELECT COUNT(*) as episode_count FROM episodes WHERE anime_id = " . $row['id'];
                                            $episode_result = mysqli_query($conn, $episode_query);
                                            $episode_data = mysqli_fetch_assoc($episode_result);
                                            echo $episode_data['episode_count'] ?? '0';
                                        ?>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="edit_anime.php?id=<?php echo $row['id']; ?>" class="btn-edit">Edit</a>
                                            <a href="delete_anime.php?id=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this anime?')">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="no-data">No anime found</div>
                <?php endif; ?>
            </div>
        </div>