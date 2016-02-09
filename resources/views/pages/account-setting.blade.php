@extends('index')
@section('content')


<div class="bc-bg">
    <ul class="breadcrumb container">
        <li><a href="{{ baseUrl() }}">Home</a></li>
        <li><a href="{{ route('account', Lang::get('url')['account']) }}">Account</a></li>
        <li class="active">Setting</li>
    </ul>
</div>
<div class="line-top"> <h3><small>SETTING</small> </h3></div>

<div class="setting container">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-3 col-sm-4">
                <div class="list-group">
                    <h5 class="list-group-item active">
                        Setting
                    </h5>
                    <a href="#" class="list-group-item">Dashboard</a>
                    <a href="#" class="list-group-item">Inbox</a> 
                    <a href="#" class="list-group-item">Your Listing</a> 
                    <a href="#" class="list-group-item">Profile</a>
                    <a href="#" class="list-group-item">Account</a>
                </div>
            </div>
            
            <div class="col-md-9 col-sm-8">
                
                    <div class="list-group">
                        <h5 class="list-group-item active">
                            Dashboard
                        </h5>
                        <div class="list-group-item">
                        
                            <form class="form-horizontal">
                                <fieldset>
                                    
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" id="inputEmail" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                                        <div class="col-lg-10">
                                            <input type="password" class="form-control" id="inputPassword" placeholder="Password">
    
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="textArea" class="col-lg-2 control-label">Textarea</label>
                                        <div class="col-lg-10">
                                            <textarea class="form-control" rows="3" id="textArea"></textarea>
                                            <span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <div class="col-lg-10 col-lg-offset-2">
                                            <button type="reset" class="btn btn-default">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
</div>

@stop