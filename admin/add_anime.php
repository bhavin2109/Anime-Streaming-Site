<?php
    include '../includes/dbconnect.php';
    
    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $genre = mysqli_real_escape_string($conn, $_POST['genre']);
        $release_year = mysqli_real_escape_string($conn, $_POST['release_year']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        $thumbnail_url = mysqli_real_escape_string($conn, $_POST['thumbnail_url']);
        
        // Insert into database
        $query = "INSERT INTO anime (title, description, genre, release_year, status, thumbnail_url) 
                  VALUES ('$title', '$description', '$genre', '$release_year', '$status', '$thumbnail_url')";
        
        if (mysqli_query($conn, $query)) {
            header("Location: anime.php?success=1");
            exit();
        } else {
            $error = "Error: " . mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Anime</title>
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


        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .btn-group {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn-submit {
            background: #667eea;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background: #5a6fd8;
        }

        .btn-cancel {
            background: #6c757d;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-cancel:hover {
            background: #5a6268;
        }

        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }

        .preview-image {
            max-width: 200px;
            max-height: 200px;
            margin-top: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="content-header">
        <h1>Add New Anime</h1>
        <p>Fill in the details below to add a new anime to your collection</p>
    </div>

    <div class="form-container">
        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="title">Anime Title *</label>
                <input type="text" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="description">Description *</label>
                <textarea id="description" name="description" required></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="genre">Genre *</label>
                    <select id="genre" name="genre" required>
                        <option value="">Select Genre</option>
                        <option value="Action">Action</option>
                        <option value="Adventure">Adventure</option>
                        <option value="Comedy">Comedy</option>
                        <option value="Drama">Drama</option>
                        <option value="Fantasy">Fantasy</option>
                        <option value="Horror">Horror</option>
                        <option value="Mystery">Mystery</option>
                        <option value="Romance">Romance</option>
                        <option value="Sci-Fi">Sci-Fi</option>
                        <option value="Seinen">Seinen</option>
                        <option value="Slice of Life">Slice of Life</option>
                        <option value="Shounen">Shounen</option>
                        <option value="Sports">Sports</option>
                        <option value="Supernatural">Supernatural</option>
                        <option value="Thriller">Thriller</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="release_year">Release Year *</label>
                    <input type="number" id="release_year" name="release_year" min="1900" max="2030" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="status">Status *</label>
                    <select id="status" name="status" required>
                        <option value="">Select Status</option>
                        <option value="ongoing">Ongoing</option>
                        <option value="completed">Completed</option>
                        <option value="upcoming">Upcoming</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="thumbnail_url">Thumbnail URL</label>
                    <input type="url" id="thumbnail_url" name="thumbnail_url" placeholder="https://example.com/image.jpg">
                </div>
            </div>

            <?php if (isset($_POST['thumbnail_url']) && !empty($_POST['thumbnail_url'])): ?>
                <div class="form-group">
                    <img src="<?php echo htmlspecialchars($_POST['thumbnail_url']); ?>" class="preview-image" alt="Preview">
                </div>
            <?php endif; ?>

            <div class="btn-group">
                <button type="submit" class="btn-submit">Add Anime</button>
                <a href="anime.php" class="btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
