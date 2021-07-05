<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
<script language='javascript'>
    function showModal(type, id) {
        $('textarea[name="' + type + '"]').val(
            $('textarea[name="' + type + id + '"]').val()
        );
        $('#' + type + '-modal button').unbind('click');
        $('#' + type + '-modal button').click(function() {
            var value = $('textarea[name="' + type + '"]').val();
            $('textarea[name="' + type + id + '"]').val(value);
            if (type=="thoughts") $.post(".", {courseId: id, thoughts: value});
            console.log(id, value);
            // submitForm(type + id, $('textarea[name="' + type + '-popup"]').val());
        });
        $('#' + type + '-modal').modal('show');
    }
    $('#autobiography-modal').on('hide.bs.modal', function (e) {
        $.post(".", {autobiography: $('textarea[name=autobiography]').val()});
    })

    function saveImage() {        
        console.log("draw canvas 2");
        var dataURL = document.getElementById("skills-radar").toDataURL("image/jpeg"); //.replace("image/png", "image/octet-stream");
        $('textarea[name="scoreImg_base64"]').html(dataURL);
        $('#skills-radar').addClass('d-none');
        // $.post(".", {scoreImg: dataURL}, function () {
        //     $('#skills-radar').addClass('d-none');
        // });
    }

    function drawCanvas() {
        console.log("draw canvas");
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
            var vw = (window.innerWidth > 0) ? window.innerWidth : screen.width;
            var data = {
                labels: [
                    "企業型 Enterprising",
                    "研究型 Investigative",
                    "事務型 Conventional ",
                    "社會型 Social",
                    "實用型 Realistic",
                    "藝術型 Artistic"
                ],
                datasets: [{
                    data: JSON.parse($('#score').val()),
                    backgroundColor: "transparent",
                    borderColor: colors.secondary,
                    pointBackgroundColor: colors.secondary,
                    pointBorderColor: colors.secondary,
                    pointRadius: 5
                }]

            };
            var fontSize = (vw > 990)? 18 : 12;
            var radarOpts = {
                pointLabelFontFamily: "sans-serif",
                pointLabelFontStyle: "400",
                pointLabelFontSize: fontSize,
                pointLabelFontColor: "#000",
                pointDotRadius: 5,
                angleLineColor: "#333",
                scaleLineColor: "#333",
                scaleOverride: true,
                scaleSteps: 1,
                scaleStepWidth: 40,
                showTooltips: false,
                onAnimationComplete: saveImage
            };

            const plugin = {
                id: 'custom_canvas_background_color',
                beforeDraw: (chart) => {
                    const ctx = chart.canvas.getContext('2d');
                    ctx.save();
                    ctx.globalCompositeOperation = 'destination-over';
                    ctx.fillStyle = 'white';
                    ctx.fillRect(0, 0, chart.width, chart.height);
                    ctx.restore();
                }
            };

            const config = {
                type: 'radar',
                data,
                plugins: [plugin],
                options: {
                    responsive:true,
                    // maintainAspectRatio:false,
                    scales: {
                        r: {
                            suggestedMin: 0,
                            suggestedMax: 40,
                            angleLines: {
                                color: 'black'
                            },
                            grid: {
                                lineWidth: 1,
                                borderColor: 'blue',
                                color: 'black',
                            },
                            pointLabels: {
                                font: {
                                    size: 44
                                },
                                color: 'black'
                            },
                            ticks: { 
                                display: false,
                                stepSize: 40,
                                autoSkip: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    animation: {
                        onComplete: saveImage
                    }
                },
            };

            var canvas = document.getElementById("skills-radar");
            var ctx = canvas.getContext("2d");
            // var radar = new Chart(ctx).Radar(data, radarOpts);
            var radar = new Chart(document.getElementById('skills-radar'), config);
        });
    }
    drawCanvas();
</script> 