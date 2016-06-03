<script>
$('a.delete').on('click', function() {
    var choice = confirm('Do you really want to delete this record?');
    if(choice === true) {
        return true;
    }
    return false;
});
</script>
<div class="footer">
            <div class="container">
                <b class="copyright">&copy; 2016 Calova - Admin Page </b>All rights reserved.
            </div>
            </** mocha was here **/>
        </div>
        <script src="http://calova.id/minset/scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="http://calova.id/minset/scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="http://calova.id/minset/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="http://calova.id/minset/scripts/flot/jquery.flot.js" type="text/javascript"></script>
        <script src="http://calova.id/minset/scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
        <script src="http://calova.id/minset/scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="http://calova.id/minset/scripts/common.js" type="text/javascript"></script>