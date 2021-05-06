@extends('admin.layouts.master')
@section('title',__('Dashboard'))
@section('content')
        <!-- top tiles -->
        <div class="row flow-root" >
            <div class="tile_count">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="tile_stats_count" style="background:#2196F5">
                        <i class="fa fa-users"></i>
                        <div>
                            <div class="count">{{$total_user}}</div>
                            <span class="count_top">@lang('Total Users')</span>
                            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>{{$total_user_mon}} </i> @lang('From last Month')</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="tile_stats_count" style="background:#08c35b">
                        <i class="fa fa-user-plus"></i>
                        <div>
                            <div class="count">{{$total_ac_user}}</div>
                            <span class="count_top"> @lang('Active Users')</span>
                            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>{{$total_ac_user_month}} </i> @lang('From last Month')</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="tile_stats_count" style="background:#F44435">
                        <i class="fa fa-user-times"></i>
                        <div>
                            <div class="count">{{$total_bn_user}}</div>
                            <span class="count_top">@lang('Banned Users')</span>
                            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>{{$total_bn_user_month}} </i> @lang('From last Month')</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="tile_stats_count" style="background:#4052B6">
                        <i class="fa fa-money"></i> 
                        <div>
                            <div class="count">{{round($total_deposit,8)}}</div>
                            <span class="count_top">@lang('Total Deposit'){{$general->currency}})</span>
                            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>{{$total_deposit_month}} </i> @lang('From last Month')</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-4 col-sm-6">
                    <div class="tile_stats_count" style="background:#9C28B1">
                        <i class="fa fa-retweet"></i> 
                        <div>
                            <div class="count">{{round($total_withdraw,8)}}</div>
                            <span class="count_top">@lang('Total Withdraw'){{$general->currency}})</span>
                            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>{{$total_withdraw_month}} </i> @lang('From last Month')</span>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6 col-md-4 col-sm-6">
                    <div class="tile_stats_count" style="background:#384148">
                        <i class="fa fa-briefcase"></i> 
                        <div>
                            <div class="count">{{round($total_invest,8)}}</div>
                            <span class="count_top">@lang('Total Invest'){{$general->currency}})</span>
                            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>{{$total_invest_month}} </i> @lang('From last Month')</span>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <!-- /top tiles -->

        <div class="row">
            <div class="col-md-6 col-sm-6 ">
                <div class="x_panel tile fixed_height_320">
                    <div class="x_title">
                        <h2>@lang('Invest Fixed Plans')</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <h4>@lang('Invest Percentage across') </h4>
                        @foreach($fixed_plans as $data)
                        <div class="widget_summary">
                            <div class="w_left w_25">
                                <span>{{$data->name}}</span>
                            </div>
                            <div class="w_center w_55">
                                <div class="progress">
                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="{{$data->percent}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$data->percent}}%;">
                                        <span class="sr-only">{{$data->percent}}% @lang('Payback')</span>
                                    </div>
                                </div>
                            </div>
                            <div class="w_right w_20">
                                <span>{{($data->fixed_amount*$data->percent)/100}}{{$general->currency}}</span>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 ">
                <div class="x_panel tile fixed_height_320">
                    <div class="x_title">
                        <h2>@lang('Invest ROI Plans')</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <h4>@lang('Invest Percentage across') </h4>
                        @foreach($roi_plans as $data)
                            <div class="widget_summary">
                                <div class="w_left w_25">
                                    <span>{{$data->name}}</span>
                                </div>
                                <div class="w_center w_55">
                                    <div class="progress">
                                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="{{$data->percent}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$data->percent}}%;">
                                            <span class="sr-only">{{$data->percent}}% @lang('Payback')</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="w_right w_20">
                                    <span>{{$data->period}} @lang('Times')</span>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h2>@lang('Recent Invest Log')</h2>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th> @lang('User') </th>
                                <th> @lang('Package') </th>
                                <th> @lang('Type') </th>
                                <th> @lang('Invest Amount') </th>
                                <th> @lang('Payable') </th>
                                <th> @lang('Already Return') </th>
                                <th> @lang('Next Return Time') </th>
                                <th> @lang('Status') </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($investLog as $data)
                                <tr>
                                    <td>{{$data->user->name}}</td>
                                    <td>{{$data->plan_name}}</td>
                                    <td>
                                        @switch($data->get_period)
                                            @case(1)
                                            @lang('Hourly')
                                            @break
                                            @case(24)
                                            @lang('Daily')   @break
                                            @case(168)
                                            @lang('Weekly')   @break
                                            @case(720)
                                            @lang('Monthly')   @break
                                            @case(2880)
                                            @lang('Quarterly')   @break
                                            @case(8640)
                                            @lang('Yearly')   @break
                                        @endswitch
                                    </td>
                                    <td>{{$data->invest_amount}}  {{$general->currency}}</td>
                                    <td>{{$data->get_percent}}%/{{is_null($data->get_action) ? 'Lifetime': $data->get_action.' Times'}}  </td>
                                    <td>{{$data->took_action}} @lang('TIMES')</td>
                                    <td>{{date('d/m/y  h:i A',strtotime($data->next_time))}}</td>
                                    <td>
                                        @if($data->status == 0)
                                            <span class="badge badge-primary">@lang('Continue')</span>
                                        @else
                                            <span class="badge badge-success">@lang('Complete')</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{$investLog->links()}}
                    </div>
                </div>
            </div>
            
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>@lang('Recent Activities') <small>@lang('Sessions')</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="dashboard-widget-content">

                            <ul class="list-unstyled timeline widget">
                               @foreach($latestNews as $data)
                                <li>
                                    <div class="block">
                                        <div class="block_content">
                                            <h2 class="title">
                                                <a href="{{route('news-area.edit', $data->id)}}">{{$data->title}}</a>
                                            </h2>
                                            <div class="byline">
                                                <span>{{$data->updated_at->diffForHumans()}}</span> @lang('by') <a>@lang('Admin')</a>
                                            </div>
                                            <p class="excerpt">
                                                {!! clean(short_text($data->description, 50))!!}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                               @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
