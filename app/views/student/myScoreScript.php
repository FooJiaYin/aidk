<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
<script type="text/javascript">
    <?php if ($user['score'] == "[0, 0, 0, 0, 0, 0]") : ?>
        alert('提醒：您尚未完成測驗');
    <?php endif ?>
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
            var vw = (window.innerWidth > 0) ? window.innerWidth : screen.width;
            var data = {
                labels: [
                    "企業型 Enterprising",
                    "研究型 Investigative",
                    "事務型 Conventional ",
                    "社交型 Social",
                    "實作型 Realistic",
                    "藝術型 Artistic"
                ],
                datasets: [{
                    data: JSON.parse($('#score').val()),
                    fillColor: "transparent",
                    strokeColor: colors.secondary,
                    pointColor: colors.secondary,
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
                showTooltips: false
            };

            var ctx = document.getElementById("skills-radar").getContext("2d");
            var radar = new Chart(ctx).Radar(data, radarOpts);

        });
    })();
</script>