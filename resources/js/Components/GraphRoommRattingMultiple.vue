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
                    data: []
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
                        data: [1,2,3,100],
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
    //
    created() {
        this.option.xAxis.data = this.ratting.map((ratting) =>{return ratting.day_for_human})
        this.option.series.data = this.ratting.map((ratting) =>{
            return ratting.edited_ratting == 100 ? {
                    value: ratting.edited_ratting,
                    itemStyle: {
                        color: '#3490dc'
                    }
                } : ratting.edited_ratting
        })

        this.option.title.text = 'Priemer: ' + this.avg(this.ratting)
    },
    // watch: {
    //     availableActivities() {
    //         this.option.xAxis.data = this.availableActivities.map((activity) =>{return activity.name})
    //         this.option.series.data = this.availableActivities.map((activity) =>{return activity.today_voters_count})
    //     }
    // }
    methods:{
        avg(week){
            let sum = 0
            let count =0;
            week.forEach((day) =>{
                typeof day.edited_ratting === 'number' ? (sum += day.edited_ratting, count++) : sum ;
            })
            return  sum == 0 ? 'Bez hodnotenia' : sum/count

        }

    },


};
</script>

<style scoped>
.chart {
    height: 400px;
}
</style>
