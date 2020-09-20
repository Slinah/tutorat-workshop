function btnClickDeregisterCourse(course, idCours){
    if (confirm("Voulez-vous vous désinscrire de ce cours : " + course + " ?")){
        $('#actionDeregister_'+ idCours).submit();
    } else {
        alert('Vous avez bien annulé l\'action.');
    }
}
