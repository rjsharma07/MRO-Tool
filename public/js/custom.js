$('#addProject').on('click', function () {
    $('#projectModal').show();
});

$('#close-btn').on('click', function () {
    $('#projectModal').hide();
});
$('.close-btn-bottom').on('click', function () {
    $('#projectModal').hide();
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