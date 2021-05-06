@extends('admin.layouts.master')

@section('title',__('Deposit Log'))

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>
                        @if (request()->path() == 'admin/deposit/acceptedRequests')
                            @lang('Accepted')
                        @elseif (request()->path() == 'admin/deposit/rejectedRequests')
                            @lang('Rejected')
                        @elseif (request()->path() == 'admin/deposit/pending')
                            @lang('Pending')
                        @endif
                        @lang('Deposit Request')
                    </h2>
                </div>

                <div class="card-body table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">@lang('Name')</th>
                            <th scope="col">@lang('Gateway Name')</th>
                            <th scope="col">@lang('Amount')</th>
                            <th scope="col">@lang('Charge')</th>
                            <th scope="col">@lang('Receipt')</th>
                            @if (request()->path() != 'admin/deposit/acceptedRequests' && request()->path() != 'admin/deposit/rejectedRequests')
                                <th scope="col">@lang('Action')</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($deposits as $deposit)
                            <tr>
                                <td data-label="Name">{{++$i}}</td>
                                <td data-label="Username"><a target="_blank" href="{{route('user.view', $deposit->user_id)}}">{{$deposit->user->name}}</a></td>
                                <td data-label="Email">{{$deposit->gateway->name}}</td>
                                <td data-label="Mobile">{{round($deposit->amount, 8)}} {{$general->currency}}</td>
                                <td data-label="Balance">{{round($deposit->charge, 8)}} {{$general->currency}}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary showImageInModal" data-depID="{{$deposit->id}}" ><i class="fa fa-eye"></i> @lang('Show')</button>
                                </td>
                                @if (request()->path() != 'admin/deposit/acceptedRequests' && request()->path() != 'admin/deposit/rejectedRequests')
                                    <td data-label="Details">
                                        <form class="inline-block" action="{{route('admin.deposit.accept')}}" method="post" style="position: relative;top: 9px;>
                                            {{csrf_field()}}
                                            <input type="hidden" name="gid" value="{{$deposit->gateway->id}}">
                                            <input type="hidden" name="dID" value="{{$deposit->id}}">
                                            <button type="submit" class="btn btn-sm btn-success">
                                                <i class="fa fa-check"></i>  @lang('Accept Request')
                                            </button>
                                        </form>
                                        <form class="inline-block" action="{{route('admin.deposit.rejectReq')}}" method="post" style="position: relative;top: 9px;>
                                            {{csrf_field()}}
                                            <input type="hidden" name="dID" value="{{$deposit->id}}">
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fa fa-times"></i> @lang('Reject Request')
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$deposits->links()}}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade showImageModal" id="showImageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Receipt Image') <span id="modalHeader"></span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img class="width-100" id="adImage" src="" alt="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        (function($) {
            "use strict";
            $(document).ready(function(){
                $('.showImageInModal').on('click',function(){
                    $.get(
                        '{{route('admin.deposit.showReceipt')}}',
                        {
                            dID: $(this).attr('data-depID'),
                        },
                        function(data) {
                            $('.showImageModal').modal('show');
                            document.getElementById('adImage').src = '{{asset('images/receipt_img')}}'+'/'+data.r_img;
                        }
                    );
                });
            });
    })(jQuery);
    </script>
@stop
