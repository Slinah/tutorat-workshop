$(document).ready(function() {
//TODO factoriser le code dans les fonctions
    //#1
    $('#btnPromoteUser').attr('disabled', 'disabled');
    $('#btnDemoteUser').attr('disabled', 'disabled');
    $('#btnDeleteUser').attr('disabled', 'disabled');

    //#2
    $('#btnDeleteSubject').attr('disabled', 'disabled')

    //#3
    $('#btnDeleteSchool').attr('disabled', 'disabled');

    //#4
    $('#btnAddPromo').attr('disabled', 'disabled')
    $("#btnDeletePromo").attr('disabled', 'disabled');

    //#5
    $('#promo-select2').attr('disabled', 'disabled');
    $('#classe-select').attr('disabled', 'disabled');
    $('#btnAddClasse').attr('disabled', 'disabled');
    $('#btnDeleteClasse').attr('disabled', 'disabled');

    //#6
    $('#btnDeleteLevel').attr('disabled', 'disabled');

    //#1
    //Fonction pour récupérer la valeur du selecteur des utilisateurs puis débloquers les boutons (promote,demote,delete)
    $('#personne-select').change(function (){
        if ($(this).val() != ''){
            $('#idUserPromote').val($(this).val());
            $('#idUserDemote').val($(this).val());
            $('#idUserDelete').val($(this).val());
            $('#btnPromoteUser').removeAttr('disabled', 'disabled');
            $('#btnDemoteUser').removeAttr('disabled', 'disabled');
            $('#btnDeleteUser').removeAttr('disabled', 'disabled');
        } else {
            $('#btnPromoteUser').attr('disabled', 'disabled');
            $('#btnDemoteUser').attr('disabled', 'disabled');
            $('#btnDeleteUser').attr('disabled', 'disabled');
        }
    });

    //#2
    //Fonction pour récupérer la valeur du selecteur de matière puis débloquer le bouton supprimer
    $('#matiere-select').change(function (){
        if ($(this).val() != '') {
            $('#idDeleteSubject').val($(this).val());
            $('#btnDeleteSubject').removeAttr('disabled', 'disabled');
        } else {
            $('#btnDeleteSubject').attr('disabled', 'disabled');
        }
    });

    //#3
    $('#ecole-select').change(function(){
       if ($(this).val() != ''){
           $('#idDeleteSchool').val($(this).val());
           $('#btnDeleteSchool').removeAttr('disabled', 'disabled');
       } else {
           $('#btnDeleteSchool').attr('disabled', 'disabled');
       }
    });


    //#4
    $('#ecole-select2').change(function () {
        if ($(this).val() != '') {
            $('#promo-select').removeAttr('disabled', 'disabled');
            $("#promo-select").val('');
            $('#promo-select option').show();
            $("#promo-select option:not(.ec_" + $(this).val() + ")").hide();
            $('#show1').show();
            $('#idSchoolForAddPromo').val($(this).val());
            $('#idAddPromo').removeAttr('disabled', 'disabled');
            $('#btnAddPromo').removeAttr('disabled', 'disabled');
        } else {
            $('#promo-select').val('');
            $('#idSchoolForAddPromo').val($(this).val());
            $("#promo-select").attr("disabled", "disabled");
            $('#idAddPromo').attr('disabled', 'disabled');
            $("#btnDeletePromo").attr('disabled', 'disabled');
            $('#btnAddPromo').attr('disabled', 'disabled')
        }
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
           $("#promo-select2").val('');
           $('#promo-select2 option').show();
           $("#promo-select2 option:not(.ec_" + $(this).val() + ")").hide();
           $('#show2').show();
           $('#idSchoolForPromo2').val($(this).val());

       } else {
           $('#classe-select').val('');
           $("#promo-select2").val('');
           $('#idSchoolForPromo2').val($(this).val());
           $('#classe-select').attr('disabled', 'disabled');
           $('#promo-select2').attr('disabled', 'disabled');
           $('#btnDeleteClasse').attr('disabled', 'disabled');
       }
       $('#idDeleteClasse').val('');
       $('#idPromoForClasse').val('');
       $('#btnAddClasse').attr('disabled', 'disabled');
    });

    $('#promo-select2').change(function (){
       if ($(this).val() != ''){
           $('#classe-select').removeAttr('disabled', 'disabled');
           $("#classe-select").val('');
           $('#classe-select option').show();
           $("#classe-select option:not(.pro_" + $(this).val() + ")").hide();
           $('#show3').show();
           $('#idPromoForClasse').val($(this).val());
           $('#btnAddClasse').removeAttr('disabled', 'disabled');
       } else {
           $('#classe-select').val('');
           $('#idPromoForClasse').val($(this).val());
           $("#classe-select").attr('disabled', 'disabled');
           $('#btnAddClasse').attr('disabled', 'disabled');
           $('#btnDeleteClasse').attr('disabled', 'disabled');
       }
       $('#idDeleteClasse').val('');
    });

    $('#classe-select').change(function (){
       if ($(this).val() != ''){
           $('#idDeleteClasse').val($(this).val());
           $('#btnDeleteClasse').removeAttr('disabled', 'disabled');
       } else {
           $('#idDeleteClasse').val('');
           $('#btnDeleteClasse').attr('disabled', 'disabled');
       }
    });

    //#6
    $('#niveau-select').change(function(){
       if ($(this).val() != ''){
           $('#idDeleteLevel').val($(this).val());
           $('#btnDeleteLevel').removeAttr('disabled', 'disabled');
       } else {
           $('#idDeleteLevel').val('');
           $('#btnDeleteLevel').attr('disabled', 'disabled');
       }
    });

});
