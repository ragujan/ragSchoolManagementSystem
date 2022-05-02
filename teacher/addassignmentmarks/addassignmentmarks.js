showstudents =()=>{
    const grade = document.getElementById('studentgrade');
    console.log(grade.value);

    let url = "../../teacher/addassignmentmarks/showstudentsassignments.php";
    const form = new FormData();
    form.append("grade_id", grade.value);
    


    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {
            console.log(text);
            if (text.trim() == "Success") {
                loadshowlessonnotes();
            }

        });
}