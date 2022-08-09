@if(Session::has('success-main'))
    <p class="alert alert-success">{{ Session::get('success-main') }} <button class="close" data-dismiss="alert">&times;</button> </p>
@endif
<!---Warning Alert--->
@if(Session::has('warning-main'))
    <p class="alert alert-warning">{{ Session::get('warning-main') }} <button class="close" data-dismiss="alert">&times;</button> </p>
@endif

<!---Danger Alert--->

@if(Session::has('danger-main'))
    <p class="alert alert-danger">{{ Session::get('danger-main') }} <button class="close" data-dismiss="alert">&times;</button> </p>
@endif

<!---Info Alert--->

@if(Session::has('info-main'))
    <p class="alert alert-info">{{ Session::get('info-main') }} <button class="close" data-dismiss="alert">&times;</button> </p>
@endif