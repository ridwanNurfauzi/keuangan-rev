var ctx = document.getElementById('chartData').getContext('2d');
var months = ['Q1', 'Q2', 'Q3', 'Q4'];
var labels = months;
var targetData = [0, 0, 0, 0];
var aktualData = [0, 0, 0, 0];
let yearList = [];
var linechartYear = 2021;
var linechartYear = 2021;
var piechartYear = 2021;

var pieCtx = document.getElementById('pieChartData').getContext('2d');
var pieData = [1, 1]; // Data pie chart
var pieLabels = ['Target', 'Aktual']; // Label pie chart
var pieColors = ['rgba(255, 99, 132, 0.7)', 'rgba(54, 162, 235, 0.7)'];


function rupiah(number) {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR"
    }).format(number);
}

function settingTarget() {
    location.href = `/set-target/${linechartYear}`;
}

var chartData = new Chart(ctx, {
    type: 'line',
    data: {
        labels,
        datasets: [{
            name: 'target',
            label: 'Target',
            data: targetData,
            backgroundColor: 'rgba(75, 192, 192, 0.12)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }, {
            name: 'aktual',
            label: 'Aktual',
            data: aktualData,
            backgroundColor: 'rgba(77, 78, 255, 0.12)',
            borderColor: 'rgba(77, 78, 255, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});
var pieChart = new Chart(pieCtx, {
    type: 'pie', // Jenis chart pie
    data: {
        labels: pieLabels,
        datasets:
            [{
                data: pieData,
                backgroundColor: pieColors
            }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});


function setLinechartAktualData() {
    fetch('/api/v1/cashflows')
        .then(x => {
            return x.json();
        })
        .then(y => {
            let _temp = [];

            y.filter(e => {
                return new Date(e.created_at).getFullYear() == linechartYear;
            }).sort((a, b) => {
                return new Date(a.created_at).getTime() - new Date(b.created_at).getTime();
            }).forEach(e => {
                let n = Math.floor(new Date(e.created_at).getMonth() /
                    3);
                if (isNaN(_temp[n]))
                    _temp[n] = 0;
                if (e.type) // Kredit
                    _temp[n] += e.amount;
                else // Debit
                    _temp[n] -= e.amount;
            });

            const latestData = _temp[_temp.length - 1];

            aktualData = [latestData];

            aktualData = _temp;

            chartData.data.datasets[chartData.data.datasets.findIndex((e) => {
                return (e.name === 'aktual')
            })].data = aktualData;

            chartData.update();

            document.getElementById("aktualDataDisplay").innerText = "Actual Revenue: " +
                (isNaN(latestData) ? rupiah(0) : rupiah(latestData));
        });
}

function setLinechartTargetData() {
    fetch('/api/v1/targets').then(x => x.json()).then(y => {
        if (!!y[y.findIndex(e => (e['year'] == linechartYear))]) {
            chartData.data.datasets[chartData.data.datasets.findIndex((e) => {
                return (e.name === 'target')
            })].data = (y[y.findIndex(e => (e['year'] == linechartYear))]['amount']).split('-');

            document.getElementById("targetDataDisplay").innerText = "Target Revenue: " +
                rupiah((y[y.findIndex(e => (e['year'] == linechartYear))]['amount']).split('-')[3]);
        }
        else {
            chartData.data.datasets[chartData.data.datasets.findIndex((e) => {
                return (e.name === 'target')
            })].data = 0;

            document.getElementById("targetDataDisplay").innerText = "Target Revenue: " +
                rupiah(0);
        }

        chartData.update();
    });
}

function changeLinechartYear() {
    linechartYear = parseInt(document.getElementById('tahunDropdownLinechart').value);
    setLinechartAktualData();
    setLinechartTargetData();
}

function setPieChartData() {
    fetch('/api/v1/cashflows')
        .then(x => x.json())
        .then(y => {
            let _temp = (y.filter(e => {
                return new Date(e['created_at']).getFullYear() == piechartYear;
            }));
            let total = 0;
            _temp.forEach(e => {
                if (e['type'])
                    total += e['amount'];
                else
                    total -= e['amount'];
            });

            document.getElementById("totalAktualDataDisplay").innerText = `Total Aktual : ${rupiah(total)}`;

            pieChart.data.datasets[0].data[1] = total;
            pieChart.update();
        });

    fetch('/api/v1/targets')
        .then(x => x.json())
        .then(y => {
            let _temp = y.find(e => e['year'] == piechartYear);
            let total = 0;
            if (!!_temp)
                _temp['amount'].split('-').forEach(e => {
                    total += parseFloat(e);
                });

            document.getElementById("totalTargetDataDisplay").innerText = `Total Target : ${rupiah(total)}`;

            pieChart.data.datasets[0].data[0] = total;
            pieChart.update();
        });
}

function changePiechartYear() {
    piechartYear = parseInt(document.getElementById('tahunDropdownPiechart').value);
    setPieChartData();
}

function exportLinechartToPdf() {
    let pdf = new jsPDF('landscape');
    let imgData = document.getElementById('chartData').toDataURL('image/PNG');
    pdf.addImage(imgData, 'PNG', 10, 10);
    pdf.save('linechart.pdf');
}

function exportLinechartToCSV() {
    // Extract chart data
    const chartLabels = chartData.data.labels;
    const chartTargetData = chartData.data.datasets.find((e) => e.name === 'target').data;
    const chartAktualData = chartData.data.datasets.find((e) => e.name === 'aktual').data;

    // Create CSV content
    let csvContent = "Quarter,Target,Aktual\n";
    for (let i = 0; i < chartLabels.length; i++) {
        csvContent += `${chartLabels[i]},${chartTargetData[i]},${chartAktualData[i]}\n`;
    }

    // Create a Blob and download the CSV file
    const blob = new Blob([csvContent], { type: 'text/csv' });
    const link = document.createElement('a');
    link.href = window.URL.createObjectURL(blob);
    link.download = 'line_chart.csv';
    link.click();
    link.remove();
}

async function selectLinechartExportFormat() {
    const { value: opt } = await Swal.fire({
        title: 'Silahkan pilih format file',
        input: 'select',
        inputOptions: {
            csv: 'csv',
            pdf: 'pdf'
        },
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonText: 'Pilih'
    });
    if (!!opt)
        if (opt == 'csv') {
            exportLinechartToCSV();
        }
        else if (opt == 'pdf') {
            exportLinechartToPdf();
        }
}

function exportPieChartToPdf() {
    let pdf = new jsPDF();
    let imgData = document.getElementById('pieChartData').toDataURL('image/PNG');
    pdf.addImage(imgData, 'PNG', 10, 10);
    pdf.save('piechart.pdf');
}

function exportPieChartToCSV() {
    // Extract pie chart data
    const pieLabels = pieChart.data.labels;
    const pieData = pieChart.data.datasets[0].data;

    // Create CSV content
    let csvContent = "Label,Value\n";
    for (let i = 0; i < pieLabels.length; i++) {
        csvContent += `${pieLabels[i]},${pieData[i]}\n`;
    }

    // Create a Blob and download the CSV file
    const blob = new Blob([csvContent], { type: 'text/csv' });
    const link = document.createElement('a');
    link.href = window.URL.createObjectURL(blob);
    link.download = 'piechart.csv';
    link.click();
    link.remove();
}

async function selectpiechartExportFormat() {
    const { value: opt } = await Swal.fire({
        title: 'Silahkan pilih format file',
        input: 'select',
        inputOptions: {
            csv: 'csv',
            pdf: 'pdf'
        },
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonText: 'Pilih'
    });
    if (!!opt)
        if (opt == 'csv') {
            exportPieChartToCSV();
        }
        else if (opt == 'pdf') {
            exportPieChartToPdf();
        }
}

function setTarget() {
    const targetAmount = document.getElementById('targetAmount').value;

    // Validate if the entered amount is a valid number
    if (isNaN(targetAmount) || targetAmount <= 0) {
        alert("Please enter a valid target amount.");
        return;
    }

    // Update the target data and chart
    chartData.data.datasets[chartData.data.datasets.findIndex((e) => {
        return (e.name === 'target');
    })].data = [targetAmount];

    document.getElementById("targetDataDisplay").innerText = "Target Revenue: " + rupiah(targetAmount);

    chartData.update();
}

$(function () {
    fetch('/api/v1/cashflows')
        .then(x => x.json())
        .then(y => {
            $('#tahunDropdownLinechart')[0].innerHTML = "";
            $('#tahunDropdownPiechart')[0].innerHTML = "";

            y.forEach(e => {
                if (!yearList.includes(new Date(e['created_at']).getFullYear())) {
                    yearList.push(new Date(e['created_at']).getFullYear());
                }
            });
            yearList.sort();

            yearList.forEach(e => {
                $('#tahunDropdownLinechart')[0].innerHTML += `<option value="${e}" ${(yearList[yearList.length - 1] == e) ? 'selected' : ''
                    }>${e}</option>`;
                $('#tahunDropdownPiechart')[0].innerHTML += `<option value="${e}" ${(yearList[yearList.length - 1] == e) ? 'selected' : ''
                    }>${e}</option>`;
            });

            linechartYear = $('#tahunDropdownLinechart')[0].value;
            piechartYear = $('#tahunDropdownPiechart')[0].value;

            setPieChartData();
            setLinechartAktualData();
            setLinechartTargetData()
        });
});
