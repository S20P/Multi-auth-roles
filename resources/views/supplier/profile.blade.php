@extends('supplier.layouts.master')
    @section('content')
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('supplier.profile') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                        <div class="form-group col-sm-12">
                            <img src="{{url($Supplier_details->image)}}" alt=""  width="100" height="100">
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
                                <input type="text" name="name" value="{{ old('name',$Supplier_details->name ) }}"  class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                           <!-- text input -->
                        <div class="form-group col-sm-6">
                        <label>Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email',$Supplier_details->email) }}" autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>    <!-- load the view from type and view_namespace attribute if set -->
   
                        <div class="form-group col-sm-6">
                            <label>Phone</label>
                                <input type="text" name="phone" value="{{ old('phone',$Supplier_details->phone) }}" class="form-control  @error('phone') is-invalid @enderror">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                       </div>
                            <!-- load the view from type and view_namespace attribute if set -->
                            <!-- text input -->
                        <div class="form-group col-sm-6">
                            <label>Service name</label>
                                            <input type="text" name="service_name" value="{{ old('service_name',$Supplier_details->service_name) }}" class="form-control  @error('service_name') is-invalid @enderror">
                  
                                 @error('service_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                            <!-- load the view from type and view_namespace attribute if set -->
                            <!-- text input -->
                        <div class="form-group col-sm-6">
                            <label>Business name</label>
                                        <input type="text" name="business_name" value="{{ old('business_name',$Supplier_details->business_name) }}" class="form-control  @error('business_name') is-invalid @enderror">
                                        @error('business_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                            <!-- load the view from type and view_namespace attribute if set -->
                            <!-- text input -->
                        <div class="form-group col-sm-6">
                            <label>Category</label>
                            
                            <select name="category" class="form-control  @error('category') is-invalid @enderror">
                            <option>Select Category</option>
                             @foreach($Category as $item)
                                       <option value="{{$item}}" {{(isset($Supplier_details) && $Supplier_details->category == $item) ? 'Selected':'' }}>{{$item}}</option>
                             @endforeach          
                             </select>
                                       
                        </div>
                            <!-- load the view from type and view_namespace attribute if set -->
                            <!-- textarea -->
                        <div class="form-group col-sm-6">
                            <label>Service description</label>
                                <textarea name="service_description" class="form-control  @error('service_description') is-invalid @enderror" >{{ old('service_description',$Supplier_details->service_description) }}</textarea>
                   
                                @error('service_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>    <!-- load the view from type and view_namespace attribute if set -->
                            <!-- text input -->
                        <div class="form-group col-sm-6">
                            <label>Event type</label>
                                            <input type="text" name="event_type" value="{{ old('event_type',$Supplier_details->event_type) }}" class="form-control  @error('event_type') is-invalid @enderror" >
                                            @error('event_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                            <!-- load the view from type and view_namespace attribute if set -->
                            <!-- text input -->
                        <div class="form-group col-sm-6">
                            <label>Location</label>
                                            <input type="text" name="location" value="{{ old('location',$Supplier_details->location) }}" class="form-control  @error('location') is-invalid @enderror">
                                            @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                            <!-- load the view from type and view_namespace attribute if set -->
                            <!-- text input -->
                        <div class="form-group col-sm-6">
                            <label>Pricing category</label>
                              <input type="text" name="pricing_category" value="{{ old('pricing_category',$Supplier_details->pricing_category) }}" class="form-control  @error('pricing_category') is-invalid @enderror">
                              @error('pricing_category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        </div>

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

    