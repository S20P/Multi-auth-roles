@extends('customer.layouts.master')
    @section('content')
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('customer.profile') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                        <div class="form-group col-sm-12">
                            <img src="{{url($Customer_details->image)}}" alt=""  width="100" height="100">
                            <label>Profile Picture</label>
                            <input type="file" name="image"   class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group col-sm-6">
                         <label>Name</label>
                                <input type="text" name="name" value="{{ old('name',$Customer_details->name ) }}"  class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                           <!-- text input -->
                        <div class="form-group col-sm-6">
                        <label>Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email',$Customer_details->email) }}" autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>    <!-- load the view from type and view_namespace attribute if set -->
   
                        <div class="form-group col-sm-6">
                            <label>Phone</label>
                                <input type="text" name="phone" value="{{ old('phone',$Customer_details->phone) }}" class="form-control  @error('phone') is-invalid @enderror">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                       </div>
                            <!-- load the view from type and view_namespace attribute if set -->
                       

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   Save
                                </button>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    @endsection

    