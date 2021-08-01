$('#pTable').DataTable();
$('#vdTable').DataTable();
$('#cTable').DataTable();
$('#vTable').DataTable();
$('#addProject').on('click', function () {
    $('#projectModal').show();
    $('body').css("overflow", "hidden");
});

$('#close-btn').on('click', function () {
    $('#projectModal').hide();
    $('body').css("overflow", "scroll");
});
$('.close-btn-bottom').on('click', function () {
    $('#projectModal').hide();
    $('body').css("overflow", "scroll");
});

$('#addClient').on('click', function () {
    $('#clientModal').show();
    $('body').css("overflow", "hidden");
});

$('#close-client-btn').on('click', function () {
    $('#clientModal').hide();
    $('body').css("overflow", "scroll");
});
$('#close-client-bottom').on('click', function () {
    $('#clientModal').hide();
    $('body').css("overflow", "scroll");
});

$('#addVendor').on('click', function () {
    $('#vendorModal').show();
    $('body').css("overflow", "hidden");
});

$('#close-vendor-btn').on('click', function () {
    $('#vendorModal').hide();
    $('body').css("overflow", "scroll");
});
$('#close-vendor-bottom').on('click', function () {
    $('#vendorModal').hide();
    $('body').css("overflow", "scroll");
});

$('#addVendorDetail').on('click', function () {
    $('#addVendorDetailModal').show();
    $('body').css("overflow", "hidden");
});

$('#close-vendordetail-btn').on('click', function () {
    $('#addVendorDetailModal').hide();
    $('body').css("overflow", "scroll");
});
$('#close-vendordetail-bottom').on('click', function () {
    $('#addVendorDetailModal').hide();
    $('body').css("overflow", "scroll");
});
$('#close-cost-btn').on('click', function () {
    $('#costModal').hide();
    $('body').css("overflow", "scroll");
});

$('#new-cui-tab').on('click', function (e) {
    e.preventDefault();
    console.log("Hello");
    $('#new-cui').show();
    $(this).addClass('active');
    $('#existing-cui').hide();
    $('#existing-cui-tab').removeClass('active');
});

$('#existing-cui-tab').on('click', function (e) {
    e.preventDefault();
    $('#existing-cui').show();
    $(this).addClass('active');
    $('#new-cui').hide();
    $('#new-cui-tab').removeClass('active');
    
});

$('#vendorsData').on('click', function (e) {
    e.preventDefault();
    $('#vendordetails').addClass('active');
    $('#project-btn-panel').hide();
    $('#vendor-btn-panel').show();
    $('#projectdetails').removeClass('active');
    // $('#new-cui-tab').removeClass('active');
    
});

$('#projectData').on('click', function (e) {
    e.preventDefault();
    $('#projectdetails').addClass('active');
    $('#vendor-btn-panel').hide();
    $('#project-btn-panel').show();
    $('#vendordetails').removeClass('active');
    
});

$('#enableEdit').on('click', function (e) {
    e.preventDefault();
    $("#cpi").attr('readonly', false);
    $("#loi").attr('readonly', false);
    $("#required_completes").attr('readonly', false);
    $("#fki_client_id").attr('disabled', false);
    $("#type").attr('disabled', false);
    $("#fki_country_id").attr('disabled', false);
    $("#ir").attr('readonly', false);
    $("#client_survey_url").attr('readonly', false);
    $('#disableEdit').show();
    $('#psubmit').show();
    $('#cancel').show();
    $(this).hide();
});

$('#disableEdit').on('click', function (e) {
    e.preventDefault();
    $("#cpi").attr('readonly', true);
    $("#loi").attr('readonly', true);
    $("#required_completes").attr('readonly', true);
    $("#fki_client_id").attr('disabled', true);
    $("#type").attr('disabled', true);
    $("#fki_country_id").attr('disabled', true);
    $("#ir").attr('readonly', true);
    $("#client_survey_url").attr('readonly', true);
    $('#enableEdit').show();
    $('#psubmit').hide();
    $('#cancel').hide();
    $(this).hide();
});

$('#enableVendorEdit').on('click', function (e) {
    e.preventDefault();
    $("#vendor").attr('readonly', false);
    $("#v_cpi").attr('readonly', false);
    $("#v_required_completes").attr('readonly', false);
    $("#v_complete_url").attr('readonly', false);
    $("#v_disqualify_url").attr('readonly', false);
    $("#v_quotafull_url").attr('readonly', false);
    $("#v_quality_term_url").attr('readonly', false);
    $('#disableVendorEdit').show();
    $('#vsubmit').show();
    $('#vcancel').show();
    $(this).hide();
});

$('#disableVendorEdit').on('click', function (e) {
    e.preventDefault();
    $("#vendor").attr('readonly', true);
    $("#v_cpi").attr('readonly', true);
    $("#v_required_completes").attr('readonly', true);
    $("#v_complete_url").attr('readonly', true);
    $("#v_disqualify_url").attr('readonly', true);
    $("#v_quotafull_url").attr('readonly', true);
    $("#v_quality_term_url").attr('readonly', true);
    $('#enableVendorEdit').show();
    $('#vsubmit').hide();
    $('#vcancel').hide();
    $(this).hide();
});

$('#close-id-btn').on('click', function () {
    $('#idsModal').hide();
});

/* Set the width of the side navigation to 250px */
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

/* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

setTimeout(function(){
    $("div.alert-flash").remove();
}, 5000 );