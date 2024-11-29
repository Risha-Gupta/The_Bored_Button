<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bored_button";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}

$sql = "CREATE TABLE IF NOT EXISTS game_scores (
id INT AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(255) NOT NULL,
score INT NOT NULL,
timestamp DATETIME DEFAULT CURRENT_TIMESTAMP
)";

if (!mysqli_query($conn, $sql)) {
die("Error creating table: " . mysqli_error($conn));
}

if (isset($_POST['save_score']) && isset($_SESSION['user_email'])) 
{
$email = mysqli_real_escape_string($conn, $_SESSION['user_email']);
$score = intval($_POST['final_score']);

// Check if the email already exists
$check_sql = "SELECT score FROM game_scores WHERE email = '$email'";
$result = mysqli_query($conn, $check_sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $existing_score = $row['score'];
    
    // If new score is higher, update the record
    if ($score > $existing_score) {
        $update_sql = "UPDATE game_scores SET score = $score, timestamp = CURRENT_TIMESTAMP WHERE email = '$email'";
        if(mysqli_query($conn, $update_sql)) {
            echo "<script>alert('Score updated successfully!');</script>";
        } else {
            echo "<script>alert('Error updating score: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Your previous score was higher. Score not updated.');</script>";
    }
} 
else {

    $insert_sql = "INSERT INTO game_scores (email, score) VALUES ('$email', $score)";
    if(mysqli_query($conn, $insert_sql)) {
        echo "<script>alert('Score saved successfully!');</script>";
    } else {
        echo "<script>alert('Error saving score: " . mysqli_error($conn) . "');</script>";
    }
}
} 
else if (!isset($_SESSION['user_email'])) {
echo "<script>alert('Please login first!');</script>";
}


$leaderboard_sql = "SELECT email, score FROM game_scores ORDER BY score DESC LIMIT 10";
$leaderboard_result = mysqli_query($conn, $leaderboard_sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Celebrity Quiz Game</title>
<style>

#game-container {
position: relative;
width: 100%;
max-width: 800px;
margin: 0 auto;
padding: 20px;
box-sizing: border-box;
}


#leaderboard {
position: absolute;
top: 100%;
left: 0;
width: 100%;
margin-top: 20px;
background-color: #f9f9f9;
border: 1px solid #ddd;
border-radius: 5px;
padding: 15px;
box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

#leaderboard h2 {
margin-top: 0;
color: #333;
}

#leaderboard table {
width: 100%;
border-collapse: collapse;
}

#leaderboard th,
#leaderboard td {
padding: 10px;
text-align: left;
border-bottom: 1px solid #ddd;
}

#leaderboard th {
background-color: #f2f2f2;
font-weight: bold;
}

#leaderboard tr:last-child td {
border-bottom: none;
}


@media (max-width: 600px) {
#leaderboard {
    position: static;
    margin-top: 20px;
}
}


#view-leaderboard {
display: block;
width: 100%;
padding: 10px;
margin-top: 20px;
background-color: #4CAF50;
color: white;
border: none;
border-radius: 5px;
cursor: pointer;
font-size: 16px;
transition: background-color 0.3s;
}

#view-leaderboard:hover {
background-color: #45a049;
}
    #leaderboard {
        margin-top: 20px;
        text-align: left;
        display: none;
    }
    
    #leaderboard table {
        width: 100%;
        border-collapse: collapse;
    }
    
    #leaderboard th, #leaderboard td {
        border: 1px solid #ddd;
        padding: 8px;
    }
    
    #leaderboard th {
        background-color: #f2f2f2;
    }
    body {
        font-family: Times New Roman, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f4f4f4;
    }

    #game-container {
        text-align: center;
        background: white;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        width: 70%;
        max-width: 350px;
    }

    #celebrity-image {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
    }

    input[type="text"] {
        width: 80%;
        padding: 10px;
        margin-top: 15px;
        font-size: 16px;
    }

    button {
        padding: 10px 20px;
        margin: 10px 0;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        background-color: #007BFF;
        color: white;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }

    #feedback {
        margin: 10px 0;
        font-size: 16px;
        color: red;
    }

    #score {
        font-size: 18px;
        font-weight: bold;
        margin-top: 10px;
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
<div id="game-container">
    <h1>Celebrity Quiz Game</h1>
    <div id="quiz">
        <div id="image-container">
            <img id="celebrity-image" src="images/celebrity1-blur5.jpg" alt="Celebrity">
        </div>
        <input type="text" id="user-answer" placeholder="Enter celebrity name">
        <button id="submit-button">Submit</button>
        <p id="feedback"></p>
        <p id="score">Score: 0</p>
        <button id="next-level" style="display:none;">Next Level</button>
        
        
        <form method="POST" id="score-form" style="display:none;">
            <input type="hidden" name="save_score" value="1">
            <input type="hidden" name="final_score" id="final-score-input">
            <input type="submit" value="Save Score" class="button">
        </form>
    </div>
</div>
<div class="redirect-container">
    <button class="redirect-button" onclick="redirectToRandomGame()">
    </button>
    <span class="redirect-text">Bored again?<br>Click to redirect</span>
</div> 
<div id="game-container">        
    <button id="view-leaderboard">View Leaderboard</button>
    
    <div id="leaderboard">
        <h2>Leaderboard</h2>
        <table>
            <tr>
                <th>Email</th>
                <th>Score</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($leaderboard_result)) {
                echo "<tr><td>" . htmlspecialchars($row['email']) . "</td><td>" . $row['score'] . "</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

<script>
    const celebrities = [{ name: "cillian murphy", images: ["images/cillian_murphy_1.png", "images/cillian_murphy_2.png", "images/cillian_murphy_3.png", "images/cillian_murphy_4.png", "images/cillian_murphy_5.jpeg"] },
{ name: "dwayne johnson", images: ["images/dwayne_johnson_1.png", "images/dwayne_johnson_2.png", "images/dwayne_johnson_3.png", "images/dwayne_johnson_4.png", "images/dwayne_johnson_5.jpeg"] },
{ name: "florence pugh", images: ["images/florence_pugh_1.png", "images/florence_pugh_2.png", "images/florence_pugh_3.png", "images/florence_pugh_4.png", 
"images/florence_pugh_5.jpeg"] },
{ name: "keanu reeves", images: ["images/keanu_reeves_1.png", "images/keanu_reeves_2.png", "images/keanu_reeves_3.png", "images/keanu_reeves_4.png", 
"images/keanu_reeves_5.jpg"] },
{ name: "taylor swift", images: ["images/taylor_swift_1.png", "images/taylor_swift_2.png", "images/taylor_swift_3.png", "images/taylor_swift_4.png", 
"images/taylor_swift_5.jpeg"] },
{ name: "jasprit bumrah", images: ["images/jasprit_bumrah_1.png", "images/jasprit_bumrah_2.png", "images/jasprit_bumrah_3.png", "images/jasprit_bumrah_4.png", "images/jasprit_bumrah_5.jpeg"] }
        
    ];

    let currentLevel = 0;
    let currentCelebrity = 0;
    let attemptsLeft = 5;
    let score = 0;

    const imageContainer = document.getElementById("celebrity-image");
    const userAnswer = document.getElementById("user-answer");
    const submitButton = document.getElementById("submit-button");
    const feedback = document.getElementById("feedback");
    const scoreDisplay = document.getElementById("score");
    const nextLevelButton = document.getElementById("next-level");
    const scoreForm = document.getElementById("score-form");
    const finalScoreInput = document.getElementById("final-score-input");

    function updateImage() {
        if (currentCelebrity < celebrities.length && attemptsLeft > 0) {
            const imageIndex = Math.max(0, Math.min(4, 5 - attemptsLeft));
            imageContainer.src = celebrities[currentCelebrity].images[imageIndex];
        }
    }

    function checkAnswer() {
        const answer = userAnswer.value.trim().toLowerCase();
        if (answer === celebrities[currentCelebrity].name) {
            feedback.textContent = "Correct!";
            score += attemptsLeft;
            scoreDisplay.textContent = `Score: ${score}`;
            nextLevelButton.style.display = "block";
            submitButton.disabled = true;
        } else {
            attemptsLeft--;
            if (attemptsLeft > 0) {
                feedback.textContent = `Wrong! Try again. Attempts left: ${attemptsLeft}`;
                updateImage();
            } else {
                feedback.textContent = "Out of attempts! Moving to the next level.";
                nextLevelButton.style.display = "block";
                submitButton.disabled = true;
            }
        }
    }

    function loadNextLevel() {
        currentCelebrity++;
        if (currentCelebrity < celebrities.length) {
            attemptsLeft = 5;
            feedback.textContent = "";
            userAnswer.value = "";
            updateImage();
            nextLevelButton.style.display = "none";
            submitButton.disabled = false;
        } else {
            feedback.textContent = `Game Over! Final Score: ${score}`;
            nextLevelButton.style.display = "none";
            submitButton.style.display = "none";
                document.getElementById('score-form').style.display = 'block';
            document.getElementById('final-score-input').value = score;
        }
    }

    submitButton.addEventListener("click", checkAnswer);
    nextLevelButton.addEventListener("click", loadNextLevel);

    updateImage();

const games = ['guessceleb.php', 'program.php', 'life_checklist.php', 'billgates.php', 'tictactoe.php', 'letssettlethis.php'];
let remainingGames = [...games];
function redirectToRandomGame() {
const currentGame = window.location.pathname.split('/').pop(); 
const availableGames = remainingGames.filter(game => game !== currentGame); 

if (availableGames.length === 0) {
    remainingGames = [...games]; 
}

const randomIndex = Math.floor(Math.random() * availableGames.length); 
const randomGame = availableGames[randomIndex]; 
remainingGames = remainingGames.filter(game => game !== randomGame); 

window.location.href = randomGame; 
}
document.getElementById('view-leaderboard').addEventListener('click', function() {
        var leaderboard = document.getElementById('leaderboard');
        if (leaderboard.style.display === 'none' || leaderboard.style.display === '') {
            leaderboard.style.display = 'block';
            this.textContent = 'Hide Leaderboard';
        } else {
            leaderboard.style.display = 'none';
            this.textContent = 'View Leaderboard';
        }
    });
</script>

<?php
mysqli_close($conn);
?>
</body>
</html>