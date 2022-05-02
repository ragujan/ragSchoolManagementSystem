showstudents = () => {
    const grade = document.getElementById('studentgrade');


    let url = "../../teacher/addassignmentmarks/showstudentsassignments.php";
    const form = new FormData();
    form.append("grade_id", grade.value);



    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {

            document.getElementById('showsomething').innerHTML = text;
            if (text.trim() == "Success") {
                loadshowlessonnotes();

            }

        });
}

window.addEventListener('load', () => {
    const grade = document.getElementById('studentgrade');


    let url = "../../teacher/addassignmentmarks/showstudentsassignments.php";
    const form = new FormData();
    form.append("grade_id", 1);



    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {

            const showsomethingdiv = document.getElementById('showsomething')
            if (showsomethingdiv) {
                showsomethingdiv.innerHTML = text;
                if (text.trim() == "Success") {
                    loadshowlessonnotes();

                }
            }


        });
})

viewassignmentsindividual = (id) => {

    window.location = "../../teacher/addassignmentmarks/viewassignmentsindividual.php?X=" + id;
}