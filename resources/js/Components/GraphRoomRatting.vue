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
                series:
                    {
                        data: [],
                        type: 'bar',
                        showBackground: true,
                        backgroundStyle: {
                            color: 'rgba(180, 180, 180, 0.2)'
                        },
                        color:'#dc2626'
                    }

            }
        };
    },

    created() {
        this.option.title.text = 'Priemer: ' + this.avg(this.ratting)

        this.option.series.data = Object.values(this.ratting).map((ratting) =>{
            return ratting == 100 ? {
                value: ratting,
                itemStyle: {
                    color: '#3490dc'
                }
            } : ratting
        })
    },


    methods:{
        avg(week){
            let sum = 0
            let count = 0;
            Object.values(week).forEach((ratting) =>{
                typeof ratting === 'number' ? (sum += ratting, count++) : sum ;
            })
            return  sum == 0 ? 'Bez hodnotenia' : sum/count

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
