<!DOCTYPE html>
<html lang="en">
    <head>
    <title>Tic Tac Toe</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Pacifico&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" >
<style>
.comp
{
    color:white;
    font-family: "josefin sans", serif;
    padding-top: 20px;
    padding-bottom: 20px;
    background-color: #14bdac;
    line-height: 1;
    margin-top:0;
}

.head2
{
    padding-top:0px;
    font-family: "pacifico";
    color: white;
    font-size: 50px;
    padding-left: 50px;
    font-style:italic;
    font-weight:500;
}
.head
{
    padding-bottom: 0px;
    padding-left: 70px;
    font-weight: 230;
    font-size: 40px;
    font-style:italic;
}

.turn
{
    display:flex;
    justify-content: center;
    padding-top: 15px;
    align-items: start;
    margin-bottom:20px;
}

.fix2
{
    margin-top:0px;
    text-align:center;
    font-family: "josefin sans";
    background-color:#14bdac;
    padding-top:10px;
    padding-bottom:10px;
    font-weight:350;
    color: white;
    padding-left: 15px;
    padding-right:15px;
}

.turn-box1
{
    text-align:right;
    font-family: "josefin sans";
    color: white;
    padding-right: 15px;
    background-color:#0d867a;
    padding-left: 15px;
    padding-top: 13px;
    padding-bottom: 10px;
}

.turn-box2
{
    padding-top: 13px;
    font-family: "josefin sans";
    color: white;
    padding-left: 20px;
    background-color:#0d867a;
    padding-right: 15px;
    padding-left: 15px;
    padding-bottom: 10px;
}

body
{
    background-color:#3bd6c6;
}

.grid
{
    display:grid;
    grid-template-columns: repeat(3, 110px);
    grid-template-rows: repeat(3, 110px);
    gap: 5px;
    place-items: center;
    position: absolute;
    top:43%;
    left: 50%; 
    transform: translate(-50%, -20%);
}

.cell
{
    width: 110px;
    height: 110px;
    border: solid 5px;
    border-color: rgba(128, 128, 128, 0.349);

}

.cell:hover
{
    background-color: #14bdac;
}
.cell:active
{
    cursor: pointer;
    opacity: 0.5;
    transition: 0.15s opacity;
}

.buttons
{
    display:flex;
    justify-content:center;
    margin-top: 365px;
    flex-direction: row;
    gap: 100px;
}

.score
{
    font-family: "roboto";
    background-color:#0d867a;
    padding-top:12px;
    padding-bottom:10px;
    padding-left: 15px;
    padding-right: 15px;
    color: white;
    border-radius: 7px;
    word-spacing: 5px;
}

.modal 
{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.modal-message 
{
    background-color: #14bdac;
    font-family: "josefin sans", serif;
    color: white;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
}

.modal-buttons button {
    margin: 10px;
    padding: 10px 20px;
    font-size: 20px;
    border: none;
    border-radius: 5px;
    background-color: #0d867a;
    color: white;
    cursor: pointer;
}

.modal-buttons button:hover 
{
    background-color: #0b6c62;
}

.cell svg 
{
    display: block;
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
<div class="comp"><span class="head">Play Some</span><br><span class="head2">TicTacToe!</span></div>
    <div class="turn">
        <div class="turn-box1">X</div>
        <div><h3 class="fix2">Turn For</h3></div><br>
        <div class="turn-box2">O</div>
    </div>
    <div class="grid">
        <div class="cell"></div>
        <div class="cell"></div>
        <div class="cell"></div>
        <div class="cell"></div>
        <div class="cell"></div>
        <div class="cell"></div>
        <div class="cell"></div>
        <div class="cell"></div>
        <div class="cell"></div>
    </div>
    <div class="buttons">        
        <div class="score">Score: 0 - 0</div>
    </div>
    <div class="modal">
        <div class="modal-message">
            <h2>Choose Your Side:</h2>
            <div class="modal-buttons">
                <button class="choose-x">X</button>
                <button class="choose-o">O</button>
            </div>
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

document.addEventListener("DOMContentLoaded", () => 
{
    const turnBox1 = document.querySelector(".turn-box1");
    const turnBox2 = document.querySelector(".turn-box2");
    const cells = document.querySelectorAll(".cell");
    const modal = document.querySelector(".modal");
    const modalButtons = document.querySelectorAll(".modal-buttons button");
    const scoreDisplay = document.querySelector(".score");
    
    let currentPlayer = null;
    let board = Array(9).fill("");
    let gameActive = false;
    let playerChoice = '';
    let playerScore = 0;
    let computerScore = 0;

    const startGame = (player) => {
        currentPlayer = "X";
        playerChoice = player;
        gameActive = true;
        modal.style.display = "none";
        updateTurnIndicator();
        
        if (playerChoice === "O") 
        {
            computerMove();
        }
};

modalButtons.forEach(button => 
{
    button.addEventListener("click", () => {
        startGame(button.textContent);
    });
});

const playerMove = (index) => 
{
    if (board[index] !== "" || !gameActive || currentPlayer !== playerChoice) return;

    makeMove(index);
};

const makeMove = (index) => 
{
    board[index] = currentPlayer;
    cells[index].innerHTML = currentPlayer === "X" ? drawX() : drawO();

    if (checkWin()) 
    {
        const winner = currentPlayer === playerChoice ? "Player" : "Computer";
        if (winner === "Player") playerScore++;
        else computerScore++;
        scoreDisplay.textContent = `Score: ${playerScore} - ${computerScore}`;
        alert(`${winner} wins!`);
        resetGame();
    } 
    else if (board.every(cell => cell !== "")) 
    {
        alert("It's a draw!");
        resetGame();
    } 
    else 
    {
        currentPlayer = currentPlayer === "X" ? "O" : "X";
        updateTurnIndicator();
        if (currentPlayer !== playerChoice && gameActive) {
            setTimeout(computerMove, 500);
        }
    }
};

const updateTurnIndicator = () =>
{
    turnBox1.style.backgroundColor = currentPlayer === "X" ? "gray" : "#0d867a";
    turnBox2.style.backgroundColor = currentPlayer === "O" ? "gray" : "#0d867a";
};

const computerMove = () => 
{
    const emptyCells = board
        .map((cell, index) => cell === "" ? index : null)
        .filter(index => index !== null);

    if (emptyCells.length > 0) 
    {
        const randomIndex = emptyCells[Math.floor(Math.random() * emptyCells.length)];
        makeMove(randomIndex);
    }
};

const checkWin = () => 
{
    const winPatterns = [
        [0, 1, 2], [3, 4, 5], [6, 7, 8],
        [0, 3, 6], [1, 4, 7], [2, 5, 8],
        [0, 4, 8], [2, 4, 6]
    ];

    return winPatterns.some(pattern => 
    {
        const [a, b, c] = pattern;
        return board[a] && board[a] === board[b] && board[a] === board[c];
    });
};

const resetGame = () => 
{
    board = Array(9).fill("");
    cells.forEach(cell => cell.innerHTML = "");
    gameActive = false;
    turnBox1.style.backgroundColor = "#0d867a";
    turnBox2.style.backgroundColor = "#0d867a";
    currentPlayer = null;
    modal.style.display = "flex";
};

cells.forEach((cell, index) => 
{
    cell.addEventListener("click", () => playerMove(index));
});

const drawX = () => `
    <svg viewBox="0 0 100 100" width="100%" height="100%">
        <line x1="20" y1="20" x2="80" y2="80" stroke="gray" stroke-width="10" stroke-linecap="round" />
        <line x1="80" y1="20" x2="20" y2="80" stroke="gray" stroke-width="10" stroke-linecap="round" />
    </svg>
`;

const drawO = () => `
    <svg viewBox="0 0 100 100" width="100%" height="100%">
        <circle cx="50" cy="50" r="30" stroke="white" stroke-width="10" fill="none" />
    </svg>
`;
});
	</script>     
</body>
</html>
<?php

$host = 'localhost';  
$user = 'root';      
$pass = '';           
$dbname = 'bored_button';  
$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "CREATE TABLE IF NOT EXISTS tictactoe_scores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    games_won INT DEFAULT 0,
    games_lost INT DEFAULT 0,
    FOREIGN KEY (email) REFERENCES users(email)
)";

mysqli_query($conn, $sql);

function updateScores($email, $outcome) 
{
    global $conn;
    $checkQuery = "SELECT * FROM tictactoe_scores WHERE email = '$email'";
    $result = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) 
    {
        if ($outcome == 'win') 
        {
            $sql = "UPDATE tictactoe_scores SET games_won = games_won + 1 WHERE email = '$email'";
        }

        else if ($outcome == 'lose') 
        {
            $sql = "UPDATE tictactoe_scores SET games_lost = games_lost + 1 WHERE email = '$email'";
        }
    } 
    
    else 
    {
        if ($outcome == 'win') {
            $sql = "INSERT INTO tictactoe_scores (full_name, email, games_won, games_lost) 
                    SELECT full_name, email, 1, 0 FROM users WHERE email = '$email'";
        } 
        
        else if ($outcome == 'lose') {
            $sql = "INSERT INTO tictactoe_scores (full_name, email, games_won, games_lost) 
                    SELECT full_name, email, 0, 1 FROM users WHERE email = '$email'";
        }
    }

    if (mysqli_query($conn, $sql)) 
    {
        echo "Scores updated successfully.";
    } 
    else 
    {
        echo "Error updating scores: " . mysqli_error($conn);
    }
}


if (isset($_POST['email']) && isset($_POST['outcome'])) 
{
    $email = $_POST['email'];
    $outcome = $_POST['outcome'];
    updateScores($email, $outcome);
}

mysqli_close($conn);
?>
