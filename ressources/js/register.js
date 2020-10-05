$(document).ready(function () {
    //#5
    $('#promo-select').attr('disabled', 'disabled');
    $('#classe-select').attr('disabled', 'disabled');
    $('#addClasse').attr('disabled', 'disabled');
    $('#btnAddClasse').attr('disabled', 'disabled');
    $('#btnDeleteClasse').attr('disabled', 'disabled');

    //#5
    $('#school-select').change(function () {
        if ($(this).val() != '') {
            $('#promo-select').removeAttr('disabled', 'disabled');
            $("#promo-select").val('');
            $('#promo-select option').show();
            $("#promo-select option:not(.ec_" + $(this).val() + ")").hide();
            $('#show2').show();
            $('#idSchoolForPromo2').val($(this).val());
        } else {
            $('#classe-select').val('');
            $("#promo-select").val('');
            $('#idSchoolForPromo2').val($(this).val());
            $('#classe-select').attr('disabled', 'disabled');
            $('#promo-select').attr('disabled', 'disabled');
            $('#btnDeleteClasse').attr('disabled', 'disabled');
        }
        $('#idDeleteClasse').val('');
        $('#idPromoForClasse').val('');
        $('#addClasse').attr('disabled', 'disabled');
        $('#btnAddClasse').attr('disabled', 'disabled');
    });
    $('#promo-select').change(function () {
        if ($(this).val() != '') {
            $('#classe-select').removeAttr('disabled', 'disabled');
            $("#classe-select").val('');
            $('#classe-select option').show();
            $("#classe-select option:not(.pro_" + $(this).val() + ")").hide();
            $('#show3').show();
            $('#idPromoForClasse').val($(this).val());
            $('#addClasse').removeAttr('disabled', 'disabled');
            $('#btnAddClasse').removeAttr('disabled', 'disabled');
        } else {
            $('#classe-select').val('');
            $('#idPromoForClasse').val($(this).val());
            $("#classe-select").attr('disabled', 'disabled');
            $('#addClasse').attr('disabled', 'disabled');
            $('#btnAddClasse').attr('disabled', 'disabled');
            $('#btnDeleteClasse').attr('disabled', 'disabled');
        }
        $('#idDeleteClasse').val('');
    });
    $('#classe-select').change(function () {
        if ($(this).val() != '') {
            $('#idDeleteClasse').val($(this).val());
            $('#btnDeleteClasse').removeAttr('disabled', 'disabled');
        } else {
            $('#idDeleteClasse').val('');
            $('#btnDeleteClasse').attr('disabled', 'disabled');
        }
    });
});









