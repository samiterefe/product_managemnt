<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        Edit  Brand


        </h2>
    </x-slot>

    <div class="py-12">

      <div class="container">
          <div class="row">


                 <div class="col-md-8">
                    <div class="card">

                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                           <strong>{{ session('success')}}</strong>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                          </button>
                        </div>

                      @endif
                       <div class="card-header">Edit Brand</div>

                       <div class="card-body">
                        <form action = "{{ url('brand/update/'.$brands->id) }}" method="POST"  enctype="multipart/form-data" >
                            @csrf
                            <input type="hidden"  value="{{ $brands->brand_image }}" name="old_image"  >
                            <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">   brand Name</label>
                            <input type="text" class="form-control" name="brand_name" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $brands->brand_name }}">

                            <div id="emailHelp" class="form-text">You are going to add new brand</div>

                            @error('brand_name')
                               <span class="text-danger">{{$message}}</span>
                            @enderror


                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">   Brand Image</label>
                                <input type="file" class="form-control"  value="{{ asset($brands->brand_image) }}" name="brand_image" id="exampleInputEmail1" aria-describedby="emailHelp">



                                </div>
                                @error('brand_image')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror

                                <div class="card" style="width: 250px; height: 200px;">

                                    <img style="height: 100%" src="{{asset($brands->brand_image)}}" alt="">

                                </div>
                                <div id="emailHelp" class="form-text">You are going to Update new brand</div>

                            <button type="submit" class="btn btn-primary">Update brand</button>
                        </form>

                       </div>



                    </div>

                 </div>



          </div>
      </div>




    </div>
</x-app-layout>
