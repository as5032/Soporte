<!DOCTYPE html>
<html>
    <head>
        <title>
            7 widgets
        </title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" rel="stylesheet" type="text/css">
        <style>

            :root {
        --grey-d1: #585858;
        --grey-d2: #F4F4F4;
        --grey-d3: #000000;
        --red-1: #F2B8D1;
        --red-2: #F04B92;
        --red-3: #EB1E77;
        --red-4: #AD1257;
        --white: #FFFFFF;
        --blue: #329EF4;
        --grey: #eeeeee;
    }
    html, body {
        font-family: 'roboto';
        height: 100%;
        background-color: var(--grey);
    }
    .card-1, .card-2, .card-3, .card-4, .card-5, .card-6, .card-7 {
        background-color: white;
        border-radius: 10px;
        box-shadow: 2px 2px 5px 2px #D7D7D7;
    }
    .chart-lbl {
        margin-left: 5%;
        font-size: 12px;
        color: var(--grey-d3);
        opacity: 0.8;
    }
    .content-center {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .divider {
        background-color: var(--grey-d2);
        height: 2px;
        margin: auto;
        width: 98%;
    }

    /*  media queries */

    @media only screen and (min-width: 320px) {
        .dashboard-container {
            display: grid;
            grid-template: repeat(7, 15%)/ repeat(1, 1fr);
            grid-gap: 20px;
        }
        .doughnut-chart-container, .pie-chart-container, .polar-chart-container {
            margin: 5% auto 5% auto;
            position: relative;
            width: 95%;
        }
        /*doughnut chart*/
        .card-1 {
            grid-row: 1 / 2;
        }
        /*pie chart*/
        .card-2 {
            grid-row: 2 / 3;
        }
        /*polar area*/
        .card-3 {
            grid-row: 3 / 4;
        }
        /*bubble chart*/
        .card-4 {
            grid-row: 4 / 5;
        }
        /*bar chart*/
        .card-5 {
            grid-row: 5 / 6;
        }
        /*line chart*/
        .card-6 {
            grid-row: 6 / 7;
        }
        /*mixed chart*/
        .card-7 {
            grid-row: 7 / 8;
        }
        main {
            margin: 10% 0 140% 0;
        }
        .line-chart-container, .bar-chart-container, .bubble-chart-container, .mixed-chart-container {
            height: 70%;
            margin: 5% auto 5% auto;
            position: relative;
            width: 90%;
        }
    }
    @media only screen and (min-width: 400px) {
        main {
            margin: 10% 5% 90% 5%;
        }
    }
    @media only screen and (min-width: 750px) {
        /*doughnut chart*/
        .card-1 {
            grid-column: 1 / 2;
            grid-row: 1 / 3;
        }
        /*pie chart*/
        .card-2 {
            grid-column: 2 / 3;
            grid-row: 1 / 3;
        }
        /*polar area*/
        .card-3 {
            grid-column: 1 / 2;
            grid-row: 3 / 5;
        }
        /*bubble chart*/
        .card-4 {
            grid-column: 2 / 3;
            grid-row: 3 / 5;
        }
        /*bar chart*/
        .card-5 {
            grid-column: 1 / 3;
            grid-row: 5 / 7;
        }
        /*line chart*/
        .card-6 {
            grid-column: 1 / 3;
            grid-row: 7 / 9;
        }
        /*mixed chart*/
        .card-7 {
            grid-column: 1 / 3;
            grid-row: 9 / -1;
        }
        .dashboard-container {
            display: grid;
            grid-template: repeat(10, 10%) / repeat(2, 1fr);
            grid-gap: 20px;
        }
        main {
            margin: 10% 5% 45% 5%;
        }
        .line-chart-container, .bar-chart-container, .bubble-chart-container, .mixed-chart-container {
            margin: 2% auto 3% auto;
        }
    }
    @media only screen and (min-width: 1000px) {
        .bar-chart-container {
            width: 90%;
            height: 70%;
            margin-top: 10%;
        }
        .bubble-chart-container, .line-chart-container {
            margin: 1% auto 0 auto;
            width: 90%;
            height: 65%;
        }
        /*doughnut chart*/
        .card-1 {
            grid-column: 10 / -1;
            grid-row: 1 / 5;
        }
        /*pie chart*/
        .card-2 {
            grid-column: 10 / -1;
            grid-row: 5 / 9;
        }
        /*polar area*/
        .card-3 {
            grid-column: 1 / 6;
            grid-row: 9 / -1;
        }
        /*bubble chart*/
        .card-4 {
            grid-column: 4 / 10;
            grid-row: 1 / 5;
        }
        /*bar chart*/
        .card-5 {
            grid-column: 1 / 4;
            grid-row: 1 / 9;
        }
        /*line chart*/
        .card-6 {
            grid-column: 4 / 10;
            grid-row: 5 / 9;
        }
        /*mixed chart*/
        .card-7 {
            grid-column: 6 / -1;
            grid-row: 9 / -1;
        }
        .content-height {
            height: 70%;
        }
        .dashboard-container {
            grid-template: repeat(13, 7%) / repeat(13, 1fr);
            grid-gap: 5px;
            padding: 0;
            width: 100%;
        }
        .doughnut-chart-container, .pie-chart-container{
            margin: 0 auto 2% auto;
            width: 95%;
        }
        .polar-chart-container {
            margin-top: 2%;
            width: 95%;
        }
        main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 90vh;
            width: 80vw;
            margin: 5vh 10vw 5vh 10vw;
            padding: 0;
        }
        .radar-chart-container {
            width: 75%;
            margin-top: 3%;
        }
    }
    @media only screen and (min-width: 1300px) {
        .dashboard-container {
            grid-template: repeat(13, 6.8%) / repeat(13, 1fr);
        }
        .doughnut-chart-container, .pie-chart-container{
            margin: 0 auto 2% auto;
            width: 80%;
        }
        .polar-chart-container {
            margin-top: 2%;
            width: 85%;
        }
    }
    @media screen and (min-width: 1500px){
        .dashboard-container {
            grid-template: repeat(13, 7.3%) / repeat(13, 1fr);
        }
    }
    @media screen and (min-width: 1920px){
        .dashboard-container {
            grid-template: repeat(13, 7.5%) / repeat(13, 1fr);
            max-width: 1536px;
        }


        </style>
    </head>
    <body>
        <div class="container">
            <main>
                <div class="dashboard-container">
                    <div class="card-1">
                        <h4 class="chart-lbl">
                            Doughnut Chart
                        </h4>
                        <div class="divider">
                        </div>
                        <div class="content-center">
                            <div class="doughnut-chart-container">
                                <canvas class="doughnut-chart" id="doughnut">
                                </canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card-2">
                        <h4 class="chart-lbl">
                            Pie Chart
                        </h4>
                        <div class="divider">
                        </div>
                        <div class="content-center">
                            <div class="pie-chart-container">
                                <canvas class="pie-chart" id="pie">
                                </canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card-3">
                        <h4 class="chart-lbl">
                            Polar Area
                        </h4>
                        <div class="divider">
                        </div>
                        <div class="content-center">
                            <div class="polar-chart-container">
                                <canvas class="polar-chart" id="polar">
                                </canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card-4">
                        <h4 class="chart-lbl">
                            Bubble Chart
                        </h4>
                        <div class="divider">
                        </div>
                        <div class="bubble-chart-container">
                            <canvas class="bubble-chart" id="bubble">
                            </canvas>
                        </div>
                    </div>
                    <div class="card-5">
                        <h4 class="chart-lbl">
                            Bar Chart
                        </h4>
                        <div class="divider">
                        </div>
                        <div class="bar-chart-container">
                            <canvas class="bar-chart" id="bar">
                            </canvas>
                        </div>
                    </div>
                    <div class="card-6">
                        <h4 class="chart-lbl">
                            line Chart
                        </h4>
                        <div class="divider">
                        </div>
                        <div class="line-chart-container">
                            <canvas class="line-chart" id="line">
                            </canvas>
                        </div>
                    </div>
                    <div class="card-7">
                        <h4 class="chart-lbl">
                            Mixed Chart
                        </h4>
                        <div class="divider">
                        </div>
                        <div class="mixed-chart-container">
                            <canvas class="mixed-chart" id="mixed">
                            </canvas>
                        </div>
                    </div>
                </div>
            </main>

            <button togglepopup="pop">Toggle</button>
            <div id="pop" popup>PopUp content</div>
        </div>
<!--         <script src="node_modules/chart.js/dist/Chart.min.js">
        </script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js">
        </script>

        <script>
        //bar chart
          var bar = document.getElementById('bar');
          bar.height = 400
          var barConfig = new Chart(bar, {
            type: 'horizontalBar',
            data: {
                labels: ['data-1', 'data-2', 'data-3', 'data-4', 'data-5', 'data-6', 'data-7'],
                datasets: [{
                    label: '# of data',
                    data: [30, 25, 20, 15, 11, 4, 2],
                    backgroundColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(225, 50, 64, 1)', 'rgba(64, 159, 64, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                responsive: true, // Instruct chart js to respond nicely.
                maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
            }
          })
          //bubble chart
          var bubble = document.getElementById('bubble');
          bubble.height = 200
          var myBubbleChart = new Chart(bubble, {
            type: 'bubble',
            data: {
                labels: ['data-1', 'data-2', 'data-3', 'data-4', 'data-5', 'data-6', 'data-7'],
                datasets: [{
                    label: '# of data',
                    data: [{
                        x: 20,
                        y: 10,
                        r: 10
                    }, {
                        x: 15,
                        y: 5,
                        r: 13
                    }, {
                        x: 12,
                        y: 4,
                        r: 8
                    }, {
                        x: 17,
                        y: 2,
                        r: 10
                    }, {
                        x: 10,
                        y: 9,
                        r: 15
                    }, {
                        x: 8,
                        y: 8,
                        r: 12
                    }, {
                        x: 16,
                        y: 9,
                        r: 8
                    }],
                    backgroundColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(225, 50, 64, 1)', 'rgba(64, 159, 64, 1)', ]
                }]
            },
            options: {
                responsive: true, // Instruct chart js to respond nicely.
                maintainAspectRatio: false,
            }
          });
          //doughnut chart
          var doughnut = document.getElementById('doughnut');
          var doughnutConfig = new Chart(doughnut, {
            type: 'doughnut',
            data: {
                labels: ['data-1', 'data-2', 'data-3'],
                datasets: [{
                    label: '# of data',
                    data: [11, 30, 20],
                    backgroundColor: ['rgba(0, 230, 118, 1)', 'rgba(255, 206, 86, 1)', 'rgba(255,99,132,1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true, // Instruct chart js to respond nicely.
                maintainAspectRatio: true, // Add to prevent default behaviour of full-width/height
            }
          });
          //line chart
          var line = document.getElementById('line');
          line.height = 200
          var lineConfig = new Chart(line, {
            type: 'line',
            data: {
                labels: ['data-1', 'data-2', 'data-3', 'data-4', 'data-5', 'data-6'],
                datasets: [{
                    label: '# of data', // Name the series
                    data: [10, 15, 20, 10, 25, 5, 10], // Specify the data values array
                    fill: false,
                    borderColor: '#2196f3', // Add custom color border (Line)
                    backgroundColor: '#2196f3', // Add custom color background (Points and Fill)
                    borderWidth: 1 // Specify bar border width
                }]
            },
            options: {
                responsive: true, // Instruct chart js to respond nicely.
                maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
            }
          })
          //pie chart
          var pie = document.getElementById('pie');
          var pieConfig = new Chart(pie, {
            type: 'pie',
            data: {
                labels: ['data-1', 'data-2'],
                datasets: [{
                    label: '# of data',
                    data: [40, 80],
                    backgroundColor: ['rgba(103, 216, 239, 1)', 'rgba(246, 26, 104,1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true, // Instruct chart js to respond nicely.
                maintainAspectRatio: true, // Add to prevent default behaviour of full-width/height
            }
          });
          //polar area chart
          var polar = document.getElementById('polar');
          var polarConfig = new Chart(polar, {
            type: 'polarArea',
            data: {
                labels: ['data-1', 'data-2', 'data-3'],
                datasets: [{
                    label: '# of data',
                    data: [10, 20, 30],
                    backgroundColor: ['rgba(0, 230, 118, 1)', 'rgba(255, 206, 86, 1)', 'rgba(255,99,132,1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true, // Instruct chart js to respond nicely.
                maintainAspectRatio: true, // Add to prevent default behaviour of full-width/height
            }
          });
          //mixed chart
          var mixed = document.getElementById('mixed');
          var mixedConfig = new Chart(mixed, {
            type: 'bar',
            data: {
                labels: ['data-1', 'data-2', 'data-3', 'data-4', 'data-5', 'data-6', 'data-7'],
                datasets: [{
                    label: '# of data',
                    data: [18, 12, 9, 11, 8, 4, 2],
                    backgroundColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(225, 50, 64, 1)', 'rgba(64, 159, 64, 1)'],
                    borderWidth: 1
                }, {
                    label: '# of data', // Name the series
                    data: [20, 19, 18, 14, 12, 15, 10],
                    type: 'line', // Specify the data values array
                    fill: false,
                    borderColor: '#2196f3', // Add custom color border (Line)
                    backgroundColor: '#2196f3', // Add custom color background (Points and Fill)
                    borderWidth: 1,
                    order: 2
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                responsive: true, // Instruct chart js to respond nicely.
                maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
            }
          })
        </script>

    </body>
</html>
