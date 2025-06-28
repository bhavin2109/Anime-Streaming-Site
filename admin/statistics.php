<?php
    include '../includes/dbconnect.php';
    
    // Fetch statistics from database
    $total_anime_query = "SELECT COUNT(*) as total FROM anime";
    $total_users_query = "SELECT COUNT(*) as total FROM users";
    $total_episodes_query = "SELECT COUNT(*) as total FROM episodes";
    
    $total_anime_result = mysqli_query($conn, $total_anime_query);
    $total_users_result = mysqli_query($conn, $total_users_query);
    $total_episodes_result = mysqli_query($conn, $total_episodes_query);
    
    $total_anime = mysqli_fetch_assoc($total_anime_result)['total'];
    $total_users = mysqli_fetch_assoc($total_users_result)['total'];
    $total_episodes = mysqli_fetch_assoc($total_episodes_result)['total'];
    
    // Fetch recent activities
    $recent_activities_query = "SELECT * FROM anime ORDER BY id DESC LIMIT 5";
    $recent_activities_result = mysqli_query($conn, $recent_activities_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Statistics</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            padding: 20px;
        }

        .content-header {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .content-header h1 {
            color: #333;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card h3 {
            color: #667eea;
            font-size: 36px;
            margin-bottom: 10px;
        }

        .stat-card p {
            color: #666;
            font-size: 16px;
        }

        .recent-activity {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .recent-activity h2 {
            color: #333;
            margin-bottom: 20px;
            font-size: 20px;
        }

        .activity-item {
            padding: 15px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            background: #667eea;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: white;
        }

        .activity-details h4 {
            color: #333;
            margin-bottom: 5px;
        }

        .activity-details p {
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="content-header">
        <h1>Dashboard Overview</h1>
        <p>Welcome to your anime streaming site administration panel</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <h3><?php echo $total_anime; ?></h3>
            <p>Total Anime</p>
        </div>
        <div class="stat-card">
            <h3><?php echo $total_users; ?></h3>
            <p>Registered Users</p>
        </div>
        <div class="stat-card">
            <h3><?php echo $total_episodes; ?></h3>
            <p>Total Episodes</p>
        </div>
        
    </div>

    <div class="recent-activity">
        <h2>Recent Activities</h2>
        <?php if(mysqli_num_rows($recent_activities_result) > 0): ?>
            <?php while($activity = mysqli_fetch_assoc($recent_activities_result)): ?>
                <div class="activity-item">
                    <div class="activity-icon">
                        📺
                    </div>
                    <div class="activity-details">
                        <h4><?php echo htmlspecialchars($activity['title']); ?></h4>
                        <p>Added on <?php echo date('M d, Y', strtotime($activity['created_at'])); ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="color: #666; text-align: center; padding: 20px;">No recent activities</p>
        <?php endif; ?>
    </div>
</body>
</html>
