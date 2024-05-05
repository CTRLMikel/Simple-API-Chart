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
          backgroundColor: 'white',
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
