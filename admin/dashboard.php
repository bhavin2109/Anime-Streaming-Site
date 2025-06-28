<?php
    include '../includes/dbconnect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            scrollbar-width: none;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            
        }

        .dashboard-container {
            display: grid;
            grid-template-columns: 20% 80%;
            min-height: 100vh;
            overflow: hidden;
        }

        /* Left Sidebar - 20% */
        .sidebar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            overflow-y: hidden;
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
            display: block;
            padding: 15px 20px;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            background: rgba(255,255,255,0.1);
            cursor: pointer;
        }

        .nav-menu a:hover {
            background: rgba(255,255,255,0.2);
            transform: translateX(5px);
        }

        .nav-menu a.active {
            background: rgba(255,255,255,0.3);
            border-left: 4px solid #fff;
        }

        /* Main Content - 80% */
        .main-content {
            padding: 0;
            overflow-y: auto;
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

        /* iframe styles */
        .content-iframe {
            width: 100%;
            height: 100%;
            min-height: 100vh;
            border: none;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <section class="dashboard-container">
        <!-- Left Sidebar -->
        <aside class="sidebar">
            <header class="sidebar-header">
                <h2>Admin Panel</h2>
                <p>Welcome, Senpai</p>
            </header>
            
            <nav>
                <ul class="nav-menu">
                    <li><a href="statistics.php" target="mainFrame" class="nav-link active">Dashboard</a></li>
                    <li><a href="anime.php" target="mainFrame" class="nav-link">Anime</a></li>
                    <li><a href="users.php" target="mainFrame" class="nav-link">Users</a></li>
                    <li><a href="analytics.php" target="mainFrame" class="nav-link">Analytics</a></li>
                    <li><a href="settings.php" target="mainFrame" class="nav-link">Settings</a></li>
                    <li><a href="feedbacks.php" target="mainFrame" class="nav-link">Feedbacks</a></li>
                    <li><a href="../logout.php" class="nav-link">Logout</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <iframe name="mainFrame" src="statistics.php" class="content-iframe"></iframe>
        </main>
    </section>

    <script>
        // Handle navigation and active states
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    // Remove active class from all links
                    navLinks.forEach(l => l.classList.remove('active'));
                    
                    // Add active class to clicked link
                    this.classList.add('active');
                });
            });
        });
    </script>
</body>
</html>
