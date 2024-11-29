<!DOCTYPE html>
<html lang="en">
<head>
    <title>Programmer or Serial Killer?</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Creepster&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
<style>
body 
{
    background-image: url("images/Designer.jpeg");
    background-size: cover;
    font-family: "roboto";
    font-size: 20px;
    background-color: #1a1a1a;
    color: #ffffff;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.main-head
{
    font-family:"Creepster", system-ui;
    font-size: 44px;
}

.game-contain 
{
    text-align: center;
    background-color: #2a2a2a;
    padding: 2rem;
    border-radius: 10px;
    max-width: 600px;
    width: 100%;
}

h1 
{
    color: #4caf50;
}

.red 
{
    color: #f44336;
}
button 
{
    background-color: #4caf50;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 5px;
}

button:hover 
{
    background-color: #45a049;
}

button:disabled 
{
    background-color: #cccccc;
    cursor: not-allowed;
}

.button-container 
{
    display: flex;
    justify-content: space-around;
    margin-top: 1rem;
}

#person-image 
{
    max-width: 100%;
    height: auto;
    margin-bottom: 1rem;
}

#result, #score 
{
    margin-top: 1rem;
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
    <div class="game-contain">
        <h1 class="main-head">Programmer or <span class="red">Serial Killer?</span></h1>
        <div id="start-screen">
            <p>Can you tell a coder from a killer? Test your knowledge in this mysterious game of recognition...</p>
            <button id="start-button">Start Game</button>
        </div>
        <div id="game-screen" style="display: none;">
            <img id="person-image" src="" alt="Mystery person">
            <div class="button-container">
                <button id="programmer-button">Programmer</button>
                <button id="killer-button">Serial Killer</button>
            </div>
            <div id="result"></div>
            <div id="score"></div>
            <button id="next-button" style="display: none;">Next</button>
        </div>
        <div id="end-screen" style="display: none;">
            <h2>Game Over!</h2>
            <p id="final-score"></p>
            <button id="play-again-button">Play Again</button>
        </div>
    </div>
    <div class="redirect-container">
        <button class="redirect-button" onclick="redirectToRandomGame()">
        </button>
        <span class="redirect-text">Bored again?<br>Click to redirect</span>
    </div> 
    <script>
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


const people = 
[
    {
        name: "Dennis Ritchie",
        image: "images/dennis.jpg",
        isProgrammer: true,
        description: "Created the C programming language and co-developed Unix"
    },
    {
        name: "Dorothea Puente",
        image: "images/Dorothea-Puente_01.jpg",
        isProgrammer: false,
        description: 'Her total count had reached nine murders. Newspapers dubbed Puente the "Death House Landlady"'
    },
    {
        name: "John Christie",
        image: "images/john.jpeg",
        isProgrammer: false,
        description: "A British serial killer active in the mid-20th century, notorious for crimes at 10 Rillington Place."
    },
    {
        name: "Robert Hansen",
        image: "images/robert hansen.jpg",
        isProgrammer: false,
        description: 'An American serial killer known as the "Butcher Baker," who targeted people in Alaska.'
    },
    {
        name: "Guido Van Rossum",
        image: "images/guido.jpg",
        isProgrammer: true,
        description: "The creator of the Python programming language, widely used in modern software development."
    },
    {
        name: "Bertrand Meyer",
        image: "images/bertrand.jpg",
        isProgrammer: true,
        description: "A computer scientist known for developing the Eiffel programming language and promoting software engineering principles like Design by Contract."
    },
    {
        name: "Tsutomu Miyazaki",
        image: "images/tsutomu.jpg",
        isProgrammer: false,
        description: "A Japanese criminal infamous for a series of heinous acts in the late 1980s."
    },
    {
        name: "Anatoly Onoprienko",
        image: "images/anatoly.jpg",
        isProgrammer: false,
        description: "A Ukrainian criminal responsible for numerous violent acts during the 1990s."
    },
    {
        name: "Bjarne Stroustrup",
        image: "images/bjarne.jpg",
        isProgrammer: true,
        description: "The creator of C++, a foundational programming language in modern computing."
    },
    {
        name: "Jean E. Sammet",
        image: "images/jean E.jpg",
        isProgrammer: true,
        description: "A pioneering computer scientist who developed the COBOL programming language and advanced programming language design."
    },
    
];

let currentRound = 0;
let score = 0;
const totalRounds = 10;

const startScreen = document.getElementById('start-screen');
const gameScreen = document.getElementById('game-screen');
const endScreen = document.getElementById('end-screen');
const startButton = document.getElementById('start-button');
const programmerButton = document.getElementById('programmer-button');
const killerButton = document.getElementById('killer-button');
const nextButton = document.getElementById('next-button');
const playAgainButton = document.getElementById('play-again-button');
const personImage = document.getElementById('person-image');
const resultDiv = document.getElementById('result');
const scoreDiv = document.getElementById('score');
const finalScoreDiv = document.getElementById('final-score');

function startGame() 
{
    startScreen.style.display = 'none';
    gameScreen.style.display = 'block';
    endScreen.style.display = 'none';
    currentRound = 0;
    score = 0;
    shuffleArray(people);
    loadPerson();
}

function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
}

function loadPerson() 
{
    const person = people[currentRound];
    personImage.src = person.image;
    resultDiv.innerHTML = '';
    scoreDiv.textContent = `Score: ${score}/${totalRounds}`;
    nextButton.style.display = 'none';
    programmerButton.disabled = false;
    killerButton.disabled = false;
}

function checkAnswer(isProgrammer) 
{
    const person = people[currentRound];
    programmerButton.disabled = true;
    killerButton.disabled = true;

    if (isProgrammer === person.isProgrammer) 
    {
        score++;
        resultDiv.innerHTML = '<p style="color: #4caf50;">Correct!</p>';
    } 
    else 
    {
        resultDiv.innerHTML = '<p style="color: #f44336;">Wrong!</p>';
    }

    resultDiv.innerHTML += 
    `<p>${person.name}</p>
    <p>${person.description}</p>`;

    scoreDiv.textContent = `Score: ${score}/${totalRounds}`;

    if (currentRound < totalRounds - 1) 
    {
        nextButton.style.display = 'inline-block';
    }
    else 
    {
        endGame();
    }
}

function nextRound() 
{
    currentRound++;
    loadPerson();
}

function endGame() 
{
    gameScreen.style.display = 'none';
    endScreen.style.display = 'block';
    finalScoreDiv.textContent = `Your final score: ${score} out of ${totalRounds}`;
}

startButton.addEventListener('click', startGame);
programmerButton.addEventListener('click', () => checkAnswer(true));
killerButton.addEventListener('click', () => checkAnswer(false));
nextButton.addEventListener('click', nextRound);
playAgainButton.addEventListener('click', startGame);


    </script>
</body>
</html>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bored_button";

$conn = mysqli_connect($servername, $username, $password);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
mysqli_query($conn, $sql);
mysqli_select_db($conn, $dbname);

$sql = "CREATE TABLE IF NOT EXISTS programmer_vs_serial_killer (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    email_id VARCHAR(255) NOT NULL,
    final_score INT NOT NULL,
    time_stamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (email_id) REFERENCES users(email) ON DELETE CASCADE
)";
mysqli_query($conn, $sql);

if (isset($_POST['submit_score'])) {
    $email = $_POST['email'];
    $final_score = $_POST['final_score'];

    if (!empty($email) && !empty($final_score)) {
        
        $sql = "SELECT id FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $user_id = $row['id'];

            $sql = "INSERT INTO programmer_vs_serial_killer (user_id, email_id, final_score) VALUES ('$user_id', '$email', '$final_score')";
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Score submitted successfully!');</script>";
            } else {
                echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
            }
        } else {
            echo "<script>alert('Error: User not found.');</script>";
        }
    } else {
        echo "<script>alert('Please fill in all fields.');</script>";
    }
}

mysqli_close($conn);
?>