<!DOCTYPE html>
<html lang="en">
<head>
    <head>
	@include('mimin.include.head')
    </head>
    <body>
	@include('mimin.include.navbar')
        <!-- /navbar -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="span3">
			@include('mimin.include.sidebar')
                        <!--/.sidebar-->
                    </div>
                    <!--/.span3-->
                    <div class="span9">
                        <div class="content">
                            @yield('content')
                        </div>
                        <!--/.content-->
                    </div>
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>
        <!--/.wrapper-->
        
        @include('mimin.include.footer')

    </body>
