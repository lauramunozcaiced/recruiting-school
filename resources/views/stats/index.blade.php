@extends('layouts.app')

@section('content')
    @auth
    <div class="{{ Auth::user()->role }} dashboard-content app__dashboard-content">
        <x-layout.title title="Statistics"></x-layout.title>
        <div class="view dashboard-view app__dashboard-view">
            <div class="statistics">
                <div class="statistics_card">
                    <h4>Applicants Registered</h4>
                    <h1>{{ count($applicants) }}<i class="fa fa-users"></i></h1>
                    <small>Total applicants registered.</small>
                </div>
                <div class="statistics_card">
                    <h4>Applicants this week</h4>
                    <h1>{{ count($data['applicants_this_week']) }}<i class="fa fa-users"></i></h1>
                    <div class="d-flex align-items-center ">
                        @if (count($data['applicants_this_week']) > count($data['applicants_last_week']))
                            <div class="d-flex flex-column justify-content-center">
                                <i class="fa fa-arrow-up"></i>
                                <small>up</small>
                            </div>
                        @elseif (count($data['applicants_this_week']) < count($data['applicants_last_week']))
                            <div class="d-flex flex-column justify-content-center">
                                <i class="fa fa-arrow-down"></i>
                                <small>down</small>
                            </div>
                        @else
                            <div class="d-flex flex-column justify-content-center">
                                <label>=</label>
                                <small>equal</small>
                            </div>
                        @endif
                        <small>compared to last week.</small>
                    </div>
                </div>
                <div class="statistics_card">
                    <h4>Active Positions</h4>
                    <h1>{{ count($jobs) }}<i class="fa fa-users"></i></h1>
                    <small>Total active positions.</small>
                </div>
                <div class="statistics_card">
                    <h4>Active Processes</h4>
                    <h1>{{ count($data['applicants_active_process']) }}<i class="fa fa-users"></i></h1>
                    <small>@if(Auth::user()->role == 'customer') Applicants that i have preselected. @else Applicants with active matches. @endif</small>
                </div>
                <div class="statistics_card">
                    <h4>Most Requested Position</h4>
                    
                        @if(isset($data['job_most_popular'][0]))
                                @php
                                    $num = 0;
                                    $max = $data['job_most_popular'][0];
                                    for($i=0; $i <= count($data['job_most_popular'])-1; $i++){
                                        if($num < count($data['job_most_popular'][$i]->matches)){
                                            empty($max);
                                            $max = $data['job_most_popular'][$i];
                                            $num = count($data['job_most_popular'][$i]->matches);
                                        }
                                    }
                                @endphp
                            <div class="text-center">
                               <h3 class="mb-0"> {{$max->name}}</h3>
                              @if(Auth::user()->role != 'customer') <p>{{$max->user->name}}</p> @endif
                            </div>
                        @else
                        <h3> No position</h3>
                        @endif
                
                    <small>Position with more matches.</small>
                </div>
            </div>
            <div class="graphics">
                <div class="card">
                    <canvas id="myChart" width="400" height="90%"></canvas>
                </div>
            </div>
        </div>
    </div>
        <script>
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['4 Weeks Ago', '3 Weeks Ago', '2 Weeks Ago', 'Last Week', 'Current Week'],
                    datasets: [{
                        label: '# of Applicants',
                        data: [{{ count($data['applicants_last_week_4']) }},
                            {{ count($data['applicants_last_week_3']) }},
                            {{ count($data['applicants_last_week_2']) }},
                            {{ count($data['applicants_last_week']) }},
                            {{ count($data['applicants_this_week']) }}
                        ],
                        backgroundColor: [
                            'rgba(240, 124, 34, 0.4)'
                        ],
                        borderColor: [
                            'rgba(240, 124, 34, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        </script>
    @endauth
@endsection
