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
                        <h3 class="page-title mt-5">Edit Room</h3> 
                    </div>
                </div>
            </div>
            <form action="{{ route('form/room/update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
    <div class="col-lg-12">
        <div class="row formtype">

            <!-- Ajouter les champs cachés nécessaires -->
            <input type="hidden" name="id" value="{{ $roomEdit->id }}">
            <input type="hidden" name="name" value="{{ auth()->id() }}">

            <div class="col-md-4">
                <div class="form-group">
                    <label>Number Room</label>
                    <input type="number" class="form-control @error('num_room') is-invalid @enderror" id="num_room" name="num_room" value="{{ $roomEdit->num_room }}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Room Type</label>
                    <select class="form-control @error('room_type') is-invalid @enderror" id="room_type" name="room_type">
                        <option selected disabled> {{$roomEdit->room_type}} </option>
                        @foreach ($data as $items)
                            @if($roomEdit->room_type === $items->room_name)
                                <option value="{{ $items->room_name }}" selected>{{ $items->room_name }}</option>
                            @else
                                <option value="{{ $items->room_name }}">{{ $items->room_name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>AC/NON-AC</label>
                    <select class="form-control @error('ac_non_ac') is-invalid @enderror" id="ac_non_ac" name="ac_non_ac">
                        <option disabled selected>{{$roomEdit->ac_non_ac}}</option>
                        <option value="AC" {{ $roomEdit->ac_non_ac === 'AC' ? 'selected' : '' }}>AC</option>
                        <option value="NON-AC" {{ $roomEdit->ac_non_ac === 'NON-AC' ? 'selected' : '' }}>NON-AC</option>
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Food</label>
                    <select class="form-control @error('food') is-invalid @enderror" id="food" name="food">
                        <option disabled selected>{{$roomEdit->food}}</option>
                        <option value="Free Breakfast" {{ $roomEdit->food === 'Free Breakfast' ? 'selected' : '' }}>Free Breakfast</option>
                        <option value="Free Lunch" {{ $roomEdit->food === 'Free Lunch' ? 'selected' : '' }}>Free Lunch</option>
                        <option value="Free Dinner" {{ $roomEdit->food === 'Free Dinner' ? 'selected' : '' }}>Free Dinner</option>
                        <option value="Free Breakfast & Dinner" {{ $roomEdit->food === 'Free Breakfast & Dinner' ? 'selected' : '' }}>Free Breakfast & Dinner</option>
                        <option value="Free Welcome Drink" {{ $roomEdit->food === 'Free Welcome Drink' ? 'selected' : '' }}>Free Welcome Drink</option>
                        <option value="No Free Food" {{ $roomEdit->food === 'No Free Food' ? 'selected' : '' }}>No Free Food</option>
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Bed Count</label>
                    <select class="form-control @error('bed_count') is-invalid @enderror" id="bed_count" name="bed_count">
                        <option disabled selected>{{$roomEdit->bed_count}}</option>
                        @for ($i = 1; $i <= 6; $i++)
                            <option value="{{ $i }}" {{ $roomEdit->bed_count == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Rent</label>
                    <input type="text" class="form-control @error('rent') is-invalid @enderror" id="rent" name="rent" value="{{ $roomEdit->rent }}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="number" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ $roomEdit->phone_number }}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>File Upload</label>
                    <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input @error('fileupload') is-invalid @enderror" id="fileupload" name="fileupload">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Message</label>
                    <textarea class="form-control @error('message') is-invalid @enderror" rows="1.5" id="message" name="message">{{ $roomEdit->message }}</textarea>
                </div>
            </div>

            <!-- Ajouter d'autres champs ici en suivant la même structure -->

            <!-- ... Fin des autres champs ... -->

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