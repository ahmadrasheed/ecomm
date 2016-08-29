@extends('layouts.master')


@section('content')





<h3> Categories&nbsp;<i class="fa fa-tags" aria-hidden="true"></i></h3>

@if(Session::has('success'))
    <div class="row">
        <div class="col-sm-12 col-md-4 col-md-offset-4 col-sm-offset-3">
            <div id="charge-message" class="alert alert-success">
                {{ Session::get('success') }}
                {{Session::forget('success')}}
            </div>
        </div>
    </div>
@endif

<div class="row">

<div class="col-sm-12 col-md-12">



        <div class="panel panel-default">
            <div class="panel-heading">All Categories:</div>

                <div class="panel-body">

                    <div class="list-group">
                        @foreach($categories as $category)


                            <div class="form-group">
                            <form class="form-inline" method="post" action="{{route('categories.updateOrdelete')}}">


                                    <input type="text" class="form-control " value="{{$category->name}}" name="name" id="name" >


                                <button type="submit" name="update" class="btn btn-primary form-control">update</button>
                                <button type="submit" name="delete" class="btn btn-danger form-control">delete </button>

                               {{-- <a href="#" class="btn btn-info fa fa-trash" role="button"></a>--}}
                                <a href="/category-products/{{$category->id}}" class="btn btn-success">view All products</a>

                                <input type="hidden" name="id" value="{{$category->id}}">
                                {{csrf_field()}}
                            </form>
                            </div>

{{--
                            ========       View button on categories page ===========
--}}

                        @endforeach
                    </div>
                </div>
        </div>

</div>


</div>


<div class="row">


    <div class="col-sm-12 col-md-12">



        <div class="panel panel-default">
            <div class="panel-heading">All Categories:</div>

            <div class="panel-body">

                <div class="list-group">

                        <form class="form-inline" method="post" action="{{route('categories.add')}}">
                            <div class="form-group">

                                <input type="text" class="form-control " name="name" id="name" >


                                <button type="submit" name="add" class="btn btn-success form-control">Add New Category </button>

                                {{-- <a href="#" class="btn btn-info fa fa-trash" role="button"></a>--}}

                            </div>

                            {{csrf_field()}}
                        </form>



                </div>
            </div>
        </div>

    </div>



</div>


</div>




    @endsection