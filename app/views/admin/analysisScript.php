<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js"></script>
<script type="text/javascript">
    (function() {
        var colors = {
            secondary: "#333",
            primary: "#777",
        };

        function ready(fn) {
            if (document.readyState != "loading") {
                fn();
            } else {
                document.addEventListener("DOMContentLoaded", fn);
            }
        }

        ready(function() {            
            // var vw = (window.innerWidth > 0) ? window.innerWidth : screen.width;
            // var fontSize = (vw > 990)? 18 : 12;

            

            // var ctx = document.getElementById("skills-radar").getContext("2d");
            // var radar = new Chart(ctx).Radar(data, radarOpts);

            var ctx = $('#grade-pie');
            var gradePie = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['一年級', '二年級', '三年級'],
                    datasets: [{
                        label: '年級',
                        data: [<?= $count['grade1'] ?>, 
                            <?= $count['grade2'] ?>, 
                            <?= $count['grade3'] ?>],
                        backgroundColor: [
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ]
                    }]
                }
            });
            var ctx = $('#gender-pie');
            var genderPie = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['女', '男'],
                    datasets: [{
                        label: '性別',
                        data: [<?= $count['genderF'] ?>,
                            <?= $count['genderM'] ?>],
                        backgroundColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)'
                        ],
                    }]
                }
            });
            var ctx = $('#dayofweek-line');
            var dayofweekLine = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['日', '一', '二', '三', '四', '五', '六'],
                    datasets: [{
                        label: '購買人數',
                        data: [<?= $count['day1'] ?>,
                            <?= $count['day2'] ?>,
                            <?= $count['day3'] ?>,
                            <?= $count['day4'] ?>,
                            <?= $count['day5'] ?>,
                            <?= $count['day6'] ?>,
                            <?= $count['day7'] ?>],
                        fill: true,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1,
                        backgroundColor: 'rgba(75, 192, 192, 0.3)'
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            // var gradePie = new Chart(ctx, {
            //     type: 'doughnut',
            //     data: {
            //         labels: ['1', '2', '3', '4', '5', '6'],
            //         datasets: [{
            //             label: '# of Votes',
            //             data: [<?= $count['grade1'] ?>, 
            //                 <?= $count['grade2'] ?>, 
            //                 <?= $count['grade3'] ?>,
            //                 <?= $count['genderM'] ?>,
            //                 <?= $count['genderF'] ?>,
            //                 <?= $count['day1'] ?>],
            //             backgroundColor: [
            //                 'rgba(255, 99, 132, 0.2)',
            //                 'rgba(54, 162, 235, 0.2)',
            //                 'rgba(255, 206, 86, 0.2)',
            //                 'rgba(75, 192, 192, 0.2)',
            //                 'rgba(153, 102, 255, 0.2)',
            //                 'rgba(255, 159, 64, 0.2)'
            //             ],
            //             borderColor: [
            //                 'rgba(255, 99, 132, 1)',
            //                 'rgba(54, 162, 235, 1)',
            //                 'rgba(255, 206, 86, 1)',
            //                 'rgba(75, 192, 192, 1)',
            //                 'rgba(153, 102, 255, 1)',
            //                 'rgba(255, 159, 64, 1)'
            //             ],
            //             borderWidth: 1
            //         }]
            //     },
            //     options: {
            //         scales: {
            //             y: {
            //                 beginAtZero: true
            //             }
            //         }
            //     }
            // });
        });
    })();
</script>

