@extends('layouts.frontend-no-sidebar')

@section('title', 'contact')
    

@section('content')
<div id="contact-page" class="container">
    <div class="bg">
        <div class="row">    		
            <div class="col-sm-12">
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('success') !!}</li>
                        </ul>
                    </div>
                @endif   			   			
                <h2 class="title text-center">Contact <strong>Us</strong></h2>    			    				    				
                <div id="gmap" class="contact-map">
                    <div class="status alert alert-success" style="display: none"></div>
                    <form id="main-contact-form" class="contact-form row" name="contact-form" action="{{ route('contact.post') }}" method="post">
                        @csrf
                        <div class="form-group col-md-6">
                            <input type="text" name="name" class="form-control" required="required" maxlength="100" placeholder="Name">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="email" name="email" class="form-control" required="required" maxlength="100" placeholder="Email">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="text" name="title" class="form-control" required="required" maxlength="100" placeholder="Title">
                        </div>
                        <div class="form-group col-md-12">
                            <textarea name="content" id="content" required="required" class="form-control" maxlength="3000" rows="8" placeholder="Your Message Here"></textarea>
                        </div>                        
                        <div class="form-group col-md-12">
                            <input type="submit" name="submit" class="btn btn-primary pull-right" value="Gửi">
                        </div>
                    </form>
                </div>
            </div>			 		
        </div>    	
    </div>	
</div><!--/#contact-page-->
@endsection