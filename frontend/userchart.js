document.getElementById('upload-csv').addEventListener('change', handleFileSelect, false);

function handleFileSelect(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const csv = e.target.result;
            const data = parseCSV(csv);
            renderChart(data);
        };
        reader.readAsText(file);
    }
}

function parseCSV(csv) {
    const lines = csv.trim().split('\n');
    const headers = lines[0].split(',');
    const data = lines.slice(1).map(line => {
        const values = line.split(',');
        const obj = {};
        headers.forEach((header, index) => {
            obj[header.trim()] = values[index].trim();
        });
        return obj;
    });
    return {
        headers,
        data
    };
}

function renderChart(parsedData) {
    const { headers, data } = parsedData;
    const categories = headers[0]; // First column as categories
    const seriesHeaders = headers.slice(1); // Remaining columns as series

    const categoryData = data.map(item => item[categories]);
    const seriesData = seriesHeaders.map(header => {
        return {
            name: header,
            type: 'bar',
            data: data.map(item => parseFloat(item[header]))
        };
    });

    const chart = echarts.init(document.getElementById('main'));
    const option = {
        title: {
            text: 'Your Dataset'
        },
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            data: seriesHeaders
        },
        xAxis: {
            type: 'category',
            data: categoryData
        },
        yAxis: {
            type: 'value'
        },
        series: seriesData
    };
    chart.setOption(option);
}