var chartCountry = [], chartAlcohol = []

async function dummyChart() {
  await getDummyData()

let ctx = document.getElementById('myChart').getContext('2d');

let chart = new Chart(ctx, {
    type: 'line',

    data: {
        labels: chartCountry,
        datasets: [{
            label: 'Country',
            backgroundColor: 'blue',
            borderColor: 'rgb(255, 255, 255)',
            data: chartCountry
        },
        {
          label: 'Alcohol Consumed',
          backgroundColor: 'rgb(255, 84, 71)',
          borderColor: 'rgb(255, 255, 255)',
          data: chartAlcohol
      }
      ]
    },

    options: {
      tooltips: {
        mode: 'index'
      } 
    }
});
}

dummyChart()

//Fetch Data from API

async function getDummyData() {
  const apiUrl = "http://localhost/phprest/api/read.php"

  const response = await fetch(apiUrl)
  const barChatData = await response.json()

  const Country = barChatData.data.map((x) => x.Country)
  const Alcohol = barChatData.data.map((x) => x.Alcohol)

  chartCountry = Country
  chartAlcohol = Alcohol
}


document.getElementById("deleteButton").addEventListener("click", function() {
        window.location.href = "delete-account.php";
});

document.getElementById("changeUsername").addEventListener("click", function() {
var newUsername = prompt("Enter new username:");

if (newUsername !== null && newUsername !== "") {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "change-username.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Handle response, if needed
            location.reload(); // Refresh the page after username change
        }
    };
    xhr.send("new_username=" + encodeURIComponent(newUsername));
}
});
