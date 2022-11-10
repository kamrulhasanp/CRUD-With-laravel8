<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           All Category <b></b>
          
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">

                <div class="col-md-8 " >
                    <div class="card" >

                    @if(session('success'))


                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{session('success')}}</strong>
            
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                    
                    @endif
                        <div class="card-header"> All Category

                        </div>
                 

                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Serial Number</th>
                            <th scope="col">Ctegory Name</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Created At</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- @php($i = 1) -->
                            @foreach($categories as $category)
                            <tr>
                            <!-- <th scope="row">{{$i++}}</th> -->
                            <th scope="row">{{ $categories->firstItem()+$loop->index }}</th>
                            <td>{{ $category->category_name }}</td>
                            <!-- <td>{{ $category->user_id }}</td>
                            <td>{{ $category->user->name }}</td> -->
                            <td>{{ $category->name }}</td>
                            <td>

                            @if($category->created_at == null)
                            <span class="text-danger" >No Date set </span>
                            @else
                                {{Carbon\Carbon::parse($category->created_at)->diffForHumans() }}
                                <!-- {{ $category->created_at->diffForHumans() }} -->
                             @endif

                            </td>
                           
                            </tr>
                            @endforeach

                    
                    </tbody>
                    </table>
                        <!-- for how much pagination have -->
                    {{ $categories->links() }}

                         </div>
                    </div>

                    
                <div class="col-md-4 " >
                    <div class="card" >
                        <div class="card-header"> Add Category </div>
                        <div class="card-body" >

                            <form action="{{route('store.category')}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Category Name</label>
                                    <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @error('category_name')

                                    <span class="text_denger" >{{ $message }}</span>

                                    @enderror
                            
                                    
                                </div>

                                
                                <button type="submit" class="btn btn-primary bg-primary ">Add Category</button>
                                </form>
                                </div>
                    </div>
                 </div>

            </div>
            
        </div>
    </div>
</x-app-layout>
