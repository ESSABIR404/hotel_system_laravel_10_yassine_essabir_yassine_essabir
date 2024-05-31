@extends('layouts.master')
@section('content')
    <style>
        .avatar {
            background-color: #aaa;
            border-radius: 50%;
            color: #fff;
            display: inline-block;
            font-weight: 500;
            height: 38px;
            line-height: 38px;
            margin: -38px 10px 0 0;
            text-align: center;
            text-decoration: none;
            text-transform: uppercase;
            vertical-align: middle;
            width: 38px;
            position: relative;
            white-space: nowrap;
            z-index: 2;
        }
    </style>
    {{-- message --}}
    {!! Toastr::message() !!}
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Edit Booking</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('form/booking/update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row formtype">

                       

                        
                            
                            <input type="hidden" name="id" value="{{ $bookingEdit->id }}">
                            <input type="hidden" name="id_users" value="{{ auth()->id() }}">


                        <div class="col-md-4">
                                <div class="form-group">
                                    <label>bkg_customer_name</label>
                                    <select class="form-control @error('id_customers') is-invalid @enderror" id="sel1" name="id_customers">
                                        
                                        @foreach ($customers as $customers )
                                    @if($bookingEdit->id_customers === $customers->id)
                                        <option value="{{$customers->id}}" >{{ $customers->first_name }} {{ $customers->last_name }}</option>
                                        
                                    @else
                                        <option {{ old('id') == $customers->id ? "selected" : "" }} value="{{ $customers->id }}">{{ $customers->first_name }} {{ $customers->last_name }}</option>
                                    @endif
                                        
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Number Room</label>
                                    <select class="form-control @error('id_rooms') is-invalid @enderror" id="sel1" name="id_rooms">

                                        
                                        @foreach ($rooms as $rooms )
                                        @if($bookingEdit->id_customers === $customers->id)
                                        <option value="{{$rooms->id}}" > {{ $rooms->num_room }} </option>
                                        
                                    @else
                                        <option {{ old('id') == $rooms->id ? "selected" : "" }} value="{{ $rooms->id }}">{{ $rooms->num_room }}</option>
                                    @endif
                                        
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                       

                           
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Total Members</label>
                                    <input type="number" class="form-control @error('total_numbers') is-invalid @enderror"name="total_numbers" value="{{ $bookingEdit->total_numbers }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Date</label>
                                    <div class="cal-icon">
                                        <input type="text" class="form-control datetimepicker @error('date') is-invalid @enderror"name="date" value="{{ $bookingEdit->date }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Time</label>
                                    <div class="time-icon">
                                        <input type="text" class="form-control @error('time') is-invalid @enderror" id="datetimepicker3" name="time" value="{{ $bookingEdit->time }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Arrival Date</label>
                                    <div class="cal-icon">
                                        <input type="text" class="form-control datetimepicker @error('arrival_date') is-invalid @enderror" name="arrival_date" value="{{ $bookingEdit->arrival_date }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Depature Date</label>
                                    <div class="cal-icon">
                                        <input type="text" class="form-control datetimepicker @error('departure_date') is-invalid @enderror" name="departure_date" value="{{ $bookingEdit->departure_date }}"> 
                                    </div>
                                </div>
                            </div>
                           
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea class="form-control @error('message') is-invalid @enderror" rows="1.5" id="message" name="message">{{ $bookingEdit->message }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary buttonedit">Update</button>
            </form>
        </div>
    </div>
    @section('script')
    <script>
        $(function() {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'
            });
        });
        </script>
    @endsection
@endsection