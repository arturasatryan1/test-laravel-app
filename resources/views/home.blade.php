@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="info d-flex justify-content-between">
                            <div>
                                <p><b>The Current Page Expired In: </b> {{$generated->expiry_date}}</p>
                                <p><a href="{{route('deactivate', $generated->id)}}" class="text-danger">Deactivate
                                        current link!</a></p>
                                <p><a href="{{route('generate-new-link', $generated->user->id)}}">Generate new
                                        link! </a></p>
                                @if(session('uri'))
                                    <p><b>URL: </b><a
                                            href="{{url('/'. session('uri'))}}">{{url('/'. session('uri'))}}</a></p>
                                    <p><b>Expiry In: </b> {{session('expiry_date')}}</p>
                                @endif
                            </div>
                            <div>
                                <button
                                    id="history"
                                    type="button"
                                    class="btn btn-primary"
                                    data-bs-toggle="modal"
                                    data-user-id="{{$generated->user->id}}"
                                    data-bs-target="#historyModal">
                                    {{__('History')}}
                                </button>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-success" id="bid"
                                    data-user-id="{{$generated->user->id}}">{{__('Im feeling lucky')}}</button>
                        </div>
                        <div id="bidResult" class="text-center mt-2 p-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="historyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="historyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">History</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="history-data">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
