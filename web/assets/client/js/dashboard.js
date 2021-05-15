function chart() {
    var dom = document.getElementById("dailyenergy");
    var myChart = echarts.init(dom);
    var app = {};
    option = null;
    option = {
        title: {
            text: 'Günlük güç tüketimi',
            borderColor: 'black',

            textStyle: {
                color: 'black',
            },
        },
        textStyle: {
            color: 'black'
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'cross'
            }
        },
        toolbox: {
            show: true,
            feature: {
                saveAsImage: {}
            }
        },

        xAxis: {
            type: 'category',
            boundaryGap: false,
            axisline: {

            },
            data: ['00:00', '01:15', '02:30', '03:45', '05:00', '06:15', '07:30', '08:45', '10:00', '11:15', '12:30', '13:45', '15:00', '16:15', '17:30', '18:45', '20:00', '21:15', '22:30', '23:45']

        },
        yAxis: {
            type: 'value',
            axisLabel: {
                formatter: '{value} W'
            },
            axisPointer: {
                snap: true
            },


        },
        visualMap: {
            show: false,
            dimension: 0,
            pieces: [
                { min: 0, max: 1000, label: '10 to 200 (custom label) ', color: 'green' },
            ]
        },
        color: {
            type: 'linear',
            x: 0,
            y: 0,
            x2: 0,
            y2: 1,
            colorStops: [{
                offset: 1,
                color: 'red' // color at 0% position
            }, {
                offset: 1,
                color: 'blue' // color at 100% position
            }],
            global: true // false by default
        },
        series: [{
            name: 'Tüketim',
            type: 'line',
            smooth: true,
            data: [1800, 300, 280, 250, 4000, 270, 300, 550, 500, 400, 390, 380, 390, 400, 500, 600, 750, 1800, 700, 600, 400, ],

        }]

    };

    ;
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }
}
$(document).ready(function() {
    chart()

})
window.onresize = function(event) {
    chart()

}