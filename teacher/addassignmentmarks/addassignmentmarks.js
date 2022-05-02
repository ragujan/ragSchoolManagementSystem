showstudents =()=>{
    const grade = document.getElementById('studentgrade');
   

    let url = "../../teacher/addassignmentmarks/showstudentsassignments.php";
    const form = new FormData();
    form.append("grade_id", grade.value);
    


    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {
            console.log(text);
            document.getElementById('showsomething').innerHTML=text;
            if (text.trim() == "Success") {
                loadshowlessonnotes();

            }

        });
}