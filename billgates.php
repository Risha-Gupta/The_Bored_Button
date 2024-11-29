<!DOCTYPE html>
<html lang="en">
<head>
  <title>Spend Bill Gates' Money</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
      margin: 0;
      padding: 0;
      background-color: #f4f4f9;
    }

    h1 {
      color: #2c3e50;
      margin-top: 20px;
    }

    h2 {
      color: #16a085;
      margin: 10px 0 30px 0;
    }

    .container {
      max-width: 1200px;
      margin: auto;
      padding: 20px;
    }

    .items {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
      gap: 20px;
    }

    .item {
      background: #ffffff;
      border-radius: 10px;
      padding: 15px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s;
    }

    .item:hover {
      transform: scale(1.05);
    }

    .item img {
      max-width: 100px;
      margin-bottom: 10px;
    }

    .item p {
      font-size: 16px;
      margin: 10px 0;
    }

    .item button {
      padding: 10px 15px;
      border: none;
      border-radius: 5px;
      font-size: 14px;
      cursor: pointer;
      transition: background 0.2s;
    }

    .buy-btn {
      background: #16a085;
      color: white;
    }

    .buy-btn:disabled {
      background: #bdc3c7;
      cursor: not-allowed;
    }

    .sell-btn {
      background: #e74c3c;
      color: white;
    }

    .sell-btn:disabled {
      background: #bdc3c7;
      cursor: not-allowed;
    }

    #total-money {
      font-size: 24px;
      font-weight: bold;
      padding: 10px;
      background-color: #fff;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: top 0.3s;
    }

    .redirect-container {
      position: fixed;
      top: 20px;
      right: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .redirect-button {
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

    .redirect-button:hover {
      transform: scale(1.1);
    }

    .redirect-text {
      margin-top: 8px;
      font-size: 14px;
      font-weight: bold;
      color: black;
      text-align: center;
    }

    #receipt {
      margin-top: 40px;
      text-align: left;
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    #receipt h3 {
      margin-bottom: 10px;
      font-size: 20px;
      color: #2c3e50;
    }

    #receipt ul {
      list-style: none;
      padding: 0;
      margin: 0 0 10px 0;
    }

    #receipt ul li {
      display: flex;
      justify-content: space-between;
      margin-bottom: 5px;
      font-size: 16px;
    }

    #receipt .total {
      font-weight: bold;
      font-size: 18px;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Spend Bill Gates' Money</h1>
    <h2 id="total-money">$100,000,000,000</h2>
    <div class="items">
      <div class="item">
        <img src="images\burger.jpg" alt="Big Mac">
        <p>Big Mac - $2</p>
        <button class="buy-btn" onclick="buyItem(2, 0,'big Mac')">Buy</button>
        <button class="sell-btn" onclick="sellItem(2, 0)" disabled>Sell</button>
      </div>
      <div class="item">
        <img src="images\flip.jpg" alt="Flip Flops">
        <p>Flip Flops - $3</p>
        <button class="buy-btn" onclick="buyItem(3, 1,'flip flop')">Buy</button>
        <button class="sell-btn" onclick="sellItem(3, 1,'flip flop')" disabled>Sell</button>
      </div>
      <div class="item">
        <img src="images\coke.jpg" alt="Coca-Cola Pack">
        <p>Coca-Cola Pack - $5</p>
        <button class="buy-btn" onclick="buyItem(5, 2,'coke')">Buy</button>
        <button class="sell-btn" onclick="sellItem(5, 2,'coke')" disabled>Sell</button>
      </div>
      <div class="item">
        <img src="images/pizza.jpg" alt="Pizza">
        <p>Pizza - $15</p>
        <button class="buy-btn" onclick="buyItem(15, 3,'pizza')">Buy</button>
        <button class="sell-btn" onclick="sellItem(15, 3,'pizza')" disabled>Sell</button>
      </div>
      <div class="item">
        <img src="images/kitten.jpg" alt="Kitten">
        <p>Kitten - $1,500</p>
        <button class="buy-btn" onclick="buyItem(1500, 4,'kitten')">Buy</button>
        <button class="sell-btn" onclick="sellItem(1500, 4,'kitten')" disabled>Sell</button>
      </div>
      <div class="item">
        <img src="images\dog.jpg" alt="Puppy">
        <p>Puppy - $1,500</p>
        <button class="buy-btn" onclick="buyItem(1500, 5,'dog')">Buy</button>
        <button class="sell-btn" onclick="sellItem(1500, 5,'dog')" disabled>Sell</button>
      </div>
      <div class="item">
        <img src="images\auto.jpg" alt="Auto Rickshaw">
        <p>Auto Rickshaw - $2,300</p>
        <button class="buy-btn" onclick="buyItem(2300, 6,'auto')">Buy</button>
        <button class="sell-btn" onclick="sellItem(2300, 6,'auto')" disabled>Sell</button>
      </div>
      <div class="item">
        <img src="images/horse.jpg" alt="Horse">
        <p>Horse - $2,500</p>
        <button class="buy-btn" onclick="buyItem(2500, 7, 'horse')">Buy</button>
        <button class="sell-btn" onclick="sellItem(2500, 7,'horse')" disabled>Sell</button>
      </div>
      <div class="item">
        <img src="images\farm.jpg" alt="Acre of Farmland">
        <p>Acre of Farmland - $3,000</p>
        <button class="buy-btn" onclick="buyItem(3000, 8,'farm')">Buy</button>
        <button class="sell-btn" onclick="sellItem(3000, 8,'farm')" disabled>Sell</button>
      </div>
      <div class="item">
        <img src="images\jetski.jfif" alt="Jet Ski">
        <p>Jet Ski - $12,000</p>
        <button class="buy-btn" onclick="buyItem(12000, 9,'jet')">Buy</button>
        <button class="sell-btn" onclick="sellItem(12000, 9,'jet')" disabled>Sell</button>
      </div>
      <div class="item">
        <img src="images/rolex.jpg" alt="Rolex">
        <p>Rolex - $15,000</p>
        <button class="buy-btn" onclick="buyItem(15000, 10,'rolex')">Buy</button>
        <button class="sell-btn" onclick="sellItem(15000, 10,'rolex')" disabled>Sell</button>
      </div>
      
      <div class="item">
        <img src="images\images.jpg" alt="PS(PlayStation)-5">
        <p>PlayStation 5 - $60</p>
        <button class="buy-btn" onclick="buyItem(60, 11,'play station')">Buy</button>
        <button class="sell-btn" onclick="sellItem(60, 11,'play station')" disabled>Sell</button>
      </div>
      <div class="item">
        <img src="images\echo.png" alt="Amazon Echo">
        <p>Amazon Echo - $99</p>
        <button class="buy-btn" onclick="buyItem(99, 12,'amazon echo')">Buy</button>
        <button class="sell-btn" onclick="sellItem(99, 12,'amazon echo')" disabled>Sell</button>
      </div>
      <div class="item">
        <img src="images\netflix.png" alt="Netflix">
        <p>Netflix - $100</p>
        <button class="buy-btn" onclick="buyItem(100, 13,'netflix')">Buy</button>
        <button class="sell-btn" onclick="sellItem(100, 13,'netflix')" disabled>Sell</button>
      </div>
      <div class="item">
        <img src="images\airjord.jpg" alt="Air Jordans">
        <p>Air Jordans - $125</p>
        <button class="buy-btn" onclick="buyItem(125, 14,'air jordan')">Buy</button>
        <button class="sell-btn" onclick="sellItem(125, 14,'air jordan')" disabled>Sell</button>
      </div>
      <div class="item">
        <img src="images\airpods.png" alt="Airpods">
        <p>Airpods - $199</p>
        <button class="buy-btn" onclick="buyItem(199, 15,'airpods')">Buy</button>
        <button class="sell-btn" onclick="sellItem(199, 15,'airpods')" disabled>Sell</button>
      </div>
      <div class="item">
        <img src="images\gamingConsole.jpg" alt="Gaming Console">
        <p>Gaming Console - $299</p>
        <button class="buy-btn" onclick="buyItem(299, 16,'gaming')">Buy</button>
        <button class="sell-btn" onclick="sellItem(299, 16,'gaming')" disabled>Sell</button>
      </div>
    </div>
</div>
 <div class="redirect-container">
      <button class="redirect-button" onclick="redirectToRandomGame()"></button>
      <span class="redirect-text">Bored again?<br>Click to redirect</span>
    </div>
    <div id="receipt">
      <h3>Your Receipt</h3>
      <ul id="receipt-list"></ul>
      <p class="total" id="receipt-total">TOTAL: $0</p>
    </div>
  </div>

  <script>
    let totalMoney = 100000000000;
    const receipt = {};
    const receiptList = document.getElementById('receipt-list');
    const receiptTotal = document.getElementById('receipt-total');
    const itemCounts = {};

    function updateReceipt() {
      receiptList.innerHTML = '';
      let total = 0;
      for (const item in receipt) {
        if (receipt[item].quantity > 0) {
          const itemTotal = receipt[item].quantity * receipt[item].price;
          total += itemTotal;
          receiptList.innerHTML += `<li>${item} x${receipt[item].quantity} - $${itemTotal.toLocaleString()}</li>`;
        }
      }
      receiptTotal.textContent = `TOTAL: $${total.toLocaleString()}`;
    }

    function buyItem(price, index, name) {
      if (totalMoney >= price) {
        totalMoney -= price;
        document.getElementById('total-money').textContent = `$${totalMoney.toLocaleString()}`;

        if (!itemCounts[index]) {
          itemCounts[index] = 0;
        }
        itemCounts[index]++;

        document.querySelectorAll('.item')[index].querySelector('.sell-btn').disabled = false;

        if (!receipt[name]) {
          receipt[name] = { price, quantity: 0 };
        }
        receipt[name].quantity++;
        updateReceipt();
      }
    }

    function sellItem(price, index, name) {
      if (itemCounts[index] > 0 && receipt[name] && receipt[name].quantity > 0) {
        totalMoney += price;
        document.getElementById('total-money').textContent = `$${totalMoney.toLocaleString()}`;

        itemCounts[index]--;
        if (itemCounts[index] === 0) {
          document.querySelectorAll('.item')[index].querySelector('.sell-btn').disabled = true;
        }

        receipt[name].quantity--;
        if (receipt[name].quantity === 0) {
          delete receipt[name];
        }
        updateReceipt();
      }
    }

    const totalMoneyElement = document.getElementById('total-money');
    let initialTopOffset = totalMoneyElement.offsetTop;

    window.addEventListener('scroll', function () {
      if (window.scrollY > initialTopOffset) {
        totalMoneyElement.style.position = 'fixed';
        totalMoneyElement.style.top = '0';
        totalMoneyElement.style.left = '50%';
        totalMoneyElement.style.transform = 'translateX(-50%)';
      } else {
        totalMoneyElement.style.position = 'absolute';
        totalMoneyElement.style.top = initialTopOffset + 'px';
        totalMoneyElement.style.left = '50%';
        totalMoneyElement.style.transform = 'translateX(-50%)';
      }
    });

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
