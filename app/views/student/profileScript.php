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
            var data = {
                labels: [
                    "企業型",
                    "研究型",
                    "常規型",
                    "社交型",
                    "實作型",
                    "藝術型"
                ],
                datasets: [{
                    data: JSON.parse($('#score').val()),
                    fillColor: "transparent",
                    strokeColor: colors.secondary,
                    pointColor: colors.secondary,
                }]

            };

            var radarOpts = {
                pointLabelFontFamily: "sans-serif",
                pointLabelFontStyle: "400",
                pointLabelFontSize: 18,
                pointLabelFontColor: "#000",
                pointDotRadius: 5,
                angleLineColor: "#333",
                scaleLineColor: "#333",
                scaleOverride: true,
                scaleSteps: 1,
                scaleStepWidth: 100,
                showTooltips: false
            };

            var ctx = document.getElementById("skills-radar").getContext("2d");
            var radar = new Chart(ctx).Radar(data, radarOpts);

        });
    })();
</script>