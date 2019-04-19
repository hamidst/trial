<template>
    <div class="row">
        <div class="col-sm-6">
            <div class="col-sm-12">
                <h5>Match Result Week {{week}}</h5>
            </div>
            <div class="col-sm-12">
                <div class="col-sm-6">
                    <div v-if="show_next_button">
                        <button class="btn btn-secondary btn-show-next float-right" v-on:click="nextWeek">Next</button>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div v-if="show_prev_button">
                        <button class="btn btn-secondary btn-show-prev float-right" v-on:click="prevWeek">prev</button>
                    </div>
                </div>
            </div>
            <table width="100%" class="table table-responsive-lg">
                <tr v-for="match in week_matches">
                    <td class="text-center">{{match.home_name}} {{match.home_goals}} - {{match.away_goals}} {{match.away_name}}</td>
                </tr>
                <tr>
                    <td></td>
                </tr>
            </table>
        </div>
        <div class="col-sm-6">
            <h5>Predict</h5>
            <table width="100%" class="table table-responsive-lg">
                <tr>
                    <td class="text-center">Liverpool : 25%</td>
                </tr>
                <tr>
                    <td class="text-center">Chelsea : 40%</td>
                </tr>
                <tr>
                    <td class="text-center">ManUnited : 30%</td>
                </tr>
                <tr>
                    <td class="text-center">Totenham : 5%</td>
                </tr>
                <tr>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
</template>
<script>
    export default {
        name:'match-results',
        data() {
            return {
                week : 1,
                week_matches: [],
                show_next_button : true,
                show_prev_button : true,
            }
        },
        methods: {
            fetchWeekMatchResult(){
                axios.get('/api/league/week/'+this.week).then((response)=> {
                    this.week_matches = [];
                    response.data.forEach(function (value,index) {
                        this.week_matches.push({
                            'home_name' : value.home_name,
                            'home_goals'   : value.home_goals,
                            'away_name' : value.away_name,
                            'away_goals' : value.away_goals
                        })
                    }.bind(this));

                    this.manageButtons();
                });
            },
            nextWeek() {
                this.week++;
                this.fetchWeekMatchResult();
                this.manageButtons();
            },
            prevWeek() {
                this.week--;
                this.fetchWeekMatchResult();
                this.manageButtons();
            },
            manageButtons() {
                if(this.week == 1)
                {
                    this.show_prev_button = false;
                }
                else
                {
                    this.show_prev_button = true;
                }


                if(this.week == 6)
                {
                    this.show_next_button = false;
                }
                else
                {
                    this.show_next_button = true;
                }

            }
        },
        mounted()
        {
            this.fetchWeekMatchResult();
        }
    }
</script>