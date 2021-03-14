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

$('#new-epo-tab').on('click', function (e) {
    e.preventDefault();
    console.log("Hello");
    $('#new-epo').show();
    $(this).addClass('active');
    $('#existing-epo').hide();
    $('#existing-epo-tab').removeClass('active');
});

$('#existing-epo-tab').on('click', function (e) {
    e.preventDefault();
    $('#existing-epo').show();
    $(this).addClass('active');
    $('#new-epo').hide();
    $('#new-epo-tab').removeClass('active');
    
});