

$(document).ready(
        function() {
            $('.editCustomerLink').css('cursor', 'pointer');
            $('button').css('cursor', 'pointer');
            $('.GeneralButton').css('cursor', 'pointer');
            $('.HiddenFullArticle').css('display', 'none');
            $('#pageTitle2').css('display', 'none');
            $('.reportMonth').css('visibility', 'hidden');
            
        });

function reportValidation() {
    var reportNumber = document.forms["reportForm"]["reportQuery"].value;

    if (reportNumber == '5')
    {
        $('.reportMonth').css('visibility', 'visible');
    } else {
        $('.reportMonth').css('visibility', 'hidden');


    }



}
function editProduct() {

    $('.HiddenFullArticle').css('display', 'block');
    $('#pageTitle2').css('display', 'block');

    $('#fullArticle').css('display', 'none');


}
function editCustomer(id) {
    //    alert($('#edit'+id));
    $('#' + id).css('display', 'none');
    $('#' + id).css('transition', '0.5s');

    $('#edit' + id).css('display', 'table-row');
    $('#edit' + id).css('transition', '0.5s');
    return id;
    //    document.getElementsByTagName('query')

}

function submitEditCustomer(id) {
//        alert(id);
    $('#edit' + id).css('display', 'none');
    $('#' + id).css('display', 'table-row');

}

function validateProductForm() {
    var Category = document.form["editProductForm"]["PCategory"].value;



    if (Category == "0")
    {
        alert("Select Category")
        return false;
    }



}

function validateRegForm()
{
    var x = document.forms["registrationForm"]["em"].value;
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length)
    {
        alert("Not a valid e-mail address");
        return false;
    }
}
function validateLoginForm()
{
    var x = document.forms["LoginForm"]["em"].value;
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length)
    {
        alert("Not a valid e-mail address");
        return false;
    }
}

function validateSubForm()
{
    var x = document.forms["SubForm"]["em"].value;
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length)
    {
        alert("Not a valid e-mail address");
        return false;
    }
    {
        $("#SubForm").valueOf(action, '<?= PROJECT_URL ?>subscribe');
        //        document.forms["SubForm"].action = '<?= PROJECT_URL ?>subscribe';


    }
}

