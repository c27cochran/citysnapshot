@extends('layouts/default')

{{-- Page title --}}
@section('title')
@parent
: {{{ trans('platform/admin::general.title') }}}
@stop

{{-- Queue assets: Asset::queue('name-your-asset', 'path-to-asset', array('dependency-name')) --}}

{{-- Inline scripts --}}
@section('scripts')
@parent
<script>
    $(document).ready(function() {

        $('#jc').on('change', function() {

            var jc_select = $(this);
            var jc_value = $('option:selected', jc_select).val();

            var mr_select = $("#minRating");
            var mr_value = $('option:selected', mr_select).val();

            $("#employers").show();

            $.getJSON('jobs/job-titles?jc='+jc_value+'&minRating='+mr_value, function(data) {

                if (data.response.countReturned = "0") {

                    var noData = "<h4>No Data</h4>";
                    $(noData).appendTo("#no-employer-data");
                    $("#spinner").hide();
                };

                var empty_option = "<option value=''>Select a job</option>";
                $(empty_option).appendTo("#jt");

                $.each(data.response.jobTitles, function(i,gd){
                        var option =
                            "<option value='"+gd.jobTitle+"'>"+gd.jobTitle+" - "+gd.numJobs+" Openings</option>";
                        $('#job-titles').show();
                        $('#jc').prop('disabled', 'disabled');
                        $('#minRating').prop('disabled', 'disabled');
                        $(option).appendTo("#jt");
                 });

                $.each(data.response.employers, function(i,gd){

                    if (gd.squareLogo === "") {
                        gd.squareLogo = "http://static.glassdoor.com/static/img/sqLogo/generic-200.png?v=59996614x";
                    }

                    if (gd.numJobs == 1) {
                        openings = "Opening";
                    } else {
                        openings = "Openings";
                    }

                    if (gd.numberOfReviews == 1) {
                        reviews = "Review";
                    } else {
                        reviews = "Total Reviews";
                    }

                    var tblRow =
                        "<tr>" +
                            "<td><img src="+gd.squareLogo+" width='75'></td>" +
                            "<td><h3><a href=?id="+gd.id+"&name="+encodeURIComponent(gd.name)+">"+gd.name+"</a></h3></td>" +
                            "<td>"+gd.numJobs+" "+openings+"</td>" +
                            "<td><strong>"+gd.rating+"</strong></td>" +
                            "<td><img src="+gd.starImageSrc+" alt='Star Rating'> "+gd.numberOfReviews+" "+reviews+"</td>" +
                        "</tr>";
                    $(tblRow).appendTo("#employer-list tbody");
                    $("#spinner").hide();

                });

            });

        });

//        $('#jt').on('change', function() {
//
//            var select = $(this);
//            var value = $('option:selected', select).val();
//
//            $('#job-stats-list').show();
//
//            $.getJSON('jobs/job-stats?jobTitle='+value, function(data) {
//
//                var tblRow =
//                    "<tr>" +
//                        "<td><h3>"+data.response.jobTitle+"</h3></td>" +
//                        "<td>$"+data.response.payLow.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"</td>" +
//                        "<td>$"+data.response.payMedian.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"</td>" +
//                        "<td>$"+data.response.payHigh.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"</td>" +
//                        "</tr>";
//                $(tblRow).appendTo("#job-stats-list tbody");
//
//            });
//
//        });

    });
</script>
@stop

{{-- Inline styles --}}
@section('styles')
@parent
@stop

{{-- Page content --}}
@section('content')

<div class="jumbotron">

    <div class="container">

        <h1>Jobs</h1>
        <div id="job-sources">
            <span>powered by
                <a href='http://www.glassdoor.com/index.htm' target="_blank"><img src='http://www.glassdoor.com/static/img/api/glassdoor_logo_80.png' title='Job Search' alt="Glassdoor" /></a> and
                <a href="http://www.linkedin.com" target="_blank"><img class="linked-in-logo" src="{{ Asset::getUrl('platform/img/linked-in.png') }}" alt="LinkedIn" /></a>
            </span>
        </div>

    </div>

</div>

<?php

if (!isset($_GET['id'])) { ?>

<div class="job-category">
    <form method="get" accept-charset="UTF-8">

        <label for="minRating">Minimum Company Rating</label>
        <select class="form-control" name="minRating" id="minRating">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <label for="jc">Job Category</label>
        <select class="form-control" name="jc" id="jc">
            <option selected value="">Select a category</option>
            <option value="1">Accounting / Finance</option>
            <option value="2">Administrative</option>
            <option value="3">Analyst</option>
            <option value="4">Architecture / Drafting</option>
            <option value="5">Art / Design / Entertainment</option>
            <option value="6">Banking / Loan / Insurance</option>
            <option value="7">Beauty / Wellness</option>
            <option value="8">Business Development / Consulting</option>
            <option value="9">Education</option>
            <option value="10">Engineering (Non-software)</option>
            <option value="11">Facilities / General Labor</option>
            <option value="12">Hospitality</option>
            <option value="13">Human Resources</option>
            <option value="14">Installation / Maintenance / Repair</option>
            <option value="15">Legal</option>
            <option value="16">Manufacturing / Production / Construction</option>
            <option value="17">Marketing / Advertising / PR</option>
            <option value="18">Medical / Healthcare</option>
            <option value="19">Non-Profit / Volunteering</option>
            <option value="20">Product / Project Management</option>
            <option value="21">Real Estate</option>
            <option value="22">Restaurant / Food Services</option>
            <option value="23">Retail</option>
            <option value="24">Sales / Customer Care</option>
            <option value="25">Science / Research</option>
            <option value="26">Security / Law Enforcement</option>
            <option value="27">Senior Management</option>
            <option value="28">Skilled Trade</option>
            <option value="29">Software Development / IT</option>
            <option value="30">Sports / Fitness</option>
            <option value="31">Travel / Transportation</option>
            <option value="32">Writing / Editing / Publishing</option>
            <option value="33">Other</option>
        </select>
    </form>

    <br>

    <div id="employers" style="display: none;">
        <span id="spinner" class="fa fa-spinner fa-spin"></span>
        <table id="employer-list" border="1" class="data-grid table table-striped table-bordered table-hover">
            <tbody></tbody>
        </table>
    </div>
    <span id="no-employer-data"></span>

    <br>

    <div id="job-titles" style="display: none;">
        <label for="jt">Job Openings</label>
        <select class="form-control" id="jt">
        </select>
    </div>

    <br>

<!--    <div id="jobs-stats">-->
<!--        <table id="job-stats-list" border="1" class="data-grid table table-striped table-bordered table-hover" style="display: none;">-->
<!--            <thead>-->
<!--                <th>Job Title</th>-->
<!--                <th>Lowest Pay</th>-->
<!--                <th>Median Pay</th>-->
<!--                <th>Highest Pay</th>-->
<!--            </thead>-->
<!--            <tbody></tbody>-->
<!--        </table>-->
<!--    </div>-->
</div>

<?php
}
?>

<?php

if (isset($_GET['id']) && isset($_GET['name'])) {

    $id = $_GET['id'];
    $name = $_GET['name'];

    ?>
<div class="col-md-4">
    <div class="gdWidget"><a href="http://www.glassdoor.com/api/api.htm?version=1&action=employer-combo&t.s=w-m&t.a=c&format=300x400&employerId=<?php echo $id;?>&activeTab=R" target="_gd"><?php echo $name;?> Salaries</a> | More details for <a href="http://www.glassdoor.com/api/api.htm?version=1&action=employer-jobs&t.s=w-m&t.a=c&employerId=<?php echo $id;?>" target="_gd"><?php echo $name;?> Jobs</a> | <a href="http://www.glassdoor.com/api/api.htm?version=1&action=employer-review&t.s=w-m&t.a=c&employerId=<?php echo $id;?>" target="_gd"><?php echo $name;?> Reviews</a> | <a href="http://www.glassdoor.com/api/api.htm?version=1&action=employer-interview&t.s=w-m&t.a=c&employerId=<?php echo $id;?>" target="_gd"><?php echo $name;?> Interview Questions & Reviews</a></div><script src="http://www.glassdoor.com/static/js/api/widget/v1.js" type="text/javascript"></script>
</div>
<div class="col-md-4">
    <iframe
        width="300"
        height="400"
        frameborder="0" style="border:0"
        src="https://www.google.com/maps/embed/v1/search?key=AIzaSyAGnnBr0dVnl6KSIHAYsO97BOdB5SIxBiQ&q=<?php echo $name;?>+Austin">
    </iframe>
</div>
<div class="col-md-4">
    <script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
    <script type="IN/JYMBII" data-format="inline"></script>
</div>

<?php
}
?>


@stop
