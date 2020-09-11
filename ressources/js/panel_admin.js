$(document).ready(function() {

    //#1
    $('#btnPromoteUser').attr('disabled', 'disabled');
    $('#btnDemoteUser').attr('disabled', 'disabled');
    $('#btnDeleteUser').attr('disabled', 'disabled');

    //#2
    $('#btnDeleteSubject').attr('disabled', 'disabled')
    $('#btnValidateSubject').attr('disabled', 'disabled')

    //#3
    $('#btnDeleteSchool').attr('disabled', 'disabled');

    //#4
    $('#btnAddPromo').attr('disabled', 'disabled')
    $("#btnDeletePromo").attr('disabled', 'disabled');

    //#5
    $('#promo-select2').attr('disabled', 'disabled');
    $('#classe-select').attr('disabled', 'disabled');
    $('#addClasse').attr('disabled', 'disabled');
    $('#btnAddClasse').attr('disabled', 'disabled');
    $('#btnDeleteClasse').attr('disabled', 'disabled');

    //#6
    $('#btnDeleteLevel').attr('disabled', 'disabled');

    //#1
    //Fonction pour récupérer la valeur du selecteur des utilisateurs puis débloquers les boutons (promote,demote,delete)
    $('#personne-select').change(function (){
        if ($(this).val() != ''){
            $('#btnPromoteUser').removeAttr('disabled', 'disabled');
            $('#btnDemoteUser').removeAttr('disabled', 'disabled');
            $('#btnDeleteUser').removeAttr('disabled', 'disabled');
        } else {
            $('#btnPromoteUser').attr('disabled', 'disabled');
            $('#btnDemoteUser').attr('disabled', 'disabled');
            $('#btnDeleteUser').attr('disabled', 'disabled');
        }
        $('#idUserPromote').val($(this).val());
        $('#idUserDemote').val($(this).val());
        $('#idUserDelete').val($(this).val());
    });

    //#2
    //Fonction pour récupérer la valeur du selecteur de matière puis débloquer le bouton supprimer
    $('#matiere-select').change(function (){
        if ($(this).val() != '') {
            $('#btnDeleteSubject').removeAttr('disabled', 'disabled');
            $('#btnValidateSubject').removeAttr('disabled', 'disabled');
        } else {
            $('#btnDeleteSubject').attr('disabled', 'disabled');
            $('#btnValidateSubject').attr('disabled', 'disabled');
        }
        $('#idDeleteSubject').val($(this).val());
        $('#idValidateSubject').val($(this).val());
    });

    //#3
    $('#ecole-select').change(function(){
       if ($(this).val() != ''){
           $('#btnDeleteSchool').removeAttr('disabled', 'disabled');
       } else {
           $('#btnDeleteSchool').attr('disabled', 'disabled');
       }
        $('#idDeleteSchool').val($(this).val());
    });


    //#4
    $('#ecole-select2').change(function () {
        if ($(this).val() != '') {
            $('#promo-select').removeAttr('disabled', 'disabled');
            $('#promo-select option').show();
            $("#promo-select option:not(.ec_" + $(this).val() + ")").hide();
            $('#show1').show();
            $('#idAddPromo').removeAttr('disabled', 'disabled');
            $('#btnAddPromo').removeAttr('disabled', 'disabled');
        } else {
            $("#promo-select").attr("disabled", "disabled");
            $('#idAddPromo').attr('disabled', 'disabled');
            $('#btnAddPromo').attr('disabled', 'disabled')
        }
        $('#promo-select').val('');
        $('#idDeletePromo').val('');
        $('#idSchoolForAddPromo').val($(this).val());
        $("#btnDeletePromo").attr('disabled', 'disabled');
    });

    $('#promo-select').change(function(){
       if ($(this).val() != ''){
           $('#idDeletePromo').val($(this).val());
           $('#btnDeletePromo').removeAttr('disabled', 'disabled');
       } else {
           $('#idDeletePromo').val('');
           $('#btnDeletePromo').attr('disabled', 'disabled');
       }
    });

    //#5
    $('#ecole-select3').change(function(){
       if ($(this).val() != ''){
           $('#promo-select2').removeAttr('disabled', 'disabled');
           $('#promo-select2 option').show();
           $("#promo-select2 option:not(.ec_" + $(this).val() + ")").hide();
           $('#show2').show();
       } else {
           $('#classe-select').val('');
           $('#classe-select').attr('disabled', 'disabled');
           $('#promo-select2').attr('disabled', 'disabled');

       }
       $('#idDeleteClasse').val('');
       $('#idPromoForClasse').val('');
       $("#promo-select2").val('');
       $('#idSchoolForPromo2').val($(this).val());
       $('#addClasse').attr('disabled', 'disabled');
       $('#btnAddClasse').attr('disabled', 'disabled');
       $('#btnDeleteClasse').attr('disabled', 'disabled');
    });

    $('#promo-select2').change(function (){
       if ($(this).val() != ''){
           $('#classe-select').removeAttr('disabled', 'disabled');
           $('#classe-select option').show();
           $("#classe-select option:not(.pro_" + $(this).val() + ")").hide();
           $('#show3').show();
           $('#addClasse').removeAttr('disabled', 'disabled');
           $('#btnAddClasse').removeAttr('disabled', 'disabled');
       } else {
           $("#classe-select").attr('disabled', 'disabled');
           $('#addClasse').attr('disabled', 'disabled');
           $('#btnAddClasse').attr('disabled', 'disabled');
           $('#btnDeleteClasse').attr('disabled', 'disabled');
       }
       $('#idDeleteClasse').val('');
       $('#classe-select').val('');
       $('#idPromoForClasse').val($(this).val());
    });

    $('#classe-select').change(function (){
       if ($(this).val() != ''){
           $('#btnDeleteClasse').removeAttr('disabled', 'disabled');
       } else {
           $('#btnDeleteClasse').attr('disabled', 'disabled');
       }
        $('#idDeleteClasse').val($(this).val());
    });

    //#6
    $('#niveau-select').change(function(){
       if ($(this).val() != ''){
           $('#btnDeleteLevel').removeAttr('disabled', 'disabled');
       } else {
           $('#btnDeleteLevel').attr('disabled', 'disabled');
       }
        $('#idDeleteLevel').val($(this).val());
    });
});

function btnClickDelete(message, id){
    if(confirm('Êtes-vous sûr de vouloir supprimer : '+ message +' ?')){
        $('#'+id).submit();
        alert('Vous avez bien supprimé : '+ message +'.')
    } else {
        alert('Vous avez annulé l\'action');
    }

}
