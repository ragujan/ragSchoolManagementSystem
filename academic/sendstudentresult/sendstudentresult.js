getsubjects=()=>{
    const grade = document.getElementById('studentgrade');
    const showsummitteddiv = document.getElementById('showsubmittedstudents');
    let url = "../../academic/sendstudentresult/getsubjects.php";
    const form = new FormData();
    form.append("grade_id", grade.value);
    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {
            
             showsummitteddiv.innerHTML ="";
             showsummitteddiv.innerHTML = text;
        });
}
window.addEventListener('load',()=>{

})

getstudentresults = ()=>{
    const student = document.getElementById('getstudent');
    

    let url = "../../academic/sendstudentresult/getspecificstudentresults.php";
    const form = new FormData();
    form.append("student_id", student.value);
    fetch(url, { body: form, method: "POST" })
        .then((response) => response.text())
        .then((text) => {
             console.log(text);
             document.getElementById('showsubmittedstudentsresults').innerHTML=text;
        });
}