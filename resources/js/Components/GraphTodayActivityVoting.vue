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
        availableActivities: Object
    },

    data() {
        return {
            option: {
                tooltip: {
                },
                xAxis: {

                    type: 'category',
                    data: []
                },
                yAxis: {
                    name: 'Počet Hlasov',
                    interval:1,
                },
                series:
                    {
                        type: 'bar',
                        data: [],
                        color:'#3490dc'
                    },



            }
        };
    },

    created() {
        this.option.xAxis.data = this.availableActivities.map((activity) =>{return activity.name})
        this.option.series.data = this.availableActivities.map((activity) =>{return activity.today_voters_count})
    },
    watch: {
        availableActivities() {
            this.option.xAxis.data = this.availableActivities.map((activity) =>{return activity.name})
            this.option.series.data = this.availableActivities.map((activity) =>{return activity.today_voters_count})
        }
    }


};
</script>

<style scoped>
.chart {
    height: 400px;
}
</style>
