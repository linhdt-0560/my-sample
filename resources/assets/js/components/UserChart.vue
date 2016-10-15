<template>

    <div>

        <div class="form-group pull-left">

            <label for="type">chart type:</label>
            <select class="form-control" id="type" v-model="type" v-on:change="changeType">
                <option>line</option>
                <option>bar</option>
            </select>


            <label for="period" id="label">chart periods:</label>
            <select class="form-control" id="period" v-model="period" v-on:change="changePeriod">
                <option value="1year">1 year</option>
                <option value="3months">3 months</option>
                <option value="30days">30 days</option>
                <option value="1week">1 week</option>
                <option value="Custom">Custom</option>

            </select>

        </div>

        <div v-show="showCustom()"  class="col-sm-offset-4">

            <label for="custom-date" id="label">Choose Custom Period:</label>

            <form id="custom-date">

                <input type="date" v-model="startDate" name="start_date" value=""></input>

                &nbsp; &nbsp; to &nbsp; &nbsp;

                <input type="date" v-model="endDate" name="end_date" value=""></input>

                <button class="btn-default" @click.prevent="submitCustom()">Go!</button>


            </form>

        </div>

        <canvas id="canvas"></canvas>

    </div>

</template>

<script>

    var $myChart;



    export default {


        data: function(){

            return {
                labels: [],
                values1: [],
                values2: [],
                values3: [],
                name: 'User',
                compare: 'Widget',
                compare2: 'Gadget',
                type: 'line',
                period: '1year',
                custom: false,
                startDate: '',
                endDate: ''
            };

        },

        mounted: function () {

            this.loadData();

        },

        methods: {

            changeType: function () {

                this.setConfig();

            },

            loadData: function () {

                $.getJSON('api/user-chart', function (data) {

                    this.labels = data.data.labels;
                    this.values1 = data.data.values1;
                    this.values2 = data.data.values2;
                    this.values3 = data.data.values3;
                    this.setConfig();

                }.bind(this));

            },

            changePeriod: function () {

                if (this.period == 'Custom'){

                    return this.customPeriod();
                }

                this.custom = false;
                this.startDate = '';
                this.endDate = '';


                $.getJSON('api/user-chart?period=' + this.period, function (data) {

                    this.labels = data.data.labels;
                    this.values1 = data.data.values1;
                    this.values2 = data.data.values2;
                    this.values3 = data.data.values3;
                    this.setConfig();

                }.bind(this));

            },

            submitCustom:  function () {

                $.getJSON('api/user-chart?period=custom&start_date=' + this.startDate + '&end_date=' + this.endDate, function (data) {

                    this.labels = data.data.labels;
                    this.values1 = data.data.values1;
                    this.values2 = data.data.values2;
                    this.values3 = data.data.values3;
                    this.setConfig();

                }.bind(this));



                this.startDate = '';
                this.endDate = '';

            },

            customPeriod:  function () {

                this.custom = true;

            },

            showCustom:  function () {


                return this.custom == true;

            },

            setConfig : function () {

                // destroy existing chart

                if (typeof $myChart !== "undefined") {
                    $myChart.destroy();
                }

                var ctx = document.getElementById('canvas').getContext('2d');
                var config = {
                    type: this.type,
                    data: {
                        labels: this.labels,
                        datasets: [{
                            label: this.name,
                            data: this.values1,
                            fill: true,
                            borderDash: [5, 5]
                        },

                            {

                                label: this.compare,
                                data: this.values2,
                                fill: true



                            },

                            {

                                label: this.compare2,
                                data: this.values3,
                                fill: true


                            }


                        ]
                    },
                    options: {
                        responsive: true,
                        legend: {
                            position: 'bottom'
                        },
                        hover: {
                            mode: 'label'
                        },
                        scales: {
                            xAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: false,
                                    labelString: 'months'
                                }
                            }],
                            yAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: '# of ' + this.name
                                }
                            }]
                        },
                        title: {
                            display: true,
                            text: this.name
                        }
                    }
                };



                // set instance, so we can destroy when rendering new chart

                $myChart = new Chart( ctx, { type: this.type, data: config.data, options:config.options });
            }

        }


    }


</script>