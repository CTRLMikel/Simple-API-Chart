var labeltitle = [], labelcategory = [], labelauthor = [], labelid = [], labelbody = []

async function dummyChart() {
  await getDummyData()

let ctx = document.getElementById('myChart').getContext('2d');

let chart = new Chart(ctx, {
    type: 'bar',

    data: {
        labels: labelbody,
        datasets: [{
            label: 'Title',
            backgroundColor: 'blue',
            borderColor: 'rgb(255, 99, 132)',
            data: labeltitle
        },
        {
          label: 'ID',
          backgroundColor: 'pink',
          borderColor: 'rgb(255, 99, 132)',
          data: labelid
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

  const title = barChatData.data.map((x) => x.title)
  const category = barChatData.data.map((x) => x.category_name)
  const author = barChatData.data.map((x) => x.author)
  const id = barChatData.data.map((x) => x.id)
  const body = barChatData.data.map((x) => x.body)

  labeltitle = title
  labelauthor = author
  labelcategory = category
  labelid = id
  labelbody = body
}
