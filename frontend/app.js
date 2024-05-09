var chartCountry = [], chartAlcohol = []

async function alcoholChart() {
  await getData()

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

alcoholChart()

//Fetch Data from API

async function getData() {
  const apiUrl = "http://localhost/API-Chart/api/read.php" // In this case using localhost API

  const response = await fetch(apiUrl)
  const barChatData = await response.json()

  const Country = barChatData.data.map((x) => x.Country)
  const Alcohol = barChatData.data.map((x) => x.Alcohol)

  chartCountry = Country
  chartAlcohol = Alcohol
}