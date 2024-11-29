<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bored_button";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql = "CREATE TABLE IF NOT EXISTS life_checklist (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    checklist_items VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if (!mysqli_query($conn, $sql)) {
    die("Error creating table: " . mysqli_error($conn));
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['checklist'])) {
    $email = $_SESSION['user_email'];
    $choices = $_POST['checklist'];

   
    $clear_sql = "DELETE FROM life_checklist WHERE email=?";
    $stmt_clear = $conn->prepare($clear_sql);
    $stmt_clear->bind_param("s", $email);
    $stmt_clear->execute();


    $stmt = $conn->prepare("INSERT INTO life_checklist (email, checklist_items) VALUES (?, ?)");
    foreach ($choices as $choice) {
        $stmt->bind_param("ss", $email, $choice);
        if (!$stmt->execute()) {
            die("Error inserting data: " . $stmt->error);
        }
    }
    $stmt->close();

    echo "<script>alert('Checklist submitted successfully!');</script>";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Life Checklist</title>
  <style>
    body 
    {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-image: url(images/checklist.jpeg);
      background-size: cover;
      background-position: center;
      color: #333;
    }

    .container 
    {
      max-width: 900px;
      margin: 20px auto;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
    }

    h1 
    {
      text-align: center;
      margin-bottom: 20px;
    }

    .checklist-grid 
    {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 10px;
    }

    .checklist-item 
    {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .checklist-item input[type="checkbox"] 
    {
      width: 20px;
      height: 20px;
      cursor: pointer;
    }
    .checklist-item label 
    {
      cursor: pointer;
      transition: color 0.3s ease;
    }

    .checklist-item input[type="checkbox"]:checked + label 
    {
      color: green;
      font-weight: bold;
    }

    .btn-submit 
    {
      display: block;
      width: 100%;
      margin-top: 20px;
      padding: 10px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }

    .btn-submit:hover
    {
      background-color: #0056b3;
    }

    .completed-count 
    {
      text-align: center;
      margin-top: 20px;
      font-size: 18px;
    }
    .redirect-container 
{
    position: fixed;
    top: 20px;
    right: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.redirect-button 
{
    width: 64px;
    height: 64px;
    border-radius: 50%;
    background-image: url("images/button.jpg");
    background-position: center;
    background-size: 100%;
    border: none;
    cursor: pointer;
    transition: transform 0.3s ease;
}
.redirect-button:hover 
{
    transform: scale(1.1);
}
.redirect-icon 
{
    width: 55px;
    height: 55px;
}
.redirect-text 
{
    margin-top: 8px;
    font-size: 14px;
    font-weight: bold;
    color: black;
    text-align: center;
}
  </style>
</head>
<body>
  <div class="container">
    <h1>Life Checklist</h1>
    <form id="lifeChecklistForm" method="POST">
      <div class="checklist-grid">
        <div class="checklist-item">
          <input type="checkbox" name="checklist[]" value="Be born" id="born">
          <label for="born">Be born</label>
        </div>
        <div class="checklist-item">
          <input type="checkbox" name="checklist[]" value="Take first steps" id="first-steps">
          <label for="first-steps">Take first steps</label>
        </div>
        <div class="checklist-item">
          <input type="checkbox" name="checklist[]" value="Say first words" id="first-words">
          <label for="first-words">Say first words</label>
        </div>
        <div class="checklist-item">
          <input type="checkbox" name="checklist[]" value="Learn to swim" id="learn-swim">
          <label for="learn-swim">Learn to swim</label>
        </div>
        <div class="checklist-item">
          <input type="checkbox" name="checklist[]" value="Play an instrument" id="play-instrument">
          <label for="play-instrument">Play an instrument</label>
        </div>
        <div class="checklist-item">
          <input type="checkbox" name="checklist[]" value="Go camping" id="go-camping">
          <label for="go-camping">Go camping</label>
        </div>
        <div class="checklist-item">
          <input type="checkbox" name="checklist[]" value="Go to a concert" id="go-concert">
          <label for="go-concert">Go to a concert</label>
        </div>
        <div class="checklist-item">
          <input type="checkbox" name="checklist[]" value="Fly in a plane" id="fly-plane">
          <label for="fly-plane">Fly in a plane</label>
        </div>
        <div class="checklist-item">
          <input type="checkbox" name="checklist[]" value="Ride a boat" id="ride-boat">
          <label for="ride-boat">Ride a boat</label>
        </div>
        <div class="checklist-item">
          <input type="checkbox" name="checklist[]" value="See the ocean" id="see-ocean">
          <label for="see-ocean">See the ocean</label>
        </div>
        <div class="checklist-item">
          <input type="checkbox" name="checklist[]" value="See snow" id="see-snow">
          <label for="see-snow">See snow</label>
        </div>
        <div class="checklist-item">
          <input type="checkbox" name="checklist[]" value="Plant a tree" id="plant-tree">
          <label for="plant-tree">Plant a tree</label>
        </div>
        <div class="checklist-item">
          <input type="checkbox" name="checklist[]" value="Climb a mountain" id="climb-mountain">
          <label for="climb-mountain">Climb a mountain</label>
        </div>
        <div class="checklist-item">
          <input type="checkbox" name="checklist[]" value="Vote in an election" id="vote-election">
          <label for="vote-election">Vote in an election</label>
        </div>
        <div class="checklist-item">
          <input type="checkbox" name="checklist[]" value="Learn another language" id="learn-language">
          <label for="learn-language">Learn another language</label>
        </div>
      </div>
      <button type="submit" class="btn-submit">Submit Checklist</button>
    </form>
    <div class="completed-count" id="completedCount">
      You've completed <span id="count">0</span> items.
    </div>
  </div>
  <div class="redirect-container">
    <button class="redirect-button" onclick="redirectToRandomGame()">
    </button>
    <span class="redirect-text">Bored again?<br>Click to redirect</span>
</div> 
  <script>
    const checklistForm = document.getElementById('lifeChecklistForm');
    const checkboxes = checklistForm.querySelectorAll('input[type="checkbox"]');
    const countDisplay = document.getElementById('count');

    checkboxes.forEach(checkbox => {
      checkbox.addEventListener('change', () => {
        const completedCount = [...checkboxes].filter(cb => cb.checked).length;
        countDisplay.textContent = completedCount;
      });
    });

    const games = ['guessceleb.php', 'program.php', 'life_checklist.php', 'billgates.php', 'tictactoe.php', 'letssettlethis.php'];
    let remainingGames = [...games];

function redirectToRandomGame() 
{
    const currentGame = window.location.pathname.split('/').pop(); 
    const availableGames = remainingGames.filter(game => game !== currentGame); 
    if (availableGames.length === 0) 
    {
        remainingGames = [...games]; 
    }

    const randomIndex = Math.floor(Math.random() * availableGames.length); 
    const randomGame = availableGames[randomIndex]; 
    remainingGames = remainingGames.filter(game => game !== randomGame); 
    window.location.href = randomGame; 
}
  </script>
</body>
</html>
