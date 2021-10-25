@extends('layouts.home-master')
@section('title','Contact')

@section('content')

<h1>Contact Us</h1>
@if(session('emailSent'))
    <p>{{session('emailSent')}}</p>
    @elseif(session('emailFailed'))
    <p>{{session('emailFailed')}}</p>

@endif
<section>
<div class="content-media">
<div class="primary-content">
    <form name="cForm" id="cForm" method="post" action="{{route('contact.mail')}}" method="post">
    @csrf
    
    <div class="form-field">
        <input name="name" type="text" id="cName" class="full-width" placeholder="Your Name" value="">
        @error('name')
            {{$message}}
        @enderror
    </div>
   
   
    <div class="form-field">
        <input name="email" type="text" id="cEmail" class="full-width" placeholder="Your Email" value="">
        @error('email')
            {{$message}}
        @enderror
    </div>
    <div class="form-field">
        <input name="subject" type="text" id="cWebsite" class="full-width" placeholder="Subject"  value="">
        @error('subject')
            {{$message}}
        @enderror
    </div>
    
    <div class="message form-field">
        <textarea name="textContact" id="cMessage" class="full-width" placeholder="Your Message" ></textarea>
        @error('textContact')
            {{$message}}
        @enderror
    </div>
    <input type="submit" name="submit" id="submit" value="Send Message" class="form-control btn btn-primary"/>
    </form>
</div>
</div>
    </section>

@endsection