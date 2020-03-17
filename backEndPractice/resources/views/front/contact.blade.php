@extends('layouts/nav')


@section('content')


<div class="container ">

    <form class="" style="padding:120px 0 120px 0;" method="POST" action="/contact" enctype="multipart/form-data">
        @csrf
        <h2>
            Contact
        </h2>
        <hr>
        <div class="form-group">
          <label for="user_name">Name</label>
          <input  class="form-control" id="user_name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="form-group">
            <label for="phone">Phone</label>
            <input  class="form-control" id="phone" name="phone" required>
          </div>
        <div class="form-group">
          <label for="question">Question</label>
          <textarea class="form-control" id="question" name="question" required></textarea>
        </div>
        <div class="form-group form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1" name="SendMeMail" >
          <label class="form-check-label" for="exampleCheck1" >Send me email when the question is solved</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>


</div>


@endsection

