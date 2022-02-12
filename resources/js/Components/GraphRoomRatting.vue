<template>
    <v-chart autoresize class="chart" :option="option" />

</template>

<script>
import * as echarts from 'echarts';
import { use } from "echarts/core";
import { CanvasRenderer } from "echarts/renderers";
import { PieChart } from "echarts/charts";
import {
    TitleComponent,
    TooltipComponent,
    LegendComponent
} from "echarts/components";
import VChart, { THEME_KEY } from "vue-echarts";

use([
    CanvasRenderer,
    PieChart,
    TitleComponent,
    TooltipComponent,
    LegendComponent
]);

export default {
    name: "HelloWorld",
    components: {
        VChart
    },
    props:{
        ratting: Object
    },

    data() {
        return {
            option: {
                title: {
                    text: '',
                    left: 'right',
                },
                tooltip: {
                    trigger: 'axis',
                    extraCssText: "max-width:300px; white-space:pre-wrap;",
                    position: function (pos, params, el, elRect, size) {
                        var obj = { top: 10 };
                        obj[['left', 'right'][+(pos[0] < size.viewSize[0] / 2)]] = 30;
                        return obj;
                    },
                },

            xAxis: {
                    type: 'category',
                    data: Object.keys(this.ratting).map((item) =>
                    {return item.charAt(0).toUpperCase() + item.substr(1,2)})
                },
                yAxis:
                    {
                        name: 'Počet Bodov',
                        type: 'value',
                        max: 100,
                        min: 0,
                    },
                series:[
                    {
                        name: 'Body: ',
                        data: [],
                        type: 'bar',
                        showBackground: true,
                        barWidth: '70%',
                        backgroundStyle: {
                            color: 'rgba(180, 180, 180, 0.2)'
                        },
                        color:'#dc2626'
                    },
                    {
                        name: 'Stratené body za:',
                        data: [],
                        type: 'bar',
                        barWidth: '0%',
                        color:'#dc2626'
                    }
                ]

            }
        };
    },

    created() {
        this.option.title.text = 'Priemer: ' + this.avg(Object.values(this.ratting))

        this.option.series[0].data = Object.values(this.ratting).map((ratting) =>{
            return ratting.ratting == 100 ? {
                value: ratting.ratting,
                itemStyle: {
                    color: '#3490dc'
                }
            } : ratting.ratting
        })

        this.option.series[1].data = Object.values(this.ratting).map((ratting) =>{
            return {
                value: ratting.message,
            }
        })
    },


    methods:{
        avg(week){
            let sum = 0
            let count =0;
            week.forEach((day) =>{
                typeof day.ratting === 'number' ? (sum += day.ratting, count++) : sum ;
            })
            return  sum == 0 ? 'Bez hodnotenia' : Math.round((sum/count)*100)/100

        }

    },

    // watch: {
    //     availableActivities() {
    //         this.option.xAxis.data = this.availableActivities.map((activity) =>{return activity.name})
    //         this.option.series.data = this.availableActivities.map((activity) =>{return activity.today_voters_count})
    //     }
    // }


};
</script>

<style scoped>
.chart {
    height: 400px;
}
</style>
