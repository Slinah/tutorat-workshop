// function submitTheForm(){
//     document.getElementById("formulaireCloseCourse").submit();
//     submitTheForm();
// }

function form2form(formA, formB) {
    $(':input[name]', formA).each(function() {
        $('[name=' + $(this).attr('name') +']', formB).val($(this).val())
    })
}

$(function(){
    $('#clore').click(function(){
        form2form($("#formulaireModifyCourse"),$("#formulaireCloseCourse"));
        $("#formulaireModifyCourse").submit();
    });
});
