$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();

    $( "#addUserForm" ).submit(function( event ) {

        // Stop form from submitting normally
        event.preventDefault();

        // Get some values from elements on the page:
        var username = $('#username').val();
        var pwd = $('#pwd').val();
        var qty = $('#qty').val();

        $.ajax({
            method: "POST",
            url: "/admin/ajaxAddUser",
            dataType: "json",
            data: { prefix: username, password: pwd, quantity: qty }
        })
            .done(function( msg ) {
                alert(msg);
            });
    });

    $("#searchUserList").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#userListTableBody").find("tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

});

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

function ajaxRemoveId(id) {
    $.ajax({
        method: "POST",
        url: "/admin/ajaxRemoveUser",
        dataType: "json",
        data: { id: id }
    })
}

function ajaxPromoteId(id) {
    $.ajax({
        method: "POST",
        url: "/admin/ajaxPromoteUser",
        dataType: "json",
        data: { id: id }
    })
}

function ajaxDemoteId(id) {
    $.ajax({
        method: "POST",
        url: "/admin/ajaxDemoteUser",
        dataType: "json",
        data: { id: id }
    })
}