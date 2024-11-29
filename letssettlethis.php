<html>
<head>
  <title>Let's Settle This</title>
  <style>
  
    body 
    {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      background-image: url("images/bg.jpg");
      color: #333;

    }

    .container {
      text-align: center;
      margin-top: 250px;
      padding: 20px;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      width: 90%;
      max-width: 530px;
    }

    h1 {
      margin-bottom: 20px;
      color: #4CAF50;
    }

    .question {
      font-size: 1.2em;
      margin-bottom: 20px;
    }

    .options {
      display: flex;
      justify-content: center;
      gap: 20px;
    }

    .option {
      padding: 10px 20px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 1em;
    }

    .option:hover {
      background-color: #45a049;
    }

    #results {
      margin-top: 20px;
      display: none;
      text-align: left;
    }

    .result-bar {
      display: flex;
      flex-direction: column;
      gap: 10px;
      margin-top: 10px;
    }

    .result {
      position: relative;
      background-color: #4CAF50;
      border-radius: 5px;
      overflow: hidden;
      height: 30px;
      width: 100%;
      max-width: 500px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
      color: white;
      padding: 0 10px;
    }

    .result-fill {
      height: 100%;
      background-color: #4CAF50;
      width: 100%;
      display: flex;
      transition: width 0.5s;
      align-items: center;
      text-align: center;
      justify-content: center;
      color: white;
      font-weight: bold;
      text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
      padding: 0 10px;
      display: flex;
      box-sizing: border-box;
    }

    .result-fill span {
      width: 100%;
      text-overflow: ellipsis;
      white-space: nowrap;
    }

    .navigation {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
    }

    .nav-button {
      padding: 10px 20px;
      background-color: #007BFF;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 1em;
    }

    .nav-button:hover {
      background-color: #0056b3;
    }

    .hidden {
      display: none;
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
    <h1>Let's Settle This!</h1>
    <div id="poll-container">
      
    </div>
    <div class="navigation">
      <button class="nav-button" onclick="previousQuestion()">Previous</button>
      <button class="nav-button" onclick="nextQuestion()">Next</button>
    </div>
  </div>
  <div class="redirect-container">
    <button class="redirect-button" onclick="redirectToRandomGame()">
    </button>
    <span class="redirect-text">Bored again?<br>Click to redirect</span>
</div> 

  <script>
    
    const questions = [
      {
        question: "Which is better?",
        options: ["Cats", "Dogs"],
        votes: [0, 0],
        voted: false,
      },
      {
        question: "What's your favorite season?",
        options: ["Summer", "Winter"],
        votes: [0, 0],
        voted: false,
      },
      {
        question: "Do you prefer coffee or tea?",
        options: ["Coffee", "Tea"],
        votes: [0, 0],
        voted: false,
      },
	{
        question: "Mountains or Beaches?",
        options: ["Mountains", "Beaches"],
        votes: [0, 0],
        voted: false,
      },
{
        question: "Classical or Pop music?",
        options: ["Classical", "Pop"],
        votes: [0, 0],
        voted: false,
      },
{
        question: "Chocolate or Vanilla?",
        options: ["Chocolate", "Vanilla"],
        votes: [0, 0],
        voted: false,
      },
{
        question: "Sweet or Salty?",
        options: ["Sweet", "Salty"],
        votes: [0, 0],
        voted: false,
      },
{
        question: "Blonde or Brunette?",
        options: ["Blonde", "Brunette"],
        votes: [0, 0],
        voted: false,
      },
{
        question: "Early bird or Night owl?",
        options: ["Early bird", "Night owl"],
        votes: [0, 0],
        voted: false,
      },
{
        question: "Ketchup or No ketchup?",
        options: ["Ketchup", "No ketchup"],
        votes: [0, 0],
        voted: false,
      }
    ];

    let currentQuestionIndex = 0;
    let userCount = 1; 

    
    function addQuestion(questionText, optionsArray) {
      const newQuestion = {
        question: questionText,
        options: optionsArray,
        votes: Array(optionsArray.length).fill(0), 
        voted: false, 
      };
      questions.push(newQuestion); 
    }

    
    function renderQuestion() {
      const pollContainer = document.getElementById('poll-container');
      const questionData = questions[currentQuestionIndex];

      if (currentQuestionIndex < questions.length) {
        pollContainer.innerHTML = `
          <p class="question">${questionData.question}</p>
          <div class="options">
            ${questionData.options.map((option, index) => `
              <button class="option" onclick="vote(${index})" ${questionData.voted ? 'disabled' : ''}>${option}</button>
            `).join('')}
          </div>
          <div id="results">
            <p>Results:</p>
            <div class="result-bar">
              ${questionData.options.map((option, index) => `
                <div class="result">
                  <div class="result-fill" id="option${index}-bar">
                    <span id="option${index}-count">${questionData.votes[index]} votes / ${userCount} users</span>
                  </div>
                </div>
              `).join('')}
            </div>
          </div>
        `;
      } else {
        displayEndPage();
      }
    }

    function vote(optionIndex) {
      const questionData = questions[currentQuestionIndex];

      if (!questionData.voted) {
        questionData.votes[optionIndex]++;
        questionData.voted = true;
        updateResults();
      }
    }

    function updateResults() {
      const questionData = questions[currentQuestionIndex];
      const totalVotes = questionData.votes.reduce((a, b) => a + b, 0);
      questionData.votes.forEach((votes, index) => {
        document.getElementById(`option${index}-count`).textContent = `${votes} votes / ${userCount} users`;
        const width = totalVotes === 0 ? 0 : (votes / totalVotes) * 100;
        document.getElementById(`option${index}-bar`).style.width = width + '%';
      });
      document.getElementById('results').style.display = 'block';
    }

    function nextQuestion() {
      if (currentQuestionIndex < questions.length - 1) {
        currentQuestionIndex++;
        renderQuestion();
      } else {
        displayEndPage();
      }
    }

    function previousQuestion() {
      if (currentQuestionIndex > 0) {
        currentQuestionIndex--;
        renderQuestion();
      }
    }

    function displayEndPage() {
      const pollContainer = document.getElementById('poll-container');
      pollContainer.innerHTML = `
        <h2>Thus, we settled the debates of the internet!</h2>
        <div>
          <h3>Here are the results:</h3>
          <ul>
            ${questions.map((question) => `
              <li><strong>${question.question}</strong>
                <ul>
                  ${question.options.map((option, oIndex) => `
                    <li>${option}: ${question.votes[oIndex]} votes / ${userCount} users</li>
                  `).join('')}
                </ul>
              </li>
            `).join('')}
          </ul>
        </div>
      `;
      document.querySelector('.navigation').style.display = 'none';
    }

    function startNewGame() {
      currentQuestionIndex = 0;
      userCount++;
      questions.forEach(question => {
        question.votes = Array(question.options.length).fill(0); 
        question.voted = false;
      });
      renderQuestion();
    }

    renderQuestion();
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
  </script>
</body>
</html>
