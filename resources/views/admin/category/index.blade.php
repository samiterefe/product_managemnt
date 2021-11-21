<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

         All Category


        </h2>
    </x-slot>

    <div class="py-12">

      <div class="container">
          <div class="row">

                <div class="col-md-8">

                    <div class="card">

                      


                       <div class="card-header">All category</div>
                       <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">ID NO</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">User</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>

                             @foreach ($categories as $category )


                                <tr>
                                    <th scope="row" >{{$category->id}}</th>
                                    <td>{{$category->category_name}}</td>
                                    <td>{{$category->user->name}}</td>
                                    <td>
                                    @if ($category->created_at == NULL)
                                     <span class = "text-danger">No date set</span>
                                    @else
                                     {{Carbon\Carbon::parse($category->created_at)->diffForHumans()}}
                                    @endif
                                   </td>
                                   <td>
                                       <a href="{{ url('/category/edit/'.$category->id) }}" class="btn btn-info">Edit</a>
                                       <a href="{{ url('/softdelete/category/'.$category->id) }}" class="btn btn-danger">Delete</a>
                                   </td>

                                </tr>

                            @endforeach

                        </tbody>
                      </table>

                      {{ $categories->links()  }}


                    </div>

                 </div>
                 <div class="col-md-4">
                    <div class="card">
                       <div class="card-header">Add category</div>

                       <div class="card-body">
                        <form action = "{{ route('store.category') }}" method="POST" >
                            @csrf
                            <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">   Category Name</label>
                            <input type="text" class="form-control" name="category_name" id="exampleInputEmail1" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">You are going to add new category</div>

                            @error('category_name')
                               <span class="text-danger">{{$message}}</span>
                            @enderror


                            </div>

                            <button type="submit" class="btn btn-primary">Add Category</button>
                        </form>

                       </div>



                    </div>

                 </div>



          </div>
      </div>




    </div>



    {{-- trashed --}}
    <div class="container">
        <div class="row">

              <div class="col-md-8">

                  <div class="card">





                     <div class="card-header">Trashed  category</div>
                     <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">ID NO</th>
                          <th scope="col">Category Name</th>
                          <th scope="col">User</th>
                          <th scope="col">Created At</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>

                           @foreach ($trashedCat as $category )


                              <tr>
                                  <th scope="row" >{{$category->id}}</th>
                                  <td>{{$category->category_name}}</td>
                                  <td>{{$category->user->name}}</td>
                                  <td>
                                  @if ($category->created_at == NULL)
                                   <span class = "text-danger">No date set</span>
                                  @else
                                   {{Carbon\Carbon::parse($category->created_at)->diffForHumans()}}
                                  @endif
                                 </td>
                                 <td>
                                     <a href="{{ url('/restore/category/'.$category->id) }}" class="btn btn-info">Restore</a>
                                     <a href="{{ url('/delete/category/'.$category->id) }}" class="btn btn-danger">P Delete</a>
                                 </td>

                              </tr>

                          @endforeach

                      </tbody>
                    </table>

                    {{ $trashedCat->links()  }}


                  </div>

               </div>
               <div class="col-md-4">


               </div>



        </div>
    </div>

    {{-- trashe finished --}}



</x-app-layout>









