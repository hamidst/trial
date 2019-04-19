<template>
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-8">
                        <h5>League Table {{title}}</h5>
                    </div>
                    <div class="col-sm-4 pull-right">
                        <div class="col-sm-6 pull-right">
                            <div v-if="show_next_button">
                                <button class="btn btn-secondary btn-show-next float-right" v-on:click="nextWeek">Next</button>
                            </div>
                        </div>
                        <div class="col-sm-6 pull-right">
                            <div v-if="show_prev_button">
                                <button class="btn btn-secondary btn-show-prev float-right" v-on:click="prevWeek">prev</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="container-fluid">

                            <table width="100%" class="table table-responsive-lg">
                                <thead>
                                <tr>
                                    <th>Position</th>
                                    <th>Club</th>
                                    <th>Played</th>
                                    <th>Won</th>
                                    <th>Drawn</th>
                                    <th>Lost</th>
                                    <th>GF</th>
                                    <th>GA</th>
                                    <th>GD</th>
                                    <th>Points</th>
                                    <th>Form</th>
                                    <th>Next</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(item,index) in LeagueTable">
                                    <td>{{(index+1)}}</td>
                                    <td>{{item.Club}}</td>
                                    <td>{{item.Played}}</td>
                                    <td>{{item.Won}}</td>
                                    <td>{{item.Drawn}}</td>
                                    <td>{{item.Lost}}</td>
                                    <td>{{item.GF}}</td>
                                    <td>{{item.GA}}</td>
                                    <td>{{item.GF - item.GA}}</td>
                                    <td>{{item.Score}}</td>
                                    <td>
                                        <span v-for="form in item.Forms">
                                            <span class="circle win" v-if="(form=='W')">W</span>
                                            <span class="circle drawn" v-if="(form=='D')">D</span>
                                            <span class="circle lost" v-if="(form=='L')">L</span>
                                        </span>
                                    </td>
                                    <td>Next</td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="col-sm-12">
                                <h5>Match Result Week {{week}}</h5>
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
                                <tr v-for="team in team_predictions">
                                    <td class="text-center">{{team.name}} : {{team.chance}}%</td>
                                </tr>
                                <tr>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
    export default{
        name:'league-table',
        data() {
            return {
                League : '1',
                LeagueTable:[],
                title: '',
                week: 1,
                show_next_button : true,
                show_prev_button : true,
                week_matches: [],
                team_predictions : []
            }
        },
        methods:{
            fetchMatchResult() {
                axios.get('/api/league/week/'+this.week).then((response)=> {

                    var homeFound = '';
                    var awayFound = '';
                    this.week_matches = [];
                    this.LeagueTable = [];
                    this.team_predictions = [];

                    var total_score = 0;

                    response.data.forEach(function (value,index) {

                        //settin week matches
                        if(value['week'] == this.week)
                        {
                            this.week_matches.push({
                                'home_name' : value.home_name,
                                'home_goals'   : value.home_goals,
                                'away_name' : value.away_name,
                                'away_goals' : value.away_goals
                            })
                        }

                        //calculating main league table rows
                        //check if we have indexed this club before
                        this.LeagueTable.forEach(function(rowItem) {

                            if(rowItem['id'] == value['home'])
                                homeFound = 1;

                            if(rowItem['id'] == value['away'])
                                awayFound = 1;
                        });

                        var statusFlagHome = '';
                        var statusFlagAway = '';

                        var home_score = 0;
                        var away_score = 0;

                        if(value['home_goals'] > value['away_goals'])
                        {
                            statusFlagHome = 'W';
                            statusFlagAway = 'L';
                            home_score = 3;
                        }
                        else if (value['home_goals'] < value['away_goals'])
                        {
                            statusFlagHome = 'L';
                            statusFlagAway = 'W';
                            away_score = 3;
                        }
                        else
                        {
                            statusFlagHome = 'D';
                            statusFlagAway = 'D';
                            home_score = 1;
                            away_score = 1;
                        }

                        total_score += home_score+away_score;

                        if(homeFound)
                        {
                            var currentIndex = this.LeagueTable.findIndex(t => t.id === value['home']);
                            this.LeagueTable[currentIndex]['Played'] += 1;
                            this.LeagueTable[currentIndex]['Won'] += (value['home_goals'] > value['away_goals'])? 1 : 0;
                            this.LeagueTable[currentIndex]['Drawn'] += (value['home_goals'] === value['away_goals'])? 1 : 0;
                            this.LeagueTable[currentIndex]['Lost'] += (value['home_goals'] < value['away_goals'])? 1 : 0;
                            this.LeagueTable[currentIndex]['GF'] += value['home_goals'];
                            this.LeagueTable[currentIndex]['GA'] += value['away_goals'];

                            this.LeagueTable[currentIndex]['Score'] += home_score;

                            this.LeagueTable[currentIndex]['Forms'] += statusFlagHome;
                        }
                        else
                        {
                            this.LeagueTable.push({
                                'id'    : value['home'],
                                'Club'  : value['home_name'],
                                'Played'  : 1,
                                'Won'  : (value['home_goals'] > value['away_goals'])? 1 : 0,
                                'Drawn'  : (value['home_goals'] === value['away_goals'])? 1 : 0,
                                'Lost'  : (value['home_goals'] < value['away_goals'])? 1 : 0,
                                'GF'  : value['home_goals'],
                                'GA'  : value['away_goals'],
                                'Score'  : home_score,
                                'Forms'  : [statusFlagHome]
                            });
                        }

                        if(awayFound)
                        {
                            var currentIndex = this.LeagueTable.findIndex(t => t.id === value['away']);
                            this.LeagueTable[currentIndex]['Played'] += 1;
                            this.LeagueTable[currentIndex]['Won'] += (value['home_goals'] < value['away_goals'])? 1 : 0;
                            this.LeagueTable[currentIndex]['Drawn'] += (value['home_goals'] === value['away_goals'])? 1 : 0;
                            this.LeagueTable[currentIndex]['Lost'] += (value['home_goals'] > value['away_goals'])? 1 : 0;
                            this.LeagueTable[currentIndex]['GF'] += value['away_goals'];
                            this.LeagueTable[currentIndex]['GA'] += value['home_goals'];
                            this.LeagueTable[currentIndex]['Score'] += away_score;
                            this.LeagueTable[currentIndex]['Forms'] += statusFlagAway;
                        }
                        else
                        {
                            this.LeagueTable.push({
                                'id'    : value['away'],
                                'Club'  : value['away_name'],
                                'Played'  : 1,
                                'Won'  : (value['home_goals'] < value['away_goals'])? 1 : 0,
                                'Drawn'  : (value['home_goals'] === value['away_goals'])? 1 : 0,
                                'Lost'  : (value['home_goals'] > value['away_goals'])? 1 : 0,
                                'GF'  : value['away_goals'],
                                'GA'  : value['home_goals'],
                                'Score'  : away_score,
                                'Forms'  : [statusFlagAway]
                            });

                        }

                    }.bind(this));

                    //calculating predictions
                    console.log(this.LeagueTable);
                    this.LeagueTable.forEach(function(row)
                    {
                        this.team_predictions.push({
                            'name' : row['Club'],
                            'chance' : Math.round((100*row['Score']/total_score) * 10)/10
                        });
                    }.bind(this));

                });

            },
            nextWeek() {
                this.week++;
                this.fetchMatchResult();
                this.manageButtons();
            },
            prevWeek() {
                this.week--;
                this.fetchMatchResult();
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
            this.fetchMatchResult();
        }
    }
</script>